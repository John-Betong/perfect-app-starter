<?php declare(strict_types=1);

$aPages = [
	'/'        => 'Home',
  'login'    => 'Login',
	'register' => 'Register',
	'v1'       => 'User API',
	'about'    => 'About',
	'contact'  => 'Contact',
	'rtfm'     => 'RTFM',
];

$items = '';
  $i2 = 0;
  foreach($aPages as $key => $item) :
    if($i2++ < count($aPages) ) :
      $item .= ' | ';
    endif;
    $items .= <<< ____EOT
      <a href="$key">
        $item
      </a>  
____EOT;
  endforeach;

echo $tmp = <<< ____EOT
    <nav> $items   </nav>
____EOT;

/*
  <header>
    <h1>  $company </h1>
  </header>
*/

