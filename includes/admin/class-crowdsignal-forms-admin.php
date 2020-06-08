<?php
/**
 * File containing the class Crowdsignal_Forms\Admin\Crowdsignal_Forms_Admin.
 *
 * @package Crowdsignal_Forms\Admin
 * @since   1.0.0
 */

namespace Crowdsignal_Forms\Admin;

use Crowdsignal_Forms\Admin\Crowdsignal_Forms_Admin_Notices;
use Crowdsignal_Forms\Admin\Crowdsignal_Forms_Setup;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles front admin page for Crowdsignal.
 *
 * @since 1.0.0
 */
class Crowdsignal_Forms_Admin {

	/**
	 * The settings class.
	 *
	 * @var Crowdsignal_Forms_Settings
	 * @since  1.0.0
	 */
	private $settings_page = null;

	/**
	 * The setup page
	 *
	 * @var Crowdsignal_Admin
	 */
	private $setup_page;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->setup_page    = new Crowdsignal_Forms_Setup();
		$this->settings_page = new Crowdsignal_Forms_Settings();
		Crowdsignal_Forms_Admin_Notices::init();

		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Set up actions during admin initialization.
	 */
	public function admin_init() {
	}

	/**
	 * Enqueues CSS and JS assets.
	 */
	public function admin_enqueue_scripts() {
	}

	/**
	 * Adds pages to admin menu.
	 */
	public function admin_menu() {
		$icon_encoded = 'PHN2ZyBpZD0iY29udGVudCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMjg4IDIyMCI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT5pY29uLWJsdWU8L3RpdGxlPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTI2Mi40MSw4MC4xYy04LjQ3LTIyLjU1LTE5LjA1LTQyLjgzLTI5Ljc5LTU3LjFDMjIwLjc0LDcuMjQsMjEwLC41NywyMDEuNDcsMy43OWExMi4zMiwxMi4zMiwwLDAsMC0zLjcyLDIuM2wtLjA1LS4xNUwxNiwxNzMuOTRsOC4yLDE5LjEyLDMwLjU2LTEuOTJ2MTMuMDVhMTIuNTcsMTIuNTcsMCwwLDAsMTIuNTgsMTIuNTZjLjMzLDAsLjY3LDAsMSwwbDU4Ljg1LTQuNzdhMTIuNjUsMTIuNjUsMCwwLDAsMTEuNTYtMTIuNTNWMTg1Ljg2bDEyMS40NS03LjY0YTEzLjg4LDEzLjg4LDAsMCwwLDIuMDkuMjYsMTIuMywxMi4zLDAsMCwwLDQuNDEtLjhDMjg1LjMzLDE3MC43LDI3OC42MywxMjMuMzEsMjYyLjQxLDgwLjFabS0yLjI2LDg5Ljc3Yy0xMC40OC0zLjI1LTMwLjQ0LTI4LjE1LTQ2LjY4LTcxLjM5LTE1LjcyLTQxLjktMTcuNS03My4yMS0xMi4zNC04My41NGE2LjUyLDYuNTIsMCwwLDEsMy4yMi0zLjQ4LDMuODIsMy44MiwwLDAsMSwxLjQxLS4yNGMzLjg1LDAsMTAuOTQsNC4yNiwyMC4zMSwxNi43MUMyMzYuMzYsNDEuNTksMjQ2LjU0LDYxLjE1LDI1NC43NCw4M2MxOC40NCw0OS4xMiwxNy43NCw4My43OSw5LjEzLDg3QTUuOTMsNS45MywwLDAsMSwyNjAuMTUsMTY5Ljg3Wk0xMzAuNiwxOTkuNDFhNC40LDQuNCwwLDAsMS00LDQuMzdsLTU4Ljg1LDQuNzdBNC4zOSw0LjM5LDAsMCwxLDYzLDIwNC4xOVYxOTAuNjJsNjcuNjEtNC4yNVoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik02LDE4NS4yNmExMC4yNSwxMC4yNSwwLDAsMCwxMC4yNSwxMC4yNSwxMC4wNSwxMC4wNSwwLDAsMCw0LjM0LTFsLTcuOTQtMTguNzNBMTAuMiwxMC4yLDAsMCwwLDYsMTg1LjI2WiIvPjwvc3ZnPgo=';
		add_menu_page( __( 'Crowdsignal', 'crowdsignal-forms' ), __( 'Crowdsignal', 'crowdsignal-forms' ), 'manage_options', 'crowdsignal-forms', array( $this->settings_page, 'output' ), 'data:image/svg+xml;base64,' . $icon_encoded );
		add_submenu_page( 'crowdsignal-forms', __( 'Settings', 'crowdsignal-forms' ), __( 'Settings', 'crowdsignal-forms' ), 'manage_options', 'crowdsignal-forms-settings', array( $this->settings_page, 'output' ) );
		add_submenu_page( 'crowdsignal-forms', __( 'Getting Started', 'crowdsignal-forms' ), __( 'Getting Started', 'crowdsignal-forms' ), 'manage_options', 'crowdsignal-forms-setup', array( $this->setup_page, 'setup_page' ) );
		remove_submenu_page( 'crowdsignal-forms', 'crowdsignal-forms' );
	}
}
