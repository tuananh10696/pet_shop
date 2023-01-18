<?php
if (isset($entity)) {
	$member_list = $entity->child_infos ?? [];
	$avatas = [];
	$opts = [];
	foreach ($member_list as $mb) {
		$avatas[] = __('<img src="/{0}/Infos/images/{1}" height="120" class="avata-{2} dpl_none" />', UPLOAD_BASE_URL, $mb->image, $mb->id);
		$opts[$mb->id] = $mb->title;
	}
}
?>
<?php $info_id = isset($datas) ? $datas['info_id'] : (isset($entity) && $entity->id ? $entity->id : 0); ?>

<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
	<div class="table__column">
		<div class="block_header">
			<?= $this->Form->input("info_contents.{$rownum}.id", ['type' => 'hidden', 'value' => @$content['id'], 'id' => "idBlockId_" . h($rownum)]); ?>
			<?= $this->Form->input("info_contents.{$rownum}.position", ['type' => 'hidden', 'value' => h($content['position'])]); ?>
			<?= $this->Form->input("info_contents.{$rownum}.block_type", ['type' => 'hidden', 'value' => h($content['block_type']), 'class' => 'block_type']); ?>
			<?= $this->Form->input("info_contents.{$rownum}.section_sequence_id", ['type' => 'hidden', 'value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
			<?= $this->Form->input("info_contents.{$rownum}._block_no", ['type' => 'hidden', 'value' => h($rownum), 'class' => '_block_no']); ?>
		</div>
		<div class="block_content">
			<div class="row box-chat-content">
				<div class="col-12 chat-content">
					<?php if (isset($content['member_chat']) && !empty($content['member_chat'])) : ?>
						<?php foreach ($content['member_chat'] as $i => $chat) : ?>

							<div class="row box_chat mt-2" data-member_id="<?= $chat['member_id'] ?>">
								<div class="col-12">
									<div class="col-12">
										<div class="row">
											<div class="col-2 t_align_c box-avata box-avata-left dpl_none">
												<?= implode('', $avatas) ?>
											</div>
											<div class="col-10 border p-2">
												<div class="row">
													<div class="col-5">
														<?= $this->Form->select("info_contents.{$rownum}.member_chat.{$i}.member_id", $opts, ['class' => 'form-control', 'empty' => [0 => '選択してください'], 'onchange' => 'changeMember(this)']); ?>
													</div>
												</div>
												<div class="row mt-1 box-enter-content-chat dpl_none">
													<div class="col-12">
														<?= $this->Form->input("info_contents.{$rownum}.member_chat.{$i}.content", ['type' => 'textarea', 'maxlength' => 300, 'class' => 'form-control']); ?>
													</div>
												</div>
											</div>
											<div class="col-2 t_align_c box-avata box-avata-right dpl_none">
												<?= implode('', $avatas) ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
			</div>
			<hr />
			<div class="row mt-2 box-btn-chat">
				<div class="col-5"></div>
				<div class="col-2">
					<span onclick="addBoxChat(this)" class="btn btn-default btn-block"><i class="fas fa-comments"></i>Chat</span>
				</div>
			</div>
			<?php if ($info_id == 0) : ?>
				<div class="row">
					<div class="attention f_c_red">＊新規登録の際は登録ができません。記事を保存したあとに座談会メンバーを登録し編集で選択してください。</div>
				</div>
			<?php endif ?>
		</div>
	</div>

	<div class="table__column table__column-sub">
		<span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.座談会チャット</span>
		<div class="table__row-config">
			<?= $this->element('UserInfos/sort_handle2'); ?>
			<?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
		</div>
	</div>
</div>