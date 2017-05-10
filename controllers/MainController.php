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
    private $numbersArray;

    private function validateInput( $input ){
        return (String) trim( strip_tags( $input ) );
    }

    public function index()
    {
        $model = new Reader();
        $this->numbersArray = $model->getNumbersArray();

        $view = new View( $this->numbersArray );
        $view->index();
    }

    public function ajax()
    {
        $delimiter = validateInput( $_POST['delimiter'] );
        $operationsString = validateInput( $_POST['operations'] );

        var_dump('here');
        die;

        $model = new Counter( $delimiter, $operationsString, $this->numbersArray );
        $model->count();

        if ( $model->statusValid ) {
            echo $model->result;
        } else {
            echo 'Введенные данные не корректны';
        }
        
    }

}