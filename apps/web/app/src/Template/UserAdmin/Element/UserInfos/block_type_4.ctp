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
      <?php $_column = 'file'; ?>
      <ul>
        <?php if (!empty($content['attaches'][$_column]['0'])) : ?>
          <li class="<?= h($content['attaches'][$_column]['extention']); ?>">
            <?= $this->Form->input("info_contents.{$rownum}.file_name", ['type' => 'text', 'maxlength' => '50', 'style' => 'width:300px;', 'placeholder' => '添付ファイル']); ?>.<?= h($content['file_extension']); ?>
            <?= $this->Form->input("info_contents.{$rownum}.file_size", ['type' => 'hidden', 'value' => h($content['file_size'])]); ?>
            <div><?= $this->Html->link('ダウンロード', $content['attaches'][$_column]['0'], array('target' => '_blank')) ?></div>
          </li>
          <?= $this->Form->input("info_contents.{$rownum}._old_{$_column}", array('type' => 'hidden', 'value' => h($content[$_column]))); ?>
          <?= $this->Form->input("info_contents.{$rownum}.file_extension", ['type' => 'hidden']); ?>
        <?php endif; ?>

        <li class="td_parent">
          <?= $this->Form->input("info_contents.{$rownum}.file", array('type' => 'file', 'class' => 'attaches', 'accept' => '.doc, .docx, .xls, .xlsx, .pdf', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/msword')); ?>
          <div class="attention">※PDF、Office(.doc, .docx, .xls, .xlsx)ファイルのみ</div>
          <div class="attention">※ファイルサイズ5MB以内</div>
        </li>
      </ul>
    </div>
  </div>

  <div class="table__column table__column-sub">
    <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.ファイル添付</span>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
    </div>
  </div>
</div>