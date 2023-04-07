<?

include 'libs/autoload.php';

use libs\core\Session;

Session::ensureLogin();

Session::renderPage();