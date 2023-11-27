<?php

namespace App\Form\EventListener;

use App\Form\MoviesType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddSeasonNumberListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
//            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::POST_SET_DATA => 'onPostSetData',
//            FormEvents::POST_SUBMIT => 'onPostSubmit',
//            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSetData(FormEvent $event): void
    {
        $form = $event->getForm();
        $data = $event->getData();


    }

    public function onPostSetData(FormEvent $event):void
    {
        $form = $event->getForm();
        $data = $event->getData();

        if ($data->getType() == 'series') {
            $form->add(
                "season_number",
                IntegerType::class,
                [
                    'label' => "Season numbers",
                ]
            );
        }
    }

    public function onPostSubmit(FormEvent $event): void
    {

    }

    public function onPreSubmit(FormEvent $event): void
    {

    }
}