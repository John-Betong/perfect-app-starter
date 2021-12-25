<?php declare(strict_types=1);

/*
$tmp = <<< ____EOT
<div class="d-flex p-2 justify-content-center mb-5">
	<a href="https://jeremy.anetizer.com">
  	### <img 
  		### src="./images/logo.png" 
  		### alt="Perfect App Starter - JB - modifications" 
  		### width="320" height="220"
  	>
  </a>
</div>  
____EOT;
*/

echo $tmp = <<< ____EOT
<header>	
	<a href="https://jeremy.anetizer.com">
  	<img 
  		src="./images/logo.png" 
  		alt="Perfect App Starter" 
  		width="320" height="220"
  	>
  </a>
____EOT;

	echo '<nav>';
		require VIEWS .'/partials/menu-subs.php'; 
	echo '</nav>';	
echo '</header>';  

