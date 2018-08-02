<?php

namespace AppBundle\Controller;

use AppBundle\Entity\District;
use AppBundle\Form\DistrictType;
use AppBundle\Service;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MainController extends Controller
{
    protected $path = "main";

    /**
     * @Route("/", name="accueil")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'value' => $this->path,
        ]);
    }

    /**
     * @Route("/main/stat", name="stat")
     * @Security("has_role('ROLE_USER')")
     */
    public function statAction(Request $request)
    {
        $statistique = new Service\Statistique();
        $em = $this->getDoctrine()->getManager();
        $province_datas = $statistique->getProvinceStat($em);
        $region_datas = $statistique->getRegionStat($em);
        $district_datas = $statistique->getDistrictStat($em);
        return $this->render('default/stat.html.twig', [
            'value' => 'stat',
            'province_datas' => $province_datas,
            'region_datas' => $region_datas,
            'district_datas' => $district_datas
        ]);
    }

    /**
     * @Route("/main/hist", name="hist")
     * @Security("has_role('ROLE_USER')")
     */
    public function histogramAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $statistique = new Service\Statistique();
        $chart = [];
        $chart[0] = $statistique->getProvinceHist($em);
        $chart[1] = $statistique->getRegionHist($em);
        $chart[2] = $statistique->getDistrictHist($em);
        return $this->render('default/hist.html.twig', [
            'value' => 'stat',
            'histogram' => $chart
        ]);
    }

    /**
     * @Route("/main/cam", name="cam")
     * @Security("has_role('ROLE_USER')")
     */
    public function camAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $statistique = new Service\Statistique();
        $pieChart_array = $statistique->getProvinceCam($em);
//        var_dump($pieChart);die;

        return $this->render('default/cam.html.twig', [
            'value' => 'stat',
            'piechart' => $pieChart_array,
        ]);
    }
}