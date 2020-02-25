<?php 
include "inc/header.php";

    $to = "pisucca11@gmail.com";

    $subject = 'Email di conferma ForumJuve';

    $headers = "From: ForumJuve \r\n";
    $headers .= "Reply-To: Te \r\n";
    $headers .= "CC: pisucca11@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = '<html><body>Ciao, benvenuto su ForumJuve!<br>Conferma il tuo indirizzo email e inizia subito a partecipare al Forum!<br><br>';
    $message .= 'Link conferma <br> <a href="https://forumjuve.cf/inc/email-verify?email?token=token">https://forumjuve.cf/inc/email-verify?email?token=token</a><br><br>Se non hai fatto nessuna iscrizione cestina questa mail.<br><br>';
    $message .= '</body>Matteo Galavotti (moonmatt) | Founder e developer di ForumJuve</html>';
    mail($to, $subject, $message, $headers);
?>
