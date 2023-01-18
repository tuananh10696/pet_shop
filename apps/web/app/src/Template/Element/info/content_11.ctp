<?php if ($c['attaches']['image']['0'] != '') : ?>
	<div class="float <?= $c['image_pos'] == 'left' ? '' : 'float--rev' ?> clearfix">
		<img src="<?= $c['attaches']['image']['0']; ?>" alt="" loading="lazy" decoding="async">
		<p><?= nl2br(h($c['content'])); ?></p>
	</div>
<?php endif; ?>