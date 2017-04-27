<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header();
?>

<?php get_template_part('template-parts/featured-image'); ?>

<div id="single-post" role="main">

	<?php do_action('foundationpress_before_content'); ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>

			</header>
			<?php do_action('foundationpress_post_before_entry_content'); ?>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php edit_post_link(__('Edit', 'foundationpress'), '<span class="edit-link">', '</span>'); ?>
			</div>
			<footer>
				<a class="expanded button" href="<?php echo get_post_type_archive_link('car'); ?>"><?php _e('späť na zoznam áut', 'foundationpress'); ?></a>
			</footer>
		</article>

		<aside class="sidebar">
			<?php get_template_part('template-parts/fragment', 'car-specs'); ?>
		</aside>
	<?php endwhile; ?>

</div>
<?php
get_footer();
