<?php
include_once(__DIR__ . '/../database/database.php');

class Text
{
    private $m_lang;

    public function __construct($lang)
    {
        $this->m_lang = $lang;
    }

    public function getTextForPage($page)
    {
        if ($page == 'projects') {
            return $this->getTextForProjects();
        } else if ($page == 'menu') {
            return $this->getTextForMenu();
        } else if ($page == 'staff') {
            return $this->getTextForStaff();
        } else if ($page == 'positions'){
            return $this->getTextForPositions();
        }
            return null;
    }

    private function getTextForProjects()
    {
        $db = new Database();
        $projects = $db->fetchProjects();
        $final = array();
        foreach ($projects as $key => $project) {
            $tmp['ID'] = $project['ID'];
            $tmp['TYPE'] = $project['PROJECT_TYPE'];
            $tmp['NUMBER'] = $project['NUMBER'];
            $tmp['DURATION'] = $project['DURATION'];
            $tmp['COORDINATION'] = $project['COORDINATION'];
            $tmp['PARTNERS'] = $project['PARTNERS'];
            $tmp['WEB'] = $project['WEB'];
            $tmp['CODE'] = $project['INTERNAL_CODE'];
            if ($this->m_lang == 'sk') {
                $tmp['TITLE'] = $project['TITLE_SK'];
                $tmp['ANNOTATION'] = $project['ANNOTATION_SK'];
            } else if ($this->m_lang == 'en') {
                $tmp['TITLE'] = $project['TITLE_EN'];
                $tmp['ANNOTATION'] = $project['ANNOTATION_EN'];
            } else
                return null;

            $final[$key] = $tmp;
        }
        return $final;
    }

    private function getTextForMenu()
    {
        $filename = __DIR__ . "/menu-" . $this->m_lang . ".json";

        $rawContent = file_get_contents($filename);
        return json_decode($rawContent);
    }

    private function getTextForStaff()
    {
        $filename = __DIR__ . "/staff-" . $this->m_lang . ".json";
        return json_decode(file_get_contents($filename));
    }

    private function getTextForPositions()
    {
        $text = null;
        if ($this->m_lang == 'en') {
            $text["director"] = "Director of Institute";
            $text["director_research"] = "Deputy Director for Scientific Research";
            $text["director_development"] = "Deputy Director for Institute Development";
            $text["director_activities"] = "Deputy Director for Educational Activities";
            $text["head_department"] = "Head of Department";
            $text["d_head_department"] = "Deputy Head of Department";
            $text["d"] = "DEPARTMENTS OF INSTITUTE OF AUTOMOTIVE MECHATRONICS";
            $text["org"] = "Organization structure of institute";
        } else if ($this->m_lang == 'sk') {
            $text["director"] = "Riaditeľ ústavu";
            $text["director_research"] = "Zástupca riaditeľa ústavu pre vedeckú činnosť";
            $text["director_development"] = "Zástupca riaditeľa ústavu pre rozvoj ústavu";
            $text["director_activities"] = "Zástupca riaditeľa ústavu pre pedagogickú činnosť";
            $text["head_department"] = "Vedúci oddelenia";
            $text["d_head_department"] = "Zástupca vedúceho oddelenia";
            $text["d"] = "ODDELENIA ÚSTAVU AUTOMOBILOVEJ MECHATRONIKY";
            $text["org"] = "Organizačný poriadok Ústavu automobilovej mechatroniky";
        }

        return $text;
    }
}