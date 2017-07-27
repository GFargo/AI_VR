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

			<img id="alley-logo" crossorigin="anonymous" src="<?php echo AI_VR_URL . 'app/img/alley_logo.png'; ?>">

			<script id="alley_box" type="text/html">
					<a-entity
						class="alley_box"
						geometry="primitive: box; width: 0.5; height: 0.5; depth: 0.5;"
						material="src: #alley-logo;"
						position="0 1 0"
						href="https://alleyinteractive.com"
						>
						<a-animation attribute="rotation"
						   dur="5000"
						   fill="forwards"
						   to="0 360 0"
						   repeat="indefinite"></a-animation>
						<a-animation attribute="position"
						   dur="3000"
						   fill="forwards"
						   direction="alternate"
						   to="0 2 0"
						   repeat="indefinite"></a-animation>
					</a-entity>
			</script>

		</a-assets>

		<!-- hack to prevent A-Frame from initializing -->
		<a-node></a-node>

		<!-- Alley Logos -->
		<a-entity id="alley_boxes" layout="type: dodecahedron; radius: 6;" position="0 0 0">
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
			<a-entity template="src: #alley_box"></a-entity>
		</a-entity>

		<a-text
			class='text-link'
			id="floor-text"
			align="center"
			rotation="-90 90 0"
			position="0 -3 0"
			color="#fefefe"
			href="https://vimeo.com/63902246"
			value="Don't Look Down!">
		</a-text>

		<!-- Skybox -->
		<a-sky id="skybox" radius="30" src="#background"></a-sky>

		<!-- Camera / Cursor -->
		<a-entity camera look-controls wasd-controls>
			<a-cursor id="cursor"
			animation__click="property: scale; startEvents: click; from: 0.1 0.1 0.1; to: 1 1 1; dur: 150"
			animation__fusing="property: fusing; startEvents: fusing; from: 1 1 1; to: 0.1 0.1 0.1; dur: 1500"
			event-set__mouseenter="_event: mouseenter; color: springgreen"
			event-set__mouseleave="_event: mouseleave; color: black"
			fuse="true"
			raycaster="objects: .alley_box .text-link"></a-cursor>
		</a-entity>
	</a-scene>
</div>
