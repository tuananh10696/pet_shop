<?php $info_id = isset($datas) ? $datas['info_id'] : (isset($entity) && $entity->id ? $entity->id : 0); ?>
<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
	<div class="table__column">
		<div class="block_header">
			<?= $this->Form->input("info_contents.{$rownum}.id", ['type' => 'hidden', 'value' => @$content['id'], 'id' => "idBlockId_" . h($rownum)]); ?>
			<?= $this->Form->input("info_contents.{$rownum}.position", ['type' => 'hidden', 'value' => h($content['position'])]); ?>
			<?= $this->Form->input("info_contents.{$rownum}.block_type", ['type' => 'hidden', 'value' => h($content['block_type']), 'class' => 'block_type']); ?>
			<?= $this->Form->input("info_contents.{$rownum}.section_sequence_id", ['type' => 'hidden', 'value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
			<?= $this->Form->input("info_contents.{$rownum}._block_no", ['type' => 'hidden', 'value' => h($rownum)]); ?>
		</div>
		<div class="block_content">
			<div class="row mt-2">
				<?php if ($info_id == 0) : ?>
					<div class="row">
						<div class="attention f_c_red">＊新規登録の際は登録ができません。記事を保存したあとにクライアントを登録し編集で選択してください。</div>
					</div>
				<?php else : ?>
					<div class="col-10">
						<?= $this->Form->input('__', ['class' => __('form-control {0}', $info_id != 0 ? '' : 'not_member'), 'placeholder' => '＊導入先お客様情報が表示されます。', 'readonly']); ?>
					</div>
					<div class="col-2 pt-2">
						<?php if ($info_id != 0) : ?>
							<small>（&nbsp;<a href="<?= __('/user_admin/infos/edit/0?page_slug={0}&parent_id={1}', CLIENT, $info_id) ?>" target="_blank">導入先お客様情報ページ</a>&nbsp;）</small>
						<?php endif ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="table__column table__column-sub">
		<span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.導入先お客様情報</span>
		<div class="table__row-config">
			<?= $this->element('UserInfos/sort_handle2'); ?>
			<?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
		</div>
	</div>
</div>