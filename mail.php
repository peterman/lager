<?php
$empfaenger = "admin@pfeiffer-privat.de";
$betreff = "Die Mail-Funktion";
$from = "From: Vorname Nachname <absender@domain.de>\r\n";
$from .= "Reply-To: antwort@domain.de\r\n";
$from .= "Content-Type: text/html\r\n";
$text = "Hier lernt Ihr, wie man mit <b>PHP</b> Mails
verschickt";
 
mail($empfaenger, $betreff, $text, $from);
?>