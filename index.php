<?php
/*
Plugin Name: Item Manager
Description:
Version: 
Author: Ilian
Author URI: 
*/

add_action('admin_menu','general_menu');

function general_menu(){
	add_menu_page('Items Manager','Items Manager','manage_options','items_list','items_list');
	add_submenu_page('items_list','Add New','Add New','manage_options','items_create','items_create');
	add_submenu_page(null,'Update','Update Items','manage_options','update_items','update_items');
}
require_once('items-list.php');
require_once('items-create.php');
require_once('items-update.php');



