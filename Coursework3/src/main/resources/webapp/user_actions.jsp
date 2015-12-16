
<div>
    <h3>Booking form</h3>
    <form method="post" action="/" >
        Dog name (Case insensitive): <br>
        <input name="dogname" type="text" required value=${dogname}> </input>
        <br>
        Dog size: <br>
        <input name="dogsize" type="number" min="1" max="3" required value=${dogsize}></input>
        <br/>
        <input type="submit" name="action" value = "Book"/>
    </form>
    <%
        Boolean booking = (Boolean) request.getSession().getAttribute("booking");
        if (booking) {
            Boolean bookOK = (Boolean) request.getSession().getAttribute("bookOK");
            out.println((bookOK) ? "<font color='green'>Booking successful!</font>"
                    :"<font color='red'>Booking failed!</font>" +
                    "<br/><font color='red'>"+ request.getSession().getAttribute("bookfailmessage")+"</font>");
            request.getSession().setAttribute("booking", false);
        }
    %>
</div>

<div>
    <h3>Checkout form</h3>
    <form method="post" action="/kennel" >
        Dog name: <br>
        <input name="dogname_checkout" type="text" required value=${dogname_checkout}> </input>
        <br/>
        <input type="submit" name="action" value = "Checkout"/>
    </form>
    <%
        Boolean checkingout = (Boolean) request.getSession().getAttribute("checkingout");
        if (checkingout) {
            Boolean checkoutOK = (Boolean) request.getSession().getAttribute("checkoutOK");
            out.println((checkoutOK) ? "<font color='green'>Checkout successful!</font>"
                    :"<font color='red'>Checkout failed! The dog might have not been booked yet.</font>");
            request.getSession().setAttribute("checkingout", false);
        }

    %>
</div>