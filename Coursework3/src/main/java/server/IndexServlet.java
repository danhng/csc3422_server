package server;

import server.auth.Auth;
import server.user.User;
import uk.ac.ncl.csc3422.kennelbooking.*;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.lang.reflect.InvocationTargetException;

/**
 * Handle requests from base address i.e. localhost/
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 */
public class IndexServlet extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        resumeContext(req);
        // set post actions attributes as false
        req.getSession().setAttribute("booking", false);
        req.getSession().setAttribute("checkingout", false);
        req.getSession().setAttribute("loggingin", false);
        req.getRequestDispatcher("/index.jsp").forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        String action = req.getParameter("action").toLowerCase();
        resumeContext(req);
        try {
            // handle request with corresponding method.
            this.getClass().getDeclaredMethod(action, HttpServletRequest.class).invoke(this, req);
        } catch (IllegalAccessException e) {
            e.printStackTrace();
        } catch (InvocationTargetException e) {
            e.printStackTrace();
        } catch (NoSuchMethodException e) {
            e.printStackTrace();
        }
        req.getRequestDispatcher("/index.jsp").forward(req, resp);
    }

    /**
     * handle logout requests from clients
     * @param req the request from client
     */
    private void logout(HttpServletRequest req) {
        Auth.logout(getUsername(req.getSession()), req.getSession());
    }

    /**
     * handle signup requests from clients
     * @param req the request from client
     */
    private void signup(HttpServletRequest req) {
        if (isSigningup(req)) {
            req.getSession().setAttribute("signingup", true);
            String username = req.getParameter("username_signup");
            String password = req.getParameter("password_signup");
            boolean r = Auth.signup(username, password);
            if (!r) {
                req.getSession().setAttribute("signupfailmessage", "Username \"" + username + "\" has been picked. Please choose another username.");
            }
            req.getSession().setAttribute("signupOK", r);
        }
        else {
            KennelAppUtilities.logReq(req, "Signup request not received! But the request is post with action signup.");
            req.getSession().setAttribute("signingup", false);
        }
    }

    /**
     * Handle login from client
     * @param req the request from client
     */
    private void login(HttpServletRequest req) {
        if (isLoggingin(req)) {

            req.getSession().setAttribute("loggingin", true);

            String username = req.getParameter("username");
            String password = req.getParameter("password");
            System.out.println("Login request received /" + username + "/" + password + "/");

            int r = Auth.login(username, password);
            KennelAppUtilities.logReq(req, "Login r from " + username + ": " + r);
            KennelAppUtilities.logReq(req, "Has user " + hasUser(req.getSession()));
            KennelAppUtilities.logReq(req, "Session ID: " + req.getSession().getId());
            switch (r) {
                case Auth.USER_PW_WRONG: {
                    req.getSession().setAttribute("loginOK", false);
                    req.getSession().setAttribute("hasuser", false);
                    req.getSession().setAttribute("loginfailmessage", "Username and password combination is incorrect");
                    break;
                }
                case Auth.USER_ALREADY_ACTIVE: {
                    // set back the user for this session
                    req.getSession().setAttribute("loginfailmessage", username + " already logged in!");
                    break;
                }
                case 0: {
                    req.getSession().setAttribute("loginOK", true);
                    req.getSession().setAttribute("user", username);
                    req.getSession().setAttribute("hasuser", true);
                    break;
                }
            }
        } else {
            KennelAppUtilities.logReq(req, "Login request not received! But the request is post with action login.");
            req.getSession().setAttribute("loggingin", false);
        }
    }

    /**
     * handle book requests from client
     * @param req the request from client
     */
    private void book(HttpServletRequest req) {
        Kennel contextKennel = getKennel(req);
        if (isBooking(req)) {
            // is booking so set the booking attr to true
            String dogName = req.getParameter("dogname");
            int dogSize = Integer.valueOf(req.getParameter("dogsize"));

            System.out.println("Booking request received!");
            req.getSession().setAttribute("booking", true);
            req.getSession().setAttribute("dogname", dogName);
            req.getSession().setAttribute("dogsize", String.valueOf(dogSize));
            if (KennelAppUtilities.isDogNameUsed(contextKennel, dogName)) {
                req.getSession().setAttribute("bookOK", false);
                req.getSession().setAttribute("bookfailmessage", "The name " + dogName + " has been used!");
            } else {
                Pen p = (new User(getUsername(req.getSession()))).bookADog(dogSize, dogName, contextKennel, req);
                if (p != null) {
                    req.getSession().setAttribute("bookOK", true);
                } else {
                    req.getSession().setAttribute("bookOK", false);
                    if (contextKennel.getVacancies()) {
                        req.getSession().setAttribute("bookfailmessage", "There is no pen available for the dog!");
                    } else {
                        req.getSession().setAttribute("bookfailmessage", "The kennel is full!");
                    }
                }
            }
        } else {
            System.out.println("Booking request not received! But the request is post.");
            req.getSession().setAttribute("booking", false);
        }
    }

    /**
     * handle checkout requests from clients
     * @param req the request from client
     */
    private void checkout(HttpServletRequest req) {
        Kennel contextKennel = getKennel(req);
        if (isCheckingout(req)) {
            // is checking out so set the booking attr to true
            String dogName = req.getParameter("dogname_checkout");
            System.out.println("Checkout request received!");
            req.getSession().setAttribute("checkingout", true);
            req.getSession().setAttribute("dogname_checkout", dogName);
            req.getSession().setAttribute("checkoutOK", (new User(getUsername(req.getSession())).checkoutADog(dogName, contextKennel, req)));
        } else {
            System.out.println("Checkout request not received! But the request is post.");
            req.getSession().setAttribute("checkingout", false);
        }
    }

    private boolean isBooking(HttpServletRequest req) {
        return req.getMethod().equalsIgnoreCase("post") && (req.getParameter("dogname") != null)
                && (req.getParameter("dogsize") != null) && (req.getParameter("action").equalsIgnoreCase("book"));
    }

    private boolean isCheckingout(HttpServletRequest req) {
        return req.getMethod().equalsIgnoreCase("post") && (req.getParameter("dogname_checkout") != null)
                && (req.getParameter("action").equalsIgnoreCase("checkout"));
    }

    private boolean isLoggingin(HttpServletRequest req) {
        return req.getMethod().equalsIgnoreCase("post") && (req.getParameter("username") != null)
                && (req.getParameter("password") != null)
                && (req.getParameter("action").equalsIgnoreCase("login"));
    }

    private boolean isSigningup(HttpServletRequest req) {
        return req.getMethod().equalsIgnoreCase("post") && (req.getParameter("username_signup") != null)
                && (req.getParameter("password_signup") != null)
                && (req.getParameter("action").equalsIgnoreCase("signup"));
    }

    private boolean hasUser(HttpSession session) {
        return (Boolean) session.getAttribute("hasuser");
    }

    private String getUsername(HttpSession session) {
        return (String) session.getAttribute("user");
    }

    /**
     * resume all required attributes for a session, or initialise them
     * @param req the request from client
     */
    private void resumeContext(HttpServletRequest req) {
        getKennel(req);
        getSessionAttribute(req.getSession(), "dogname", "");
        getSessionAttribute(req.getSession(), "dogsize", "");
        getSessionAttribute(req.getSession(), "dogsize_checkout", "");
        getSessionAttribute(req.getSession(), "hasuser", false);
        getSessionAttribute(req.getSession(), "user", null);
    }

    private Kennel getKennel(HttpServletRequest req) {
        Kennel kennel = (Kennel) req.getSession().getAttribute("kennel");
        if (kennel != null)
            return kennel;
        else {
            req.getSession().setAttribute("kennel", KennelFactory.initialiseKennel());
            return (Kennel) req.getSession().getAttribute("kennel");
        }
    }

    /**
     * get a session attribute
     * @param session the session
     * @param name the name  of the attribute
     * @param def the default value for the attribute
     * @param <T> type of the attribute
     * @return the value of attribute, or its default value
     */
    private <T> T getSessionAttribute(HttpSession session, String name, T def) {
        T value = (T) session.getAttribute(name);
        if (value != null) {
            return value;
        }
        session.setAttribute(name, def);
        return (T) session.getAttribute(name);
    }
}
