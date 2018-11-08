<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RubricRepository")
 * @ApiResource
 */
class Rubric
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Question", mappedBy="rubric", cascade={"persist", "remove"})
     */
    private $questions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuestions(): ?Question
    {
        return $this->questions;
    }

    public function setQuestions(Question $questions): self
    {
        $this->questions = $questions;

        // set the owning side of the relation if necessary
        if ($this !== $questions->getRubric()) {
            $questions->setRubric($this);
        }

        return $this;
    }
}
