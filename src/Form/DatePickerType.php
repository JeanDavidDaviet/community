<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatePickerType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required' => false,
            'widget' => 'single_text',
            'html5' => false,
            'attr' => [
                'class' => 'js-datepicker'
            ],
            'format' => 'yyyy-MM-dd',
        ]);
    }

    public function getParent(): string
    {
        return DateType::class;
    }
}
