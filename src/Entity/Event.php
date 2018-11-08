<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ApiResource
 */
class Event
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
     * @ORM\Column(type="integer")
     */
    private $facebookId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Survey", mappedBy="event")
     */
    private $surveys;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Analysis", mappedBy="event", cascade={"persist", "remove"})
     */
    private $analysis;

    public function __construct()
    {
        $this->surveys = new ArrayCollection();
    }

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

    public function getFacebookId(): ?int
    {
        return $this->facebookId;
    }

    public function setFacebookId(int $facebookId): self
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Survey[]
     */
    public function getSurveys(): Collection
    {
        return $this->surveys;
    }

    public function addQuestionnaire(Survey $questionnaire): self
    {
        if (!$this->surveys->contains($questionnaire)) {
            $this->surveys[] = $questionnaire;
            $questionnaire->setEvent($this);
        }

        return $this;
    }

    public function removeQuestionnaire(Survey $questionnaire): self
    {
        if ($this->surveys->contains($questionnaire)) {
            $this->surveys->removeElement($questionnaire);
            // set the owning side to null (unless already changed)
            if ($questionnaire->getEvent() === $this) {
                $questionnaire->setEvent(null);
            }
        }

        return $this;
    }

    public function getAnalysis(): ?Analysis
    {
        return $this->analysis;
    }

    public function setAnalysis(Analysis $analysis): self
    {
        $this->analysis = $analysis;

        // set the owning side of the relation if necessary
        if ($this !== $analysis->getEvent()) {
            $analysis->setEvent($this);
        }

        return $this;
    }
}
