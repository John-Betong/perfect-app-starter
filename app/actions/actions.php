<?php declare(strict_types=1);

namespace PerfectApp\Utilities;

$messages = new ActionMessages(ACTIONS_ARRAY);
$action = new MessageHTML($messages);

define('DISPLAY_ACTION', 
  $action = !empty($_GET['action']) 
          ? $action->render($_GET['action']) 
          : null
);
