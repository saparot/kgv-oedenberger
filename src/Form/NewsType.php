<?php

namespace App\Form;

use App\Entity\News;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewsType extends AbstractType {

    function buildForm (FormBuilderInterface $builder, array $options) {
        $builder->add('title', TextType::class, [
            'label_attr' => ['class' => 'formRequired'],
            'label_format' => 'Titel / Überschrift',
            'constraints' => [
                new NotBlank(),
                new Length(['min' => 5]),
            ],
        ])->add('description', CKEditorType::class, [
            'config' => ['toolbar' => 'full'],
            'label_attr' => ['class' => 'formRequired'],
            'label_format' => 'Inhalt',
            'constraints' => [
                new NotBlank(),
                new Length(['min' => 20]),
            ],
        ])->add('isPublished', ChoiceType::class, [
            'label_attr' => ['class' => 'formRequired'],
            'label' => 'Veröffentlichen',
            'choices' => [
                'Ja, veröffentlichen' => true,
                'Nein, noch nicht veröffentlichen' => false,
            ],
            'expanded' => true, // use a radio list instead of a select input
        ]);
    }

    public function configureOptions (OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
