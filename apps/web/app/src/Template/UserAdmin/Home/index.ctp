<?php
$menu_list = $this->Session->read('admin_menu.menu_list');
?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">管理メニュー</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">
						Home
					</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

	<?= $this->element('error_message'); ?>

	<div class="container-fluid">
		<?php foreach ($menu_list['main'] as $m) : ?>
			<?php if (
				empty($m['role']) || empty($m['role']['role_type']) ||
				(!empty($m['role']) && !empty($m['role']['role_type']) && $this->Common->isUserRole(
					$m['role']['role_type'],
					(empty($m['role']['role_only']) ? false : true)
				))
			) : ?>

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header bg-gray-dark">
								<h2 class="card-title"><?= $m['title']; ?></h2>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
								</div>
							</div>

							<div class="card-body">
								<div class="row">
									<?php foreach ($m['buttons'] as $b) : ?>

										<?php if (
											empty($b['role']) || empty($b['role']['role_type']) ||
											(!empty($b['role']) && !empty($b['role']['role_type']) && $this->Common->isUserRole(
												$b['role']['role_type'],
												(empty($m['role']['role_only']) ? false : true)
											))
										) : ?>

											<div class="col-12 col-md-4 mb-2">
												<a href="<?= $b['link']; ?>" class="btn btn-block btn-secondary btn-lg">
													<?= $b['name']; ?>
													<?= (!empty($b['right_icon'])) ? $b['right_icon'] : '<i class="btn-icon-right fas fa-angle-right"></i>'; ?>
												</a>
											</div>

										<?php endif; ?>

									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
					<!-- /.col-md-6 -->
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
		<!-- /.row -->

	</div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<?php $this->start('beforeBodyClose'); ?>
<script>
	$(function() {
		$(".btnUpdateContent").on('click', function() {
			var id = $(this).data('id');

			alert_dlg('現在のコンテンツを最新版にします。<br><span class="text-danger">自動的に表示端末のブラウザの再読み込みを実行します。</span><br>元に戻すことは出来ません。よろしいですか？', {
				buttons: [{
						text: 'いいえ',
						click: function() {
							$(this).dialog("close");
						}
					},
					{
						text: 'はい',
						click: function() {
							$("#fm_update_" + id).submit();
							$(this).dialog("close");
						}
					}
				]
			});

			return false;
		});

	});
</script>
<?php $this->end(); ?>