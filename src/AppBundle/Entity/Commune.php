<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="commune")
 */
class Commune
{
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
     * @ORM\Column(type="integer", length=255)
     */
    protected $population;
    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $electeurs;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $hvm;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $rnm;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $tvm;

    /**
     * @ORM\Column(type="string")
     */
    protected $freqrnm;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observation;


    /**
     * @var Region $region
     *
     * @ORM\ManyToOne(targetEntity="District", inversedBy="communes", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="district_id", referencedColumnName="id")
     * })
     */
    protected $district;

    /**
     * @var ArrayCollection $fokontanys
     *
     * @ORM\OneToMany(targetEntity="Fokontany", mappedBy="commune", cascade={"persist", "remove", "merge"})
     */
    private $fokontanys;

    /**
     * Commune constructor.
     * @param ArrayCollection $fokontanys
     */
    public function __construct()
    {
        $this->fokontanys = new ArrayCollection();
    }

    public function addFokontany(Fokontany $fokontany)
    {
        $fokontany->setCommune($this);

        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->fokontanys->contains($fokontany)) {
            $this->fokontanys->add($fokontany);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getFokontanys()
    {
        return $this->fokontanys;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $id
     */
    public function setDistrict(District $district)
    {
        $this->district = $district;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRnm()
    {
        return $this->rnm;
    }

    /**
     * @param mixed $rnm
     */
    public function setRnm($rnm)
    {
        $this->rnm = $rnm;
    }

    /**
     * @return mixed
     */
    public function getTvm()
    {
        return $this->tvm;
    }

    /**
     * @param mixed $tvm
     */
    public function setTvm($tvm)
    {
        $this->tvm = $tvm;
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @return mixed
     */
    public function getElecteurs()
    {
        return $this->electeurs;
    }

    /**
     * @return mixed
     */
    public function getHvm()
    {
        return $this->hvm;
    }

    /**
     * @return mixed
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param mixed $population
     */
    public function setPopulation($population)
    {
        $this->population = $population;
    }

    /**
     * @param mixed $electeurs
     */
    public function setElecteurs($electeurs)
    {
        $this->electeurs = $electeurs;
    }

    /**
     * @param mixed $hvm
     */
    public function setHvm($hvm)
    {
        $this->hvm = $hvm;
    }

    /**
     * @param mixed $observation
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;
    }

    /**
     * @param ArrayCollection $fokontanys
     */
    public function setFokontanys($fokontanys)
    {
        $this->fokontanys = $fokontanys;
    }

    /**
     * @return mixed
     */
    public function getFreqrnm()
    {
        return $this->freqrnm;
    }

    /**
     * @param mixed $freqrnm
     */
    public function setFreqrnm($freqrnm)
    {
        $this->freqrnm = $freqrnm;
    }

}