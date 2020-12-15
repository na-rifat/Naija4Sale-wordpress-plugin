<?php

namespace Naija;

class Captcha {
    function __construct() {

        add_action( 'wp_head', [$this, 'add_cdn'] );
        
        add_action( 'naija_captcha', [$this, 'load_captcha'] );

        add_action('verify_naija_captcha', [$this, 'verify_captcha']);
    }


    /**
     * loads the cdn
     *
     * @return void
     */
    public function add_cdn() {
        echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
    }

    /**
     * loads the captcha to frontend
     *
     * @return void
     */
    public function load_captcha() {
        $site_key = get_option( 'naija_captcha_site_key' ) ? get_option( 'naija_captcha_site_key' ) : '';
        echo '<div class="g-recaptcha brochure__form__captcha" data-sitekey="' . $site_key . '" style="margin: auto;"></div>';
    }

}
