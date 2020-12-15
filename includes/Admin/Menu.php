<?php

namespace Naija\Admin;


/**
 * Handles menus
 */
class Menu{    
    private $pages;
    
    /**
     * Build Menu class
     */    
    function __construct()
    {
        $this->pages = new Pages();
        add_action('admin_menu', [$this, 'register_menu']);
    }

    /**
     * Registers required menus to admin panel
     *
     * @return void
     */
    function register_menu(){
        $parent_slug = 'naija4sale';
        $capability = 'manage_options';
        
        add_menu_page('Naija4Sale', 'Naija4Sale', $capability, $parent_slug, [$this->pages, 'main_page'], 'dashicons-admin-tools', 2);
    }
}