<?php

namespace App\Form;

use App\Entity\EntertainmentProduct;
use App\Form\EventListener\AddGenreListener;
use App\Form\EventListener\AddSeasonNumberListener;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class EntertainmentProductType extends AbstractType
{
    public function __construct(private readonly NameTransformer $transformer) {
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                "name",
                TextType::class,
                [
                    'required' => true,
                    'constraints' => [new Length(['min' => 3])],
                ]
            )
            ->add("type", ChoiceType::class, [
                'label' => "Type",
                'required' => true,
                'choices' => [
                    "Movie" => 'movie',
                    "Series" => 'series',
                ],
            ])
            ->addEventSubscriber(new AddSeasonNumberListener())
            ->addEventSubscriber(new AddGenreListener())
            ->addModelTransformer($this->transformer)
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
}
