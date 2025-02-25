<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Entities\Mail as Mail;


//////////////////////////
// CLASSE MODEL DE MAIL //
//////////////////////////
class MailModel
{
    ///////////////////////////////////////////////////////
    // METHODE POUR ENVOYER UN MAIL DE REINITIAILISATION //
    ///////////////////////////////////////////////////////
    public function mdpForget(Mail $majMdpMail)
    {
        try {
            // INSTANCIATION D'UN OBJET PHP MAILER (true pour l'activation des exceptions)
            $mail = new PHPMailer(true);

            // PARAMETRE DU MAIL
            $mail->isHTML(true); // Email en format HTML
            $mail->CharSet = "UTF-8"; // Définit l'encodage en UTF-8

            // ADRESSE DE L'EXPEDITEUR
            $mail->setFrom("support@cefii-developpements.fr", "Support CEFII");

            // ADRESSE DU DESTINATAIRE
            $mail->addAddress($majMdpMail->getEmail());

            // SUJET DE MAIL
            $mail->Subject = "Ma Bibliothèque - Réinitialisation de votre mot de passe";

            // IMAGE DANS LE CORPS DU MAIL
            $mail->AddEmbeddedImage("../public/images/mail/font.jpg", "font");

            // CORPS DU MAIL
            $prenomNom = $majMdpMail->getPrenom() . " " . $majMdpMail->getNom();
            $token = $majMdpMail->getToken();
            ob_start();
            include "../views/email/mailNewMDP.php";
            $html = ob_get_clean();

            $mail->Body = $html;            

            // ENVOI DU MAIL
            return $mail->send();

        } catch (Exception $e) {
            //echo $mail->ErrorInfo;
            //die;
            return false;
        }
    }
}