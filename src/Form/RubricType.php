<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RubricType extends AbstractType
{
    private $listRubric = ["Aucune","Respect du site", "Déchet", "Alimentation",
        "Déplacement", "Energie/eau/assainissement", "Accessibilité"];

    public function configureOptions(OptionsResolver $resolver)
    {
        $list = [];
        foreach ($this->listRubric as $rubric) {
            /* Config $specie */
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