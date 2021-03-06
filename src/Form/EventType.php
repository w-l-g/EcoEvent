<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => [
                'class' => 'custom-input w-100',
                'placeholder' => 'Nom de l\'évènement'
            ]])
            ->add('facebookId',  TextType::class, ['attr' => [
                'class' => 'custom-input w-100',
                'placeholder' => 'Lien facebook'
            ]])
            ->add('date', DateType::class, ['widget' => 'single_text', 'attr' => [
             'class' => 'custom-input w-100']])
            ->add('submit', SubmitType::class, ['label' => 'Valider', 'attr' => [
                'class' => 'btn btn-primary btn-block mt-4'
            ]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
