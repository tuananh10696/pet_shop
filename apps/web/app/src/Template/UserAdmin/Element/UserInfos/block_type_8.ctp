<div class="table__row first-dir item_block" id="block_no_<?= h($rownum); ?>" data-sub-block-move="1">
  <div class="table__column">
    <div class="block_header">
      <?= $this->Form->input("info_contents.{$rownum}.id", ['type' => 'hidden', 'value' => @$content['id'], 'id' => "idBlockId_" . h($rownum)]); ?>
      <?= $this->Form->input("info_contents.{$rownum}.position", ['type' => 'hidden', 'value' => h($content['position'])]); ?>
      <?= $this->Form->input("info_contents.{$rownum}.block_type", ['type' => 'hidden', 'value' => h($content['block_type']), 'class' => 'block_type']); ?>
      <?= $this->Form->input("info_contents.{$rownum}.section_sequence_id", ['type' => 'hidden', 'value' => h($content['section_sequence_id']), 'class' => 'section_no']); ?>
      <?= $this->Form->input("info_contents.{$rownum}._block_no", ['type' => 'hidden', 'value' => h($rownum)]); ?>
    </div>

    <div class="block_title"></div>


    <div class="modal-body table_area">
      <dl>
        <dt>１．ボタン名</dt>
        <dd>
          <?= $this->Form->input("info_contents.{$rownum}.title", [
            'type' => 'text',
            'style' => 'width: 100%;',
            'maxlength' => 30,
            // 'onchange' => 'changeButtonName(this);',
            'data-row' => h($rownum)
          ]); ?>
          <div>※30文字以内</div>
        </dd>

        <dt style="margin-top: 10px;">２．リンク先
          <?= $this->Form->input("info_contents.{$rownum}.option_value2", [
            'type' => 'select',
            'options' => $link_target_list,
            'value' => $content['option_value2']
          ]); ?>

        </dt>
        <dd>
          <?= $this->Form->input("info_contents.{$rownum}.content", ['type' => 'text', 'style' => 'width: 100%;', 'maxlength' => 255, 'placeholder' => 'http://']); ?>
        </dd>
        <?php if (false) : ?>
          <dt>３．ボタンの背景色</dt>
          <dd>
            <?= $this->Form->input("info_contents.{$rownum}.option_value", [
                'type' => 'select',
                'options' => $button_color_list,
                'empty' => ['' => '指定なし'],
                'value' => $content['option_value'],
                'escape' => false,
              ]); ?>　
          </dd>
        <?php else : ?>
          <dd><?= $this->Form->input("info_contents.{$rownum}.option_value", ['type' => 'hidden', 'value' => '']); ?></dd>
        <?php endif; ?>

      </dl>
    </div>
  </div>


  <div class="table__column table__column-sub">
    <span style="font-size:0.9rem;"><?= (h($rownum) + 1); ?>.リンクボタン</span>
    <div class="table__row-config">
      <?= $this->element('UserInfos/sort_handle2'); ?>
      <?= $this->element('UserInfos/item_block_buttons', ['rownum' => $rownum, 'disable_config' => true]); ?>
    </div>
  </div>
</div>