<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formulaire
 *
 * @ORM\Table(name="formulaire")
 * @ORM\Entity
 */
class Formulaire
{
    /**
     * @var string
     *
     * @ORM\Column(name="lib_formulaire", type="text", length=65535, nullable=false)
     */
    private $libFormulaire;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif_formulaire", type="boolean", nullable=false)
     */
    private $actifFormulaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_formulaire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormulaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Question", mappedBy="idFormulaire")
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
     * Set libFormulaire
     *
     * @param string $libFormulaire
     *
     * @return Formulaire
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
     * Set actifFormulaire
     *
     * @param boolean $actifFormulaire
     *
     * @return Formulaire
     */
    public function setActifFormulaire($actifFormulaire)
    {
        $this->actifFormulaire = $actifFormulaire;

        return $this;
    }

    /**
     * Get actifFormulaire
     *
     * @return boolean
     */
    public function getActifFormulaire()
    {
        return $this->actifFormulaire;
    }

    /**
     * Get idFormulaire
     *
     * @return integer
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
     * @return Formulaire
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
    public function __toString() {
    	$items =(string)$this->idFormulaire;
    	
    	return $items;
    }
}
