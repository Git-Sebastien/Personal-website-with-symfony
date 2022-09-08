<?php

namespace App\Controller;

use App\Entity\ContactMail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/', name:'base.html.twig')]
    public function index(Request $request,MailerInterface $mailer) : Response
    {
        $contact = new ContactMail();
        $error = null;
        $success = null;
        

        $form = $this->createFormBuilder($contact)
            ->add("name", TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom'])
            ->add('email',EmailType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Email'])
            ->add('subject',TextType::class,[
                    'attr' => ['class' => 'form-control','rows' => 8],
                    'label' => 'Sujet'])     
            ->add('message',TextareaType::class,[
                    'attr' => ['class' => 'form-control','rows' => 8],
                    'label' => 'Message'])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-warning'],
                'label' => 'Soumettre'])
            ->setMethod('POST')
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $email = (new TemplatedEmail())
                    ->from('elwrci1011@gmail.com')
                    ->to('sebastien.ancelin7@gmail.com')
                    ->subject($form->get('subject')->getData())
                   
                    // path of the Twig template to render
                    ->htmlTemplate('mail/contact.html.twig')

                    // pass variables (name => value) to the template
                    ->context([
                        'expiration_date' => new \DateTime('+7 days'),
                        'name' => $form->get('name')->getData(),
                        'mail' => $form->get('email')->getData(),
                        'subject' => $form->get('subject')->getData(),
                        'message' => $form->get('message')->getData(),
                    ]);
                    $this->addFlash('success', 'Votre message a bien été envoyé');
                    $success = "Message envoyé avec succés";
                    
                 $mailer->send($email);
                 
            }
            else{
                $error = "Whoops ! Un problème est survenu durant l'envoi du mail";
                $this->addFlash('error', 'Un problème est survenu');
            }
        return $this->renderForm('base.html.twig',compact('form','error','success'));
    }
}
