<?php

/**
 *
 */

if ( !class_exists( 'AI_VR_scene' ) ) :

class AI_VR_Scene {

	public $assets;

	public $entities;

	private $recent_posts;

	private static $instance;

	private function __construct() {
		/* Don't do anything, needs to be initialized via instance() method */
	}

	public function __clone() { wp_die( "Please don't __clone AI_VR_scene" ); }

	public function __wakeup() { wp_die( "Please don't __wakeup AI_VR_scene" ); }

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new AI_VR_scene;
			self::$instance->setup();
		}
		return self::$instance;
	}

	public function setup() {
		// grab and parse our recent posts
		$this->parse_recent_content( $this->get_recent_posts() );
	}

	public function get_recent_posts() {
		if ( empty( $this->recent_posts ) ) {
			$posts = get_posts( array(
				'posts_per_page'   => 8,
				'offset'           => 0,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => true
			));

			if ( empty( $posts ) ) {
				return;
			}

			$this->recent_posts = $posts;
		}

		return $this->recent_posts;
	}

	public function parse_recent_content( $posts ) {
		// go through each post and prep content for aframe output
		foreach ( $posts as $post ) {
			$this->parse_post( $post );
		}
	}

	public function get_background_image() {
		global $post;
		$background_src = get_the_post_thumbnail_url( $post, 'full' );
		if ( ! empty( $background_src ) ) {
			$this->add_asset( 'img', 'background', $background_src );
		}
	}

	// Add a new asset to the assets array
	public function add_asset( $tag, $id, $src, $origin = 'anonymous', $has_closing_tag = false  ) {
		if ( empty( $tag ) || empty( $id ) || empty( $src ) ) {
			return;
		}
		// To save time we're compile tags manually.
		$asset = sprintf(
			'<%s id="%s" crossorigin="%s" src="%s">%s',
			$tag,
			$id,
			$origin,
			$src,
			( $has_closing_tag ? '</' . $tag . '>' : '' )
		);

		$this->assets[] = $asset;
	}

	// Parse content of each post e.g. title, slug, excerpt, thumbnail
	public function parse_post( $post ) {
		if ( empty( $post->ID ) ) {
			return;
		}

		// store post featured image url as an asset
		// this will be output at the top of the scene
		// in the <a-assets> tag.
		$thumb_src = get_the_post_thumbnail_url( $post, 'large' );
		if ( ! empty( $thumb_src ) ) {
			$this->add_asset( 'img', $post->post_name, $thumb_src );
		}

		$animation = '';

		if ( ! empty( $post->post_name ) ) {
			$post_entity = sprintf(
				'<a-entity template="src: %s" data-src="%s" data-slug="%s" data-title="%s" data-excerpt="%s" data-thumb="#%s">%s</a-entity>',
				'#link',
				get_post_permalink( $post->ID ),
				$post->post_name,
				$post->post_title,
				get_the_excerpt( $post ),
				$post->post_name,
				$animation
			);

			$this->entities[] = $post_entity;
		}


	}

	public function get_assets() {
		$this->get_background_image();
		return $this->assets;
	}

	public function get_entities() {
		return $this->entities;
	}

}

function AI_VR_scene() {
	return AI_VR_scene::instance();
}
add_action( 'after_setup_theme', 'AI_VR_scene' );

endif;
