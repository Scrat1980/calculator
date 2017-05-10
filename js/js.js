/**
 * Created by ivan on 08.05.17.
 */


$( document ).ready(function(){

    $( '#operations_id' ).on( 'change paste keyup', function() {
        App.validateInput();
    });
    
    $( '#execute' ).on( 'click', function() {
        App.getAnswers();

    } );

});

App = {
    validateInput: function(){
        var delimiter = String( $( '#delimiter_id' ).val() );

        if( ! App.delimiterIsSet( delimiter ) ){
            alert( 'Сначала введите разделитель' );
            $( '#operations_id' ).val( '' );
        } else if( ! App.delimiterIsValid( delimiter ) ) {
            alert( 'Разделитель не корректен' );
            $( '#operations_id' ).val( '' );
        } else {
            var operations = $( '#operations_id' ).val();
            var numberOfDelimiters = App.getNumberOfEntrances( operations, delimiter );
            var numberOfSums = $( '#rows' ).val();
            var tooManyDelimiters = ( numberOfDelimiters > numberOfSums - 1 );

            if ( tooManyDelimiters ) {
                alert( 'Вы пытаетесь ввести больше действий, чем задано чисел' );
                App.deleteLastSymbol();
            }

            var doubleDelimiter =  delimiter + delimiter;
            var emptyOperationsPresent = operations.indexOf( doubleDelimiter ) !== -1;

            if ( emptyOperationsPresent ) {
                alert();
            }
        }

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
                $( '#execute' ).after( '<div>' + result + '</div>' );
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
    }

};
