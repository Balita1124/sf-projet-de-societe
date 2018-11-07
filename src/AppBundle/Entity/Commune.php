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

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }



}