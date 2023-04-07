<?

include 'libs/autoload.php';
use libs\core\Session;

Session::$isError = true;

Session::renderPage();