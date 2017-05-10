<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.05.17
 * Time: 23:35
 */

class View
{
    private $numbersArray;
    
    public function __construct( $numbersArray )
    {
        $this->numbersArray = $numbersArray;
    }
    
    public function index()
    {
        $form = '
        <form>
            <label for="delimiter_id">Разделитель</label>
            <input type="text" id="delimiter_id">
            <br>
            <label for="operations_id">Действия</label>
            <input type="text" id="operations_id" name="operations_name">
        </form>
    ';

        $jQuery = '
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    ';

        $script = '
        <script type="text/javascript" src="../js/js.js"></script>
    ';

        $button = '<button id="execute">Обработать запрос</button>';
        
        $numbersTable = '';
        $numberOfRows = 0;

        foreach ( $this->numbersArray as $numbersPair ) {
            foreach ($numbersPair as $index => $number) {
                if( $index === 0 ) {
                    $numbersTable .= $number;
                } else {
                    $numbersTable .= ', ' . $number . '; <br>';
                }
            }
            $numberOfRows ++;
        };
        
        $inputNumberOfRows = '<input id="rows" style="display:none;" value = ' . $numberOfRows . '>';

        $instruction = '<br>Эта программа выполнит арифметические действия, которые будут указаны в поле "Действия" через разделитель, который нужно указать в поле "Разделитель". <br>Сначала введите разделитель. Он не должен быть пустым и не должен совпадать ни с одним из символов: "+", "-", "*", "/". Затем введите строку действий через разделитель.<br>';

        $page = $numbersTable
            . $instruction
            . $form
            . $jQuery
            . $script
            . $button
            . $inputNumberOfRows;

        echo $page;

    }
}