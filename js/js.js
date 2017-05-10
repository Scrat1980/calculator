/**
 * Created by ivan on 08.05.17.
 */


$( document ).ready(function(){

    $( '#operations_id' ).on( 'change paste keyup', function() {
        App.validateAllButOperations();
    });
    
    $( '#delimiter_id' ).on( 'change', function() {
        $( '#operations_id' ).val( '' );
    });
    
    $( '#execute' ).on( 'click', function() {
        App.getAnswersIfValid( function() {
            App.getAnswers();
        });
    } );

});

App = {
    validateAllButOperations: function(){
        var delimiter = String( $( '#delimiter_id' ).val() );
        var operationsInput = $( '#operations_id' );

        if( ! App.delimiterIsSet( delimiter ) ){
            alert( 'Сначала введите разделитель' );
            operationsInput.val( '' );
        } else if( ! App.delimiterIsValid( delimiter ) ) {
            alert( 'Разделитель не корректен' );
            operationsInput.val( '' );
        } else if ( App.operationsStartWithDelimiter( delimiter ) ) {
            alert( 'Операции начинаются с разделителя' );
            App.deleteFirstSymbol();
        } else {

            var operations = operationsInput.val();
            var numberOfDelimiters = App.getNumberOfEntrances(operations, delimiter);
            var numberOfSums = $('#rows').val();
            var tooManyDelimiters = ( numberOfDelimiters > numberOfSums - 1 );

            if ( tooManyDelimiters ) {
                alert('Вы пытаетесь ввести больше действий, чем задано чисел');
                App.deleteLastSymbol();
            } else {

                var doubleDelimiter = delimiter + delimiter;
                var emptyOperationsPresent = operations.indexOf(doubleDelimiter) !== -1;

                if (emptyOperationsPresent) {
                    alert('По крайней мере одна операция пуста (два разделителя идут подряд)');
                }
            }

        }
    
    },

    getAnswersIfValid: function( callback ) {
        var operationsValid = App.validateOperations();
        if( operationsValid ) {
            callback();
        }
    },

    validateOperations: function() {
        var delimiter = String( $( '#delimiter_id' ).val() );
        var operations = $( '#operations_id' ).val();
        var operationsArray = operations.split( delimiter );
        var isValid = true;

        for( var index in operationsArray ) {
            var operation = operationsArray[index];
            var operationIsValid = $.inArray( operation, ['+', '-', '*', '/'] ) !== -1;
console.log(operation);
console.log(operationIsValid);
            if( ! operationIsValid ) {
                alert( 'По крайней мере одна из операций не валидна' );
                isValid = false;
                break;
            }
        }

        return isValid;

    },

    getAnswers: function() {
        var delimiter = $( '#delimiter_id' ).val();
        var operations = $( '#operations_id' ).val();

        $.ajax({
            method: 'POST',
            url: 'index.php',
            data: {
                action: 'ajax',
                delimiter: delimiter,
                operations: operations
            }
        }).done(
            function( result ) {
                $( '#result' ).remove();
                $( '#execute' ).after( '<div id="result">' + result + '</div>' );
            }
        );

    },

    delimiterIsSet: function( delimiter ){
        return delimiter !== '';
    },

    delimiterIsValid: function( delimiter ){
        return ($.inArray( delimiter, ['+', '-', '*', '/'] ) === -1);
    },

    getNumberOfEntrances: function( string, substring ){
        var numberOfEntrances = 0;
        var position = 0;

        while( true ) {
            var foundEntrance = string.indexOf( substring, position );
            if ( foundEntrance == -1 ) {
                break;
            }

            position = foundEntrance + 1;
            numberOfEntrances ++;
        }

        return numberOfEntrances;
    },

    deleteLastSymbol: function(){
        var input = $( '#operations_id' );

        input.val( input.val().slice( 0, -1 ) );
    },

    operationsStartWithDelimiter: function( delimiter ) {
        var operations = $( '#operations_id' ).val();

        return ( operations.indexOf( delimiter ) === 0 );
    },

    deleteFirstSymbol: function() {
        var input = $( '#operations_id' );

        input.val( input.val().slice( 1 ) );

    }

};
