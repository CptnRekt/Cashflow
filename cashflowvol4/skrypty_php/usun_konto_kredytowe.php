<?php
    if ( isset( $_POST["usun_konto_kredytowe"] ) ) {
        $id_konta_kredytowego = $_POST["id_konta_kredytowego"];
        if ( $conn->connect_error ) {
            die( "Błąd połączenia: " . $conn->connect_error );
        }
        $sql3 = 'DELETE FROM konta_kredytowe where id="'.$id_konta_kredytowego.'"';
        if ( $conn->query( $sql3 ) === TRUE ) {} else {
            echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
        }
    }
?>