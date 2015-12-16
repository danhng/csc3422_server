<!DOCTYPE html>
<html lang="en">
<%@ page session="true" %>
<%@page import="uk.ac.ncl.csc3422.kennelbooking.*" %>
<%@page import="server.*" %>
<%Kennel kennel = (Kennel) request.getSession().getAttribute("kennel");%>
<head>
    <meta charset="UTF-8">
    <title>Kennel Booking</title>
</head>
<body>

<h2>Welcome to kennel booking page.</h2>

<% Boolean hasuser = (Boolean) request.getSession().getAttribute("hasuser");
    String username = (String) request.getSession().getAttribute("user");%>

<% if (hasuser) {
    out.print("Hello " + username + "! Have a good day with your puppies!");
%>
<%@include file="logout.jsp" %>
<%} %>

<p>
    Today's date: <%= (new java.util.Date()).toLocaleString()%>
</p>

<div>
    <%
        if (kennel.getVacancies()) {
            out.println("<font color='green'>There are vacancies available!</font>");
        } else {
            out.println("<font color='red'>No vacancies are available at the moment!</font>");
        }
    %>
</div>

<div>
    <h3>Kennel details</h3>
    <%= KennelAppUtilities.addHtmlNewLines(KennelReport.generateReport(kennel)) %>
</div>

<% if (hasuser) { %>
<%@include file="user_info.jsp" %>
<%@include file="user_actions.jsp" %>

<% } else { %>
<%@include file="login.jsp" %>
<%@include file="signup.jsp" %>
<% } %>

</body>
</html>