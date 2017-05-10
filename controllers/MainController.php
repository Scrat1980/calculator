<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 08.05.17
 * Time: 10:49
 */
require_once ('views/view.php');
require_once ('models/Reader.php');
require_once ('models/Counter.php');

class MainController
{

    private function validateInput( $input ){
        return $input;
    }

    public function index()
    {
        $model = new Reader();
        $numbersArray = $model->getNumbersArray();

        $view = new View( $numbersArray );
        $view->index();
    }

    public function ajax()
    {
        $delimiter = validateInput( $_POST['delimiter'] );
        $operationsString = validateInput( $_POST['operations'] );

        $model = new Counter( $delimiter, $operationsString );

        if ( $model->statusValid ) {
            echo $model->result;
        } else {
            echo $model->errors;
        }
        
    }

}