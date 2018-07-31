<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="region")
 */
class Region
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
    protected $capital;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $slogan;

    /**
     * @var Province $province
     *
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="regions", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     * })
     */
    protected $province;
    /**
     * @var ArrayCollection $districts
     *
     * @ORM\OneToMany(targetEntity="District", mappedBy="region", cascade={"persist", "remove", "merge"})
     */
    private $districts;

    /**
     * @var ArrayCollection $promesses
     *
     * @ORM\OneToMany(targetEntity="Promesse", mappedBy="region", cascade={"persist", "remove", "merge"})
     */
    private $promesses;


    public function __construct()
    {
        $this->districts = new ArrayCollection();
        $this->promesses = new ArrayCollection();
    }

    /**
     * @param District $disctrict
     */
    public function addDistrict(District $disctrict)
    {
        $disctrict->setRegion($this);

        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->disctricts->contains($disctrict)) {
            $this->disctricts->add($disctrict);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getDistricts()
    {
        return $this->districts;
    }

    public function addPromesse(Promesse $promesse)
    {
        $promesse->setRegion($this);

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
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param mixed $id
     */
    public function setProvince(Province $province)
    {
        $this->province = $province;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * @param mixed $capital
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;
    }

    /**
     * @return mixed
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * @param mixed $slogan
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;
    }


}