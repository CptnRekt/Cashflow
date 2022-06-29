<?php
    if ( isset( $_POST["usun_transakcje"] ) ) {
        $id_transakcji = $_POST["id_transakcji"];
        $rodzaj_transakcji = $_POST["rodzaj_transakcji"];
        $kwota = $_POST["kwota"];
        if ( $conn->connect_error ) {
            die( "Błąd połączenia: " . $conn->connect_error );
        }
        if ($rodzaj_transakcji=="Przychód")
            $sql3 = 'Update konta_kredytowe set laczne_przychody=laczne_przychody-'.$kwota.', 
            saldo_koncowe=saldo_koncowe-'.$kwota.' where id='.$_SESSION["id_konta_kredytowego"];
        if ($rodzaj_transakcji=="Wydatek")
            $sql3 = 'Update konta_kredytowe set laczne_wydatki=laczne_wydatki-'.$kwota.', 
            saldo_koncowe=saldo_koncowe+'.$kwota.' where id='.$_SESSION["id_konta_kredytowego"];
        $conn->query($sql3);
        $sql3 = 'DELETE FROM transakcje_kont_kredytowych where id="'.$id_transakcji.'"';
        $conn->query($sql3);
    }
?>