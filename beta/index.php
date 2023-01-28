<?
include 'libs/autoload.php';

if (isset($_GET['logout'])) {
    if (Session::isset('session_token')) {
        UserSession::removeSession(Session::get('session_token'));
    }

    Session::destroy();
    header("Location: /");
    die();
} else {
    Session::renderPage();
}
