<?php
// Importation des classes PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Vérification si un email est bien envoyé via POST
if (isset($_POST['mail'])) {
    $email = trim($_POST['mail']); // Nettoyage des espaces
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide !");
    }

    // Inclusion des fichiers PHPMailer
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    // Création d'une instance de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'abrarbouslahi100@gmail.com'; // Remplacez par votre email
        $mail->Password   = 'jtyuzshkgwssekhz'; // ⚠️ Utilisez un mot de passe d'application Google !
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Expéditeur & Destinataire
        $mail->setFrom('abrarbouslahi100@gmail.com', 'Test');
        $mail->addAddress($email); // Ajout du destinataire

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation RDV';
        $mail->Body    = '<b>Votre RDV est confirmé.</b>';
        $mail->AltBody = 'Votre RDV est confirmé.';

        // Envoi du mail
        $mail->send();
        echo 'Message envoyé avec succès !';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
    }
} else {
    echo "Aucune adresse email fournie.";
}
