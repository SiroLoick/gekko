<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 */
class Question
{
    /**
     * @var string
     *
     * @ORM\Column(name="question_question", type="text", length=65535, nullable=false)
     */
    private $questionQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="rep1_question", type="text", length=65535, nullable=false)
     */
    private $rep1Question;

    /**
     * @var string
     *
     * @ORM\Column(name="rep2_question", type="text", length=65535, nullable=false)
     */
    private $rep2Question;

    /**
     * @var string
     *
     * @ORM\Column(name="rep3_question", type="text", length=65535, nullable=true)
     */
    private $rep3Question;

    /**
     * @var string
     *
     * @ORM\Column(name="rep4_question", type="text", length=65535, nullable=true)
     */
    private $rep4Question;

    /**
     * @var string
     *
     * @ORM\Column(name="rep5_question", type="text", length=65535, nullable=true)
     */
    private $rep5Question;

    /**
     * @var string
     *
     * @ORM\Column(name="rep6_question", type="text", length=65535, nullable=true)
     */
    private $rep6Question;

    /**
     * @var string
     *
     * @ORM\Column(name="corect_question", type="string", length=30, nullable=false)
     */
    private $corectQuestion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif_question", type="boolean", nullable=true)
     */
    private $actifQuestion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_question", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuestion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Formulaire", inversedBy="idQuestion")
     * @ORM\JoinTable(name="contient",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_question", referencedColumnName="id_question")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_formulaire", referencedColumnName="id_formulaire")
     *   }
     * )
     */
    private $idFormulaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Evaluation", inversedBy="idQuestion")
     * @ORM\JoinTable(name="details_evaluation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_question", referencedColumnName="id_question")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_evaluation", referencedColumnName="id_evaluation")
     *   }
     * )
     */
    private $idEvaluation;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idFormulaire = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idEvaluation = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set questionQuestion
     *
     * @param string $questionQuestion
     *
     * @return Question
     */
    public function setQuestionQuestion($questionQuestion)
    {
        $this->questionQuestion = $questionQuestion;

        return $this;
    }

    /**
     * Get questionQuestion
     *
     * @return string
     */
    public function getQuestionQuestion()
    {
        return $this->questionQuestion;
    }

    /**
     * Set rep1Question
     *
     * @param string $rep1Question
     *
     * @return Question
     */
    public function setRep1Question($rep1Question)
    {
        $this->rep1Question = $rep1Question;

        return $this;
    }

    /**
     * Get rep1Question
     *
     * @return string
     */
    public function getRep1Question()
    {
        return $this->rep1Question;
    }

    /**
     * Set rep2Question
     *
     * @param string $rep2Question
     *
     * @return Question
     */
    public function setRep2Question($rep2Question)
    {
        $this->rep2Question = $rep2Question;

        return $this;
    }

    /**
     * Get rep2Question
     *
     * @return string
     */
    public function getRep2Question()
    {
        return $this->rep2Question;
    }

    /**
     * Set rep3Question
     *
     * @param string $rep3Question
     *
     * @return Question
     */
    public function setRep3Question($rep3Question)
    {
        $this->rep3Question = $rep3Question;

        return $this;
    }

    /**
     * Get rep3Question
     *
     * @return string
     */
    public function getRep3Question()
    {
        return $this->rep3Question;
    }

    /**
     * Set rep4Question
     *
     * @param string $rep4Question
     *
     * @return Question
     */
    public function setRep4Question($rep4Question)
    {
        $this->rep4Question = $rep4Question;

        return $this;
    }

    /**
     * Get rep4Question
     *
     * @return string
     */
    public function getRep4Question()
    {
        return $this->rep4Question;
    }

    /**
     * Set rep5Question
     *
     * @param string $rep5Question
     *
     * @return Question
     */
    public function setRep5Question($rep5Question)
    {
        $this->rep5Question = $rep5Question;

        return $this;
    }

    /**
     * Get rep5Question
     *
     * @return string
     */
    public function getRep5Question()
    {
        return $this->rep5Question;
    }

    /**
     * Set rep6Question
     *
     * @param string $rep6Question
     *
     * @return Question
     */
    public function setRep6Question($rep6Question)
    {
        $this->rep6Question = $rep6Question;

        return $this;
    }

    /**
     * Get rep6Question
     *
     * @return string
     */
    public function getRep6Question()
    {
        return $this->rep6Question;
    }

    /**
     * Set corectQuestion
     *
     * @param string $corectQuestion
     *
     * @return Question
     */
    public function setCorectQuestion($corectQuestion)
    {
        $this->corectQuestion = $corectQuestion;

        return $this;
    }

    /**
     * Get corectQuestion
     *
     * @return string
     */
    public function getCorectQuestion()
    {
        return $this->corectQuestion;
    }

    /**
     * Set actifQuestion
     *
     * @param boolean $actifQuestion
     *
     * @return Question
     */
    public function setActifQuestion($actifQuestion)
    {
        $this->actifQuestion = $actifQuestion;

        return $this;
    }

    /**
     * Get actifQuestion
     *
     * @return boolean
     */
    public function getActifQuestion()
    {
        return $this->actifQuestion;
    }

    /**
     * Get idQuestion
     *
     * @return integer
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    /**
     * Add idFormulaire
     *
     * @param \AppBundle\Entity\Formulaire $idFormulaire
     *
     * @return Question
     */
    public function addIdFormulaire(\AppBundle\Entity\Formulaire $idFormulaire)
    {
        $this->idFormulaire[] = $idFormulaire;

        return $this;
    }

    /**
     * Remove idFormulaire
     *
     * @param \AppBundle\Entity\Formulaire $idFormulaire
     */
    public function removeIdFormulaire(\AppBundle\Entity\Formulaire $idFormulaire)
    {
        $this->idFormulaire->removeElement($idFormulaire);
    }

    /**
     * Get idFormulaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdFormulaire()
    {
        return $this->idFormulaire;
    }

    /**
     * Add idEvaluation
     *
     * @param \AppBundle\Entity\Evaluation $idEvaluation
     *
     * @return Question
     */
    public function addIdEvaluation(\AppBundle\Entity\Evaluation $idEvaluation)
    {
        $this->idEvaluation[] = $idEvaluation;

        return $this;
    }

    /**
     * Remove idEvaluation
     *
     * @param \AppBundle\Entity\Evaluation $idEvaluation
     */
    public function removeIdEvaluation(\AppBundle\Entity\Evaluation $idEvaluation)
    {
        $this->idEvaluation->removeElement($idEvaluation);
    }

    /**
     * Get idEvaluation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdEvaluation()
    {
        return $this->idEvaluation;
    }
    public function __toString() {
    	$items =(string)$this->idQuestion;
    	
    	return $items;
    }
    
}
