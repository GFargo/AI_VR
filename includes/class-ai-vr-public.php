<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://github.com/alleyinteractive
 * @since      1.0.0
 *
 * @package    AI_VR
 * @subpackage AI_VR/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AI_VR
 * @subpackage AI_VR/public
 * @author     Alley Interactive <griffen@alleyinteractive.com>
 */
class AI_VR_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, AI_VR_URL . '/app/css/ai-vr-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'aframe-core', 'https://aframe.io/releases/0.5.0/aframe.min.js', array(), null, false );
		wp_enqueue_script( 'aframe-animation', 'https://npmcdn.com/aframe-animation-component@3.0.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-events', 'https://npmcdn.com/aframe-event-set-component@3.0.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-layout', 'https://npmcdn.com/aframe-layout-component@3.0.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-template', 'https://npmcdn.com/aframe-template-component@3.1.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-lookat', 'https://unpkg.com/aframe-look-at-component@0.2.0/dist/aframe-look-at-component.min.js', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-href', 'https://npmcdn.com/aframe-href-component@0.5.1', array('aframe-core'), null, false );

		wp_enqueue_script( $this->plugin_name, AI_VR_URL . 'app/js/ai-vr-public.js', array( 'jquery', 'aframe-core' ), $this->version, false );
	}

	/**
	 * Registers Shortcodes with Wordpress
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {

		add_shortcode('ai_vr_recent', array( $this, 'ai_vr_recent_posts_shortcode' ) );

	}

	public function ai_vr_recent_posts_shortcode( $atts, $content = null ) {
		// extract( shortcode_atts( array(
		// 			'message' => ''
		// 		), $atts
		// 	)
		// );
		ob_start();
		require_once AI_VR_PATH . 'includes/partials/ai-vr-recent-posts-shortcode.php';
		return ob_get_clean();
		// return '<iframe src="' . AI_VR_URL . 'partials/AI_VR-public-display.php' .'"></iframe>';
	}

}
