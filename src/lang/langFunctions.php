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
        } else if ($page == 'contact'){
            return $this->getTextForContact();
        } else if ($page == 'research'){
            return $this->getTextForResearch();
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

    private function getTextForContact()
    {
        $text = null;
        if($this->m_lang == 'en'){
            $text['address_t'] = "Address";
            $text['address'] = 'Institute of automotive mechatronics';
            $text['state'] = 'Slovak republic';
            $text['secretariat'] = 'Secretariat';
            $text['office'] = 'Office';
            $text['number']= 'Phone number';
        } else if ($this->m_lang == 'sk') {
            $text['address_t'] = "Adresa";
            $text['address'] = 'Ústav automobilovej mechatroniky';
            $text['state'] = 'Slovak republic';
            $text['secretariat'] = 'Sekretariát';
            $text['office'] = 'Kancelária';
            $text['number']= 'Telefónne číslo';
        }

        return $text;
    }

    private function getTextForResearch()
    {
        $text = null;
        if($this->m_lang == 'en') {
            $text['cube'] = 'Displayed cube was created within the diploma thesis. It was created for remote access via the Internet. 
            It allows the user to insert custom code blocks and in this way to influence its behavior.';
            $text['param'] = 'Technical parameters';
            $text['1'] = 'Weight';
            $text['2'] = 'Dimensions (l x w x h)';
            $text['3'] = 'Type of control: Remote control, controlled by microprocessor';
            $text['4'] = 'Propulsion: 6x6, each wheel controlled independently by BLCD electric motor';
            $text['5'] = 'Total power of electric motors: 6x 175W';
            $text['6'] = 'Power supply: 6x DC / AC converter';
            $text['7'] = 'Power Source: 4x Li-Pol Batteries';
            $text['8'] = 'Total battery capacity: 13.2 Ah';

        } else if ($this->m_lang == 'sk'){
            $text['cube'] = 'Zobrazená kocka bola vytvorená v rámci diplomovej práce. Bol k nej vytvorený vzdialený prístup cez Internet, 
            čo umožňuje užívateľovi vkladať do kocky vlastný kód, ktorý ovplyvňuje jej správanie sa.';
            $text['param'] = 'Technické údaje';
            $text['1'] = 'Hmotnosť';
            $text['2'] = 'Rozmery (d x š x v)';
            $text['3'] = 'Spôsob ovládania: Diaľkové ovládanie, riadené mikroprocesorom';
            $text['4'] = 'Pohon: 6×6, každé koleso samostatne riadené BLDC elektromotorom';
            $text['5'] = 'Celkový výkon elektromotorov: 6x 175W';
            $text['6'] = 'Napájanie motorov: 6x DC/​AC menič';
            $text['7'] = 'Zdroj el. prúdu: 4x Li-​Pol akumulátory';
            $text['8'] = 'Celková kapacita aku­mulá­torov: 13,2 Ah';
        }

        return $text;
    }
}