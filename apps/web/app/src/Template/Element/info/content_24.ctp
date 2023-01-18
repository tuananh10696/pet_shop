<?php if (isset($c['member_chat']) && !empty($c['member_chat'])) : ?>
	<?php
	$img_pos_left = true;
	$count = 0;
	$member_id = 0;
	?>
	<div class="discussion">
		<?php foreach ($c['member_chat'] as $mb) : ?>
			<?php $mid = $mb['member_id'] ?>
			<?php if ($mid == 0) continue; ?>

			<?php if ($count != 0 && $mid != $member_id) : ?>
				<?php $img_pos_left = !$img_pos_left; ?>
			<?php endif ?>

			<div class="blockquote <?= $mb['member_info']['value_text'] && $mb['member_info']['value_text'] != '' ? $mb['member_info']['value_text'] : '' ?> <?= $img_pos_left ? '' : 'reverse' ?>">
				<div class="avatar">
					<figure>
						<img class="fit" src="<?= __('/{0}/Infos/images/{1}', UPLOAD_BASE_URL, $mb['member_info']['image']) ?>" alt="" width="136" height="136" loading="lazy" decoding="async">
					</figure>
					<p class="name"><?= h($mb['member_info']['title']) ?></p>
				</div>
				<div class="quote">
					<p><?= $mb['content'] ?></p>
				</div>
			</div>

			<?php $member_id = $mid ?>
			<?php $count++ ?>
		<?php endforeach ?>
	</div>
<?php endif ?>