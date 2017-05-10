<?php

/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 08.05.17
 * Time: 16:00
 */
class Counter
{     
    private $validOperations = ['+', '-', '/', '*'];
    private $delimiter;
    private $operationsString;
    public $errors = '';
    public $statusValid = false;
    public $result = '';

    public function __construct( $delimiter, $operationsString ){
        $this->delimiter = $delimiter;
        $this->operationsString = $operationsString;
    }

    public function count()
    {
        $operationsArray = explode( 
            $this->delimiter, 
            $this->operationsString 
        );
        $delimiterEmpty = ( $this->operationsString === false );
        if ( $delimiterEmpty ) {
            $errors[] = 'Разделитель не может быть пустым';
        } else {
//            $numbersArray 
            $numbersQuantityMatchesOperationsQuantity = count( $this->actionsArray ) ===
                count( $this->mockNumbersArray );

            if ( !$numbersQuantityMatchesOperationsQuantity ) {
                $errorQuantityMismatch = 'Количество строк с числами не соответствует количеству операций';
                $statusValid = false;
            } else {

                $result = '';

                foreach ( $operationsArray as $operation ) {
                    $result .= '';
                    $operationIsValid = validateOperation( $operation );
                }


            }

        }
    }

    private function validateOperation( $operation ){
        return ( in_array( $operation, $this->validOperations ) );
    }


}