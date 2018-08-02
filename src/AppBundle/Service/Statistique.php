<?php


namespace AppBundle\Service;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;

class Statistique
{

    public function getProvinceStat($em)
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
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        return $province_datas;
    }

    public function getRegionStat($em)
    {
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
        $statement = $em->getConnection()->prepare($sql_region);
        $statement->execute();
        $region_datas = $statement->fetchAll();
        return $region_datas;
    }

    public function getDistrictStat($em)
    {
        $sql_district = "
                SELECT
                rg.name \"DISTRICT\",
                count(pm.id) \"A FAIRE\",
                count(CASE WHEN pm.etat = 1 THEN 1 END) \"FAIT\",
                ((count(CASE WHEN pm.etat = 1 THEN 1 END) / count(pm.id)) * 100) \"POURCENTAGE\"
                FROM promesse pm
                LEFT JOIN district rg ON rg.id = pm.district_id
                GROUP BY rg.name
                ORDER BY rg.name ASC
                ";

        $statement = $em->getConnection()->prepare($sql_district);
        $statement->execute();
        $district_datas = $statement->fetchAll();
        return $district_datas;
    }

    public function getRegionHist($em)
    {
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
        $statement = $em->getConnection()->prepare($sql_region);
        $statement->execute();
        $region_datas = $statement->fetchAll();
        $stat_array = array(array('Region', 'Pourcentage'));
        foreach ($region_datas as $data) {
            array_push($stat_array, array($data['REGION'], $data['POURCENTAGE']));
        }
        return $this->setHist('Projets des societés par region', $stat_array);
    }

    public function getDistrictHist($em)
    {
        $sql_district = "
                SELECT
                rg.name \"DISTRICT\",
                count(pm.id) \"A FAIRE\",
                count(CASE WHEN pm.etat = 1 THEN 1 END) \"FAIT\",
                ((count(CASE WHEN pm.etat = 1 THEN 1 END) / count(pm.id)) * 100) \"POURCENTAGE\"
                FROM promesse pm
                LEFT JOIN district rg ON rg.id = pm.district_id
                GROUP BY rg.name
                ORDER BY rg.name ASC
                ";

        $statement = $em->getConnection()->prepare($sql_district);
        $statement->execute();
        $district_datas = $statement->fetchAll();
        $stat_array = array(array('District', 'Pourcentage'));
        foreach ($district_datas as $data) {
            array_push($stat_array, array($data['DISTRICT'], $data['POURCENTAGE']));
        }
        return $this->setHist('Projets des societés par district', $stat_array);
    }

    public function getProvinceHist($em)
    {
        $sql = "
                    SELECT
                    pr.name \"PROVINCE\",
                    count(pm.id) \"A FAIRE\",
                    count(CASE WHEN pm.etat = 1 THEN 1 END) \"FAIT\",
                    round(((count(CASE WHEN pm.etat = 1 THEN 1 END) / count(pm.id)) * 100),2) \"POURCENTAGE\"
                    FROM promesse pm
                    LEFT JOIN province pr ON pr.id = pm.province_id
                    GROUP BY pr.name
                    ORDER BY pr.name ASC
                ";

        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        $stat_array = array(array('Province', 'Pourcentage'));
        foreach ($province_datas as $data) {
            array_push($stat_array, array($data['PROVINCE'], $data['POURCENTAGE']));
        }
        return $this->setHist('Projets des societés par province', $stat_array);
    }

    public function getProvinceCam($em)
    {
        $sql = "
                    SELECT
                    pr.name \"PROVINCE\",
                    count(pm.id) \"A FAIRE\",
                    count(CASE WHEN pm.etat = 1 THEN 1 END) \"FAIT\",
                    round(((count(CASE WHEN pm.etat = 1 THEN 1 END) / count(pm.id)) * 100),2) \"POURCENTAGE\"
                    FROM promesse pm
                    LEFT JOIN province pr ON pr.id = pm.province_id
                    GROUP BY pr.id
                    ORDER BY pr.id ASC
                ";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        $stat_array = [['Province', 'Pourcentage']];
        $stat_array2 = [['Province', 'Pourcentage']];
        foreach ($province_datas as $data) {
//            array_push($stat_array, [$data['PROVINCE'], floatval($data['POURCENTAGE'])]);
            array_push($stat_array, [$data['PROVINCE'], floatval($data['A FAIRE'])]);
            array_push($stat_array2, [$data['PROVINCE'], floatval($data['FAIT'])]);
        }

//        var_dump($stat_array);die;
//        $stat_array = [
//            ['Province', 'Pourcentage'],
//            ['Fianarantsoa', 75],
//            ['Antananarivo', 80],
//        ];
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable($stat_array);
        $pieChart->getOptions()->setTitle("Projets des societés à faire par provinces");
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        $pieChart2 = new PieChart();
        $pieChart2->getData()->setArrayToDataTable($stat_array2);
        $pieChart2->getOptions()->setTitle('Projets des societés fait par provinces');
        $pieChart2->getOptions()->setHeight(500);
        $pieChart2->getOptions()->setWidth(900);
        $pieChart2->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart2->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart2->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart2->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart2->getOptions()->getTitleTextStyle()->setFontSize(20);
//        $pieChart->getOptions()->setFormat('decimal');
        return [$pieChart, $pieChart2];
    }

    private function setHist($title, $data)
    {
        $chart = new ColumnChart();
        $chart->getData()->setArrayToDataTable($data);
        $chart->getOptions()->getChart()
//            ->setTitle($title)
        ;
        $chart->getOptions()
            ->setBars('vertical')
            ->setHeight(300)
            ->setWidth(500)
            ->setColors(["#FF". rand(1000,9999)])
            ->getVAxis()
            ->setFormat('decimal');
        $chart->getOptions()->getBar()->setGroupWidth(5);
        return $chart;
    }

}