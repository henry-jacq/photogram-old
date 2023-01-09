<? 

Session::loadTemplate('_header');

if (Session::isAuthenticated()) {
    Session::loadTemplate('index/calltoaction');
} else {
    Session::loadTemplate('index/login');
}

Session::loadTemplate('index/photogram');
Session::loadTemplate('_footer');
