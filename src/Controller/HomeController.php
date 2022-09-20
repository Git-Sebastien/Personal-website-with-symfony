<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Newsletter;
use App\Entity\ContactMail;
use App\Form\Type\ContactType;
use App\Entity\Mail as Mail_Data;
use App\Form\Type\NewsletterType;
use App\Controller\MailController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name:'base.html.twig')]
    public function index(Request $request,MailerInterface $mailer,ManagerRegistry $doctrine) : Response
    {

        $contact = new ContactMail();
        $form = $this->createForm(ContactType::class,$contact);
        $newsletter = new Newsletter();
        $form_newsletter = $this->createForm(NewsletterType::class,$newsletter);
        $form->handleRequest($request);
        $form_newsletter->handleRequest($request);
       
            if ($form->isSubmitted() && $form->isValid()) {
                $email = new TemplatedEmail();
                
                // SendingMail
                $mail = MailController::sendMail($email,$form,'sebastien.ancelin7@gmail.com','name','email','subject','message');
                $this->addFlash('success', 'Votre message à bien été envoyé');
                $mailer->send($mail);
         
                //Save mail in database
                $entityManager = $doctrine->getManager();
                $mail_data = new Mail_Data();
                MailController::saveMail($mail_data,$form);
                $entityManager->persist($mail_data);
                $entityManager->flush(); 
                //empty array for just having the anchor contact
                return $this->redirect($this->generateUrl('base.html.twig', []) . '#contact');
            }
            //Create new form to flush input
            unset($form);
            unset($form_newsletter);
            $form = $this->createForm(ContactType::class);
            $form_newsletter = $this->createForm(NewsletterType::class);
        return $this->renderForm('base.html.twig',compact('form','form_newsletter'));
    }


    #[Route('/newsletter', name:'newsletter' ,methods: ['POST'])]    
    public function addToNewsletter(ManagerRegistry $doctrine,Request $request) :Response
    {
        $news = $doctrine->getRepository(Newsletter::class);
        $arrayOfEmail = [];
        foreach($news->findAll() as $var){
           $arrayOfEmail[] = $var->getEmail();
        }

        if(!in_array($request->get('newsletter')['email'],$arrayOfEmail)){
            $entityManager = $doctrine->getManager();
            $newsletter_entity = new Newsletter();
            $newsletter_entity->setEmail($request->get('newsletter')['email']); 
            $newsletter_entity->setSubmitAt(new DateTimeImmutable());
            $entityManager->persist($newsletter_entity);
            $entityManager->flush();
            $this->addFlash('mail_exist',true);
            return $this->redirect('/');
        }
        else{
            $this->addFlash('mail_not_exist',true);
        }
    
        return  $this->redirect($this->generateUrl('base.html.twig', []) . '#footer');
    }
}