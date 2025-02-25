<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Entities\Mail;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";


//////////////////////////
// CLASSE MODEL DE MAIL //
//////////////////////////
class MailModel
{
    ///////////////////////////////////////////////////////
    // METHODE POUR ENVOYER UN MAIL DE REINITIAILISATION //
    ///////////////////////////////////////////////////////
    public function mdpForgot(Mail $majMdpMail)
    {
        try {
            // INSTANCIATION D'UN OBJET PHP MAILER (true pour l'activation des exceptions)
            $mail = new PHPMailer(true);

            // PARAMETRE DU MAIL
            $mail->isHTML(true); // Email en format HTML
            $mail->CharSet = "UTF-8"; // Définit l'encodage en UTF-8
            //$mail->Encoding = "base64"; // Encodage en base64

            // PARAMETRE DU SERVEUR SMTP (MailTrap)
            $mail->isSMTP(); // Utilisation du serveur SMTP
            $mail->Host = "sandbox.smtp.mailtrap.io"; // Hôte SMTP de MailTrap
            $mail->SMTPAuth = true; // Activation de l'authentification SMTP
            $mail->Username = "eee6221abfc8ee"; // Votre nom d'utilisateur MailTrap
            $mail->Password = "f24cb7d97b6076"; // Votre mot de passe MailTrap
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sécurisation via STARTTLS
            $mail->Port = 2525; // Port SMTP (vous pouvez utiliser 25, 465, 587 ou 2525)

            // ADRESSE DE L'EXPEDITEUR
            $mail->setFrom("support@backoffice.fr", "Support BACK OFFICE");

            // ADRESSE DU DESTINATAIRE
            $mail->addAddress($majMdpMail->getEmail());

            // SUJET DE MAIL
            $mail->Subject = "BACK OFFICE - Réinitialisation de votre mot de passe";

            // IMAGE DANS LE CORPS DU MAIL
            $mail->AddEmbeddedImage("../public/img/mail/font.jpg", "font");

            // CORPS DU MAIL
            $prenomNom = $majMdpMail->getPrenom() . " " . $majMdpMail->getNom();
            $token = $majMdpMail->getToken();
            ob_start();
            include "../app/views/email/mailForgotPassword.php";
            $html = ob_get_clean();

            $mail->Body = $html;            

            // ENVOI DU MAIL
            return $mail->send();

        } catch (Exception $e) {
            echo $mail->ErrorInfo;
            die;
            return false;
        }
    }
}