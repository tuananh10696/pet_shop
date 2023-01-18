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
			<div class="row">
				<div class="col-6 card-secondary">
					<div class="card-header">
						<h3 class="card-title">Before</h3>
					</div>
					<?= $this->Form->input("info_contents.{$rownum}.before_text", ['type' => 'textarea',  'maxlength' => 200, 'class' => 'form-control']); ?>
					<span class="attention">※リスト利用の場合「・」を入力してください</span>
				</div>
				<div class="col-6 card-secondary">
					<div class="card-header">
						<h3 class="card-title">After</h3>
					</div>
					<?= $this->Form->input("info_contents.{$rownum}.after_text", ['type' => 'textarea',  'maxlength' => 200, 'class' => 'form-control']); ?>
					<span class="attention">※リスト利用の場合「・」を入力してください</span>
				</div>
			</div>
		</div>
	</div>

	<div class="table__column table__column-sub">
		<span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.Before・After</span>
		<div class="table__row-config">
			<?= $this->element('UserInfos/sort_handle2'); ?>
			<?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
		</div>
	</div>
</div>