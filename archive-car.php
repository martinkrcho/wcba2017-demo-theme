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

<div id="page" role="main" class="car-list-wrapper">

	<form class="car-filter-form">

		<input type="hidden" name="orderby" value="date" />
		<input type="hidden" name="page" value="1" />
		<div class="row">

			<div class="columns small-12 large-6 ordering">

				<label><?php _e('Zoradené'); ?>:</label>
				<button type="button" name="button" class="active" data-name="orderby" data-value="date">Od najnovšieho</button>
				<button type="button" name="button" data-name="orderby" data-value="title">Abecedne</button>
				<button type="button" name="button" data-name="orderby" data-value="mileage">Podľa km</button>

			</div>

			<div class="columns small-12 large-6">

				<div class="row">
					<div class="columns small-12 large-6">
						<label>
							<?php _e('Vyberte rok'); ?>:
							<select name="year">
								<option value="all" selected="selected">všetky</option>
								<?php foreach (get_terms(array('taxonomy' => 'year', 'hide_empty' => false)) as $term): ?>
									<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</div>

					<div class="columns small-12 large-6">
						<label>
							<?php _e('Vyberte výrobcu'); ?>:
							<select name="manufacturer">
								<option value="all" selected="selected">všetci</option>
								<?php foreach (get_terms(array('taxonomy' => 'manufacturer', 'hide_empty' => false)) as $term): ?>
									<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</div>
				</div>
			</div>

		</div>
	</form>

	<?php if (have_posts()) : ?>

		<article class="row medium-uncollapse" data-equalizer data-equalize-by-row="true">
			<?php get_template_part('template-parts/content', 'car-template'); ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('template-parts/content', 'car'); ?>
			<?php endwhile; ?>
		</article>

		<div class="row">

			<a class="expanded button load-more" href="#"><?php _e('zobraziť ďalšie', 'foundationpress'); ?></a>
		</div>
	<?php endif; // End have_posts() check. ?>

</div>

<?php
get_footer();
