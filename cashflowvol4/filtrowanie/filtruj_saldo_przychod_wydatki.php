<?php
    function filtruj_saldo_przychod_wydatki ($nazwa_filtra)
    {
        global $sql_przefiltrowany;
        $sql30 = "";
        if (!empty($_POST["filtry_".$nazwa_filtra."_od"]))
        {
            $nazwa_filtrowanego_elementu2 = ' and '.$nazwa_filtra.'>='.$_POST["filtry_".$nazwa_filtra."_od"];
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
        }
        if (!empty($_POST["filtry_".$nazwa_filtra."_do"]))
        {
            $nazwa_filtrowanego_elementu2 = ' and '.$nazwa_filtra.'<='.$_POST["filtry_".$nazwa_filtra."_do"];
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
        }
        if (!empty($sql30))
        {
            $sql30 = substr($sql30,4);
            $sql30 = " and (".$sql30.")";
            $sql_przefiltrowany = $sql_przefiltrowany.$sql30;
        }
    }
    filtruj_saldo_przychod_wydatki("saldo_poczatkowe");
    filtruj_saldo_przychod_wydatki("saldo_koncowe");
    filtruj_saldo_przychod_wydatki("laczne_przychody");
    filtruj_saldo_przychod_wydatki("laczne_wydatki");
?>