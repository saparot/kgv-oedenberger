<?php

namespace App\Form;

use App\Entity\DownloadFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DownloadFileUploadFormType extends AbstractType {

    public function buildForm (FormBuilderInterface $builder, array $options) {
        $builder->add('name', TextType::class, [
            'label_format' => 'Name des Eintrages',
            'label_attr' => ['class' => 'formRequired'],
            'attr' => [
                'placeholder' => 'z.B. Aufnahmeantrag',
            ],
            'constraints' => [
                new NotBlank(),
                new Length(['min' => 3]),
            ],
        ]);
        $builder->add('description', TextareaType::class, [
            'label_format' => 'Name des Eintrages',
            'label_attr' => ['class' => 'formRequired'],
            'attr' => [
                'placeholder' => 'z.B. Falls Sie gerne Mitglied in unserem Verein werden moechten, senden Sie uns bitte das ausgefüllte Formluar per E-Mail zu.',
            ],

            'constraints' => [
                new NotBlank(),
                new Length(['min' => 10]),
            ],
        ]);
        //$builder->add('fileName');
        $builder->add('fileObject', VichFileType::class, [
            'label_format' => 'Datei die zum Download angeboten wird',
            'required' => true,
            'asset_helper' => true,
            'attr' => [
                'placeholder' => 'hier bitte die Datei vom Computer auswählen',
            ],

        ]);
    }

    public function configureOptions (OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => DownloadFile::class,
        ]);
    }
}
