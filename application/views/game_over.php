<?php
?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"  id='score_modal'>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">X</button>
          <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>End of Game</h4>
        </div>
        <div class="modal-body">
		<?=$score;?>
        </div>
        <div class="modal-footer">
	  <button type="button" class="btn btn-info" data-dismiss="modal">Save Score</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>

<script type='text/javascript'>
	/* Close modal only using the buttons */
	$('#score_modal').modal({
		backdrop: 'static',
		keyboard: false
	});

        $('#score_modal').modal('show');
	var img = "assets/img/level"+<?=$_SESSION['img'];?>+".png";
	$("#user_input").attr("disabled", "disabled");
	$('#full_word').attr('disabled', 'disabled');
	$('#submit_full_word').attr('disabled', 'disabled');
	$('#hang_image' ).attr("src",img);
	$('.submit_form').remove();
	$('.word_submit').remove();
        $('#word_modal').modal('toggle');
	$('#word_modal').modal('hide');
</script>

