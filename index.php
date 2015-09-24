<?php

//  Set everything up
require 'bootstrap.php';

//  Horrendously crude router >_<
$route = !empty($_POST['route']) ? $_POST['route'] : '';

switch ($route) {

    case 'gotoGateway':
        require 'views/gotoGateway.php';
        break;

    case 'thanks':
        require 'views/thanks.php';
        break;

    default:
        require 'views/index.php';
        break;
}
