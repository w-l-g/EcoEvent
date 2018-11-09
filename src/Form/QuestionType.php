<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', TextType::class, ['attr' => [
                'class' => 'custom-input w-100',
                'placeholder' => 'Votre question'
            ]])
            ->add('type', TypeQuestionType::class, ['label' => 'Quel type de question ?', 'label_attr' => [
                'class' => 'text-white mt-3'
            ], 'attr' => [
                'class' => 'custom-select-eco',
                'placeholder' => 'Votre question'

            ]])
            ->add('rubric', RubricType::class, ['label' => 'Dans quelle rubrique ?', 'label_attr' => [
                'class' => 'text-white mt-3'
            ], 'attr' => [
                'class' => 'custom-select-eco'
            ]])
            ->add('submit', SubmitType::class, ['label' => 'Valider', 'attr' => [
                'class' => 'btn btn-primary btn-block mt-4'
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
