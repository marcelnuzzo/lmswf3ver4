<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $proposition;

    /**
     * @ORM\Column(type="boolean")
     */
    private $correction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $questions;

    /*
    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }
    */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProposition(): ?string
    {
        return $this->proposition;
    }

    public function setProposition(string $proposition): self
    {
        $this->proposition = $proposition;

        return $this;
    }

    public function getCorrection(): ?bool
    {
        return $this->correction;
    }

    public function setCorrection(bool $correction): self
    {
        $this->correction = $correction;

        return $this;
    }

    
    public function getQuestions(): ?string
    {
        return $this->questions;
    }

    
    public function setQuestions(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
    
    /*
    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setAnswers($this);
        }

        return $this;
    }
    

    public function removeQuestion(Question $questions): self
    {
        if ($this->questions->contains($questions)) {
            $this->questions->removeElement($questions);
            // set the owning side to null (unless already changed)
            if ($questions->getAnswers() === $this) {
                $questions->setAnswers(null);
            }
        }

        return $this;
    }
    */
}
