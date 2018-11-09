<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeQuestionType extends AbstractType
{
    private $listRubric = ["Ninja", "Exploreur"];

    public function configureOptions(OptionsResolver $resolver)
    {
        $list = [];
        foreach ($this->listRubric as $rubric) {
            $list[$rubric] = $rubric;
        }
        $resolver->setDefaults([
            'choices' => $list,
        ]);
    }
    public function getParent()
    {
        return ChoiceType::class;
    }
}