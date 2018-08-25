<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="promesse")
 */
class Promesse
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
     * @ORM\Column(type="text", nullable=false)
     */
    protected $description;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $etat;

    /**
     * @ORM\Column(type="date", nullable=false)
     *
     * */
    protected $date;

    /**
     * @var Region $region
     *
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="promesses", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     * })
     */
    protected $region;

    /**
     * @var Province $province
     *
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="promesses", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     * })
     */
    protected $province;

    /**
     * @var District $district
     *
     * @ORM\ManyToOne(targetEntity="District", inversedBy="promesses", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="district_id", referencedColumnName="id")
     * })
     */
    protected $district;

    /**
     * Promesse constructor.
     */
    public function __construct()
    {
        $this->etat = false;
    }


    /**
     * @return District
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param District $district
     */
    public function setDistrict(District $district)
    {
        $this->district = $district;
    }


    /**
     * @return Province
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param Province $province
     */
    public function setProvince(Province $province)
    {
        $this->province = $province;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $id
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }
}