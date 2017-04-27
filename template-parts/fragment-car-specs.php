<div class="car-specs">
	<?php $manufacturer = get_the_terms(get_the_ID(), 'manufacturer'); ?>
	<?php if (!empty($manufacturer)): ?>
		<p>
			<span class="meta-label"><i class="fa fa-car"></i></span><?php echo $manufacturer[0]->name; ?>
		</p>
	<?php endif; ?>
	<?php $year = get_the_terms(get_the_ID(), 'year'); ?>
	<?php if (!empty($year)): ?>
		<p>
			<span class="meta-label"><i class="fa fa-calendar"></i></span><?php echo $year[0]->name; ?>
		</p>
	<?php endif; ?>
	<?php
	$otherMetaFields = array(
		'engine_size' => array(
			'suffix' => 'cm<super>3</super>',
			'icon' => 'cogs'
		),
		'mileage' => array(
			'suffix' => 'km',
			'icon' => 'tasks'
		),
		'consumption' => array(
			'suffix' => 'l/100km',
			'icon' => 'area-chart'
		)
	);
	?>
	<?php foreach ($otherMetaFields as $metaField => $item): ?>
		<?php if (get_field($metaField)): ?>
			<p>
				<span class="meta-label"><i class="fa fa-<?php echo $item['icon']; ?>"></i></span><?php the_field($metaField); ?>&nbsp;<?php echo $item['suffix']; ?>
			</p>
		<?php endif; ?>
	<?php endforeach; ?>
</div>