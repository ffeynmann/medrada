<?php

class gt3PostTypesRegister{
    private static
        $instance = null;

    private $postTypes = array();
    private $allShortcodes = array();

    /**
     * @return Returns current instance of class
     */

    public static function getInstance() {
        if(self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    public function register(){
        /*$this->postTypes['tour'] = new gt3TourRegister();*/
        $this->postTypes['team'] = new gt3TeamRegister();
        $this->postTypes['practice'] = new gt3PracticeRegister();
        $this->postTypes['case'] = new gt3CaseRegister();
        foreach ($this->postTypes as $postType) {
            $postType->register();
        }

        if(class_exists('Vc_Manager')) {
          $list = array(
              'team',
              'page'
          );
          vc_set_default_editor_post_types( $list );
        }
    }

    public function shortcodes(){
        $gt3Team = new gt3Team();
        $gt3Team->shortcode_render();

        $gt3Practice = new gt3Practice();
        $gt3Practice->shortcode_render();

        $gt3Case = new gt3Case();
        $gt3Case->shortcode_render();
    }

    private function __clone() {}
    private function __construct() {}
    private function __wakeup() {}
}
