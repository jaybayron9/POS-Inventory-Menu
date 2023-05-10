<?php
date_default_timezone_set("Asia/Manila");

session_start();

require('core/functions.php');

require(core('connection'));
require(core('auth'));
require(core('settings'));
require(core('menu'));
require(core('history'));
require(core('dashboard'));

// Always update prduct information
$menu->update_sale();

require(view('partial/head'));
if ( Auth::isAuth() ) {
    require(view('partial/tabs'));
    require( checkUrl($get) );
} else {
    require( checkUrl('login') );
}
require(view('partial/foot'));