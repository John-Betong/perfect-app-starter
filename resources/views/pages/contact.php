<?php declare(strict_types=1);

  $tmpApp = APP_NAME;

  echo $tmp = <<< ____EOT
      <header id="mini">
      <h1> $tmpApp </h1>
      <nav>
____EOT;
      require VIEWS .'/partials/menu-subs.php';

  echo $tmp = <<< ____EOT
      </nav>  
    </header>
    <section>
      <h2> Contact us </h2>
    </section>  
____EOT;


