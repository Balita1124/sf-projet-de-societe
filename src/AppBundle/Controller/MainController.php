<?php

namespace AppBundle\Controller;

use AppBundle\Entity\District;
use AppBundle\Form\DistrictType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MainController extends Controller
{
    protected $path = "accueil";

    /**
     * @Route("/", name="accueil")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        $sql = "
                    SELECT
                    pr.name \"PROVINCE\",
                    count(pm.id) \"A FAIRE\",
                    count(CASE WHEN pm.etat = 1 THEN 1 END) \"FAIT\",
                    ((count(CASE WHEN pm.etat = 1 THEN 1 END) / count(pm.id)) * 100) \"POURCENTAGE\"
                    FROM promesse pm
                    LEFT JOIN province pr ON pr.id = pm.province_id
                    GROUP BY pr.name
                    ORDER BY pr.name ASC
                ";
        $sql_region = "
                SELECT
                rg.name \"REGION\",
                count(pm.id) \"A FAIRE\",
                count(CASE WHEN pm.etat = 1 THEN 1 END) \"FAIT\",
                ((count(CASE WHEN pm.etat = 1 THEN 1 END) / count(pm.id)) * 100) \"POURCENTAGE\"
                FROM promesse pm
                LEFT JOIN region rg ON rg.id = pm.region_id
                GROUP BY rg.name
                ORDER BY rg.name ASC
                ";

        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();

        $statement = $em->getConnection()->prepare($sql_region);
        $statement->execute();
        $region_datas = $statement->fetchAll();
        return $this->render('default/index.html.twig', [
            'value' => $this->path,
            'province_datas' => $province_datas,
            'region_datas' => $region_datas
        ]);
    }
}