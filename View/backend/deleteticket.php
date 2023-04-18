<?php
include 'C:/xampp/htdocs/web/Controller/TicketC.php';
$ticketc = new TicketC();
$ticketc->deleteTicket($_GET["IDTicket"]);
header('Location:index.php');
?>