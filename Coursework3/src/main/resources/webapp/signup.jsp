<div>
    <h3>Sign up</h3>
    If you don't have an account, sign up to book and checkout.
    <form method="post" action="/" >
        Username (case sensitive): <br>
        <input name="username_signup" type="text" required></input>
        <br>
        Password <br>
        <input name="password_signup" type="password" required></input>
        <br/>
        <input type="submit" name="action" value = "signup"/>
    </form>
    <%
        Boolean signingup = (Boolean) request.getSession().getAttribute("signingup");
        if (signingup != null && signingup) {
            Boolean signupOK = (Boolean) request.getSession().getAttribute("signupOK");
            out.println((signupOK) ? "<font color='green'>Signup successful. You could now use the details provided to log in.</font>"
                    :"<font color='red'>Sign up failed!</font>" +
                    "<br/><font color='red'>"+ request.getSession().getAttribute("signupfailmessage")+"</font>");
            request.getSession().setAttribute("signingup", false);
        }
    %>
</div>