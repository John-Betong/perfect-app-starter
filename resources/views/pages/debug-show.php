<?php declare(strict_types=1);

        # echo '<div class="danger">
        #        <H1>DEBUGGING IS ON !!!</H1>
        #     </div>';
        # $varDumper->dump($var);
?>

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
