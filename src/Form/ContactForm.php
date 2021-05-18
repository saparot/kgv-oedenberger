<?php

namespace App\Form;

use App\Entity\Executive;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactForm extends AbstractType {

    public function buildForm (FormBuilderInterface $builder, array $options) {
        $builder->add('name', TextType::class, [
            'label_format' => 'Ihr Name',
            'label_attr' => ['class' => 'formRequired'],
            'constraints' => [
                new NotBlank(),
                new Length(['min' => 3]),
            ],
        ])->add('email', EmailType::class, [
            'label_format' => 'E-Mail-Adresse',
            'label_attr' => ['class' => 'formRequired'],
            'constraints' => [
                new NotBlank(),
                new Length(['min' => 3]),
                new Email(),
            ],
        ])->add('request', TextareaType::class, [
            'label_attr' => ['class' => 'formRequired'],
            'label_format' => 'Ihre Anfrage',
            'constraints' => [
                new NotBlank(),
                new Length(['min' => 10]),
            ],
        ]);
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
