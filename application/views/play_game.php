<div class = 'row'>
	<div class = 'col-md-6' id='hang_image'>
		<img src = "<?=base_url('assets/img/level0.png');?>" class=img-responsive' alt='The hang!' >
		<p>Desc: <?=$word['desc'];?></p>

	</div>
	<div class = 'col-md-6'>
		<div class="col-xs-4">
			<p class = 'input_chars'>Please input a single character:</p>
			<?= form_open('game/send'); ?>
			<input type='text' class='form-control input-lg' maxlength='1' id='user_input'>
			<span class="submit_form glyphicon glyphicon-ok" aria-hidden="true"></span>
			<?= form_close(); ?>
		</div>
	</div>
</div>