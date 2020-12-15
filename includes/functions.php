<?php
    /**
     * This files contains all important functions for naija4sale website project
     */

    /**
     * Return a css files url
     *
     * @param [type] $filename
     * @return void
     */
  if(!function_exists('cssfile')){
    function cssfile( $filename ) {
        return NAIJA_CSS . "/$filename";
    }
  }

    /**
     * Return a js files url
     *
     * @param [type] $filename
     * @return void
     */
  if(!function_exists('jsfile')){
    function jsfile( $filename ) {
        return NAIJA_JS . "/$filename";
    }
  }

    /**
     * Return a image files url
     *
     * @param [type] $filename
     * @return void
     */
    if(!function_exists('imgfile')){
        function imgfile( $filename ) {
            return NAIJA_IMAGES . "/$filename";
        }
    }

    /**
     * Get js files version based on date modified
     *
     * @param [type] $filename
     * @return void
     */
if(!function_exists('jsversion')){
    function jsversion( $filename ) {
        return filemtime( convert_path_slash( NAIJA_PATH . "/assets/js/$filename" ) );
    }

}
    /**
     * Get css files version based on date modified
     *
     * @param [type] $filename
     * @return void
     */
    if(!function_exists('cssversion')){
        function cssversion( $filename ) {
            return filemtime( convert_path_slash( NAIJA_PATH . "/assets/css/$filename" ) );
        }
    }

    /**
     * Replaces back slashes with slashes from a files path
     *
     * @param [type] $path
     * @return void
     */
    if(!function_exists('convert_path_slash')){
        function convert_path_slash( $path ) {
            return str_replace( "\\", "/", $path );
        }
    }

    /**
     * Pulls a template from views folder
     *
     * @param [type] $dir
     * @param [type] $filename
     * @return void
     */
if(!function_exists('naija_template')){
    function naija_template( $dir, $filename ) {
        ob_start();
        include convert_path_slash( "$dir/views/$filename" );
        echo ob_get_clean();
        return;
    }
}

    /**
     * Echos naijas localized text
     *
     * @param [type] $text
     * @return void
     */
    if(!function_exists('n')){
        function n( $text ) {
            _e( $text, 'naija' );
        }
    }

    /**
     * Return naijas localized value
     *
     * @param [type] $val
     * @return void
     */
    if(!function_exists('__n')){
        function __n( $val ) {
            return __( $val, 'naija' );
        }
    }

    /**
     * Creates a action field for forms
     *
     * @param [type] $action
     * @return void
     */
if(!function_exists('naija_form_action')){
    function naija_form_action( $action ) {
        ob_start();
    ?>
    <input type="hidden" name="action" value="<?php n( $action )?>"/>
    <?php
        echo ob_get_clean();
        }
}

        /**
         * Returns user location object from IP
         *
         * @return object|array
         */
if(!function_exists('naija_user_location')){
    function naija_user_location() {
        $ip                        = strlen( $_SERVER['REMOTE_ADDR'] ) > 3 ? $_SERVER['REMOTE_ADDR'] : '';
        $ip_response               = file_get_contents( 'http://ip-api.com/json/' . $ip );
        $ip_array                  = json_decode( $ip_response );
        $GLOBALS['naija_location'] = $ip_array;
        return $ip_array;
    }
}

        /**
         * get's google recaptcha response
         *
         * @param [type] $recaptcha
         * @return void
         */
      if(!function_exists('reCaptcha')){
        function reCaptcha( $recaptcha ) {
            $secret = get_option( 'naija_captcha_secret' ) ? get_option( 'naija_captcha_secret' ) : '';
            $ip     = $_SERVER['REMOTE_ADDR'];

            $postvars = array( "secret" => $secret, "response" => $recaptcha, "remoteip" => $ip );
            $url      = "https://www.google.com/recaptcha/api/siteverify";
            $ch       = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $postvars );
            $data = curl_exec( $ch );
            curl_close( $ch );

            return json_decode( $data, true );
        }
      }
        
        /**
         * Verifies if a function is okay or not
         *
         * @return void
         */
if(!function_exists('verify_naija_captcha')){
    function verify_naija_captcha() {
        $recaptcha = $_POST['g-recaptcha-response'];
        $res       = reCaptcha( $recaptcha );
        if ( !$res['success'] ) {
            return true;
        } else {
            return false;
        }
}
}


