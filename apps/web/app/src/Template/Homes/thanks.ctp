<!-- Blog Start -->
<div class="container pt-5">

    <div class="d-flex flex-column text-center mb-5 pt-5">
    <h1 class="display-4 m-0"><span class="text-primary">MER's House</span> Thanks You</h1>
        </br><h4 class="text-secondary mb-3">Cám ơn quý khách đã sử dụng dịch vụ, Chăm sóc pet iu của bạn cùng MER's House nhé !</h4>

    </div>

    <div class="row pb-3">
        <?php foreach ($infos as $blog_data) : ?>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <a href="/blog/<?= $blog_data->id ?>">
                        <img class="card-img-top" src="<?= h($blog_data->attaches['image'][0]) ?>" alt="">
                        <div class="card-body bg-light p-4">
                            <h4 class="card-title text-truncate"><?= h($blog_data->category->name) ?></h4>
                            <!-- <div class="d-flex mb-3">
                                <small class="mr-2"></small>
                            </div> -->
                            <p style="text-overflow: ellipsis;min-height: 176px; "><?= mb_strimwidth(h($blog_data->notes), 0, 80, "...") ?></p>

                        </div>
                    </a>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
<!-- Blog End -->