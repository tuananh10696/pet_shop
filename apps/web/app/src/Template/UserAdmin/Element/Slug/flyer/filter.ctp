<?php

use Cake\Utility\Hash; ?>

<?php $this->start('search_box'); ?>
<div class="row">
    <div class="col-12">
        <div class="card on">
            <div class="card-header bg-gray-dark">
                <h2 class="card-title">検索条件</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">

                <!-- 検索開始ボタン用フォーム -->
                <!-- 多階層カテゴリ以外-->
                <?= $this->Form->create(false, ['type' => 'get', 'valueSources' => ['query'], 'id' => 'fm_search', 'templates' => $form_templates]); ?>
                <?= $this->Form->hidden('sch_page_id'); ?>

                <div class="table__search">
                    <div class="row">
                        <div class="col-2" style="min-width: 200px">
                            <div class="input-group" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text">掲載</span>
                                </div>
                                <?= $this->Form->input('sch_status', [
                                    'type' => 'select',
                                    'options' => ['publish' => '掲載中', 'draft' => '下書き', 'waiting_pl' => '掲載待ち'],
                                    'empty' => ['' => '全て'],
                                    // 'onChange' => 'change_category("fm_search");',
                                    'class' => 'form-control'
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="btn_area center">
                        <button type="button" class="btn btn-secondary mr-2" onclick="window.location.href='/user_admin/infos/?sch_page_id=<?= $page_config->id ?>'"><?= __('条件クリア'); ?></button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i><?= __('検索開始'); ?></button>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
        <!--/.card-->
    </div>
    <!--/.col-12-->
</div>
<!--/.row-->
<?php $this->end(); ?>