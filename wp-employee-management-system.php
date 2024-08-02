<?php
/*
 * Plugin Name:       cd
 * Description:       This is a WordPress CRUD Employee Management System
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Razel Ahmed
 * Author URI:        https://razelahmed.com
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

// http://wpplugin.test/wp-content/plugins/wp-employee-management-system/
// echo plugin_dir_url(__FILE__);

// css and js
define('EMS_PLUGIN_URL', plugin_dir_url(__FILE__));

class Wp_Employee_Management_System {
    public function __construct() {
        add_action('init', array( $this,'init') );

    }


    /**
     * 
     *  admin menu
     */
    public function init() {
        add_action('admin_menu', array( $this, 'ra_wp_admin_menu' ));
        // add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    
    /**
     * Enqueue admin styles and scripts
     */
    public function enqueue_admin_scripts($hook) {
        // Define the base URL for the plugin
        $plugin_url = plugin_dir_url(__FILE__);
    
        // Enqueue Bootstrap CSS from the plugin's folder
        wp_enqueue_style('bootstrap-css', $plugin_url . 'css/bootstrap.min.css');
    
        // Enqueue DataTables CSS from the plugin's folder
        wp_enqueue_style('datatables-css', $plugin_url . 'css/dataTables.dataTables.min.css');
    
        // Enqueue WordPress's default jQuery
        wp_enqueue_script('jquery');
    
        // Enqueue Bootstrap JS from the plugin's folder, making sure jQuery is a dependency
        wp_enqueue_script('bootstrap-js', $plugin_url . 'js/bootstrap.min.js', ['jquery'], null, true);
    
        // Enqueue DataTables JS from the plugin's folder, making sure jQuery is a dependency
        wp_enqueue_script('datatables-js', $plugin_url . 'js/dataTables.min.js', ['jquery'], null, true);
    
        // Add inline script to initialize DataTables on the specific admin page
        // if ( 'toplevel_page_employee-system' === $hook || 'employee-system_page_list-employee' === $hook ) {
        //     wp_add_inline_script('datatables-js', 'jQuery(document).ready(function($) { $("#tbl-employee").DataTable(); });');
        // }
    }
    



    
    /**
     * 
     *  add_menu_page
     */
    public function ra_wp_admin_menu() {

        add_menu_page(
            'Employee Management System', 
            'Employee Management System', 
            'manage_options', 
            'employee-system', 
            array( $this,'ems_crud_system_callback'),
            'dashicons-networking',
            4,
        );

        // sub menus
        add_submenu_page(
            'employee-system',
            'Add Employee',
            'Add Employee',
            'manage_options',
            'employee-system',
            array( $this,'ems_crud_system_callback'),
        );

        add_submenu_page(
            'employee-system',
            'List Employee',
            'List Employee',
            'manage_options',
            'list-employee',
            array( $this,'ems_list_employee'),
        );

    }

    

    /**
     * 
     *  menu callback function
     */
    public function ems_crud_system_callback() {
        // echo '<h1>Welcome To Employee Management System</h1>';
        require_once __DIR__ ."/pages/add-employee.php";
    }


    // submenu callback function
    // public function ems_add_employee() {
    //     echo '<h1>Add Employee</h1>';
    // }

    public function ems_list_employee() {
        require_once __DIR__ ."/pages/list-employee.php";
    }

}

new Wp_Employee_Management_System();