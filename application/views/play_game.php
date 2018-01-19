<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<a href = "<?=base_url();?>"><span class="glyphicon glyphicon-home hidden-xs"></span></a>
<div class = 'row'>
	<div class = 'col-md-6'>
		<img src = "<?=base_url('assets/img/level0.png');?>" class='img-responsive' alt='The hang!' id='hang_image' >
		<p>Desc: <?=$hang_word['desc'];?></p>

	</div>
	<div class = 'col-md-6'>
		<div class="col-xs-6">
			<p class = 'input_chars'>Please input a single character:</p>
			<?= form_open(); ?>
			<input type='text' class='form-control input-lg' maxlength='1' id='user_input'>
			<span class="submit_form glyphicon glyphicon-ok" aria-hidden="true"></span>

			<p>Word input:</p>
			<span class="word_submit glyphicon glyphicon-text-background" aria-hidden="true" data-toggle="modal" data-target="#word_modal"></span>

			<?= form_close(); ?>
		</div>
	</div>
</div>
<div class = 'word'><?=$first_str;?></div>

