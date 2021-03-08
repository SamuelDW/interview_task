<?php

declare(strict_types=1);

namespace App\Form;


use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubstanceSearchType
{
    public const FORM_NAME = 'formSubstanceSearch';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $substances = $options['data']['substanceList'];

        $builder->add('europeanCommunitySearchField', ChoiceType::class, [
            'placeholder' => 'Enter an EC Number',
            'required' => false,
            'choices' => $substances,
            'data' => $substance,
            'attr' => [
                'class' => 'ec-number-search',
            ],
        ]);

        $builder->add('CASSearchField', ChoiceType::class, [
            'placeholder' => 'Enter an CAS number',
            'required' => false,
            'choices' => $substances,
            'attr' => [
                'class' => 'cas-number',
            ],
        ]);

        $builder->add('substanceNameSearchField', TextType::class, [
            'placeholder' => 'Substance Name',
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
            'mapped' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return self::FORM_NAME;
    }
}