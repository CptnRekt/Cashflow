<?php
    $sql_przefiltrowany = $sql_przefiltrowany." order by data_transakcji desc";
    $result3 = $conn->query($sql_przefiltrowany);
    $rodzaj_transakcji_klasa = "";
    if (@($result3->num_rows > 0)) 
    {
        while ($row3 = $result3->fetch_assoc()) 
        {
            if ($row3["rodzaj_transakcji"] == "Przychód") $rodzaj_transakcji_klasa = "rodzaj_transakcji_przychod";
            if ($row3["rodzaj_transakcji"] == "Wydatek") $rodzaj_transakcji_klasa = "rodzaj_transakcji_wydatek";
            $licznik_transakcji = $licznik_transakcji + 1;
            if ($row3["wykonane"]==0)
            {
                echo
                '<div class = "panele2 row mt-4 ml-1 mr-1">

                    <div class = "col mt-3 text-left">
                        <b><p style="">'.$row3["nazwa"].'</p></b>
                        <p>Kategoria: '.$row3["kategoria"].'</p>
                        <p style="" class="kwota '.$rodzaj_transakcji_klasa.'">'.$row3["rodzaj_transakcji"].': '.$row3["kwota"].' pln</p>
                    </div>

                    <div class = "col mt-3 mr-0 text-right">
                        <div class = "btn-group mb-3 d-flex flex-row-reverse">
                            <form action="edytuj_konto_kredytowe.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_transakcji"/>
                            <input type="hidden" value='.$row3["rodzaj_transakcji"].' name="rodzaj_transakcji"/>
                            <input type="hidden" value='.$row3["kwota"].' name="kwota"/>
                            <button type = "submit" class = "btn-primary" id="usun_transakcje'.$licznik_transakcji.'" name="usun_transakcje"
                            style="border-top-right-radius:10px; border-bottom-right-radius:10px;">Usuń</button>
                            </form>
                            <form action="edytuj_konto_kredytowe.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_transakcji"/>
                            <button type = "submit" class = "btn-primary" id="archiwizuj_transakcje'.$licznik_transakcji.'" name="archiwizuj_transakcje"
                            style="border-top-left-radius:10px;border-bottom-left-radius:10px;">Archiwizuj</button>
                            </form>
                        </div>
                        <p>'.$row3["data_transakcji"].'</p>
                    </div>

                </div>';
            }
            if ($row3["wykonane"]==1)
            {
                echo
                '<div class = "panele2 row mt-4 ml-1 mr-1" style="opacity:0.5;">

                   <div class = "col mt-3 text-left">
                        <b><p style="">'.$row3["nazwa"].'</p></b>
                        <p>Kategoria: '.$row3["kategoria"].'</p>
                        <p style="" class="kwota '.$rodzaj_transakcji_klasa.'">'.$row3["rodzaj_transakcji"].': '.$row3["kwota"].' pln</p>
                    </div>

                    <div class = "col mt-3 mr-0 text-right">
                        <div class = "btn-group mb-3 d-flex flex-row-reverse">
                            <form action="edytuj_konto_kredytowe.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_transakcji"/>
                            <input type="hidden" value='.$row3["rodzaj_transakcji"].' name="rodzaj_transakcji"/>
                            <input type="hidden" value='.$row3["kwota"].' name="kwota"/>
                            <button type = "submit" class = "btn-primary" id="usun_transakcje'.$licznik_transakcji.'" name="usun_transakcje"
                            style="border-top-right-radius:10px;border-bottom-right-radius:10px;">Usuń</button>
                            </form>
                            <form action="edytuj_konto_kredytowe.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_transakcji"/>
                            <button type = "submit" class = "btn-primary" id="przywroc_transakcje'.$licznik_transakcji.'" name="przywroc_transakcje" 
                            style="border-top-left-radius:10px;border-bottom-left-radius:10px;">Przywróć</button>
                            </form>
                        </div>
                        <p>'.$row3["data_transakcji"].'</p>
                    </div>
                </div>';
            }
        }                        
    }
    else 
    {
        echo "<br><h2>Nie znaleziono żadnych transakcji!</h2>";
    }
?>