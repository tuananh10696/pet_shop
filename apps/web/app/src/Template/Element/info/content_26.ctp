<?php if (!is_null($info_client)) : ?>
	<div class="customer">
		<h2 class="c-ttls"><span>導入先お客様情報</span></h2>
		<div class="customer-info">
			<figure class="customer-info__images">
				<img class="fit fit--contain" src="<?= $info_client->attaches['image']['0']; ?>" alt="" width="416" height="304" loading="lazy" decoding="async">
			</figure>
			<div class="customer-info__text">
				<dl>
					<dt>会社名</dt>
					<dd><?= h($info_client->info_append_items[0]->value_text); ?></dd>
				</dl>
				<dl>
					<dt>所在地</dt>
					<dd><?= h($info_client->info_append_items[1]->value_text); ?></dd>
				</dl>
				<dl>
					<dt>業種</dt>
					<dd><?= h($info_client->info_append_items[2]->value_text); ?></dd>
				</dl>
				<dl>
					<dt>Webサイト</dt>
					<dd><a href="<?= h($info_client->info_append_items[3]->value_text); ?>" target="_blank"><?= h($info_client->info_append_items[3]->value_text); ?></a></dd>
				</dl>
			</div>
		</div>
		<div class="customer-gallery">
			<?php
				foreach ($info_client->info_contents as $get_img) {
					$elements = [$get_img->attaches['image'][0], $get_img->attaches['image_2'][0], $get_img->attaches['image_3'][0]];
					array_walk($elements, function ($value) {
						if ($value != '') {
							echo '<img class="fit" src="' . $value . '" alt="" width="314" height="229" loading="lazy" decoding="async">';
						}
					});
				}
				?>
		</div>
	</div>
<?php endif ?>