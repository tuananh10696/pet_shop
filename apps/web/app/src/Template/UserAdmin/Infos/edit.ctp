<?php

use App\Model\Entity\PageConfigItem;
use App\Model\Entity\AppendItem;
?>

<?php
$this->start('beforeHeadClose');
echo '<link rel="stylesheet" type="text/css" href="/user/common/js/datetimepicker-master/jquery.datetimepicker.css"/>';
$this->end();
?>

<?php
$page_config_title = h($page_config->page_title);
if (isset($case_info))
	$page_config_title = __('{0}<br/><div style="width: 100%; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><small>【導入事例】{1}</small></div>', $page_config_title, h($case_info->title));
?>

<?php $this->assign('content_title', $page_config_title); ?>

<!-- Header breadcrumb -->
<?php $this->start('menu_list'); ?>

<?php if ($this->elementExists('InfoContents/edit-menu-list_' . $page_config->slug)) : ?>
	<?= $this->element('InfoContents/edit-menu-list_' . $page_config->slug); ?>
<?php else : ?>
	<li class="breadcrumb-item">
		<a href="<?= $this->Url->build(['action' => 'index', '?' => isset($_query) ? $_query : $query]); ?>"><?= h($page_title) ?></a>
	</li>
	<li class="breadcrumb-item active"><span><?= ($data['id'] > 0) ? '編集' : '新規登録'; ?></span></li>
<?php endif; ?>

<?php $this->end(); ?>
<!-- /Header breadcrumb -->

<!-- ??? -->
<?php if ($this->elementExists('InfoContents/content-prepend-' . $page_config->slug)) : ?>
	<?php $this->start('content_prepend'); ?>
	<?= $this->element('InfoContents/content-prepend-' . $page_config->slug); ?>
	<?php $this->end(); ?>
<?php endif; ?>
<!-- /??? -->

<?php $this->start('content_header'); ?>
<h2 class="card-title"><?= ($data["id"] > 0) ? '編集' : '新規登録'; ?></h2>
<?php $this->end(); ?>

<!-- FORM -->
<?= $this->Form->create($entity, array('type' => 'file', 'context' => ['validator' => 'default'], 'name' => 'fm', 'templates' => $form_templates)); ?>
<?= $this->Form->hidden('position'); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->hidden('page_config_id'); ?>
<?= $this->Form->hidden('page_config_slug', ['value' => h($page_config->slug)]); ?>
<?= $this->Form->hidden('meta_keywords'); ?>
<?= $this->Form->hidden('postMode', ['value' => 'save', 'id' => 'idPostMode']); ?>
<input type="hidden" name="MAX_FILE_SIZE" value="<?= (1024 * 1024 * 5); ?>">

<!-- ??? -->
<?php if (!empty($item)) : ?>
	<?= $this->Form->hidden('item_id', ['value' => $item->id]); ?>
<?php endif; ?>
<!-- /??? -->

<div class="table_edit_area">
	<!--記事番号-->
	<?= $this->element('edit_form/item-start', ['title' => '記事番号', 'required' => false]); ?>
	<?= ($data["id"]) ? sprintf('No. %04d', h($data["id"])) : "新規" ?>
	<?= $this->element('edit_form/item-end'); ?>

	<!--親ページ設定-->
	<?php if ($page_config->parent_config_id) : ?>
		<?= $this->element('edit_form/item-start', ['title' => $parent_config->page_title, 'required' => false]); ?>
		<?= h($parent_info->title); ?>
		<?= $this->Form->input('parent_info_id', ['type' => 'hidden', 'value' => $parent_info->id]); ?>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<!--掲載期間-->
	<?php if ($page_config->is_public_date) : ?>
		<!-- start - end -->
		<?= $this->element('edit_form/item-start', ['title' => '掲載期間', 'required' => true]); ?>
		<?= $this->Form->input('start_date', array('type' => 'text', 'class' => 'datepicker', 'data-auto-date' => '1', 'default' => date('Y/m/d'), 'style' => 'width: 120px;')); ?> ～
		<?= $this->Form->input('end_date', array('type' => 'text', 'class' => 'datepicker', 'style' => 'width: 120px;')); ?>
		<span>※開始日のみ必須。終了日を省略した場合は下書きにするまで掲載されます。</span>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<!-- only start -->
	<?= $this->element('edit_form/item-start', ['title' => '掲載日時', 'required' => true]); ?>

	<div class="input-group">

		<div class="input-group-prepend">
			<?= $this->Form->input('start_datetime', ['type' => 'text', 'class' => 'datetimepicker form-control', 'default' => (new DateTime())->format('Y/m/d'), 'style' => 'width: 100px;', 'readonly']); ?>
		</div>
	</div>

	<?= $this->element('edit_form/item-end'); ?>

	<!-- 記事表示 -->
	<?= $this->element('edit_form/item-start', ['title' => '記事表示']); ?>
	<?= $this->element('edit_form/item-status', ['enable_text' => '掲載する', 'disable_text' => '下書き']); ?>
	<?= $this->element('edit_form/item-end'); ?>

	<!--checkbox-->
	<?php if ($page_config->slug == 'news') : ?>
		<?= $this->element('edit_form/item-start', ['title' => 'TOPスライド表示']); ?>
		<?= $this->Form->checkbox('top_slide_display', array('type' => 'checkbox', 'class' => 'form-control', 'style' => 'width: 30px;margin-top: 10px;')); ?>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<!-- 基本項目 -->
	<!--タイトル-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'title')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'title', 'タイトル'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'sub_title', ''); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
		<?= $this->Form->input('title', array('type' => 'text', 'maxlength' => 100, 'class' => 'form-control')); ?>
		<div class="attention">※100文字以内で入力してください</div>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<!--カテゴリ-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'category')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'category', 'title', 'カテゴリ'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'category', 'sub_title', ''); ?>
		<?php if ($this->Common->isCategoryEnabled($page_config) && !$this->Common->isCategoryEnabled($page_config, 'category_multiple')) : ?>
			<!-- 単カテゴリ -->
			<?php
					//タグ無しのリスト
					$non_category_list = array_map(function ($v) {
						return $v;
					}, $category_list);
					?>
			<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
			<?= $this->Form->input('category_id', ['type' => 'select', 'options' => $non_category_list, 'empty' => ['0' => '選択してください'], 'class' => 'form-control']); ?>
			<?= $this->element('edit_form/item-end'); ?>
		<?php elseif ($this->Common->isCategoryEnabled($page_config) && $this->Common->isCategoryEnabled($page_config, 'category_multiple')) : ?>
			<!-- 複数カテゴリ -->
			<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
			<div class="list-group" style="height: 200px; overflow:auto;">
				<?php foreach ($category_list as $cat_id => $cat_name) : ?>
					<label class="list-group-item">
						<?= $this->Form->input(
										"info_categories.{$cat_id}",
										[
											'type' => 'checkbox',
											'value' => $cat_id,
											'checked' => in_array((int) $cat_id, $info_category_ids, false),
											'class' => 'form-check-input me-1',
											'hiddenField' => false
										]
									); ?>
						<?= $cat_name; ?>
					</label>
				<?php endforeach; ?>
			</div>
			<?= $this->element('edit_form/item-end'); ?>
		<?php endif; ?>
	<?php endif; ?>

	<!-- image -->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'image')) : ?>

		<?php $image_column = 'image'; ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image', 'title', 'メイン画像'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image', 'sub_title', '<div>(一覧と詳細に表示)</div>'); ?>

		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
		<div class="edit_image_area td_parent">
			<ul>
				<li>
					<?= $this->Form->input($image_column, array('type' => 'file', 'accept' => '.jpeg, .jpg, .gif, .png', 'onChange' => 'chooseFileUpload(this)', 'data-type' => 'image/jpeg,image/gif,image/png', 'class' => 'attaches')); ?>
					<?php if (!empty($data['attaches'][$image_column]['0'])) : ?>
						<div class="thumbImg">
							<a href="<?= $data['attaches'][$image_column]['0']; ?>" class="pop_image_single">
								<img src="<?= $this->Url->build($data['attaches'][$image_column]['0']) ?>" style="width: 300px;">
								<?= $this->Form->input("attaches.{$image_column}.0", ['type' => 'hidden']); ?>
							</a>
							<?= $this->Form->input("_old_{$image_column}", array('type' => 'hidden', 'default' => h($data[$image_column]), 'class' => 'old_img_input')); ?>
						</div>
					<?php endif; ?>

					<div class="preview_img dpl_none">
						<span class="preview_img_btn" onclick="preview_img_action(this)">画像の削除</span>
					</div>
					<div class="attention">※jpeg , jpg , gif , png ファイルのみ</div>
					<div class="attention"><?= $this->Form->getRecommendSize('Infos', 'image', ['before' => '※', 'after' => '']); ?></div>
					<div class="attention">※ファイルサイズ5MB以内</div>
					<?= $this->Form->error("_image") ?>
				</li>
			</ul>

			<?= $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'image', 'memo', ''); ?>
		</div>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>



	<!--概要-->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'notes')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'notes', 'title', $page_config->slug == 'staff' ? '見出し' : '一覧概要'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'notes', 'sub_title', '<div>(一覧と詳細に表示)</div>'); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte, 'required' => true]); ?>
		<?= $this->Form->input('notes', ['type' => 'textarea', 'maxlength' => 500, 'class' => 'form-control']); ?>
		<div class="attention">※500文字以内で入力してください</div>
		<?= $this->element('edit_form/item-end'); ?>
	<?php endif; ?>

	<!-- ハッシュタグ -->
	<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'hash_tag')) : ?>
		<?php $_title = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'hash_tag', 'title', 'ハッシュタグ'); ?>
		<?php $_sub_tilte = $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'hash_tag', 'sub_title', ''); ?>
		<?= $this->element('edit_form/item-start', ['title' => $_title, 'sub_title' => $_sub_tilte]); ?>
		<div>
			<?= $this->Form->input('add_tag', [
					'type' => 'text',
					'style' => 'width: 200px;',
					'maxlength' => '40',
					'id' => 'idAddTag',
					'placeholder' => 'タグを入力',
					'class' => 'form-control'
				]); ?>
			<span class="btn_area" style="display: inline;">
				<a href="#" class="btn_confirm small_menu_btn btn_orange" id="btnAddTag">追加</a>
				<a href="#" class="btn_confirm small_menu_btn" id="btnListTag">タグリスト</a>
			</span>
			<div>※タグを入力して追加ボタンで追加またはタグリストから選択する事もできます。</div>
			<div>※重複した場合は１つにまとめられます。</div>
		</div>
		<div>
			<ul id="tagArea">
				<?php $info_tag_count = 0; ?>
				<?php if (!empty($entity->info_tags)) : ?>
					<?php $info_tag_count = count($entity->info_tags); ?>
					<?php foreach ($entity->info_tags as $k => $tag) : ?>
						<?= $this->element('UserInfos/tag', ['num' => $k, 'tag' => $tag->tag->tag]); ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
		<?= $this->element('edit_form/item-end'); ?>
	<?php else : ?>
		<?php $info_tag_count = 0; ?>
	<?php endif; ?>

	<!--追加項目-->
	<?php if (!empty($append_list)) : ?>
		<?php foreach ($append_list as $n => $ap) : ?>
			<?php
					$ap_list = [];
					if (!empty($ap['mst_list_slug']) && isset($append_item_list[$ap['mst_list_slug']])) {
						$ap_list = $append_item_list[$ap['mst_list_slug']];
					}
					?>
			<?php if ($ap['value_type'] == AppendItem::TYPE_CUSTOM) : ?>
				<?= $this->element("UserInfos/append_items/custom_{$ap['slug']}", ['num' => $n, 'append' => $ap, 'list' => $ap_list, 'slug' => $page_config->slug, 'placeholder_list' => $placeholder_list, 'notes_list' => $notes_list]) ?>
			<?php else : ?>
				<?= $this->element("UserInfos/append_items/value_type_{$ap['value_type']}", ['num' => $n, 'append' => $ap, 'list' => $ap_list, 'slug' => $page_config->slug, 'placeholder_list' => $placeholder_list, 'notes_list' => $notes_list]) ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>


	<div id="optionMetaItem" class="collapse">

		<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'meta')) : ?>
			<?= $this->element('edit_form/item-start', ['title' => 'meta', 'subTitle' => '（ページ説明文）']); ?>
			<?= $this->Form->input('meta_description', ['type' => 'textarea', 'maxlength' => '200', 'class' => 'form-control']); ?>
			<span class="attention">※200文字まで</span>
			<?= $this->element('edit_form/item-end'); ?>
		<?php endif; ?>

		<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'meta')) : ?>
			<?= $this->element('edit_form/item-start', ['title' => 'meta', 'subTitle' => '（キーワード）']); ?>
			<?php for ($i = 0; $i < 5; $i++) : ?>
				<div><?= ($i + 1); ?>.<?= $this->Form->input("keywords.{$i}", ['type' => 'text', 'maxlength' => '20', 'class' => 'form-control']); ?></div>
			<?php endfor; ?>
			<span class="attention">※各20文字まで</span>
			<?= $this->element('edit_form/item-end'); ?>
		<?php endif; ?>

	</div>

</div>

<!--コンテンツブロック-->
<?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_BLOCK, 'all')) : ?>
	<div class="editor__table mb-5">
		<div id="blockArea" class="table__body list_table">
			<?php if (!empty($contents) && array_key_exists('contents', $contents)) : ?>
				<?php foreach ($contents['contents'] as $k => $v) : ?>
					<?php if ($v['block_type'] != 13) : ?>
						<?= $this->element("UserInfos/block_type_{$v['block_type']}", ['rownum' => h($v['_block_no']), 'content' => h($v)]); ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?= $this->element('UserInfos/dlg_select_block'); ?>
	</div>
<?php endif; ?>

<div id="blockWork"></div>

<div id="deleteArea" style="display: hide;"></div>


<div class="btn_area center">
	<?php if (!empty($data['id']) && $data['id'] > 0) { ?>
		<a href="javascript:void(0)" class="btn btn-danger btn_post submitButtonPost">変更する</a>
		<?php if ($this->Common->isUserRole('admin')) : ?>
			<a href="javascript:kakunin('データを完全に削除します。よろしいですか？','<?= $this->Url->build(array('action' => 'delete', $data['id'], 'content', null, '?' => isset($_query) ? $_query : $query)) ?>')" class="btn btn_post btn_delete"><i class="far fa-trash-alt"></i> 削除する</a>
		<?php endif; ?>
	<?php } else { ?>
		<a href="javascript:void(0)" class="btn btn-danger btn_post submitButtonPost">登録する</a>
	<?php } ?>
</div>

<?= $this->Form->end(); ?>

<div class="dpl_none" id="default_temp">
	<?php
	$member_list = $entity->child_infos ?? [];
	$avatas = [];
	$opts = [];
	foreach ($member_list as $mb) {
		$avatas[] = __('<img src="/{0}/Infos/images/{1}" height="120" class="avata-{2} dpl_none" />', UPLOAD_BASE_URL, $mb->image, $mb->id);
		$opts[$mb->id] = $mb->title;
	}
	?>
	<div class="row box_chat mt-2" data-member_id='0'>
		<div class="col-12">
			<div class="col-12">
				<div class="row">
					<div class="col-2 t_align_c box-avata box-avata-left dpl_none">
						<?= implode('', $avatas) ?>
					</div>
					<div class="col-10 border p-2">
						<div class="row">
							<div class="col-5">
								<?= $this->Form->select('member_chat[{index}][member_id]', $opts, ['class' => 'form-control', 'empty' => [0 => '選択してください'], 'onchange' => 'changeMember(this)']); ?>
							</div>
						</div>
						<div class="row mt-1 box-enter-content-chat dpl_none">
							<div class="col-12">
								<?= $this->Form->input("member_chat[{index}][content]", ['type' => 'textarea', 'class' => 'form-control', 'maxlength' => 300]); ?>
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
</div>

<?php $this->start('beforeBodyClose'); ?>
<script src="/user/common/js/ckeditor/ckeditor.js"></script>
<script src="/user/common/js/ckeditor/translations/ja.js"></script>
<script src="/user/common/js/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>

<?= $this->Html->script('/user/common/js/system/pop_box'); ?>
<script>
	var page_config_slug = '<?= $page_config->slug; ?>';
	var rownum = 0;
	var tag_num = <?= $info_tag_count; ?>;
	var max_row = 100;
	var pop_box = new PopBox();
	var out_waku_list = <?= json_encode($out_waku_list); ?>;
	var block_type_waku_list = <?= json_encode($block_type_waku_list); ?>;
	var block_type_relation = 14;
	var block_type_relation_count = 0;
	var max_file_size = <?= (1024 * 1024 * 5); ?>;
	var total_max_size = <?= (1024 * 1024 * 30); ?>;
	var form_file_size = 0;
	var page_config_id = <?= $page_config->id; ?>;
	var is_old_editor = <?= ($editor_old == 1 ? 1 : 0); ?>;
	jQuery.datetimepicker.setLocale('ja');
	jQuery('.datetimepicker').datetimepicker({
		format: 'Y/m/d',
		timepicker: false,
		lang: 'ja',
		scrollMonth: false,
		scrollInput: false
	});

	function checkFileType(e) {

		console.log(e)
		//画像プレビュー
		$(document).on("change", ".preview-uploader", function() {
			$(".img_text").remove();
			let elem = this
			let fileReader = new FileReader();
			fileReader.readAsDataURL(elem.files[0]);
			fileReader.onload = (function() {
				let imgTag = `<img src='${fileReader.result}'>`
				$(elem).next(".preview").html(imgTag)
			});
		})

		//validation file type
		var $this = $(e);
		$('.block_content').find('.error-message').remove();

		var files = $this[0].files;
		var types = $this.attr('data-type');
		var types = types.split(",");

		var is_file_type = false;


		for (let i = 0; i < files.length; i++) {
			const __type = files[i].type;
			if ($.inArray(__type, types) === -1) {
				is_file_type = true;
				break;
			}
		}
		if (is_file_type) {
			$this.parents('.edit__image-button').append(`<div class="error-message"><div class="error-message">指定されたファイルを選択してください</div></div>`);
			$this.val('');
			return false;
		}
	}
</script>
<?= $this->Html->script('/user/common/js/info/base'); ?>
<?= $this->Html->script('/user/common/js/info/edit'); ?>

<?php $this->end(); ?>