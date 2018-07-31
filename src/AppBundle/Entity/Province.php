<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="province")
 */
class Province
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
     * @ORM\Column(type="string", length=255)
     */
    protected $zipCode;

    /**
     * @var ArrayCollection $region
     *
     * @ORM\OneToMany(targetEntity="Region", mappedBy="province", cascade={"persist", "remove", "merge"})
     */
    private $regions;

    /**
     * @var ArrayCollection $region
     *
     * @ORM\OneToMany(targetEntity="Promesse", mappedBy="province", cascade={"persist", "remove", "merge"})
     */
    private $promesses;

    /**
     * Province constructor.
     */
    public function __construct()
    {
        $this->regions = new ArrayCollection();
        $this->promesses = new ArrayCollection();
    }

    /**
     * @param Region $region
     */
    public function addRegion(Region $region)
    {
        $region->setProvince($this);

        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->regions->contains($region)) {
            $this->regions->add($region);
        }
    }
    /**
     * @return ArrayCollection $regions
     */
    public function getRegions()
    {
        return $this->regions;
    }

    public function addPromesse(Promesse $promesse)
    {
        $promesse->setProvince($this);

        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->promesses->contains($promesse)) {
            $this->promesses->add($promesse);
        }
    }
    /**
     * @return ArrayCollection $promesses
     */
    public function getPromesses()
    {
        return $this->promesses;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
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
}