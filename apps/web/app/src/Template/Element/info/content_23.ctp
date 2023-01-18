<div class="discussion">
	<div class="introduce">

		<?php foreach ($info->child_infos as $child) : ?>
			<div class="introduce-item <?= $child->value_text && $child->value_text != '' ? $child->value_text : '' ?>">
				<figure>
					<img class="fit" src="<?= __('/{0}/Infos/images/{1}', UPLOAD_BASE_URL, $child->image) ?>" alt="" width="314" height="229" loading="lazy" decoding="async">
				</figure>
				<div class="person">
					<h3 class="person-title"><?= h($child->title) ?></h3>
					<p class="regency">［担当］<br><?= h($child->info_append_items[0]['value_text']) ?></p>
					<p class="area"><?= h($child->info_append_items[1]['value_text']) ?></p>
				</div>
			</div>
		<?php endforeach ?>

	</div>
</div>