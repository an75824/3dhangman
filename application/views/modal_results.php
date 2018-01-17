<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
usort($scores, function($a, $b) { //Sort the array using a user defined function
    return $a['score'] > $b['score'] ? -1 : 1; //Compare the scores
});
?>
<div class="table-responsive">
  <table class="table">
	<thead>
	 <tr>
	  <th scope='col'>Rank</th>
	  <th scope='col'>Name</th>
	  <th scope='col'>Score</th>
	  <th scope='col'>Date</th>
	 </tr>
	</thead>
	<tbody>
		<?php foreach($scores as $a=>$score):?>
	 	<tr>
		 <td><?= ++$a; ?></td>
		 <td><?= $score['name'];?></td>
		 <td><?= $score['score'];?></td>
		 <td><?= $score['date'];?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
   </table>
</div> <!-- end of responsive table results -->
