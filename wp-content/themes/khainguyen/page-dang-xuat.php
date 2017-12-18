<?php 
	session_start();
	unset($_SESSION['user']);
    wp_redirect(esc_url( home_url( '/' )));
    exit;    
?>