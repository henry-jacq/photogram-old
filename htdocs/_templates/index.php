<? 

if (Session::isAuthenticated()) {
    Session::loadTemplate('_header');
    Session::loadTemplate('index/calltoaction');
} else {
    Session::loadTemplate('_header');
    Session::loadTemplate('index/login');
}

Session::loadTemplate('index/photogram');
Session::loadTemplate('_footer');
