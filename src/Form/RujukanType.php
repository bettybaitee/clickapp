<?php

namespace App\Form;

use App\Entity\Rujukan;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RujukanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nama')
            ->add('template', CKEditorType::class, [
                'config' => [
                    'uiColor' => '#e2e2e2',
                    'toolbar' => 'full',
                    'required' => true,
                    /*'extraPlugins' => 'wordcount,notification',
                    'wordcount' => [
                        'showParagraphs' => false,
                        'showWordCount' => true,
                        'maxWordCount' => 100
                    ]*/
                ],
            ])
            ->add('flag')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rujukan::class,
        ]);
    }
}
