<?php
/**
 * Extension-Boilerplate
 *
 * @link https://github.com/ReduxFramework/extension-boilerplate
 *
 * gt3 Registration - Modified For ReduxFramework
 *
 * @package     gt3 Registration - Extension for building header
 * @author      gt3themes
 * @version     1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_gt3_registration' ) ) {

    /**
     * Main ReduxFramework_custom_field class
     *
     * @since       1.0.0
     */
    class ReduxFramework_gt3_registration extends ReduxFramework {

        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent ) {


            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                if (trailingslashit( str_replace( '\\', '/', ABSPATH ) ) == '/') {
                    $this->extension_url = site_url( $this->extension_dir );
                }else{
                    $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
                }
                $this->extension_url = plugin_dir_url(__FILE__);

            }


            /*if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }

            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'options'           => array(),
                'stylesheet'        => '',
                'output'            => true,
                'enqueue'           => true,
                'enqueue_frontend'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );   */

        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            // HTML output goes here

            $nonce = wp_create_nonce( "redux_{$this->parent->args['opt_name']}_gt3_registrator" );

            if ( ! is_array( $this->value ) && isset( $this->field['options'] ) ) {
                $this->value = $this->field['options'];
            }


            $option_value = $this->value;
            if (!is_array($option_value)) {
                $option_value = array(
                    'puchase_code' => $option_value,
                );
            }
            $purchase_code = $this->value;

            $gt3_registration_status = get_option( 'gt3_registration_status');
            $side_row = '';

            echo '<div class="gt3_register_container'.($gt3_registration_status == 'active' ? ' gt3_register_active' : '').'" data-nonce="' . $nonce . '">';
            echo '<input type="text" id="' . esc_attr($this->field['id']) . '_purchase_code" name="oconnor[' . esc_attr($this->field['id']) . '][puchase_code]" value="'.$option_value['puchase_code'].'" class="regular-text "'
                        .($gt3_registration_status == 'active' ? ' readonly="readonly"' : '')
                        . esc_attr($this->field['class'])
                . '>';
            echo '<div class="gt3_register__buttons">';
                echo '<a href="javascript:void(0);" class="gt3_register__submit">'.__( 'Activate', 'gt3_oconnor_core' ).'</a>';
                echo '<a href="javascript:void(0);" class="gt3_register__deregister">'.__( 'Deactivate', 'gt3_oconnor_core' ).'</a>';
                echo '<a href="javascript:void(0);" class="gt3_activation_refresh" title="'.__( 'Refresh Activation', 'gt3_oconnor_core' ).'"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
            echo "</div>";


            if ($gt3_registration_status != 'active') {
                echo '<div class="gt3_info_container">'.__( 'To unlock all theme features and get auto-updates, please activate the theme. Enter your purchase code and click "Activate". Don\'t know where the purchase code is? ', 'gt3_oconnor_core' ).'<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">'.__( 'Click here.', 'gt3_oconnor_core').'</a>'.'</div>';
            }


            if ($gt3_registration_status == 'active') {

                if (get_option( 'gt3_account_attached' ) == 'true') {
                    echo "<div class='gt3_support_container gt3_info_container'>";
                        echo '<div><strong>'.esc_html( 'The purchase code is linked to your gt3themes account', 'gt3_oconnor_core' ).' </strong></div>';
                        echo "<a class='button button-primary' href='https://gt3accounts.com/app' style='color: #71c341;background: #ffffff;border-color: #ffffff;box-shadow: none;text-shadow: none;color: #d54e21;font-weight: 600;margin-top: 5px;'>". esc_html( "Go to Your Account", "gt3_oconnor_core" ) ." </a>";
                    echo "</div>";
                }else{
                    echo '<div class="gt3_info_container gt3_info_container--no_icon gt3_account_submit_container">';
                        echo "<div class='gt3_register__popup_sepparator'><span>".__( 'Next Step', 'gt3_oconnor_core' )."</span></div>";
                        echo '<strong style="font-size: 1.4em;color: #121212;">'.__( 'It\'s time to protect your purchase code.', 'gt3_oconnor_core' ).'</strong>';
                        echo '<p class="gt3_register__key"><i class="fa fa-key" aria-hidden="true"></i> <span class="key" style="text-decoration: underline;">'.$option_value['puchase_code'].'</span></p>';
                        echo "<p>".__( 'Enter your email address to bind the purchase code. We will create a customer account for you by using your email address.', 'gt3_oconnor_core' )."</p>";
                        echo "<div>".__( 'After that, you will be able to:', 'gt3_oconnor_core' )."</div>";
                        echo "<ul>
                            <li>".__( 'View where your purchase code is used.', 'gt3_oconnor_core' )."</li>
                            <li>".__( 'Manage all your purchase codes.', 'gt3_oconnor_core' )."</li>
                            <li>".__( 'Check for product and support status.', 'gt3_oconnor_core' )."</li>
                        </ul>";
                        $admin_email = empty($option_value['email_account']) ? get_bloginfo('admin_email') : $option_value['email_account'];
                        echo '<input type="email"  id="' . esc_attr($this->field['id']) . '_account_email"  name="oconnor[' . esc_attr($this->field['id']) . '][email_account]" value="'.$admin_email.'" class="regular-text gt3_account '.esc_attr($this->field['class']) .'">';
                        $newsletter_value = '';
                        echo '<a href="javascript:void(0);" class="gt3_account_submit">'.__( 'Protect & Create Account', 'gt3_oconnor_core' ).'</a>';
                    echo "</div>";
                }


                if (get_option('sdfgdsfgdfg') != 'Product is activated!') {
                    update_option( 'gt3_registration_status', '');
                }
                if (function_exists('gt3_get_support_time_left')) {
                    $support_time_left = gt3_get_support_time_left();
                    if (!empty($support_time_left['time_to_left'])) {
                        $gt3_tmeme_id = get_option( 'gt3_tmeme_id' );
                        if (!empty($gt3_tmeme_id)) {
                            $theme_link = 'https://themeforest.net/checkout/from_item/'.(int)$gt3_tmeme_id.'?license=regular&size=source&support=renew_6month';
                        }else{
                            $theme_link = 'https://themeforest.net/user/gt3themes/portfolio?ref=gt3themes';
                        }
                        echo "<div class='".(!empty($support_time_left['expired']) && $support_time_left['expired'] == true ? '' : 'gt3_support_container')." gt3_info_container'>";
                        if (!empty($support_time_left['expired']) && $support_time_left['expired'] == true) {
                            printf( 'Your support package for this theme was expired <strong>%1$s</strong> ago', $support_time_left['time_to_left']);
                        }else{
                            printf( 'You have <strong>%1$s</strong> of available support', $support_time_left['time_to_left']);
                        }
                        echo '<div><a class="button button-primary" href="'. $theme_link .'" style="color: #71c341;background: #ffffff;border-color: #ffffff;box-shadow: none;text-shadow: none;color: #d54e21;font-weight: 600;margin-top: 5px;">'. esc_html( "Update Support Package", "gt3_oconnor_core" ) .' <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>';
                        echo "</div>";
                    }
                }
            }


            echo "<div class='gt3_register__popup'>";
                echo "<div class='gt3_register__popup_container'>";
                    echo "<div class='gt3_register__popup_close'><i class='fa fa-times' aria-hidden='true'></i></div>";
                    echo '<div class="gt3_info_container gt3_info_container--no_icon gt3_account_submit_container">';
                        echo "<div class='gt3_register__popup_sepparator'><span>".__( 'Next Step', 'gt3_oconnor_core' )."</span></div>";
                        echo '<strong style="font-size: 1.4em;color: #121212;">'.__( 'It\'s time to protect your purchase code.', 'gt3_oconnor_core' ).'</strong>';
                        echo '<p class="gt3_register__key"><i class="fa fa-key" aria-hidden="true"></i> <span class="key" style="text-decoration: underline;">'.$option_value['puchase_code'].'</span></p>';
                        echo "<p>".__( 'Enter your email address to bind the purchase code. We will create a customer account for you by using your email address.', 'gt3_oconnor_core' )."</p>";
                        echo "<div>".__( 'After that, you will be able to:', 'gt3_oconnor_core' )."</div>";
                        echo "<ul>
                            <li>".__( 'View where your purchase code is used.', 'gt3_oconnor_core' )."</li>
                            <li>".__( 'Manage all your purchase codes.', 'gt3_oconnor_core' )."</li>
                            <li>".__( 'Check for product and support status.', 'gt3_oconnor_core' )."</li>
                        </ul>";
                        $admin_email = empty($option_value['email_account']) ? get_bloginfo('admin_email') : $option_value['email_account'];
                        echo '<input type="email"  id="' . esc_attr($this->field['id']) . '_account_email"  name="oconnor[' . esc_attr($this->field['id']) . '][email_account]" value="'.$admin_email.'" class="regular-text gt3_account '.esc_attr($this->field['class']) .'">';
                        $newsletter_value = '';
                        echo '<a href="javascript:void(0);" class="gt3_account_submit">'.__( 'Protect & Create Account', 'gt3_oconnor_core' ).'</a>';
                    echo "</div>";
                echo "</div>";
                echo '<div class="gt3_info_container gt3_info_container--no_icon gt3_account_submit_success_container">';
                    echo '<strong style="font-size: 1.4em;color: #121212;">'.__( 'Hey!', 'gt3_oconnor_core' ).'</strong>';
                    echo "<p>".__( 'Your account has been successfully created and its details were sent your e-mail address ', 'gt3_oconnor_core' )."<strong class='gt3_account_emai_holder'></strong></p>";
                    echo "<p>".__( 'You can log into your account at', 'gt3_oconnor_core' ).' <a href="https://gt3accounts.com/app">gt3accounts.com</a> '.__( 'to manage your purchase code(s) and get dedicated support.', 'gt3_oconnor_core' )."</p>";
                    echo "<p>".__( "If you haven't received your account details, please contact us at", 'gt3_oconnor_core' ).' <a href="mailto:help@gt3themes.com">help@gt3themes.com</a> '.__( "and our support team will assist you.", 'gt3_oconnor_core' )."</p>";
                    echo "<p><strong>".__( "Thank you for choosing our product.", 'gt3_oconnor_core' )."</strong></p>";
                    echo "<div class='gt3_account_submit_success_button'>".__( "Close", 'gt3_oconnor_core' )."</div>";
                echo "</div>";
            echo "</div>";


            echo "</div>"; //end gt3_register_container




        }

        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            wp_enqueue_script(
                'redux-field_gt3_registration-js',
                $this->extension_url . '/field_gt3_registration.js',
                array( 'jquery' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field_gt3_registration-css',
                $this->extension_url . '/field_gt3_registration.css',
                time(),
                true
            );

        }

        /*function localize( $field, $value = "" ) {

            $params = array();

            if ( empty( $value ) ) {
                $value = $this->value;
            }
            $params['val'] = $value;

            return $params;
        }*/

        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function output() {

            if ( $this->field['enqueue_frontend'] ) {

            }

        }

    }
}
