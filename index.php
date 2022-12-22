<?php declare(strict_types=1);

// 1. Setup Autoload and define objects we'll use in the file
require_once __DIR__ . '/vendor/autoload.php';
use Utils\SiteRunner;

// 3. Figure out what page to run and do it
SiteRunner::runPage();



// 3. Make sure we put out all the text we need want to display
flush();

// 4. Exit with no errors
exit(/*success*/0);
