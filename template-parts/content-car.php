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
			<?php $manufacturer = get_the_terms(get_the_ID(), 'manufacturer'); ?>
			<?php if (!empty($manufacturer)): ?>
				<p class="manufacturer">
					<span class="meta-label"><i class="fa fa-address-card"></i><?php _e('Manufacturer', 'foundationpress'); ?>:</span><?php echo $manufacturer[0]->name; ?>
				</p>
			<?php endif; ?>
			<?php $year = get_the_terms(get_the_ID(), 'year'); ?>
			<?php if (!empty($year)): ?>
				<p class="year">
					<span class="meta-label"><i class="fa fa-calendar-o"></i><?php _e('Year', 'foundationpress'); ?>:</span><?php echo $year[0]->name; ?>
				</p>
			<?php endif; ?>
		</footer>
	</div>
</div>