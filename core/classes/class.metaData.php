<?php

/* * ****************************************
  Class for interacting with DB
 * **************************************** */

class metaData {

    // geo Location integration
    protected $pages;

    public function __construct() {

        $this->pages = array();

        $this->pages['default'] = array('title' => '##### | #######',
            'keywords' => '',
            'description' => ''
        );

        $this->pages['home'] = array('title' => '##### | #######',
            'keywords' => '',
            'description' => ''
        );

        $this->pages['pagename/subpage'] = array('title' => '#####################',
            'keywords' => '',
            'description' => ''
        );

        
        $this->pages['contact-us'] = array('title' => '#####################',
            'keywords' => '',
            'description' => ''
        );
        
        $this->pages['terms-conditions'] = array('title' => '#####################',
            'keywords' => '',
            'description' => ''
        );
        
        $this->pages['privacy-policy'] = array('title' => '#####################',
            'keywords' => '',
            'description' => ''
        );
        
        $this->pages['sitemap'] = array('title' => '#####################',
            'keywords' => '',
            'description' => ''
        );
        
           

        
        }

    public function getTitle($page) {
        //echo "</title></head><body>";
        //foreach ($this->pages as $k => $v)
          //  echo $k . "<br />";
        //exit();
        if (array_key_exists($page, $this->pages))
            return $this->pages[$page]['title'];
        else
            return $this->pages['default']['title'];
    }

    public function getKeywords($page) {
        if (array_key_exists($page, $this->pages))
            return $this->pages[$page]['keywords'];
        else
            return $this->pages['default']['keywords'];
    }

    public function getDescription($page) {
        if (array_key_exists($page, $this->pages))
            return $this->pages[$page]['description'];
        else
            return $this->pages['default']['description'];
    }

    public function getPagesNames() {
        return array_keys($this->pages);
    }

    public function __get($name) {
        return $this->$name;
    }

    public static function init() {
        return new self();
    }

}

?>
