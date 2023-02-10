<?php if ($c['attaches']['image']['0'] != '') : ?>
		<img class="img-fluid w-50 float-<?= $c['image_pos'] == 'left' ? 'left' : 'right' ?> mr-4 mb-3" src="<?= $c['attaches']['image']['0']; ?>" alt="" loading="lazy" decoding="async">
		<p style="margin-bottom: 20px;"><?= nl2br(h($c['content'])); ?></p>
<?php endif; ?>