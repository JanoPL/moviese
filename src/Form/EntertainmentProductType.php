<?php

namespace App\Form;

use App\Entity\EntertainmentProduct;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntertainmentProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                "Name",
                TextType::class,
                [
                    'required' => false
                ]
            )
            ->add("filter", ChoiceType::class, [
                'label' => "Filter",
                'required' => true,
                "choices" => call_user_func(function () {

                })
            ])
            ->add("type", ChoiceType::class, [
                'label' => "Type",
                'required' => false,
                'choices' => [
                    "Movie" => 'Test1',
                    "Series" => 'test2',
                ],
                'attr' => [
                    'data-hide-show-me' => true,
                ]
            ])
            ->add(
                "season_number",
                IntegerType::class,
                [
                    'label' => "Season numbers",
                    'attr' => [
                        'data-hide-show-me' => true,
                        'class' => 'hidden-class'
                    ]
                ]
            )
            ->addModelTransformer(new SeriesTransformer())
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EntertainmentProduct::class,
        ]);
    }
}
