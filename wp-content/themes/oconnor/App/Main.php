<?php

namespace App;

class Main {
    public static $version    = '15111238';
    public        $url        = null;
    public        $siteUrl    = null;
//    public static $tmGroup    = '-214862049'; //tomograph test
    public static $tmGroup    = '-1001451525014'; //Medrada Group
    public static $tmBotToken = '1172459707:AAHpLlXT_w3_CpfHQEcYp7JykTYbYVvt59E';
    public        $company;

	function __construct() {
		$this->siteUrl = get_bloginfo( 'url', 'display' );
		$this->setUrl();

		if(isset($_GET['bot-test'])) {
		    self::dump(self::botSendText(self::$tmGroup, 'test'));
        }

//        self::$version = rand(0, 1000000);

        add_action('wp_enqueue_scripts', [$this, 'includeFrontAssets']);

        add_action("wp_ajax_sub", [$this, "ajax_in"]);
        add_action("wp_ajax_nopriv_sub", [$this, "ajax_in"]);

        add_action('wp_footer', [$this, 'printFooter']);

        add_filter('comments_template', function($string = ''){
            return get_template_directory() . '/App/templates/comments.php';
        },1, 9999);

        add_filter('acf/load_field/name=pack_param', function($field){
            $params = get_field('pack_params', 'option') ?: [];
            foreach ($params as $param) {
                $field['choices'][$param['slug']] =  $param['name_pc'];
            }
            return $field;
        });

        add_action('pre_footer', function(){
            global $post;

            if($post instanceof \WP_Post && $post->post_type == 'practice') {
                echo do_shortcode('[call-me-row]');
            }
        }, 1);

        add_filter('the_content', function($string){
            //—
            //–
//            $string = str_replace('-', '–', $string);
//            $string = str_replace('—', '–', $string);
            $string = str_replace('&#8212;', '–', $string);

            return $string;
        });

        add_action('save_post_post', function($postId, $post, $update){
            if(!empty($_POST['mb_header_presets']) &&
                $_POST['mb_header_presets'] == 'default'
            ) {
                $_POST['mb_header_presets'] = 2;
            }
        }, 10, 3);

        $this->add_shortcodes();
        $this->debug();
    }

    private function setUrl()
    {
        if( substr_count( plugin_dir_url( __FILE__ ), "wp-content" ) > 1 ){
            $this->url = trailingslashit( get_bloginfo( "stylesheet_directory" ) );
        }else{
            $this->url = plugin_dir_url( __FILE__ );
        }
    }

    public function add_shortcodes()
    {
        add_shortcode('call-me-form', function(){
            ob_start();
            include(get_template_directory() . '/App/templates/call-me.php');
            $html = ob_get_clean();
            return $html;
        });

        add_shortcode('call-me-row', function($args = ''){
            ob_start();
            include(get_template_directory() . '/App/templates/call-me-row.php');
            $html = ob_get_clean();
            return $html;
        });

        add_shortcode('contact-us', function($args = ''){
            ob_start();
            include(get_template_directory() . '/App/templates/contact-us.php');
            $html = ob_get_clean();
            return $html;
        });

        add_shortcode('packages', function($args = ''){
            ob_start();
            include(get_template_directory() . '/App/templates/packages.php');
            $html = ob_get_clean();
            return $html;
        });


    }

    public function includeFrontAssets()
    {
        wp_enqueue_style('style', $this->url . 'assets/css/style.css', [], self::$version);
//        wp_enqueue_style('bootstrap', $this->url . 'assets/css/bootstrap.css', [], self::$version);
//        wp_enqueue_style('bootstrap', $this->url . 'assets/css/bootstrap2.css', [], self::$version);
        wp_enqueue_style('bootstrap', $this->url . 'assets/css/bootstrap3.css', [], self::$version);
        wp_enqueue_script('bootstrap', $this->url . 'assets/js/bootstrap.min.js', [], self::$version, true);
        wp_enqueue_script('x-helper', $this->url . 'assets/js/x-helper.js', [], self::$version, true);
        wp_enqueue_script('maskedinput', $this->url . 'assets/js/jquery.maskedinput-1.3.js', [], self::$version, true);
        wp_enqueue_script('script', $this->url . 'assets/js/script.js#asyncload', ['x-helper', 'maskedinput'], self::$version, true);

        wp_localize_script('script', 'vars', [
            'url' => $this->siteUrl,
            'ajax' => admin_url( "admin-ajax.php")
        ]);

        $this->textDomain();
    }

    function textDomain()
    {
        load_theme_textdomain( 'oconnor', get_template_directory() . '/' );
        load_theme_textdomain( 'gt3_oconnor_core', get_template_directory() . '/' );
    }

    public function printFooter()
    {
        include(get_template_directory() . '/App/templates/modal-error.php');
        include(get_template_directory() . '/App/templates/modal-write-us.php');
        include(get_template_directory() . '/App/templates/modal-write-us-ok.php');
    }

    function ajax_in()
    {
        $response = [];
        ob_start();
//        time_nanosleep(0, 5e+8);

        switch ($_POST['route']) {
            case "call-me":
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $post['form'] && $this->proceedCallMeForm($post['form']);
                break;
            case "write-us":
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $post['form'] && $this->proceedWriteUs($post['form']);
                break;
        }

        ob_get_clean();
        die(json_encode($response));
    }

    private function proceedCallMeForm($form)
    {
        $text = sprintf("%s\n%s",
            'Перезвоните мне',
            $form['phone']
        );

        $this->botSendText(self::$tmGroup, $text);
    }

    private function proceedWriteUs($form)
    {
        $text = sprintf("%s\n%s",
            $form['name'],
            $form['phone']
        );
        !empty($form['section']) && $text .= "\n\n" . $form['section'];
        !empty($form['comment']) && $text .= "\n\n" . $form['comment'];

        $this->botSendText(self::$tmGroup, $text);
    }

    public function botSendText($chatId = '', $string = '')
    {
        $params = [
            'chat_id' => $chatId,
            'text'    => $string,
        ];

        $this->botLog($params);

        if (empty($chatId) || empty($string) || mb_strlen($string) > 400) {
            return;
        }

        $url = 'https://api.telegram.org/bot' . self::$tmBotToken . '/sendMessage?' . http_build_query($params);
        $proxyUrl = 'https://resonance.com.ua?proxy';

        return wp_remote_post($proxyUrl, [
            'method'      => 'POST',
            'redirection' => 5,
            'sslverify'   => false,
            'body'        => [
                'url' => $url
            ]
        ]);
    }

    public function botLog($data = [])
    {
        $key = 'bot_log_' . date('Y_m_d');

        $log   = get_option($key) ?: [];
        $log[] = array_merge(['time' => date('Y-m-d H:i:s')], $data);
        update_option($key, $log, 0);
    }

    public function debug()
    {
        global $wpdb;
        //$url = 'https://api.telegram.org/bot475995439:AAFjnfj-rttwIsSmT-VQMpYlq3s-V54ELP4/sendMessage?chat_id=-209581666&text=%D1%82%D0%B5%D1%81%D1%82%0A%2B38+%28000%29+000-00-00%0A%0A%D0%97%D0%B0%D0%BF%D0%BE%D1%80%D0%BE%D0%B6%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D0%BD%D0%B0%D1%8F+%D0%B1%D0%BE%D0%BB%D1%8C%D0%BD%D0%B8%D1%86%D0%B0%0A%D0%9C%D0%A0%D0%A2+%D0%B3%D0%BE%D0%BB%D0%BE%D0%B2%D0%BD%D0%BE%D0%B3%D0%BE+%D0%BC%D0%BE%D0%B7%D0%B3%D0%B0%0A%D0%9C%D0%A0%D0%A2+0%2C3+%D0%A2%D0%B5%D1%81%D0%BB%D0%B0+600+%D0%B3%D1%80%D0%BD%2F1550+%D0%B3%D1%80%D0%BD+%28%D1%81+%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%B0%D1%81%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5%D0%BC%29%0A%0A000';


        if(isset($_GET['bot-log'])) {
            $raw = $wpdb->get_results("SELECT * FROM $wpdb->options WHERE `option_name` LIKE 'bot_log%' ORDER BY `option_name` DESC");
            $data = [];
            foreach($raw as $row) {
                $data[$row->option_name] = maybe_unserialize($row->option_value);
            }
            self::dump($data);
        }

        if(isset($_GET['php-info'])) {
            phpinfo();
            die();
        }
    }

    public static function dump($data = [], $vardump = false)
    {
        if(!$vardump) {
            ob_get_clean();
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            ob_get_clean();
            echo print_r($data, JSON_PRETTY_PRINT);
        }

        die();
    }
}