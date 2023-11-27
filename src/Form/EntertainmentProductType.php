<?php

namespace App\Form;

use App\Entity\EntertainmentProduct;
use App\Form\EventListener\AddGenreListener;
use App\Form\EventListener\AddPreSetDataListener;
use App\Form\EventListener\AddSeasonNumberListener;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntertainmentProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                "name",
                TextType::class,
                [
                    'required' => false
                ]
            )
            ->add("type", ChoiceType::class, [
                'label' => "Type",
                'required' => false,
                'choices' => [
                    "Movie" => 'movie',
                    "Series" => 'series',
                ],
            ])
            ->addEventSubscriber(new AddSeasonNumberListener())
            ->addEventSubscriber(new AddGenreListener())
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EntertainmentProduct::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'task_item'
        ]);
    }

    public function getParent()
    {
        return parent::getParent();
    }
}
