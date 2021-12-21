<?php

namespace App\Form;

use DateTime;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CreatePostType extends PostType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $entity = $event->getData();

                if (!$entity) {
                    return;
                }

                $created_at = $entity['created_at'];

                if (empty($created_at)) {
                    $default_created_at = new DateTime();
                    $entity['created_at'] = $default_created_at->format('Y-m-d');
                    $event->setData($entity);
                }
            })
        ;
    }
}
