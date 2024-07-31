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