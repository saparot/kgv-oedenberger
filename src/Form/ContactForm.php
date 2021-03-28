<?php

namespace App\Form;

use App\Entity\Executive;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactForm extends AbstractType {

    public function buildForm (FormBuilderInterface $builder, array $options) {
        $builder->add('Name')->add('E-Mail-Adresse')->add('Anfrage', TextareaType::class);
        //using reCaptcha
        //https://packagist.org/packages/excelwebzone/recaptcha-bundle
        $builder->add('recaptcha', EWZRecaptchaType::class, [
            'attr' => [
                'options' => [
                    'theme' => 'light',
                    'type' => 'image',
                    'size' => 'normal',
                    'defer' => true,
                    'async' => true,
                ],
            ],
        ]);
    }

    public function configureOptions (OptionsResolver $resolver) {
        $resolver->setDefaults([]);
    }
}
