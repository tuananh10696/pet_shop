<div class="customer-gallery">
	<?php for ($i = 1; $i <= 2; $i++) : ?>
		<?php $img = __('image{0}', $i == 1 ? '' : '_' . $i); ?>
		<?php if (isset($c['attaches'][$img][0]) && $c['attaches'][$img][0] != '') : ?>
			<img class="fit" src="<?= $c['attaches'][$img][0] ?>" alt="" loading="lazy" decoding="async">
		<?php endif ?>
	<?php endfor ?>
</div>