<?php
//Destrucción de la sesión
session_start();
session_destroy();
header("location: ../../index.php");
