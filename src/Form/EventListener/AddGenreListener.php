<?php

namespace App\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddGenreListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
//            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::POST_SET_DATA => 'onPostSetData',
//            FormEvents::POST_SUBMIT => 'onPostSubmit',
//            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPostSetData(FormEvent $event):void
    {
        $form = $event->getForm();
        $data = $event->getData();

        if ($data->getType() == 'movie') {
            $form->add(
                "genre",
                TextType::class,
                [
                    'label' => "Genre",
                    'required' => true,
                ]
            );
        }
    }
}