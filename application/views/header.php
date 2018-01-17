<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='description' content='A Hangman game'>
    <meta name='author' content='Antony'>

    <title><?=$title;?></title>

	<noscript>
 		<META HTTP-EQUIV="Refresh" CONTENT="0;URL=base/noJs">
	</noscript>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave+Display" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url('assets/css/main.css');?>" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<!-- Modal for inputting the full word -->
<div class="modal" id = 'word_modal' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter the word</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group">
		<?= form_open(); ?>
			<label for="full_word">Word:</label>
			<input type="text" class="form-control" id="full_word">
		</form>
		</div>
	<div class = "word_input"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id = 'submit_full_word'>Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for saving the score -->
<div class="modal" id = 'modal_save_score' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Save your score!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group">
		<?= form_open(); ?>
			<p class = 'score'></p>
			<label for="full_word">Pen Name:</label>
			<input type="text" class="form-control" id="pen_name">
		</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id = 'submit_score'>Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for the score -->
<div class="modal" id = 'modal_score' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Results</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "results_modal_body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id = 'dead_end'>End</button>
      </div>
    </div>
  </div>
</div>


    <div class="container">

