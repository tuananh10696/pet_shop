<?= $this->element('edit_form/append_item-start', [
	'title' => $append['name'],
	'slug' => $append['slug'],
	'required' => ($append['is_required'] ? true : false),
	'num' => $num,
	'data' => $data,
	'append' => $append
]); ?>

<?php $image_column = 'image'; ?>

<dl>
	<dd class="td_parent">
		<?= $this->Form->input("info_append_items.{$num}.{$image_column}", array('type' => 'file', 'accept' => '.jpeg, .jpg, .gif, .png', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'image/jpeg,image/gif,image/png', 'class' => 'attaches')); ?>

		<?php if (!empty($data['info_append_items'][$num]['attaches'][$image_column]['0'])) : ?>
			<div class="thumbImg">
				<a href="<?= h($data['info_append_items'][$num]['attaches'][$image_column]['0']); ?>" class="pop_image_single">
					<img src="<?= $this->Url->build($data['info_append_items'][$num]['attaches'][$image_column]['0']) ?>" style="width: 300px;">
					<?= $this->Form->input("info_append_items.{$num}.attaches.{$image_column}.0", ['type' => 'hidden']); ?>
				</a>
				<?= $this->Form->input("info_append_items.{$num}._old_{$image_column}", ['type' => 'hidden', 'default' => h($data['info_append_items'][$num][$image_column]), 'class' => 'old_img_input']); ?>
			</div>
		<?php endif; ?>

		<div class="preview_img dpl_none">
			<span class="preview_img_btn" onclick="preview_img_action(this)">画像の削除</span>
		</div>
		<div class="attention">※jpeg , jpg , gif , png ファイルのみ</div>
		<div class="attention">※ファイルサイズ5MB以内</div>
		<?php if ($page_config->slug == CASESTUDY && $num == 4) : ?>
			<div class="attention">※推奨画像サイズ　2000px×760px</div>
		<?php elseif ($page_config->slug == CASESTUDY && $num == 5) : ?>
			<div class="attention">※推奨画像サイズ　770px×486px</div>
		<?php elseif ($page_config->slug == STAFF) : ?>
			<div class="attention">※推奨画像サイズ　2000px×928px</div>
		<?php endif; ?>



		<?= $this->Html->view($append['attention'], ['before' => '<br><span>', 'after' => '</span>']); ?>
		<?= $this->Form->error("{$slug}.{$append['slug']}") ?>
	</dd>
</dl>

<?= $this->element('edit_form/append_item-end'); ?>