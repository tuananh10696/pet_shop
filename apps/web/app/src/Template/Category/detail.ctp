<?php $this->start('css') ?>
<link rel="stylesheet" href="/assets/css/wysiwyg.css">
<link rel="stylesheet" href="/assets/css/common.css">
<style>
    .wysiwyg p a {
        border-bottom: 1px solid #00a040;
        color: #00a040 !important;
    }

    .table>table>thead>tr>th {
        background-color: #cce2d5;
    }

    .table>table>thead>tr>th>span {
        color: #ff2143 !important;
    }

    h3 {
        font-size: 22px;
        display: block;
        color: #051441;
        font-weight: 700
    }

    .customer-gallery {
        display: -webkit-box;
        display: flex;
        flex-wrap: wrap;
        margin: 3px -15px 0
    }

    .customer-gallery img {
        height: 250px;
        margin: 15px 1px 3px 1px;
        width: 431px
    }
</style>
<?php $this->end() ?>
<main>
    <!-- About US Start -->
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
            <div class="row contents" style=" background-color: #fff; border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;border-top-right-radius: 10px;border-top-left-radius: 10px;">
                <div class="wysiwyg col-lg-8">
                    <!-- Trending Tittle -->
                    <div class="about-right mb-90">
                        <?php foreach ($contents as $content) : ?>
                            <?php $is_show = is_show($content) ?>
                            <?php if (!$is_show) : ?>
                                <?= $this->element('info/content_' . $content['block_type'], ['c' => $content]); ?>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn boxed-btn22">← Trở Lại</button>
                    </div>
                    <!-- From -->
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="form-contact contact_form mb-80" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control w-100 error" name="message" id="message" cols="30" rows="5" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="button button-contactForm boxed-btn boxed-btn2">← Trở Lại</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn boxed-btn2">Send</button>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Flow Socail -->
                    <div class="single-follow mb-45">
                        <div class="single-box">
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="/assets/img/news/icon-fb.png" alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="/assets/img/news/icon-tw.png" alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="/assets/img/news/icon-ins.png" alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="/assets/img/news/icon-yo.png" alt=""></a>
                                </div>
                                <div class="follow-count">
                                    <span>8,045</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New Poster -->
                    <div class="news-poster d-none d-lg-block">
                        <img src="/assets/img/news/news_card.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About US End -->
</main>