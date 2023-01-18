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
$placeholder = '';
if (isset($placeholder_list[$append['slug']])) {
	$placeholder = $placeholder_list[$append['slug']];
}
$notes = '';
if (isset($notes_list[$append['slug']])) {
	$notes = $notes_list[$append['slug']];
}

$opt_input = ['type' => 'text', 'class' => 'form-control', 'maxlength' => $length, 'default' => empty($append['value_default']) ? '' : h($append['value_default']), 'placeholder' => h($placeholder)];
if ($append['slug'] == 'yt') $opt_input['onchange'] = "getVideoYT(this)"; ?>

<?= $this->Form->input("info_append_items.{$num}.value_text", $opt_input); ?>
<?= empty($length) ? '' : '<div class="attention">※' . h($length) . '文字以内で入力してください</div>'; ?>
<?= empty($notes) ? '' : '<div class="attention">※' . h($notes) . '</div>'; ?>

<?php if ($append['slug'] === 'yt') : ?>
	<?php $id = getIDofYTfromURL(@$entity->info_append_items[$num]->value_text); ?>
	<?php $src = @$entity->info_append_items[$num]->value_text ? __('https://www.youtube.com/embed/{0}', $id ?? $entity->info_append_items[$num]->value_text) : ''; ?>

	<div class="yt<?= @$entity->info_append_items[$num]->value_text ? '' : ' dpl_none' ?>">
		<iframe width="560" height="315" src="<?= $src ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
<?php endif; ?>

<?= $this->Html->view($append['attention'], ['before' => '<div class="attention">', 'after' => '</div>']); ?>
<?= $this->Form->error("{$slug}.{$append['slug']}") ?>
<?= $this->element('edit_form/append_item-end'); ?>