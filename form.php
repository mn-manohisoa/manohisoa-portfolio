<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST["name"], $_POST["email"], $_POST["subject"], $_POST["message"])) {
    $nom = $_POST["name"];
    $destinataire = "mn.manohisoa@gmail.com";
    $expediteur = $_POST["email"];
    $objet = $_POST["subject"];
    $message = $_POST["message"];
    $notification = "Merci pour votre message, je l'ai bien reçu !";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $destinataire;
        $mail->Password   = 'blbf qikh tbgg uvjp' ;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($expediteur, $nom);
        $mail->addAddress($destinataire);

        $mail->Subject = $objet;
        $mail->Body    = $message;
        $mail->send();

        // Envoi notification
        $mail->clearAddresses();
        $mail->addAddress($expediteur);
        $mail->Subject = "Confirmation de réception de votre message";
        $mail->Body    = $notification;
        $mail->send();

        echo "Message envoyé avec succès !";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
    }
} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}
?>
