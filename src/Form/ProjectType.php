<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',null, [
                'label' => 'Titre',
            ])
            ->add('description', null, [
                'label' => 'Déscription',
            ])
            ->add('urlFile', VichFileType::class, [
                'label' => 'Sélectionner une image',
                'required'      => true,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
            ->add('date', DateType::class, [
                'label' => 'Date du projet',
                'placeholder' => [
                    'year' => 'Année',
                    'month' => 'Mois',
                ],
                'html5' => false,
                'format' => 'd M y',
            ])
            ->add('categories', null, [
                'choice_label' => 'name',
                'label' => 'Catégories'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
