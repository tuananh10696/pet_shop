<?php if ($c['attaches']['image']['0']) : ?>

	<?php if ($c['content'] != '') : ?>
		<a href="<?= h($c['content']) ?>" target="<?= $c['option_value'] ?>">
		<?php endif; ?>
		<img class="img-fluid w-100 mb-4" src="<?= $c['attaches']['image']['0'] ?>" alt="Image">
		<?php if ($c['content'] != '') : ?>
		</a>
	<?php endif; ?>


<?php endif; ?>