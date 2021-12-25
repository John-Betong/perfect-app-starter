<?php declare(strict_types=1);

echo '<header id="mini">';
  echo '<h1>' .$company .'</h1>';
  echo '<nav>';
    require VIEWS .'/partials/menu-subs.php';
  echo '</nav>';  
echo '</header>';

echo '<h2> Debug </h2>';

?>

<section>
  <div class="danger">
    <H1>QQQ-DEBUGGING IS ON !!!</H1>
  </div>

  <div style="color:red;font-weight:bold">
    POST
    <pre> 
      <?php print_r($_POST); ?> 
    </pre>

    GET
    <pre>
      <?php print_r($_GET); ?> 
    </pre>

    SESSION
    <pre>
      <?php print_r($_SESSION); ?> 
    </pre>
  </div>
</section>
