<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="0">
	<div class="table__column">
		<tr>
			<td>
				<div class="sort_handle"></div>
				<?= $this->Form->input("info_contents.{$rownum}.id", ['type' => 'hidden', 'value' => @$content['id'], 'id' => "idBlockId_" . h($rownum)]); ?>
				<?= $this->Form->input("info_contents.{$rownum}.position", ['type' => 'hidden', 'value' => h($content['position'])]); ?>
				<?= $this->Form->input("info_contents.{$rownum}.block_type", ['type' => 'hidden', 'value' => h($content['block_type']), 'class' => 'block_type']); ?>
				<?= $this->Form->input("info_contents.{$rownum}.title", ['type' => 'hidden', 'value' => '']); ?>
				<?= $this->Form->input("info_contents.{$rownum}.file", ['type' => 'hidden', 'value' => '']); ?>
				<?= $this->Form->input("info_contents.{$rownum}.file_size", ['type' => 'hidden', 'value' => '0']); ?>
				<?= $this->Form->input("info_contents.{$rownum}.file_name", ['type' => 'hidden', 'value' => '']); ?>
				<?= $this->Form->input("info_contents.{$rownum}.section_sequence_id", ['type' => 'hidden', 'value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
				<?= $this->Form->input("info_contents.{$rownum}._block_no", ['type' => 'hidden', 'value' => h($rownum)]); ?>
				<?= $this->Form->input("info_contents.{$rownum}.option_value3", ['type' => 'hidden', 'value' => '']); ?>
				<?= $this->Form->input("info_contents.{$rownum}.option_value2", ['type' => 'hidden', 'value' => '']); ?>
			</td>

			<td colspan="2">
				<div class="sub-unit__wrap">
					<?php for ($i = 1; $i <= 2; $i++) : ?>

						<?php $image_column = $i == 1 ? 'image' : __('image_{0}', $i); ?>

						<dt><?= $i ?>. 画像</dt>
						<dd>
							<div class="td_parent">
								<?= $this->Form->input("info_contents.{$rownum}.{$image_column}", ['type' => 'file', 'accept' => '.jpeg, .jpg, .gif, .png', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'image/jpeg,image/gif,image/png', 'class' => 'attaches']); ?>
								<?php if (!empty($content['attaches'][$image_column]['0'])) : ?>
									<div class="thumbImg">
										<a href="<?= h($content['attaches'][$image_column]['0']); ?>" class="pop_image_single">
											<img src="<?= $this->Url->build($content['attaches'][$image_column]['0']) ?>" style="width: 300px;">
											<?= $this->Form->input("info_contents.{$rownum}.attaches.{$image_column}.0", ['type' => 'hidden']); ?>
										</a>
										<?= $this->Form->input("info_contents.{$rownum}._old_{$image_column}", ['type' => 'hidden', 'value' => h($content[$image_column]), 'class' => 'old_img_input']); ?>
									</div>
								<?php endif; ?>

								<div class="preview_img dpl_none">
									<span class="preview_img_btn" onclick="preview_img_action(this)">画像の削除</span>
								</div>

								<div class="attention">※jpeg , jpg , gif , png ファイルのみ</div>
								<div class="attention">※ファイルサイズ5MB以内</div>
							</div>
							<hr>
						</dd>
					<?php endfor; ?>
				</div>
			</td>
		</tr>
	</div>
	<div class="table__column table__column-sub">
		<span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.複数画像</span>
		<div class="table__row-config">
			<?= $this->element('UserInfos/sort_handle2'); ?>
			<?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
		</div>
	</div>
</div>