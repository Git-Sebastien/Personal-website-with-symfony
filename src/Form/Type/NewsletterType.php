<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class NewsletterType extends AbstractType 
{

    public function buildForm(FormBuilderInterface $builder, array $options) :void
    {
        $builder
        ->add('email',EmailType::class,[
            'attr' => ['class' => 'form-control'],
            'label' => 'S\'inscrire a la newsletter'
        ])
        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'btn btn-warning'],'label'=>'S\'inscrire'
        ])
        ->setMethod('POST');
    }
}