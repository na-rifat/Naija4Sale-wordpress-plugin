<?php
namespace Naija;
/**
 * Assets registration handler
 */
class Assets {
    /**
     * Construct assets class
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'register'] );
        add_action( 'admin_enqueue_scripts', [$this, 'register'] );
    }

    /**
     * Return scripts from array
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'naija-frontend-script' => [
                'src'     => jsfile( 'frontend.js' ),
                'version' => jsversion( 'frontend.js' ),
                'deps'    => ['jquery'],
            ],
            'naija-admin-script'    => [
                'src'     => jsfile( 'admin.js' ),
                'version' => jsversion( 'admin.js' ),
                'deps'    => ['jquery'],
            ],
        ];
    }

    /**
     * Return styles from array
     *
     * @return array
     */
    public function get_styles() {
        return [
            'naija-frontend-style'       => [
                'src'     => cssfile( 'frontend.css' ),
                'version' => cssversion( 'frontend.css' ),
            ],
            'naija-admin-template-style' => [
                'src'     => cssfile( 'admin-template.css' ),
                'version' => cssversion( 'admin-template.css' ),
            ],
        ];
    }

    /**
     * Return localize variable from array
     *
     * @return array
     */
    public function get_localize() {
        return [
            'naija-admin-script' => [
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'options' => [
                    
                ],
            ],
        ];
    }

    /**
     * Registers scripts, styles and localize variables
     *
     * @return void
     */
    public function register() {
        $scripts = $this->get_scripts();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, true );
        }

        $styles = $this->get_styles();

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps );
        }

        $localize = $this->get_localize();

        foreach ( $localize as $handle => $vars ) {
            wp_localize_script( $handle, 'naija', $vars );
        }
    }
}