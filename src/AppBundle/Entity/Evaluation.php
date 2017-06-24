<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation", indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_formulaire", columns={"id_formulaire"})})
 * @ORM\Entity
 */
class Evaluation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="score_evaluation", type="integer", nullable=false)
     */
    private $scoreEvaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="timer_evaluation", type="string", length=250, nullable=false)
     */
    private $timerEvaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="date_evaluation", type="string", length=30, nullable=false)
     */
    private $dateEvaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_formulaire", type="text", length=65535, nullable=false)
     */
    private $libFormulaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_evaluation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvaluation;

    /**
     * @var \AppBundle\Entity\Formulaire
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Formulaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formulaire", referencedColumnName="id_formulaire")
     * })
     */
    private $idFormulaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Question", mappedBy="idEvaluation")
     */
    private $idQuestion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idQuestion = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set scoreEvaluation
     *
     * @param integer $scoreEvaluation
     *
     * @return Evaluation
     */
    public function setScoreEvaluation($scoreEvaluation)
    {
        $this->scoreEvaluation = $scoreEvaluation;

        return $this;
    }

    /**
     * Get scoreEvaluation
     *
     * @return integer
     */
    public function getScoreEvaluation()
    {
        return $this->scoreEvaluation;
    }

    /**
     * Set timerEvaluation
     *
     * @param string $timerEvaluation
     *
     * @return Evaluation
     */
    public function setTimerEvaluation($timerEvaluation)
    {
        $this->timerEvaluation = $timerEvaluation;

        return $this;
    }

    /**
     * Get timerEvaluation
     *
     * @return string
     */
    public function getTimerEvaluation()
    {
        return $this->timerEvaluation;
    }

    /**
     * Set dateEvaluation
     *
     * @param string $dateEvaluation
     *
     * @return Evaluation
     */
    public function setDateEvaluation($dateEvaluation)
    {
        $this->dateEvaluation = $dateEvaluation;

        return $this;
    }

    /**
     * Get dateEvaluation
     *
     * @return string
     */
    public function getDateEvaluation()
    {
        return $this->dateEvaluation;
    }

    /**
     * Set libFormulaire
     *
     * @param string $libFormulaire
     *
     * @return Evaluation
     */
    public function setLibFormulaire($libFormulaire)
    {
        $this->libFormulaire = $libFormulaire;

        return $this;
    }

    /**
     * Get libFormulaire
     *
     * @return string
     */
    public function getLibFormulaire()
    {
        return $this->libFormulaire;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Evaluation
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Get idEvaluation
     *
     * @return integer
     */
    public function getIdEvaluation()
    {
        return $this->idEvaluation;
    }

    /**
     * Set idFormulaire
     *
     * @param \AppBundle\Entity\Formulaire $idFormulaire
     *
     * @return Evaluation
     */
    public function setIdFormulaire(\AppBundle\Entity\Formulaire $idFormulaire = null)
    {
        $this->idFormulaire = $idFormulaire;

        return $this;
    }

    /**
     * Get idFormulaire
     *
     * @return \AppBundle\Entity\Formulaire
     */
    public function getIdFormulaire()
    {
        return $this->idFormulaire;
    }

    /**
     * Add idQuestion
     *
     * @param \AppBundle\Entity\Question $idQuestion
     *
     * @return Evaluation
     */
    public function addIdQuestion(\AppBundle\Entity\Question $idQuestion)
    {
        $this->idQuestion[] = $idQuestion;

        return $this;
    }

    /**
     * Remove idQuestion
     *
     * @param \AppBundle\Entity\Question $idQuestion
     */
    public function removeIdQuestion(\AppBundle\Entity\Question $idQuestion)
    {
        $this->idQuestion->removeElement($idQuestion);
    }

    /**
     * Get idQuestion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }
}
