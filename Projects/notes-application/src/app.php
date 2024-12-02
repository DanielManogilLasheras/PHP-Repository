<?php
/*
    Here we are telling the autoloader to direct us to the create.php page if there is no specific query about
    the page we want to navigate to. The formula $viewformula had to be stored in a variable because otherwise it didn't work well for me.
*/
if (isset($_GET['view'])) {
    $view = $_GET['view'];
    $viewformula = "src/views/" . $view . ".php";
    require $viewformula;
} else {
    require 'src/views/create.php';
}
