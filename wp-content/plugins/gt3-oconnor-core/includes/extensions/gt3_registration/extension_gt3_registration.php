<?php

/**
 * Extension-Boilerplate
 *
 * @link https://github.com/ReduxFramework/extension-boilerplate
 *
 * gt3 Register - Modified For ReduxFramework
 *
 * @package     gt3 Registration - Extension for building header
 * @author      gt3themes
 * @version     1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_extension_gt3_registration' ) ) {


    /**
     * Main ReduxFramework custom_field extension class
     *
     * @since       3.1.6
     */
    class ReduxFramework_extension_gt3_registration extends ReduxFramework {

        // Protected vars
        protected $parent;
        public $extension_url;
        public $extension_dir;
        public static $theInstance;

        /**
        * Class Constructor. Defines the args for the extions class
        *
        * @since       1.0.0
        * @access      public
        * @param       array $sections Panel sections.
        * @param       array $args Class constructor arguments.
        * @param       array $extra_tabs Extra panel tabs.
        * @return      void
        */
        public function __construct( $parent ) {

            $this->parent = $parent;
            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
            }
            $this->field_name = 'gt3_registration';

            self::$theInstance = $this;

            add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/'.$this->field_name, array( &$this, 'overload_field_path' ) ); // Adds the local field

            add_action( 'wp_ajax_gt3_registration', array(
                    $this,
                    'ajax_gt3_registration'
                ) );

            add_action( 'wp_ajax_gt3__account_registration', array(
                    $this,
                    'gt3__account_registration'
                ) );

            add_action( 'wp_ajax_gt3__activation_refresh', array(
                    $this,
                    'gt3__activation_refresh'
                ) );

            add_action( 'pre_set_site_transient_update_themes', array(
                    $this,
                    'gt3__activation_refresh_on_autoupdate'
                ) );

            add_action( 'redux/loaded', array(
                    $this,
                    'gt3_first_init'
                ));


            add_action( 'radium_theme_import_theme_options', array(
                    $this,
                    'fix_for_import_theme_options'
                ));
            

            //Adds Importer section to panel
            $this->add_gt3_registration();

        }

        public function fix_for_import_theme_options($data){
            $opt_name = $this->parent->args['opt_name'];
            $redux_options = Redux::getOption( $opt_name, 'gt3_registration_id');
            $data['gt3_registration_id'] = $redux_options;
            return $data;
        }

        public function getInstance() {
            return self::$theInstance;
        }

        // Forces the use of the embeded field path vs what the core typically would use
        public function overload_field_path($field) {
            return dirname(__FILE__).'/'.$this->field_name.'/field_'.$this->field_name.'.php';
        }

        public function getMenuList(){
            $menus = wp_get_nav_menus();
            $menu_list = array();

            foreach ($menus as $menu => $menu_obj) {
                $menu_list[$menu_obj->slug] = $menu_obj->name;
            }
            return $menu_list;
        }

        public function add_gt3_registration() {
            // Checks to see if section was set in config of redux.
            for ( $n = 0; $n <= count( $this->parent->sections ); $n++ ) {
                if ( isset( $this->parent->sections[$n]['id'] ) && $this->parent->sections[$n]['id'] == 'gt3_registration_section' ) {
                    return;
                }
            }


            $registration_option = array();

            $registration_option[] = array(
                        'id'   => 'gt3_registration_id',
                        'title'    => esc_html__( 'Enter your purchase code:', 'gt3_oconnor_core' ),
                        'type' => 'gt3_registration'
                    );

            if (get_option( 'gt3_registration_status') == 'active') {
                $registration_option[] = array(
                        'id'       => 'gt3_auto_update',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Enable Auto-update', 'gt3_oconnor_core' ),
                        'default'  => true,
                    );
            }




            $this->parent->sections[] = array(
                'id'     => 'gt3_registration_section',
                'title'  =>  esc_html__( 'Product Activation', 'gt3_oconnor_core' ),
                'icon'   => 'el el-unlock',
                'fields' => $registration_option,
            );

            $gt3_changelog = get_option( 'gt3_changelog' );
            $theme_name = get_template();
            if (!empty($gt3_changelog) && is_array($gt3_changelog) && !empty($gt3_changelog[$theme_name])) {
                $this->parent->sections[] = array(
                    'title'            => esc_html__('Changelog', 'wizecore' ),
                    'id'               => 'changelog',
                    'icon'   => 'el el-list-alt',
                    'customizer_width' => '450px',
                    'fields'           => array(
                        array(
                            'id'       => 'changelog',
                            'type'     => 'raw',
                            'markdown' => true,
                            'full_width' => true,
                            'content' => $gt3_changelog[$theme_name]['content'],
                        ),
                    )
                );
            }

        }


        public function ajax_gt3_registration(){

            if ( !isset( $_REQUEST['nonce'] ) || !wp_verify_nonce( $_REQUEST['nonce'], "redux_{$this->parent->args['opt_name']}_gt3_registrator" ) ) {
                die( 0 );
            }
            //var_dump(function_exists('gt3_registration'));
            update_option( 'gt3_account_attached' , 'false' );
            if ( function_exists('gt3_registration') ) {
                $return_array = array();

                if (isset( $_REQUEST['type'] )) {
                    $type = $_REQUEST['type'];
                }else{
                    $type = 'register';
                }
                if (isset( $_REQUEST['code'] )) {
                    $code = $_REQUEST['code'];
                }else{
                    $code = '';
                }
                if (isset( $_REQUEST['field_id'] )) {
                    $field_id = $_REQUEST['field_id'];
                }else{
                    $field_id = '';
                }

                $account_respond = gt3_activation_check($code,'',true);
                $account_respond = json_decode($account_respond,true);

                $return_array['account_respond'] = $account_respond;

                if (!empty($account_respond['already_linked']) && $account_respond['already_linked'] == true && $type == 'register_not_active') {
                    $type = 'register';
                }

                if (!empty($account_respond['Status_active']) && $account_respond['Status_active'] == '1' && $type == 'register_not_active') {
                    $type = 'register';
                }

                $registration_returns = gt3_registration($code,$type);
                $return_array['respond_out'] = $registration_returns;
                $registration_returns = json_decode($registration_returns,true);
                if (!empty($registration_returns['respond'])) {
                    $return_array['msg'] = $registration_returns['respond'];
                    $return_array['msg_type'] = 'notice';
                    $return_array['action_done'] = 'nothing';

                    if ($registration_returns['respond'] == 'Invalid license key.') {
                        $return_array['msg'] = 'Invalid purchase code. Please make sure that you have entered the correct code.';
                        $return_array['msg_type'] = 'error';
                    }

                    if ($registration_returns['respond'] == 'Envato API Connection error' || $registration_returns['respond'] == 'Registration Connection error') {
                        $return_array['msg_type'] = 'error';
                    }

                    if ($registration_returns['respond'] == 'Purchase code already exists') {
                        $return_array['msg'] = 'This purchase code already activated!';
                        $return_array['msg_type'] = 'error';
                    }
                    if ($registration_returns['respond'] == 'Product is activated!') {
                        $return_array['msg'] = 'Congrats! Your purchase code has been activated successfully.';
                        $return_array['msg_type'] = 'success';
                        $return_array['action_done'] = 'register_active';

                        $redux_options = Redux::getOption( 'oconnor', $field_id);
                        if (is_array($redux_options)) {
                            $redux_options['puchase_code'] = $code;
                        }else{
                            $redux_options = array('puchase_code' => $code );
                        }
                        Redux::setOption( 'oconnor', $field_id, $redux_options);

                        if ($type == 'register') {
                            update_option( 'gt3_registration_status' , 'active');
                            update_option( 'sdfgdsfgdfg' , $registration_returns['respond'] );
                        }
                        update_option( 'gt3_tmeme_id' , $registration_returns['id'] );

                        if (!empty($registration_returns['supported_until'])) {
                            update_option( 'gt3_registration_supported_until' , $registration_returns['supported_until']);
                            update_option( 'gt3_supported_notice_srart' , 'true' );
                        }
                        $return_array['already_linked'] = !empty($account_respond['already_linked']) ? $account_respond['already_linked'] : '';
                        if (!empty($account_respond['already_linked']) && ($account_respond['already_linked'] == 'true')) {
                            update_option( 'gt3_account_attached' , 'true' );
                        }

                    }
                    if ($registration_returns['respond'] == 'Deregister successfully') {
                        $return_array['msg'] = 'The purchase code has been deactivated successfully.';
                        $return_array['msg_type'] = 'success';
                        $return_array['action_done'] = 'register_deactive';
                        $redux_options = Redux::getOption( 'oconnor', $field_id);
                        if (is_array($redux_options)) {
                            $redux_options['puchase_code'] = '';
                        }else{
                            $redux_options = array('puchase_code' => '' );
                        }
                        Redux::setOption( 'oconnor', $field_id, $redux_options);
                        update_option( 'gt3_tmeme_id' , '' );
                        update_option( 'gt3_registration_status' , '');
                        update_option( 'sdfgdsfgdfg' , $registration_returns['respond'] );
                        update_option( 'gt3_registration_supported_until' , '');
                        update_option( 'gt3_supported_notice_srart' , 'false' );
                    }

                    if ($registration_returns['respond'] == 'Product is activated!') {

                    }

                }

                echo json_encode($return_array);

                die();
            }

            die();
        }

        public function gt3__account_registration(){
            if ( !isset( $_REQUEST['nonce'] ) || !wp_verify_nonce( $_REQUEST['nonce'], "redux_{$this->parent->args['opt_name']}_gt3_registrator" ) ) {
                die( 0 );
            }
            if ( function_exists('gt3_account_activation') ) {
                $return_array = array();

                if (isset( $_REQUEST['code'] )) {
                    $code = $_REQUEST['code'];
                }else{
                    $code = '';
                }
                if (isset( $_REQUEST['email'] )) {
                    $email = $_REQUEST['email'];
                }else{
                    $email = '';
                }
                if (isset( $_REQUEST['field_id'] )) {
                    $field_id = $_REQUEST['field_id'];
                }else{
                    $field_id = '';
                }

                $registration_returns = gt3_account_activation($code,$email);
                //$registration_returns = json_decode($registration_returns);
                $return_array['respond_out'] = $registration_returns;


                /*$registration_returns = (array)$registration_returns;*/

                update_option( 'gt3_account_attached' , 'false' );

                if ( !empty($registration_returns) ) {
                    $registration_obj = json_decode($registration_returns,true);
                    if (!empty($registration_obj['errors'])) {
                        $errors = $registration_obj['errors'];
                        foreach ($errors as $error => $error_message) {

                            switch ($error) {
                                case 'error-user-attached-code':
                                    $return_array['msg'] = $error_message[0];
                                    $return_array['msg_type'] = 'notice';
                                    update_option( 'gt3_account_attached' , 'true' );
                                    break;

                                case 'success-user-attached-code':
                                    $return_array['msg'] = $error_message[0];
                                    $return_array['msg_type'] = 'success';
                                    update_option( 'gt3_account_attached' , 'true' );
                                    update_option( 'gt3_registration_status' , 'active');
                                    update_option( 'sdfgdsfgdfg' , 'Product is activated!' );
                                    update_option( 'gt3_supported_account_registration_srart', 'true' );
                                    gt3_registration($code,'register');
                                    break;

                                case 'error-user-attached-code':
                                    $return_array['msg'] = $error_message[0];
                                    $return_array['msg_type'] = 'error';
                                    break;


                                default:
                                    $return_array['msg'] = $error_message[0];
                                    $return_array['msg_type'] = 'error';
                                    break;
                            }

                        }
                    }
                    $redux_options = Redux::getOption( 'oconnor', $field_id);
                    if (is_array($redux_options)) {
                        $redux_options['email_account'] = $email;
                    }else{
                        $redux_options = array('puchase_code' => $code, 'email_account' => $email );
                    }
                    Redux::setOption( 'oconnor', $field_id, $redux_options);

                }

                if (!empty($registration_returns['respond'])) {
                    $return_array['msg'] = $registration_returns['respond'];
                    $return_array['msg_type'] = 'notice';
                    $return_array['action_done'] = 'nothing';

                    if ($registration_returns['respond'] == 'Invalid license key.') {
                        $return_array['msg'] = 'Invalid purchase code. Please make sure that you have entered the correct code.';
                        $return_array['msg_type'] = 'error';
                    }

                    if ($registration_returns['respond'] == 'Envato API Connection error' || $registration_returns['respond'] == 'Registration Connection error') {
                        $return_array['msg_type'] = 'error';
                    }

                    if ($registration_returns['respond'] == 'Purchase code already exists') {
                        $return_array['msg'] = 'This purchase code already activated!';
                        $return_array['msg_type'] = 'error';
                    }

                }

                echo json_encode($return_array);

                die();
            }

            die();
        }

        public function gt3__activation_refresh_on_autoupdate($transient){

            $code = '';
            $email = '';

            $redux_options = Redux::getOption( 'oconnor', 'gt3_registration_id');
            $field_id = 'gt3_registration_id';
            if (is_array($redux_options)) {
                if (isset($redux_options['puchase_code'])) {
                    $code = $redux_options['puchase_code'];
                }
                if (isset($redux_options['email_account'])) {
                    $email = $redux_options['email_account'];
                }
            }else{
                return $transient;
            }

            if ( function_exists('gt3_activation_check') ) {
                $return_array = array();
                if (empty($email)) {
                     $registration_returns = gt3_activation_check($code,$email,true);
                 }else{
                     $registration_returns = gt3_activation_check($code,$email);
                 }
                $return_array['respond_out'] = $registration_returns;
                $return_array['msg'] = 'Nothing happened';
                $return_array['msg_type'] = 'notice';
                $return_array['action_done'] = 'register_nothing';

                if (!empty($registration_returns)) {
                    $registration_returns = json_decode($registration_returns,true);
                    $supported_until = !empty($registration_returns['Support_until']) ? $registration_returns['Support_until'] : '';
                    $status_active = !empty($registration_returns['Status_active']) ? $registration_returns['Status_active'] : '';
                    if (!empty($status_active)) {
                        if ($status_active == '1') {
                            if (!empty($supported_until)) {
                                if (!empty($supported_until)) {
                                    update_option( 'gt3_registration_supported_until' , $supported_until);
                                    //update_option( 'gt3_supported_notice_srart' , 'true' );
                                    $return_array['msg'] = 'Updated successfully';
                                    $return_array['msg_type'] = 'success';
                                }

                            }
                        }

                    }elseif(isset($registration_returns['Status_active']) && $status_active == ''){
                        $redux_options = Redux::getOption( 'oconnor', $field_id);
                        if (is_array($redux_options)) {
                            $redux_options['puchase_code'] = '';
                        }else{
                            $redux_options = array('puchase_code' => '' );
                        }
                        Redux::setOption( 'oconnor', $field_id, $redux_options);
                        update_option( 'gt3_tmeme_id' , '' );
                        update_option( 'gt3_registration_status' , '');
                        update_option( 'sdfgdsfgdfg' , 'Deregister successfully' );
                        update_option( 'gt3_registration_supported_until' , '');
                        //update_option( 'gt3_supported_notice_srart' , 'false' );
                        $return_array['msg'] = 'Updated successfully';
                        $return_array['msg_type'] = 'success';
                        $return_array['action_done'] = 'register_deactive';
                    }
                }

                //echo json_encode($return_array);

                return $transient;
            }

            return $transient;
        }

        public function gt3__activation_refresh(){
            if ( !isset( $_REQUEST['nonce'] ) || !wp_verify_nonce( $_REQUEST['nonce'], "redux_{$this->parent->args['opt_name']}_gt3_registrator" ) ) {
                return false;
            }
            if ( function_exists('gt3_activation_check') ) {
                $return_array = array();

                if (isset( $_REQUEST['code'] )) {
                    $code = $_REQUEST['code'];
                }else{
                    $code = '';
                }
                if (isset( $_REQUEST['email'] )) {
                    $email = $_REQUEST['email'];
                }else{
                    $email = '';
                }
                if (isset( $_REQUEST['field_id'] )) {
                    $field_id = $_REQUEST['field_id'];
                }else{
                    $field_id = '';
                }

                if (empty($email)) {
                     $registration_returns = gt3_activation_check($code,$email,true);
                 }else{
                     $registration_returns = gt3_activation_check($code,$email);
                 }
                //$registration_returns = json_decode($registration_returns);
                $return_array['respond_out'] = $registration_returns;
                $return_array['msg'] = 'Nothing happened';
                $return_array['msg_type'] = 'notice';
                $return_array['action_done'] = 'register_nothing';

                if (!empty($registration_returns)) {
                    $registration_returns = json_decode($registration_returns,true);
                    $supported_until = !empty($registration_returns['Support_until']) ? $registration_returns['Support_until'] : '';
                    $status_active = !empty($registration_returns['Status_active']) ? $registration_returns['Status_active'] : '';
                    if (!empty($status_active)) {
                        if ($status_active == '1') {
                            if (!empty($supported_until)) {
                                if (!empty($supported_until)) {
                                    update_option( 'gt3_registration_supported_until' , $supported_until);
                                    //update_option( 'gt3_supported_notice_srart' , 'true' );
                                    $return_array['msg'] = 'Updated successfully';
                                    $return_array['msg_type'] = 'success';
                                }

                            }
                        }

                    }elseif(isset($registration_returns['Status_active']) && $status_active == ''){
                        $redux_options = Redux::getOption( 'oconnor', $field_id);
                        if (is_array($redux_options)) {
                            $redux_options['puchase_code'] = '';
                        }else{
                            $redux_options = array('puchase_code' => '' );
                        }
                        Redux::setOption( 'oconnor', $field_id, $redux_options);
                        update_option( 'gt3_tmeme_id' , '' );
                        update_option( 'gt3_registration_status' , '');
                        update_option( 'sdfgdsfgdfg' , 'Deregister successfully' );
                        update_option( 'gt3_registration_supported_until' , '');
                        //update_option( 'gt3_supported_notice_srart' , 'false' );
                        $return_array['msg'] = 'Updated successfully';
                        $return_array['msg_type'] = 'success';
                        $return_array['action_done'] = 'register_deactive';
                    }
                }


                echo json_encode($return_array);

                die();
            }

            die();
        }

        public function gt3_first_init(){
            if (get_option('gt3_first_init') != 'true') {
                update_option( 'gt3_first_init' , 'true');
                $code = 'check_is_site_activated';
                $email = 'no';
                $registration_returns = gt3_activation_check($code,$email,true);
                if (!empty($registration_returns)) {
                    $registration_returns = json_decode($registration_returns,true);
                    $product = !empty($registration_returns['Product']) ? $registration_returns['Product'] : '';
                }


                if (!empty($registration_returns) && is_array($registration_returns)) {
                    if (!empty($registration_returns['Status_active']) && $registration_returns['Status_active'] == '1') {

                        if (!empty($registration_returns['Supported_until'])) {
                            update_option( 'gt3_registration_supported_until' , $registration_returns['Supported_until']);
                        }

                        $code = !empty($registration_returns['Code']) ? $registration_returns['Code'] : '';


                        update_option( 'gt3_registration_status' , 'active');
                        update_option( 'sdfgdsfgdfg' , $registration_returns['respond'] );

                        $redux_options = Redux::getOption( 'oconnor', 'gt3_registration_id');
                        if (is_array($redux_options)) {
                            $redux_options['puchase_code'] = $code;
                        }else{
                            $redux_options = array('puchase_code' => $code );
                        }
                        Redux::setOption( 'oconnor', 'gt3_registration_id', $redux_options);

                        if ($registration_returns['Product_id']) {
                            update_option( 'gt3_tmeme_id' , $registration_returns['Product_id'] );
                        }

                        if (!empty($registration_returns['Support_until'])) {
                            update_option( 'gt3_registration_supported_until' , $registration_returns['Support_until']);
                            update_option( 'gt3_supported_notice_srart' , 'true' );
                        }

                        if (!empty($registration_returns['already_linked']) && ($registration_returns['already_linked'] == 'true')) {
                            update_option( 'gt3_account_attached' , 'true' );
                        }

                    }
                }

            }
        }


    } // class



} // if
