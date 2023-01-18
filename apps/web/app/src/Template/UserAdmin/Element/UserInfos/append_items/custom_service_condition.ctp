<tr id="append_block-<?= $append['slug'] ?>">
    <td>
        <?= h($append['name']);?>
        <?= ($append['is_required'] == 1)?'<span class="attent">※必須</span>':'';?>

        <?= $this->Form->input("info_append_items.{$num}.id",['type' => 'hidden','value' => empty($data['info_append_items'][$num]['id'])?'':$data['info_append_items'][$num]['id']]);?>
        <?= $this->Form->input("info_append_items.{$num}.append_item_id",['type' => 'hidden','value' => $append['id']]);?>
        <?= $this->Form->input("info_append_items.{$num}.is_required",['type' => 'hidden','value' => $append['is_required']]);?>
        <?= $this->Form->input("info_append_items.{$num}.value_text",['type' => 'hidden','value' => '']);?>
        <?= $this->Form->input("info_append_items.{$num}.value_textarea",['type' => 'hidden','value' => '']);?>
        <?= $this->Form->input("info_append_items.{$num}.value_date",['type' => 'hidden','value' => '0']);?>
        <?= $this->Form->input("info_append_items.{$num}.value_datetime",['type' => 'hidden','value' => DATE_ZERO]);?>
        <?= $this->Form->input("info_append_items.{$num}.value_time",['type' => 'hidden','value' => '0']);?>
        <?= $this->Form->input("info_append_items.{$num}.value_decimal",['type' => 'hidden','value' => '0']);?>
        <?= $this->Form->input("info_append_items.{$num}.value_key",['type' => 'hidden','value' => '']);?>
        <?= $this->Form->input("info_append_items.{$num}.file",['type' => 'hidden','value' => '']);?>
        <?= $this->Form->input("info_append_items.{$num}.file_size",['type' => 'hidden','value' => '0']);?>
        <?= $this->Form->input("info_append_items.{$num}.file_extension",['type' => 'hidden','value' => '']);?>
        <?= $this->Form->input("info_append_items.{$num}.image",['type' => 'hidden','value' => '']);?>
    </td>
    <td>
        <?= $this->Form->control("services._ids", ['type' => 'multiCheckbox', 'options' => $service_condition_list, 'label' => false]); ?>
    </td>
</tr>