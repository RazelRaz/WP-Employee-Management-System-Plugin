# WP CRUD Employee Management System

A simple WordPress plugin that allows users to manage employee records through a CRUD (Create, Read, Update, Delete) system. The plugin provides an intuitive interface for adding, viewing, updating, and deleting employee data in the WordPress admin area.

## Features

- Add, edit, view, and delete employee records
- Custom database table for storing employee data
- Data validation for forms
- Enqueue Bootstrap and DataTables for responsive, interactive data display
- WordPress-friendly architecture with action hooks and filter usage

## Requirements

- WordPress version 5.2 or higher
- PHP version 7.2 or higher

## Installation

1. Download the plugin and extract it.
2. Upload the `wp-employee-management-system` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

1. After activation, navigate to **Employee Management System** in the WordPress admin panel.
2. From here, you can add a new employee, view all employees, and perform edit or delete operations.



## Code Highlights

### Plugin Initialization

```php
class Wp_Employee_Management_System {
    public function __construct() {
        add_action('init', array($this, 'init'));
    }
    public function init() {
        add_action('admin_menu', array($this, 'ra_wp_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    public function enqueue_admin_scripts($hook) {
        wp_enqueue_style('ems-bootstrap-css', EMS_PLUGIN_URL . 'css/bootstrap.min.css');
        wp_enqueue_script('ems-bootstrap-js', EMS_PLUGIN_URL . 'js/bootstrap.min.js', array('jquery'));
    }
    public function ra_wp_admin_menu() {
        add_menu_page('Employee Management System', 'Employee Management System', 'manage_options', 'employee-system', array($this, 'ems_crud_system_callback'));
    }
    public function ems_crud_system_callback() {
        require_once __DIR__ . "/pages/add-employee.php";
    }
}
