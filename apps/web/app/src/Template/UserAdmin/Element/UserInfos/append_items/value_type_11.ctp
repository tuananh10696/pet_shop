<?= $this->element('edit_form/append_item-start', [
    'title' => $append['name'],
    'slug' => $append['slug'],
    'required' => ($append['is_required'] ? true : false),
    'num' => $num,
    'data' => $data,
    'append' => $append
]); ?>

<?php
if (empty($append['max_length']) || $append['max_length'] == 0) {
    $length = '';
} else {
    $length = $append['max_length'];
}
?>

<?= $this->Form->input("info_append_items.{$num}.value_key", [
    'type' => 'checkbox', 'value' => '1', 'id' => "append_{$num}_check", 'class' => 'form-control', 'style' => 'width: 30px;margin-top: 10px;'
]); ?>

<label for="append_<?= h($num) ?>_check"><?= h(@$label_message) ?></label>
<?= $this->Html->view($append['attention'], ['before' => '<br><span>', 'after' => '</span>']); ?>
<?= $this->Form->error("{$slug}.{$append['slug']}") ?>

<?= $this->element('edit_form/append_item-end'); ?>