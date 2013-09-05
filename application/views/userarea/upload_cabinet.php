<?php

echo "<div style='margin:20px 50px;'>";

foreach ($msgs as $m):
	
	echo $m;
	
endforeach;

echo "</div>";

echo anchor('cabinet/cabinate_files', 'Back to Cabinet', 'class="btn btn-b" style="margin:0 50px;"');

?>

