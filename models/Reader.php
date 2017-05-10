<?php

/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 08.05.17
 * Time: 16:27
 */
class Reader
{
    public function getNumbersArray(){
        $path = 'source.txt';

        if( ! file_exists( $path ) ) {
            $newFile = fopen( $path, 'w' );
            for ( $i=1; $i <= 10; $i++ ) {
                $row = (String) mt_rand(0, 10) . ' ' . (String) mt_rand(0, 10) . "\n";
                fwrite( $newFile, $row );
            }
            fclose( $newFile );
        }

        $lines = file($path);
        $output = [];

        foreach ($lines as $index => $line) {
            $rowArray = explode(' ', $line);
            if (isset($rowArray[0]) && isset($rowArray[1])) {
                $output[] = [$rowArray[0], $rowArray[1]];
            }
        }

        return $output;

    }

}