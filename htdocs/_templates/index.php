<? 

Session::loadTemplate('_header');

if (Session::isAuthenticated()) {
    Session::loadTemplate('home/calltoaction');
} else {
    Session::loadTemplate('home/login');
}

Session::loadTemplate('home/photogram');
Session::loadTemplate('_footer');
