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
    private $numbersArray;
    public $statusValid = false;
    public $result = '';

    public function __construct( $delimiter, $operationsString, $numbersArray ){
        $this->delimiter = $delimiter;
        $this->operationsString = $operationsString;
        $this->numbersArray = $numbersArray;
    }

    public function count()
    {
        $delimiterEmpty = ( $this->delimiter === '' );

        if( $delimiterEmpty ) {
            return;
        }

        $operationsArray = explode(
            $this->delimiter,
            $this->operationsString
        );

//        $numbersQuantityMatchesOperationsQuantity = count( $this->actionsArray ) ===
//            count( $this->mockNumbersArray );

        $result = '';

        foreach ( $operationsArray as $index => $operation ) {
            $result .= '';
            $operationIsValid = $this->validateOperation( $operation );
            $currentPair = $this->numbersArray[$index];
            $numbersPresent = isset( $currentPair );
            if( $operationIsValid && $numbersPresent ) {
                if( count( $currentPair ) === 2 ) {
                    $resultRow = $this->operation(
                        $currentPair[0],
                        $currentPair[1],
                        $operation
                    );
                    
                    if( $resultRow === 'error' ) {
                        return;
                    }
                    
                    $result .= $resultRow . '<br>';
                } else {
                    return;
                }
            }
        }
        
        $this->result = $result;

        $this->statusValid = true;
    }

    private function validateOperation( $operation ){
        return ( in_array( $operation, $this->validOperations ) );
    }

    private function operation( $operandOne, $operandTwo, $operation )
    {
        switch( $operation ) {
            case '+':
                $result = $operandOne + $operandTwo;
                break;
            case '-':
                $result = $operandOne - $operandTwo;
                break;
            case '*':
                $result = $operandOne * $operandTwo;
                break;
            case '/':
                $result = ( $operandTwo !== 0 )
                    ? $operandOne / $operandTwo
                    : 'error';
        }
        
        return $result;
    }

}