<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fokontany")
 */
class Fokontany
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
     * @ORM\Column(type="integer")
     */
    protected $habitants;
    /**
     * @ORM\Column(type="integer")
     */
    protected $lecteurs;

    /**
     * @ORM\Column(type="integer")
     */
    protected $dernierElection;

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
     * @return mixed
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * @param mixed $id
     */
    public function setCommune(Commune $commune)
    {
        $this->commune = $commune;
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
    public function getHabitants()
    {
        return $this->habitants;
    }

    /**
     * @param mixed $habitants
     */
    public function setHabitants($habitants)
    {
        $this->habitants = $habitants;
    }

    /**
     * @return mixed
     */
    public function getLecteurs()
    {
        return $this->lecteurs;
    }

    /**
     * @param mixed $lecteurs
     */
    public function setLecteurs($lecteurs)
    {
        $this->lecteurs = $lecteurs;
    }

    /**
     * @return mixed
     */
    public function getDernierElection()
    {
        return $this->dernierElection;
    }

    /**
     * @param mixed $dernierElection
     */
    public function setDernierElection($dernierElection)
    {
        $this->dernierElection = $dernierElection;
    }

}