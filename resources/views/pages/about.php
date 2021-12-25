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
      <h2> About </h2>
      <h3>
        A Proprietary Non-Opinionated Framework
             Implementing Best Practices
      </h3>
    </section>  
____EOT;
