<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{

    /**
     * @Route("/mail")
     */
    public function mailAction()
    {

        // création d'un message
        $message = new \Swift_Message(); // pas de namespace // on créé un message avec des méthodes fournis

        $logo = \Swift_Image::fromPath( // on veut ajouter une image à notre mail donc on créé une pièce jointe (image) ici $logo
            __DIR__ . '/../../../web/apple-touch-icon.png' // chemin vers une image se trouvant dans le projet
        );
        $logo->setDisposition('inline'); // attachment pour le mettre en pièce jointe, inline pour le glisser dans le mail
        $cid = $message->embed($logo); // là on demande d'attacher l'image au message, le CID qui est généré doit être placé dans le template
        // on met le nom qu'on veut mais on appel ça un CID donc là on a écrit la variable ainsi

        //Swift_Attachment pour envoyer en pièce jointe une pièce autre qu'une image
        $attachment = \Swift_Attachment::fromPath(__DIR__ . '/../Entity/IdTrait.php');
        $message->attach($attachment);

        // on va générer la vue avec les paramètres que l'on a récupérés et créés
        $mail = $this->renderView('contact/email.html.twig', [
            'author' => 'Moi',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'logo' => $cid,
        ]);

        // création d'un contenu // on configure donc
        $message
            ->setSubject('Contact depuis Terre Natale')
            ->setFrom('no-reply@terre-natale.com', 'Terre Natale')// c'est mon appli qui envoie mon mail
            ->setTo('admin@rpg.com', 'Admin Terre Natale')// c'est le destinataire
            ->setBody($mail, 'text/html', 'utf-8');

        // on charge le mailer de symfony d'envoyer notre message // on envoie
        $mail = $this->get('mailer')->send($message); //$mail à 1 si envoyé

        return $this->redirectToRoute('app_default_index');
    }

}