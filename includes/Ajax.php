<?php

namespace Naija;

/**
 * Ajax handler class
 */

class Ajax {

    /**
     * Builds the ajax controller class
     */
    function __construct() {
        add_action( 'wp_ajax_naija_save_options', [$this, 'save_options'] );
    }

    /**
     * Saves the options
     *
     * @return void
     */
    public function save_options() {

        $ip_redirection = isset( $_POST['ip_redirection'] ) ? true : false;
        $site_key = isset($_POST['naija_site_key'])?$_POST['naija_site_key']:'';
        $site_secret = isset($_POST['naija_site_secret'])?$_POST['naija_site_secret']:'';

        $ip_redirection = update_option( 'naija_use_ip_redirection', $ip_redirection );
        $site_key = update_option('naija_captcha_site_key', $site_key);
        $site_secret = update_option('naija_captcha_secret', $site_secret);

        wp_send_json_success( [
            'ip_redirection' => isset($_POST['ip_redirection']),
        ] );
    }
}
