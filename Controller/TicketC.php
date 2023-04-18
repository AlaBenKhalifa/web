<?php

include 'C:/xampp/htdocs/web/config.php';
include 'C:/xampp/htdocs/web/Model/Ticket.php';

class TicketC 
{
    public function listTicket()
    {
        $sql = "SELECT * FROM ticket";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function showTicket($id)
    {
        $sql = "SELECT * from Ticket where IDTicket = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $ticket = $query->fetch();
            return $ticket;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addTicket($ticket)
    {
        $sql = "INSERT INTO ticket 
        VALUES (:idt,:nmt,:fn,:ln,:cp,:ev,:pd,:pt,'Pending')";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':idt' => $ticket->getIDTicket(),
                ':nmt' => $ticket->getNumTickets(),
                'fn' => $ticket->getFirstName(),
                'ln' => $ticket->getLastName(),
                'cp' => $ticket->getCoupon(),
                'ev' => $ticket->getEvent(),
                'pd' => $ticket->getPickupDate()->format('Y/m/d'),
                'pt' => $ticket->getPickupTime()->format('H:i')
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function updateticket($tickett, $id)
    {
        try {
            $db = config::getConnexion();
            echo('<script>alert("test")</script>');
            $query = $db->prepare(
                'UPDATE ticket SET
                    NumTickets = :nt,
                    FirstName = :fn, 
                    LastName = :ln,
                    Coupon = :cp,
                    Event = :ev,
                    PickupDate = :pd,
                    PickupTime = :pt
                WHERE IDTicket = :id'
            );
            $query->execute([
                'id' => $id,
                'nt' => $tickett->getNumTickets(),
                'fn' => $tickett->getFirstName(),
                'ln' => $tickett->getLastName(),
                'cp' => $tickett->getCoupon(),
                'ev' => $tickett->getEvent(),
                'pd' => $tickett->getPickupDate()->format('Y/m/d'),
                'pt' => $tickett->getPickupTime()->format('H:i')
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function deleteTicket($id)
    {
        $sql = "DELETE FROM Ticket WHERE IDTicket = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}