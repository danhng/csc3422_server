<div>
    <h3>Login</h3>
    Login to book and checkout.
    <form method="post" action="/" >
        Username (case sensitive): <br>
        <input name="username" type="text" required></input>
        <br>
        Password <br>
        <input name="password" type="password" required></input>
        <br/>
        <input type="submit" name="action" value = "login"/>
    </form>
    <%
        Boolean loggingin = (Boolean) request.getSession().getAttribute("loggingin");
        if (loggingin != null && loggingin) {
            Boolean bookOK = (Boolean) request.getSession().getAttribute("loginOK");
            out.println((bookOK) ? "<font color='green'>Login successful. Redirecting to home..</font>"
                    :"<font color='red'>Login failed!</font>" +
                    "<br/><font color='red'>"+ request.getSession().getAttribute("loginfailmessage")+"</font>");
            request.getSession().setAttribute("loggingin", false);
        }
    %>
</div>