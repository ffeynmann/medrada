<?php


/**
 * gt3PracticeRegister
 */
class gt3PracticeRegister {

    public  $cpt;
    public  $dest_taxonomy;
    private $tag_taxonomy;
    private $slug;

    function __construct() {
        $this->cpt      = 'practice';
        $this->taxonomy = 'practice-category';
        $this->tag      = 'practice-tag';
        $this->slug     = 'practice-posts';
        if (function_exists('gt3_option')) {
            $slug_option = gt3_option('practice_slug');
        } else {
            $slug_option = '';
        }

        if (empty($slug_option)) {
            $this->slug = 'practice';
        } else {
            $this->slug = sanitize_title($slug_option);
        }
    }

    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    private function registerPostType() {

        register_post_type($this->cpt,
            array(
                'labels'        => array(
                    'name'          => esc_html__('Practice', 'gt3-oconnor-core'),
                    'singular_name' => esc_html__('Single Practice', 'gt3-oconnor-core'),
                    'add_item'      => esc_html__('New Practice', 'gt3-oconnor-core'),
                    'add_new_item'  => esc_html__('Add New Practice', 'gt3-oconnor-core'),
                    'edit_item'     => esc_html__('Edit Practice', 'gt3-oconnor-core')
                ),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $this->slug),
                'menu_position' => 5,
                'show_ui'       => true,
                'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes','comments'),
                'menu_icon'     => 'dashicons-id-alt'
            )
        );

    }

    private function registerTax() {
        $labels = array(
            'name'              => esc_html__('Practice Categories', 'gt3-oconnor-core'),
            'singular_name'     => esc_html__('Practice Category', 'gt3-oconnor-core'),
            'search_items'      => esc_html__('Search Practice Categories', 'gt3-oconnor-core'),
            'all_items'         => esc_html__('All Practice Categories', 'gt3-oconnor-core'),
            'parent_item'       => esc_html__('Parent Practice Category', 'gt3-oconnor-core'),
            'parent_item_colon' => esc_html__('Parent Practice Category:', 'gt3-oconnor-core'),
            'edit_item'         => esc_html__('Edit Practice Category', 'gt3-oconnor-core'),
            'update_item'       => esc_html__('Update Practice Category', 'gt3-oconnor-core'),
            'add_new_item'      => esc_html__('Add New Practice Category', 'gt3-oconnor-core'),
            'new_item_name'     => esc_html__('New Practice Category Name', 'gt3-oconnor-core'),
            'menu_name'         => esc_html__('Categories', 'gt3-oconnor-core'),
        );

        register_taxonomy($this->taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->slug.'-category' ),
        ));

        $labels = array(
            'name' => esc_html__( 'Tags', 'gt3-oconnor-core' ),
            'singular_name' => esc_html__( 'Tag', 'gt3-oconnor-core' ),
            'search_items' =>  esc_html__( 'Search Tags','gt3-oconnor-core' ),
            'all_items' => esc_html__( 'All Tags','gt3-oconnor-core' ),
            'parent_item' => esc_html__( 'Parent Tag','gt3-oconnor-core' ),
            'parent_item_colon' => esc_html__( 'Parent Tag:','gt3-oconnor-core' ),
            'edit_item' => esc_html__( 'Edit Tag','gt3-oconnor-core' ),
            'update_item' => esc_html__( 'Update Tag','gt3-oconnor-core' ),
            'add_new_item' => esc_html__( 'Add New Tag','gt3-oconnor-core' ),
            'new_item_name' => esc_html__( 'New Tag Name','gt3-oconnor-core' ),
            'menu_name' => esc_html__( 'Tags','gt3-oconnor-core' ),
        );

        register_taxonomy($this->tag, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->slug.__('-tag','gt3_oconnor_core') ),
        ));
    }

    public function registerSingleTemplate($single) {
        global $post;
        if(!empty($post) && $post->post_type == $this->cpt) {
            if(!file_exists(get_template_directory().'/single-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'practice/templates/single-'.$this->cpt.'.php';
            }
        }
        return $single;
    }

    public function registerArchiveTemplate($archive){
        global $post;

        if(!empty($post) && $post->post_type == $this->cpt && is_archive()) {
            if(!file_exists(get_template_directory().'/archive-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'practice/templates/archive-'.$this->cpt.'.php';
            }
        }

        return $archive;
    }

}
