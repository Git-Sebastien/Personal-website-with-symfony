<?php

namespace App\Controller;

use App\Entity\ContactMail;
use App\Form\Type\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public $data_decode;
    #[Route('/', name:'base.html.twig')]
    public function index(Request $request,MailerInterface $mailer) : Response
    {
        $contact = new ContactMail();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
            if ($form->isSubmitted()) {
                
                $email = (new TemplatedEmail())
                ->from('elwrci1011@gmail.com')
                ->to('sebastien.ancelin7@gmail.com')
                ->subject($form->get('subject')->getData())
                ->htmlTemplate('mail/contact.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'name' => $form->get('name')->getData(),
                    'mail' => $form->get('email')->getData(),
                    'subject' => $form->get('subject')->getData(),
                    'message' => $form->get('message')->getData(),
                ]);
                $this->addFlash('success', 'Votre message a bien été envoyé');
                $mailer->send($email);  
                return $this->redirect($this->generateUrl('base.html.twig', array('mail' => "send")) . '#contact');
            }
            //Create new form to flush input
            unset($form);
            $form = $this->createForm(ContactType::class);
        return $this->renderForm('base.html.twig',compact('form'));
    }
}
