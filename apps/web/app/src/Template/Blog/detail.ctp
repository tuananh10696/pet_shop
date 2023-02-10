<!-- Detail Start -->
<div class="container py-5">
    <div class="row pt-5">
        <div class="col-lg-8">
            <div class="d-flex flex-column text-left mb-4">
                <h4 class="text-secondary mb-3">Blog Detail</h4>
                <h1 class="mb-3"><?= $info->title ?></h1>
                <div class="d-index-flex mb-2">
                    <span class="mr-3"><?= $info->category->name ?></span>
                </div>
            </div>
            <div class="mb-5">
                <?php foreach ($contents as $content) : ?>

                    <?= $this->element('info/content_' . $content['block_type'], ['c' => $content]); ?>

                <?php endforeach; ?>
            </div>
        </div>


        <div class="col-lg-4 mt-5 mt-lg-0">
            <div class="mb-5">
                <h3 class="mb-4">Categories</h3>
                <div class="d-flex flex-wrap m-n1">
                    <?php foreach ($category['category'] as $val) : ?>
                        <a href="/blog?category=<?= $val->id ?>" class="btn btn-outline-primary m-1"><?= h($val->name) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mb-5">
                <h3 class="mb-4">Other Post</h3>
                <?php foreach ($lq_blog as $lq_blog_val) : ?>
                    <div class="d-flex align-items-center border-bottom mb-3 pb-3">
                        <img class="img-fluid" src="<?= $lq_blog_val->attaches['image'][0] ?>" style="width: 80px; height: 80px;" alt="">
                        <div class="d-flex flex-column pl-3">
                            <a class="text-dark mb-2" href=""><?= h($lq_blog_val->title) ?></a>
                            <div class="d-flex">
                                <small class="mr-3"><i class="fa fa-paw" aria-hidden="true"></i> <?= h($lq_blog_val->category->name) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="mb-5">
                <a href="https://www.facebook.com/profile.php?id=100087815199195"></a><img src="/img/mer.jpeg" alt="" class="img-fluid">
            </div>
            <div>
                <h3 class="mb-4">Về MER's House</h3>
                MER's House được thành lập bởi Linh nhiều tiền vl với mong muốn cho mọi em pet luôn được best mọi lúc mọi nơi. Hãy đến với em và để em chăm sóc con pet "ấy" nhé ^^!
            </div>
        </div>
    </div>
</div>
<!-- Detail End -->