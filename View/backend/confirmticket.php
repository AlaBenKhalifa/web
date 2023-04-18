<?php
    include 'C:/xampp/htdocs/web/Controller/TicketC.php';
    $db = config::getConnexion();
    $query = $db->prepare(
    'UPDATE ticket SET Confirmation = :cn WHERE IDTicket= :idc');
    $query->execute([
        'cn' => 'Confirm',
        'idc' => $_GET["IDTicket"]
    ]);
    echo $query->rowCount() . " records UPDATED successfully <br>";
    echo ini_set("25","465");
    $template = "./tickettemplate.php";
    $subject = "Thank you for choosing Cultrify!";
    $headers = array(
        "MIME-Vesrion" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8",
        "From" => "cultrifycultrify@gmail.com"
    );
    $message = file_get_contents($template);
    $email = "mrcrewned@gmail.com";
    mail($email,$subject,$message,$headers);
    //echo '<script>alert("test")</script>';
    header('Location:index.php');
?>