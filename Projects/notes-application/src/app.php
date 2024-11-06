<?php
if (isset($_GET['view'])) {
    $view = $_GET['view'];
    $viewformula = "src/views/" . $view . ".php";
    require $viewformula;
} else {
    require 'src/views/home.php';
}
