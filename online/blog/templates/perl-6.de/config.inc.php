<?php
$serendipity['smarty']->security = false;

$serendipity['smarty']->register_function('my_inc_header', 'my_inc_header');

function my_inc_header() {
	include("blog-menu.html");
}

?>
