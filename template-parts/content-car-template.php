<?php
/**
 * Hanldebars template for displaying custom post type content in the archive
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>
<script id="car-template" type="text/x-handlebars-template">
	<div id="post-{{id}}; ?>" <?php post_class('blogpost-entry column small-12 medium-6 large-4'); ?> data-equalizer-watch>
	<div class="inner card">
	<header>
	{{#if thumbnail_url}}
	<a class="featured" href="{{permalink}}" title="{{title}}" style="background-image: url('{{thumbnail_url}}');"></a>
	{{/if}}
	<h2><a href="{{permalink}}">{{title}}</a></h2>
	</header>
	</div>
	</div>
</script>