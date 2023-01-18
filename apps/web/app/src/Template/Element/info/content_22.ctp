<div class="differrence">
	<h2 class="c-ttls"><span>課題と成果 (Before After)</span></h2>
	<div class="differrence-group">
		<div class="differrence__col">
			<h3 class="differrence-title"><span>Before</span></h3>
			<ul class="differrence-list">
				<?= str_replace(['・', '\r\n'], ['<li>', '</li>'], nl2br(h($c['before_text']))) ?>
			</ul>
		</div>
		<div class="differrence__col d-after">
			<h3 class="differrence-title"><span>After</span></h3>
			<ul class="differrence-list">
				<?= str_replace(['・', '\r\n'], ['<li>', '</li>'], nl2br(h($c['after_text']))) ?>
			</ul>
		</div>
	</div>
</div>