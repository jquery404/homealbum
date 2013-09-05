<?php
	
	if (file_exists($download_path)) 
	{
		$data = file_get_contents($download_path);   
	
		$name = $download_name;

		force_download($name, $data);
		
	} else {
		echo "<center>Sorry! The file does not exist</center>";
	}
	

	
	