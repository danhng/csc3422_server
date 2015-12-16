<%@ page import="server.user.User" %>
<%@ page import="server.KennelAppUtilities" %>
<div>
    <h3>Your booking info</h3>
    <% String bookinginfo =  new User(username).status();
        if (bookinginfo.isEmpty()) {
            out.print("You don't have any booking yet.");
        }
    else {
            out.print(KennelAppUtilities.addHtmlNewLines(bookinginfo));
        }%>
</div>