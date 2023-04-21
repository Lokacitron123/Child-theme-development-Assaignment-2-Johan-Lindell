<?php
/*
    Plugin Name: myplugin for Blocksy-child
    Description: Handles my custom functions
*/


// Remove the admin bar from the front end
add_filter( 'show_admin_bar', '__return_false' );