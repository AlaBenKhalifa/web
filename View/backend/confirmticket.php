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
    $a = $_GET["IDTicket"];
    $template = "./tickettemplate.php";
    $subject = "Thank you for choosing Cultrify!";
    $headers = array(
        "MIME-Vesrion" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8",
        "From" => "cultrifycultrify@gmail.com"
    );
    $message = file_get_contents($template);
    $word_to_replace = "Hello World";
    $replacement_word = $a;
    $message = str_replace($word_to_replace, $replacement_word, $message);
    $email = $_GET["email"];
    mail($email,$subject,$message,$headers);
    header('Location:index.php');
?>