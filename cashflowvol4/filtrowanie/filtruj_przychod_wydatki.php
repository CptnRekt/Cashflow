<?php
    $sql40 = "";
    function filtruj_saldo_przychod_wydatki ($nazwa_filtra)
    {
        global $sql_przefiltrowany;
        global $sql40;
        $sql30 = "";
        if (!empty($_POST["filtry_".$nazwa_filtra."_od"]))
        {
            $nazwa_filtrowanego_elementu2 = ' and kwota >='.$_POST["filtry_".$nazwa_filtra."_od"];
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
        }
        if (!empty($_POST["filtry_".$nazwa_filtra."_do"]))
        {
            $nazwa_filtrowanego_elementu2 = ' and kwota <='.$_POST["filtry_".$nazwa_filtra."_do"];
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
        }
        if (!empty($_POST["filtry_".$nazwa_filtra."_do"]) || !empty($_POST["filtry_".$nazwa_filtra."_od"]))
        {
            $nazwa_filtrowanego_elementu2 = ' and rodzaj_transakcji="'.$nazwa_filtra.'"';
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
        }
        if (!empty($sql30))
        {
            $sql30 = substr($sql30,4);
            $sql30 = " or (".$sql30.")";
            $sql40 = $sql40.$sql30;
        }
    }
    filtruj_saldo_przychod_wydatki("przychód");
    filtruj_saldo_przychod_wydatki("wydatek");
    if (!empty($sql40))
    {
        $sql40 = substr($sql40,4);
        $sql40 = " and (".$sql40.")";
        $sql_przefiltrowany = $sql_przefiltrowany.$sql40;
    }
?>