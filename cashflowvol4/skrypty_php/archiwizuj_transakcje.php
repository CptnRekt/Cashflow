<?php
    if ( isset( $_POST["archiwizuj_transakcje"] ) ) {
        $id_transakcji = $_POST["id_transakcji"];
        if ( $conn->connect_error ) {
            die( "Błąd połączenia: " . $conn->connect_error );
        }
        $sql3 = 'UPDATE transakcje_kont_kredytowych set wykonane=1 where id="'.$id_transakcji.'"';
        if ( $conn->query( $sql3 ) === TRUE ) {} else {
            echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
        }
    }
    if ( isset( $_POST["przywroc_transakcje"] ) ) {
        $id_transakcji = $_POST["id_transakcji"];
        if ( $conn->connect_error ) {
            die( "Błąd połączenia: " . $conn->connect_error );
        }
        $sql3 = 'UPDATE transakcje_kont_kredytowych set wykonane=0 where id="'.$id_transakcji.'"';
        if ( $conn->query( $sql3 ) === TRUE ) {} else {
            echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
        }
    }
?>