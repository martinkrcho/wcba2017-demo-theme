<?php
/**
 * Cars archive
 *
 *
 * @package FoundationPress
 * @subpackage Cars
 * @since FoundationPress 1.0.0
 */
get_header();
?>

<div id="page" role="main">
	<article class="row medium-uncollapse" data-equalizer data-equalize-by-row="true">
		<?php if (have_posts()) : ?>

			<?php /* Start the Loop */ ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('template-parts/content', 'car'); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part('template-parts/content', 'none'); ?>

		<?php endif; // End have_posts() check. ?>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php
		if (function_exists('foundationpress_pagination')) :
			foundationpress_pagination();
		elseif (is_paged()) :
			?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link(__('&larr; Older cars', 'foundationpress')); ?></div>
				<div class="post-next"><?php previous_posts_link(__('Newer cars &rarr;', 'foundationpress')); ?></div>
			</nav>
		<?php endif; ?>

	</article>

</div>

<?php
get_footer();
