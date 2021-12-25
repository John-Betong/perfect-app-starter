<?php declare(strict_types=1);

  echo '<header>';
    echo '<h1>' .$company .'</h1>';
    echo '<nav>';
      require VIEWS .'/partials/menu-subs.php' ;
    echo '</nav>';  
  echo '</header>';


# ADD ITEMS 
  $ols = [
    '+Route'       => './config/routes.php <br>'
                     . ' -> ' 
                     .'<br> $router->get("NEWPAGE", "Pages\PagesController@NEWPAGE")
                      ',
    '+Controller'  => './app/Http/Controllers/Pages/PageController.php <br>'
                     . ' -> ' 
                     .'<br>'
                     .'
                        final public function rtfm(): void
    {
        $rtfm = "The Manual";
        view(
            "layouts/layout",
            [
                "templatePage"  => "pages/rtfm", 
                "company"       => $rtfm
            ]
        );
    }
                      ',

    '+Page'        => './resources/views/pages/rtfm.php <br>',
    '+Menu'        => './resources/views/partials/menu-subs.php <br>',
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
      <h2> How to add a NEWPAGE  </h2>
      <div class="text-center">
        <dl id="dd-1em"> 
          $items
        </dl>  
      </div>  
    </section>  
    \n\n
____EOT;

