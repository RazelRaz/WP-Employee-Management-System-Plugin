<?php
/*
 * Plugin Name:       WP CRUD Employee Management System
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

// returning plugin path
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
        wp_enqueue_style('ems-bootstrap-css', $plugin_url . 'css/bootstrap.min.css', array(), '1.0.0', 'all');
    
        // Enqueue DataTables CSS from the plugin's folder
        wp_enqueue_style('ems-datatables-css', $plugin_url . 'css/dataTables.dataTables.min.css', array(), '1.0.0', 'all');
        // Custom CSS
        wp_enqueue_style('ems-custom-css', $plugin_url . 'css/custom.css', array(), '1.0.0', 'all');
    
        // Enqueue WordPress's default jQuery
        // wp_enqueue_script('jquery');
    
        // Enqueue Bootstrap JS from the plugin's folder, making sure jQuery is a dependency
        wp_enqueue_script('ems-bootstrap-js', $plugin_url . 'js/bootstrap.min.js', array('jquery'), '1.0.0');
    
        // Enqueue DataTables JS from the plugin's folder, making sure jQuery is a dependency
        wp_enqueue_script('ems-datatables-js', $plugin_url . 'js/dataTables.min.js', array('jquery'), '1.0.0');
        // validate js
        wp_enqueue_script('ems-validate-js', $plugin_url . 'js/jquery.validate.min.js', array('jquery'), '1.0.0');
    
        // custom js
        wp_enqueue_script('ems-custom-js', $plugin_url . 'js/custom.js', array('jquery'), '1.0.0');

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


    // public function table_activation_mange() {
    //     require_once __DIR__ ."/pages/table-manage.php";
    // }

    
}



new Wp_Employee_Management_System();



// dynamic table creation during plugin activation
register_activation_hook(__FILE__, 'ems_create_table');
function ems_create_table() {
    global $wpdb;
    $table_prefix = $wpdb->prefix; //return value will be: wp_
    $sql = "
        CREATE TABLE {$table_prefix}ems_system (
            `id` INT(10) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(120) NULL DEFAULT NULL,
            `email` VARCHAR(80) NULL DEFAULT NULL,
            `phoneNo` VARCHAR(50) NULL DEFAULT NULL,
            `gender` ENUM('Male','Female','Other') NULL DEFAULT NULL,
            `designation` VARCHAR(50) NULL DEFAULT NULL,
            PRIMARY KEY (`id`) USING BTREE
        )
        ENGINE=InnoDB
        ;
    ";

    include_once ABSPATH. "wp-admin/includes/upgrade.php";
    dbDelta($sql);
}

// plugin deactivation
register_deactivation_hook(__FILE__, 'ems_drop_table');
function ems_drop_table() {
    global $wpdb;
    $table_prefix = $wpdb->prefix;
    $sql = "DROP TABLE IF EXISTS {$table_prefix}ems_system"; // {$table_prefix}ems_system
    $wpdb->query($sql);
}

