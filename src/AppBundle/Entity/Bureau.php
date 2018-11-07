<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="bureau")
 */
class Bureau {

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
    protected $code;

    /**
     * @var District $district
     *
     * @ORM\ManyToOne(targetEntity="Fokontany", inversedBy="bureaux", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="fokontany_id", referencedColumnName="id")
     * })
     */
    protected $fokontany;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $electeurs;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $votants;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $voix12;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $voix13;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $voix25;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $voixautre;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $voixfotsy;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $voixmaty;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCode() {
        return $this->code;
    }

    public function getFokontany() {
        return $this->fokontany;
    }

    public function getElecteurs() {
        return $this->electeurs;
    }

    public function getVotants() {
        return $this->votants;
    }

    public function getVoix12() {
        return $this->voix12;
    }

    public function getVoix13() {
        return $this->voix13;
    }

    public function getVoix25() {
        return $this->voix25;
    }

    public function getVoixautre() {
        return $this->voixautre;
    }

    public function getVoixfotsy() {
        return $this->voixfotsy;
    }

    public function getVoixmaty() {
        return $this->voixmaty;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setFokontany(Fokontany $fokontany) {
        $this->fokontany = $fokontany;
    }

    public function setElecteurs($electeurs) {
        $this->electeurs = $electeurs;
    }

    public function setVotants($votants) {
        $this->votants = $votants;
    }

    public function setVoix12($voix12) {
        $this->voix12 = $voix12;
    }

    public function setVoix13($voix13) {
        $this->voix13 = $voix13;
    }

    public function setVoix25($voix25) {
        $this->voix25 = $voix25;
    }

    public function setVoixautre($voixautre) {
        $this->voixautre = $voixautre;
    }

    public function setVoixfotsy($voixfotsy) {
        $this->voixfotsy = $voixfotsy;
    }

    public function setVoixmaty($voixmaty) {
        $this->voixmaty = $voixmaty;
    }

}
