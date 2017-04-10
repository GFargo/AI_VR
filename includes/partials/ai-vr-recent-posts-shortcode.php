<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://github.com/alleyinteractive
 * @since      1.0.0
 *
 * @package    AI_VR
 * @subpackage AI_VR/public/partials
 */

$assets = AI_VR_Scene()->get_assets();
$entities = AI_VR_Scene()->get_entities();

?>

<div class="ai-vr-toggle-scene">
	<a href>Open</a>
</div>

<div id="ai-vr-scene-container" class="ai-vr-scene-container">
	<a-scene embedded>
		<a-assets>
			<!-- Post Feature Image Assets -->
			<?php foreach ($assets as $asset): ?>
				<?php echo $asset; ?>
			<?php endforeach; ?>

			<img id="goto-link" crossorigin="anonymous" src="<?php echo AI_VR_URL . 'app/img/link.png'; ?>">
			<audio id="click-sound" crossorigin="anonymous" src="<?php echo AI_VR_URL . 'app/audio/click.ogg' ?>"></audio>

			<!-- Article Template -->
			<script id="link" type="text/html">
				<a-entity class="link"
				look-at="[camera]"
				geometry="primitive: plane; width: 2.25; height: 3.5;"
				material="color: #3a3a3a; depthTest: false"
				position="0 0 -0.01"
				event-set__1="_event: mousedown; scale: 1 1 1"
				event-set__2="_event: mouseup; scale: 1.2 1.2 1"
				event-set__3="_event: mouseenter; scale: 1.2 1.2 1"
				event-set__4="_event: mouseleave; scale: 1 1 1"
				event-set__5="_event: mouseenter; _target: #${slug}-text; opacity: 1.0; position: 0 1.3 0"
				event-set__6="_event: mouseleave; _target: #${slug}-text; opacity: 0.0; position: 0 0 0"
				event-set__5="_event: mouseenter; _target: #${slug}-link; opacity: 1.0;"
				event-set__6="_event: mouseleave; _target: #${slug}-link; opacity: 0.0;"
				sound="_event: mouseleave; src: #click-sound">
					<!-- Title -->
					<a-text
						id="${slug}-text"
						width="1.85"
						wrap-count="20.00"
						align="center"
						position="0 0 0"
						color="#fefefe"
						opacity="0"
						transparent="true"
						value="${title}">
					</a-text>

					<!-- Featured Image -->
					<a-image geometry="primitive: circle" width="1" height="1" src="${thumb}" roughness="0.8"></a-image>

					<!-- Article Link -->
					<a-image
						id="${slug}-link"
						geometry="primitive: plane;"
						position="0 -1.35 0.01"
						width="0.25"
						opacity="0.25"
						height="0.25"
						href="${src}"
						src="#goto-link">
						<a-ring
							color="#fefefe"
							radius-inner="0.23"
							opacity="0.5"
							radius-outer="0.26">
						</a-ring>
					</a-image>
				</a-entity>
			</script>
		</a-assets>

		<!-- hack to prevent A-Frame from initializing -->
		<a-node></a-node>

		<!-- Image links. -->
		<a-entity id="links" layout="type: circle; radius: 3.5" position="0 0 0">
			<?php foreach ( $entities as $entity ): ?>
				<?php echo $entity; ?>
			<?php endforeach ?>
		</a-entity>

		<!-- Skybox -->
		<a-sky id="skybox" radius="30" src="#background"></a-sky>

		<!-- Camera / Cursor -->
		<a-entity camera look-controls wasd-controls>
			<a-cursor id="cursor"
			animation__click="property: scale; startEvents: click; from: 0.1 0.1 0.1; to: 1 1 1; dur: 150"
			animation__fusing="property: fusing; startEvents: fusing; from: 1 1 1; to: 0.1 0.1 0.1; dur: 1500"
			event-set__1="_event: mouseenter; color: springgreen"
			event-set__2="_event: mouseleave; color: black"
			fuse="true"
			raycaster="objects: .link"></a-cursor>
		</a-entity>
	</a-scene>
</div>
