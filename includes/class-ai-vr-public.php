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
	 * The path to scene partials.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The path used to require scene partials.
	 */
	public $partial_path;

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
		$this->partial_path = AI_VR_PATH . 'includes/partials/';

		// TODO: REMOVE
		// changes 2017 theme description & title based on current page
		add_filter( 'bloginfo', [ $this, 'update_blog_info' ], 10, 2 );

	}

	// TODO: REMOVE
	// changes 2017 theme description & title based on current page
	public function update_blog_info( $text, $show ) {
		// only run on single pages
		if ( ! is_home() && ! is_front_page() && is_page() ) {
		    if ( 'description' === $show ) {
		        $text = get_bloginfo( 'name' );
		    }
		    if ( 'name' === $show ) {
		    	$text = get_the_title();
		    }
		}
	    return $text;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, AI_VR_URL . '/static/css/global.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		// AFrame Core & Component Libs
		wp_enqueue_script( 'aframe-core', 'https://aframe.io/releases/0.5.0/aframe.min.js', array(), null, false );
		wp_enqueue_script( 'aframe-animation', 'https://npmcdn.com/aframe-animation-component@3.0.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-events', 'https://npmcdn.com/aframe-event-set-component@3.0.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-layout', 'https://unpkg.com/aframe-layout-component@4.2.0/dist/aframe-layout-component.min.js', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-template', 'https://npmcdn.com/aframe-template-component@3.1.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-lookat', 'https://unpkg.com/aframe-look-at-component@0.2.0/dist/aframe-look-at-component.min.js', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-href', 'https://npmcdn.com/aframe-href-component@0.5.1', array('aframe-core'), null, false );
		wp_enqueue_script( 'aframe-html-shader', 'https://unpkg.com/aframe-html-shader@0.2.0/dist/aframe-html-shader.min.js', array('aframe-core'), null, false );

		// Our Javascript
		wp_enqueue_script( $this->plugin_name, AI_VR_URL . 'static/js/global.bundle.js', array( 'jquery', 'aframe-core' ), $this->version, false );
	}

	/**
	 * Registers our VR Shortcodes with Wordpress
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		// Hello World - Basic Demo
		add_shortcode('ai_vr_hello_world', array( $this, 'ai_vr_hello_world_shortcode' ) );

		// Recent Post - Display Recent Posts
		add_shortcode('ai_vr_recent', array( $this, 'ai_vr_recent_posts_shortcode' ) );

		// Post - Display Single Post Content
		add_shortcode('ai_vr_post', array( $this, 'ai_vr_single_post_shortcode' ) );
	}

	/**
	 * Renders out markup for Hello World shortcode
	 */
	public function ai_vr_hello_world_shortcode() {
		ob_start();
		require_once $this->partial_path . 'ai-vr-hello-world-shortcode.php';
		return ob_get_clean();
	}

	/**
	 * Renders out markup for Recent Posts shortcode
	 */
	public function ai_vr_recent_posts_shortcode() {
		ob_start();
		require_once $this->partial_path . 'ai-vr-recent-posts-shortcode.php';
		return ob_get_clean();
	}

	/**
	 * Renders out markup for Single Post shortcode
	 */
	public function ai_vr_single_post_shortcode() {
		ob_start();
		require_once $this->partial_path . 'ai-vr-single-post-shortcode.php';
		return ob_get_clean();
	}

}
