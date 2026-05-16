<?php
function getDB() {
    static $dbh = null;
    if ($dbh === null) {
        try {
            $dbh = new PDO(
                'mysql:host=sql103.infinityfree.com;dbname=if0_41866786_traffic',
                'if0_41866786',
                'MaLi1357',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
            $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    return $dbh;
}


$pagetitle = array(
    'title' => 'Traffic Restriction Portal',
);

$header = array(
    'imagesource' => 'logo.png',
    'imagealt'    => 'Traffic Restriction Portal Logo',
    'title'       => 'Traffic Restriction Portal',
    'motto'       => 'Hungarian Road Restriction Data 2010'
);

$footer = array(
    'copyright' => 'Copyright ' . date("Y") . '.',
    'firm'      => 'Traffic Restriction Portal'
);


$pages = array(
    '/'        => array('file' => 'home',     'text' => 'Mainpage', 'menun' => array(1, 1)),
    'images'   => array('file' => 'images',   'text' => 'Images',   'menun' => array(1, 1)),
    'contact'  => array('file' => 'contact',  'text' => 'Contact',  'menun' => array(1, 1)),
    'crud'     => array('file' => 'crud',     'text' => 'CRUD',     'menun' => array(1, 1)),
    'messages' => array('file' => 'messages', 'text' => 'Messages', 'menun' => array(0, 1)),
    'login'    => array('file' => 'login',    'text' => 'Login',    'menun' => array(1, 0)),
    'login2'   => array('file' => 'login2',   'text' => '',         'menun' => array(0, 0)),
    'logout'   => array('file' => 'logout',   'text' => 'Logout',   'menun' => array(0, 1)),
    'register' => array('file' => 'register', 'text' => '',         'menun' => array(0, 0)),
);

$error_page = array('file' => '404', 'text' => 'Page not found!');