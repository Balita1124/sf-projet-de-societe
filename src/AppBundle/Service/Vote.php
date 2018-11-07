<?php

namespace AppBundle\Service;

class Vote {
    public function getFokontanyStat($em) {
        $sql = "
                SELECT
                fk.name \"FOKONTANY\",
                cm.name \"COMMUNE\",
                count(br.id) \"NB\",
                sum(br.voix12) \"Valeur12\",
                sum(br.voix13) \"Valeur13\",
                sum(br.voix25) \"Valeur25\",
                sum(br.votants) \"Total\"
                FROM bureau br
                LEFT JOIN fokontany fk ON fk.id = br.fokontany_id
                left join commune cm on cm.id = fk.commune_id
                left join district dt on dt.id = cm.district_id
                left join region rg on rg.id = dt.region_id
                left join province pr on pr.id = rg.province_id
                GROUP BY fk.name
                ORDER BY pr.name,rg.name,dt.name,cm.name,fk.name ASC
                ";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $datas = $statement->fetchAll();
        return $datas;
    }

    public function getCommuneStat($em) {
        $sql = "
                SELECT
                cm.name \"COMMUNE\",
                dt.name \"DISTRICT\",
                count(br.id) \"NB\",
                sum(br.voix12) \"Valeur12\",
                sum(br.voix13) \"Valeur13\",
                sum(br.voix25) \"Valeur25\",
                sum(br.votants) \"Total\"
                FROM bureau br
                LEFT JOIN fokontany fk ON fk.id = br.fokontany_id
                left join commune cm on cm.id = fk.commune_id
                left join district dt on dt.id = cm.district_id
                left join region rg on rg.id = dt.region_id
                left join province pr on pr.id = rg.province_id
                GROUP BY cm.name
                ORDER BY pr.name,rg.name,dt.name,cm.name,fk.name ASC
                ";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        return $province_datas;
    }

    public function getDistrictStat($em) {
        $sql = "
                SELECT
                dt.name \"DISTRICT\",
                rg.name \"REGION\",
                count(br.id) \"NB\",
                sum(br.votants) \"Total\",
                sum(br.voix12) \"Valeur12\",
                sum(br.voix13) \"Valeur13\",
                sum(br.voix25) \"Valeur25\"
                FROM bureau br
                LEFT JOIN fokontany fk ON fk.id = br.fokontany_id
                left join commune cm on cm.id = fk.commune_id
                left join district dt on dt.id = cm.district_id
                left join region rg on rg.id = dt.region_id
                left join province pr on pr.id = rg.province_id
                GROUP BY dt.name
                ORDER BY pr.name,rg.name,dt.name,cm.name,fk.name ASC
                ";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        return $province_datas;
    }

    public function getRegionStat($em) {
        $sql = "
                SELECT
                rg.name \"REGION\",
                pr.name \"PROVINCE\",
                count(br.id) \"NB\",
                sum(br.votants) \"Total\",
                sum(br.voix12) \"Valeur12\",
                sum(br.voix13) \"Valeur13\",
                sum(br.voix25) \"Valeur25\"
                FROM bureau br
                LEFT JOIN fokontany fk ON fk.id = br.fokontany_id
                left join commune cm on cm.id = fk.commune_id
                left join district dt on dt.id = cm.district_id
                left join region rg on rg.id = dt.region_id
                left join province pr on pr.id = rg.province_id
                GROUP BY rg.name
                ORDER BY pr.name,rg.name,dt.name,cm.name,fk.name ASC
                ";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        return $province_datas;
    }
    public function getProvinceStat($em) {
        $sql = "
                SELECT
                pr.name \"PROVINCE\",
                count(br.id) \"NB\",
                sum(br.votants) \"Total\",
                sum(br.voix12) \"Valeur12\",
                sum(br.voix13) \"Valeur13\",
                sum(br.voix25) \"Valeur25\"
                FROM bureau br
                LEFT JOIN fokontany fk ON fk.id = br.fokontany_id
                left join commune cm on cm.id = fk.commune_id
                left join district dt on dt.id = cm.district_id
                left join region rg on rg.id = dt.region_id
                left join province pr on pr.id = rg.province_id
                GROUP BY pr.name
                ORDER BY pr.name,rg.name,dt.name,cm.name,fk.name ASC
                ";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        return $province_datas;
    }
        public function getGeneralStat($em) {
        $sql = "
                SELECT
                 \"GENERAL\",
                count(br.id) \"NB\",
                sum(br.votants) \"Total\",
                sum(br.voix12) \"Valeur12\",
                sum(br.voix13) \"Valeur13\",
                sum(br.voix25) \"Valeur25\"
                FROM bureau br
                ";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $province_datas = $statement->fetchAll();
        return $province_datas;
    }

}
