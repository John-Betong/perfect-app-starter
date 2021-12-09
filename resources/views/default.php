<p><a href="about">About</a> | <a href="contact">Contact</a> | <a href="table">HTML Table</a> | <a href="register">Form</a>
</p>
<h1>Perfect App Framework</h1>
<h2>A Proprietary Non-Opinionated Framework Implementing Best Practices</h2>

<h3>Contributors</h3>
Kevin Rubio<br>John Betong

<br><br>
<h1>FLASH Message Example</h1>
<?php

use PerfectApp\Utilities\Flash;

Flash::addmessage(ACTIONS_ARRAY['update']['message'], ACTIONS_ARRAY['update']['status']);
Flash::addmessage(ACTIONS_ARRAY['inactive']['message'], ACTIONS_ARRAY['inactive']['status']);
Flash::addmessage(ACTIONS_ARRAY['reset_sent']['message'], ACTIONS_ARRAY['reset_sent']['status']);

FLASH::displayMessages();