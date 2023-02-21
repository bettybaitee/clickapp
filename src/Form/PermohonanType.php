<?php

namespace App\Form;

use App\Entity\Permohonan;
use App\Entity\Rujukan;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermohonanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tajuk')
            ->add('sor', CKEditorType::class, [
                'config' => [
                    'uiColor' => '#e2e2e2',
                    'toolbar' => 'full',
                    'required' => true,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Permohonan::class,
        ]);
    }
}
