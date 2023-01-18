<div class="file">
    <?php if ($c['file_extension'] == 'xls' || $c['file_extension'] == 'xlsx') : ?>
        <div class="file-excel">
            <a href="<?= $c['attaches']['file'][0]; ?>" target="_blank"><?= h($c['file_name']); ?>（<?= human_filesize($c['attaches']['file']['size']) ?>）<i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
        </div>
    <?php elseif ($c['file_extension'] == 'doc' || $c['file_extension'] == 'docx') : ?>
        <div class="file-word">
            <a href="<?= $c['attaches']['file'][0]; ?>" target="_blank"><?= h($c['file_name']); ?>（<?= human_filesize($c['attaches']['file']['size']) ?>）<i class="fa fa-file-word-o" aria-hidden="true"></i></a>
        </div>
    <?php else : ?>
        <div class="file-pdf">
            <a href="<?= $c['attaches']['file'][0]; ?>" target="_blank"><?= h($c['file_name']); ?>（<?= human_filesize($c['attaches']['file']['size']) ?>）<i class="fa fa-file-pdf-o" aria-hidden="true"></i></i></a>
        </div>
    <?php endif; ?>
</div>