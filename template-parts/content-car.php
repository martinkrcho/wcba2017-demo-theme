<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry column small-12 medium-6 large-4'); ?> data-equalizer-watch>
	<div class="inner card">
		<header>
			<?php if (has_post_thumbnail()): ?>
				<a class="featured" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');"></a>
			<?php endif; ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<footer>
			<?php get_template_part('template-parts/fragment', 'car-specs'); ?>
		</footer>
	</div>
</div>