<?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) : ?>

	<ul class="pagination justify-content-start">
		<?= $this->Paginator->prev('') ?>
		<?= $this->Paginator->numbers(['modulus' => 6, 'first' => false, 'last' => 1]); ?>
		<?= $this->Paginator->next('') ?>
	</ul>

<?php endif; ?>