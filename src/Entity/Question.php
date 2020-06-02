<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="questions", cascade={"persist"}, orphanRemoval=true)
     */
    private $answers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $choice;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    
    public function setAnswers(?Answer $answers): self
    {
        $this->answers = $answers;

        return $this;
    }
    

    public function addAnswer(Answer $answers): self
    {
        //if (!$this->answers->contains($answers)) {
            $this->answers[] = $answers;
            $answers->setQuestions($this);
        //}

        return $this;
    }
    

    public function removeAnswer(Answer $answers): self
    {
        //if ($this->answers->contains($answers)) {
            //$this->answers->removeElement($answers);
            // set the owning side to null (unless already changed)
            
            if ($answers->getQuestions() === $this) {
                $answers->setQuestions(null);
            }
            
        //}

        return $this;
    }

    public function getChoice(): ?bool
    {
        return $this->choice;
    }

    public function setChoice(bool $choice): self
    {
        $this->choice = $choice;

        return $this;
    }
}
