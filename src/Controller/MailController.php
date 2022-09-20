<?php 

namespace App\Controller;

use App\Entity\Mail;
use DateTimeImmutable;
use Symfony\Component\Form\FormInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{


    public static function sendMail(TemplatedEmail $mail,FormInterface $form,string $to, string $name,string $email, string $subject, string $message) :TemplatedEmail
    {
        $mail
        ->from('Portfolio <elwrci1011@gmail.com>')
        ->to($to)
        ->subject($form->get($subject)->getData())
        ->htmlTemplate('mail/contact.html.twig')
        ->context([
            'expiration_date' => new \DateTime('+7 days'),
            'name' => $form->get($name)->getData(),
            'mail' => $form->get($email)->getData(),
            'subject' => $form->get($subject)->getData(),
            'message' => $form->get($message)->getData(),
        ]);

        return $mail;
    }

    public static function saveMail(Mail $mail_data,FormInterface $form) :void
    {
        $mail_data->setSender($form->get('email')->getData());
        $mail_data->setName($form->get('name')->getData());
        $mail_data->setSubject($form->get('subject')->getData());
        $mail_data->setMessage($form->get('message')->getData());
        $mail_data->setSendedAt(new DateTimeImmutable());
    }
}