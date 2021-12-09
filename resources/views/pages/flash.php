<h1>FLASH Message Example</h1>
<a href="/">Back</a>
<?php

use PerfectApp\Utilities\Flash;

Flash::addmessage(ACTIONS_ARRAY['update']['message'], ACTIONS_ARRAY['update']['status']);
Flash::addmessage(ACTIONS_ARRAY['inactive']['message'], ACTIONS_ARRAY['inactive']['status']);
Flash::addmessage(ACTIONS_ARRAY['reset_sent']['message'], ACTIONS_ARRAY['reset_sent']['status']);

FLASH::displayMessages();