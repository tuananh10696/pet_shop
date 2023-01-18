<?php $this->start('css') ?>
<link rel="stylesheet" href="/assets/css/company.css">

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
                "@id": "http://example.co.jp/",
                "name": "HOME"
            }
        }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
                "@id": "http://example.co.jp/company/",
                "name": "社員紹介"
            }
        }]
    }
</script>
<?php $this->end('css') ?>
<main>
    <div class="mv">
        <div class="row">
            <h1 class="mv__ttl"><span class="mv__ttl--en">STAFF</span><span class="mv__ttl--jp">社員紹介</span>
            </h1>
        </div>
    </div>
    <div class="breadcrumb">
        <ul class="breadcrumb-wrap row">
            <li class="breadcrumb-items"><a href="/">トップページ</a></li>
            <li class="breadcrumb-items"><a href="/company/">社員紹介</a></li>
            <li class="breadcrumb-items"><?= h($info->notes) ?></li>
        </ul>
    </div>
    <div class="detail">
        <div class="detail-title">
            <div class="detail-title__info">
                <h2 class="detail-title__ttl"><?= nl2br(h($info->notes)) ?></h2>
                <p class="detail-title__des"><?= h($info->info_append_items[0]->value_text) ?> | <?= h($info->info_append_items[1]->value_text) ?></p>
            </div>
            <figure class="detail-title__img"><img src="<?= $info->info_append_items[2]->attaches['image'][0] ?>" alt="" width="999" height="464" loading="lazy" decoding="async">
            </figure>
        </div>
        <div class="detail-content inner">
            <?php foreach ($contents as $content) : ?>
                <?= $content['block_type'] == '5.0' ? '<article class="detail-article">' : '' ?>
                <?= $this->element('info/content_' . $content['block_type'], ['c' => $content]); ?>
                <?= $content['block_type'] == '2.0' ? '</article>' : '' ?>
            <?php endforeach; ?>
            <div class="btn-center"><a class="c-btn c-btn--default" href="/company/#employee"><span>一覧へ戻る</span></a></div>
        </div>
    </div>
</main>


<?php $this->start('contact') ?>
<?php include_once WWW_ROOT . 'assets/include/contact.html' ?>
<?php $this->end() ?>