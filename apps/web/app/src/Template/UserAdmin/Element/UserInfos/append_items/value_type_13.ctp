<?= $this->element('edit_form/append_item-start',[
    'title' => $append['name'],
    'slug' => $append['slug'],
    'required' => ($append['is_required'] ? true : false),
    'num' => $num,
    'data' => $data,
    'append' => $append
]); ?>

<?php 
if(empty($append['max_length']) || $append['max_length'] == 0){
$length = '';
}else{
$length = $append['max_length'];
}
$checked = false;
if (empty($data['info_append_items'][$num]['id'])) {
    $checked = ($append['value_default'] == 1 ? true : false);
} else {
    $checked = ($data['info_append_items'][$num]['value_decimal'] == 1 ? true : false);
}
?>
<?= $this->Form->input("info_append_items.{$num}.value_int",[
        'type'=>'checkbox', 'value' => '1', 'hiddenField' => true, 'id' => "append_{$num}_check", 'checked' => $checked,
        'class' => 'form-control']); ?>
<label for="append_<?= h($num) ?>_check"><?= h($append['attention']) ?></label>
<?= $this->Form->error("{$slug}.{$append['slug']}") ?>

<?= $this->element('edit_form/append_item-end'); ?>