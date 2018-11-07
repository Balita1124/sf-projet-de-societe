<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fokontany")
 */
class Fokontany {

    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var Commune $commune
     *
     * @ORM\ManyToOne(targetEntity="Commune", inversedBy="fokontanys", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="commune_id", referencedColumnName="id")
     * })
     */
    protected $commune;

    /**
     * @var ArrayCollection $bureaux
     *
     * @ORM\OneToMany(targetEntity="Bureau", mappedBy="fokontany", cascade={"persist", "remove", "merge"})
     */
    private $bureaux;

    public function __construct() {
        $this->bureaux = new ArrayCollection();
    }

    public function addBureau(Bureau $bureau) {
        $bureau->setFokontany($this);

        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->bureaux->contains($bureau)) {
            $this->bureaux->add($bureau);
        }
    }

    /**
     * @return ArrayCollection $promesses
     */
    public function getBureaux() {
        return $this->bureaux;
    }

    /**
     * @return mixed
     */
    public function getCommune() {
        return $this->commune;
    }

    /**
     * @param mixed $id
     */
    public function setCommune(Commune $commune) {
        $this->commune = $commune;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

}
