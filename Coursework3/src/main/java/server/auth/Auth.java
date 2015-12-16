package server.auth;
import server.io.IO;
import server.user.User;

import javax.servlet.http.HttpSession;
import java.util.HashMap;

/**
 * Simple auth implementation for the website.
 * @author Danh Nguyen <d.t.nguyen@newcastle.ac.uk>
 */
public class Auth {

    // error codes
    public static final int USER_PW_WRONG = 2;
    public static final int USER_ALREADY_ACTIVE = 4;
    public static final int NO_USER_ACTIVE = 8;

    /**
     * Sign up action
     * @param usr the username
     * @param password the password
     * @return true if signup is successful, false otherwise
     */
    public static boolean signup(String usr, String password) {
        // check if username has already been picked
        if (AuthStorage.usernamePicked(usr)) {
            System.out.println(usr + " picked");
            return false;
        }
        // flush record to the auth storage
        AuthStorage.add(usr, password);
        // flush the user info (booking details) to storage as well
        IO.writeSerialisedObject(User.getFileInfoName(usr), new HashMap<String, String>());
        return true;
    }

    /**
     * Perform login
     * @param user username
     * @param password password
     * @return status code (success, already logged in or failed)
     */
    public static int login(String user, String password) {
        boolean userPwOK = AuthStorage.usernamePicked(user) && AuthStorage.getPassword(user).equals(password);
        // test if user is already being active
        boolean userActive = AuthStorage.getActives().contains(user);
        System.out.println(user + " active? " + userActive);
            if (userPwOK) {
                if (!userActive) {
                    // mark the user as active
                    AuthStorage.active(user);
                    return 0;
                }
                return USER_ALREADY_ACTIVE;
            }
        else {
                return USER_PW_WRONG;
            }
    }

    /**
     * Perform logout
     * @param user username
     * @param session session
     * @return status code (success or no user active to log out)
     */
    public static int logout(String user, HttpSession session) {
        int status = 0;
        // test if no user is currently logged in
        if (!(Boolean)session.getAttribute("hasuser") && session.getAttribute("user") != null && !AuthStorage.getActives().contains(user)) {
            System.out.println("Warning. No user active");
            status = NO_USER_ACTIVE;
        }
        // perform session clean up for logout
        session.setAttribute("hasuser", false);
        session.setAttribute("user", null);
        // mark the user as not active.
        AuthStorage.deactive(user);
        return status;
    }
}
