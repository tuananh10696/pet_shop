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
?>
        <?= $this->Form->input("info_append_items.{$num}.value_text",['type'=>'text','maxlength' => $length, 'class' => 'form-control']); ?>
        <?= empty($length)?'':'<br><span>※'.h($length).'文字以内で入力してください</span>';?>
        <?= $this->Form->error("{$slug}.{$append['slug']}") ?>

<?= $this->element('edit_form/append_item-end'); ?>