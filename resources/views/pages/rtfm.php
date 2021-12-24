<?php declare(strict_types=1);

  echo '<header>';
    echo '<h1>' .$company .'</h1>';
    require VIEWS .'/partials/menu-subs.php' ;
  echo '</header>';


# ADD ITEMS 
  $ols = [
    '+Route'       => './config/routes.php',
    '+Controller'  => './app/Http/Controllers/Pages/PageController.php',
    '+Page'        => './resources/views/pages/rtfm.php',
    '+Menu'        => './resources/views/partials/menu-subs.php',
  ];
  $items = '';
  foreach($ols as $key => $item) :
    $items .= <<< ____EOT
      \n <dt> $key </dt> 
      \n  <dd> $item </dd> 
____EOT;
  endforeach;

  echo $tmp = <<< ____EOT
    \n\n
    <p> &nbsp; </p>
    <section>
      <h2> How to add a New Page  </h2>
      <div class="text-center">
        <dl id="dd-1em"> 
          $items
        </dl>  
      </div>  
    </section>  
    \n\n
____EOT;

