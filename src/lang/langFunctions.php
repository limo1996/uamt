<?php
echo __DIR__;
include_once (__DIR__.'/../database/database.php');

class Text
{
    private $m_lang;

    public function __construct($lang)
    {
        $this->m_lang = $lang;
    }

    public function getTextForPage($page)
    {
        if($page == 'projects'){
            return $this->getTextForProjects();
        }
        else if ($page == 'menu'){
            return $this->getTextForMenu();
        }
        else
            return null;
    }

    private function getTextForProjects(){
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

    private function getTextForMenu(){
        $filename = __DIR__."/menu-".$this->m_lang.".json";
       # echo $filename;

        $rawContent = file_get_contents($filename);
        return json_decode($rawContent);
    }
}