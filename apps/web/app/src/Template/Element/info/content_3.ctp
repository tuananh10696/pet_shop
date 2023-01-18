<?php if ($c['attaches']['image']['0']) : ?>
	<div class="about-img">
		<?php if ($c['content'] != '') : ?>
			<a href="<?= h($c['content']) ?>" target="<?= $c['option_value'] ?>">
			<?php endif; ?>
			<img src="<?= $c['attaches']['image']['0'] ?>" alt="">
			<?php if ($c['content'] != '') : ?>
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>