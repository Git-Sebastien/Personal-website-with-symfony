<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
        ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-warning'],'label'=>'Soumettre'])
        ->add('captcha',ReCaptchaType::class)
        ->setMethod('POST');
    }
}   
