<?php

namespace App\Form;

use App\Entity\Post;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $submitLabel = new TranslatableMessage('Créer');
        $builder
            ->add('title', TextType::class)
            ->add('content', CKEditorType::class, [
                'config_name' => 'content_config',
            ])
            ->add('created_at', DatePickerType::class)
            ->add('updated_at', DatePickerType::class)
            ->add('submit', SubmitType::class, [
                'label' => $submitLabel
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
