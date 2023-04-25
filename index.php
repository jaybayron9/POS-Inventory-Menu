<?php
date_default_timezone_set("Asia/Manila");

session_start();

require('core/functions.php');

require(core('connection'));
require(core('auth'));
require(core('settings'));
require(core('menu'));
require(core('history'));
require(core('inventory'));

require(view('partial/head'));
if ( Auth::isAuth() ) {
    require(view('partial/tabs'));
    require( checkUrl($get) );
} else if ( Auth::isSetPassReq() ) {
    require( checkUrl($_SESSION['reqpass_id']) );
} else {
    require( checkUrl('login') );
}
require(view('partial/foot'));