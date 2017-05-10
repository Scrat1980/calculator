<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.05.17
 * Time: 23:34
 */

/*todo: hook up bootstrap?*/
require_once ( 'controllers/MainController.php' );

$controller = new MainController();
if( isset( $_POST['action'] ) && $_POST['action'] === 'ajax' ) {
    $controller->ajax();
} else {
    $controller->index();
}