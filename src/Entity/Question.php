<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 * @ApiResource
 */
class Question
{

    const TYPE_NINJA = 0;

    const TYPE_INVESTIGATOR = 1;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rubric;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Response", mappedBy="question")
     */
    private $responses;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRubric(): ?string
    {
        return $this->rubric;
    }

    public function setRubric(string $rubric): self
    {
        $this->rubric = $rubric;

        return $this;
    }

    /**
     * @return Collection|Response[]
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

}
