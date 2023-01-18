<?php $this->start('css') ?>
<style>
	._pagination {
		margin: 0 auto;
		padding-top: 20px;
	}

	a>span {
		color: #ff2143;
	}
</style>
<?php $this->end() ?>
<main>
	<!-- About US Start -->
	<div class="about-area2 gray-bg pt-60 pb-60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="whats-news-wrapper">
						<!-- Heading & Nav Button -->
						<div class="row justify-content-between align-items-end mb-15">
							<div class="col-xl-4">
								<div class="section-tittle mb-30">
									<h3>Whats New</h3>
								</div>
							</div>
							<div class="col-xl-8 col-md-9">
								<div class="properties__button">
									<!--Nav Button  -->
									<nav>
										<div class="nav nav-tabs" id="nav-tab" role="tablist">
											<a class="nav-item nav-link <?= $category_id == 0 ? 'active' : '' ?>" href="/category">ALL</a>
											<?php foreach ($category as $news_category) : ?>
												<a class="nav-item nav-link <?= $news_category->id == $category_id ? 'active' : '' ?>" href="/category?category_id=<?= $news_category->id ?>"><?= h($news_category->name) ?></a>
											<?php endforeach; ?>
										</div>
									</nav>
									<!--End Nav Button  -->
								</div>
							</div>
						</div>
						<!-- Tab content -->
						<div class="row">
							<div class="col-12">
								<!-- Nav Card -->
								<div class="tab-content" id="nav-tabContent">
									<!-- card one -->
									<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
										<div class="row">

											<?php foreach ($infos as $news_data) : ?>
												<?php
													// dd($news_data);
													?>
												<div class="col-xl-6 col-lg-6 col-md-6">
													<a href="/category/<?= $news_data->id ?>">
														<div class="whats-news-single mb-40 mb-40">
															<div class="whates-img">
																<img style="min-height: 210px;max-height: 20px" src="<?= $news_data->attaches['image'][0] ?>" alt="">
															</div>
															<div class="whates-caption whates-caption2">
																<h4><?= h($news_data->title) ?></h4>
																<span>TG: BTA - <?= $news_data->start_datetime->format('d/m/Y') ?></span>
																<p class="newsNotes"><?= nl2br(charlimit($news_data->notes, 118)) ?></p>
															</div>
														</div>
													</a>
												</div>
											<?php endforeach; ?>
										</div>
									</div>

								</div>
								<!-- End Nav Card -->
							</div>
						</div>

					</div>
					<div class="pagination-area  gray-bg pb-45">
						<div class="container">
							<div class="row">
								<div class="_pagination">
									<div class="single-wrap">
										<?= $this->element('pagination') ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<!-- Flow Socail -->
					<div class="single-follow mb-45">
						<div class="single-box">
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a>
								</div>
								<div class="follow-count">
									<span>8,045</span>
									<p>Fans</p>
								</div>
							</div>
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a>
								</div>
								<div class="follow-count">
									<span>8,045</span>
									<p>Fans</p>
								</div>
							</div>
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
								</div>
								<div class="follow-count">
									<span>8,045</span>
									<p>Fans</p>
								</div>
							</div>
							<div class="follow-us d-flex align-items-center">
								<div class="follow-social">
									<a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
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
						<img src="assets/img/news/news_card.jpg" alt="">
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- About US End -->
	<!--Start pagination -->

	<!-- End pagination  -->
</main>