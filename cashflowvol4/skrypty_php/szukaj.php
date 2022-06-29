<?php 
    $sql_przefiltrowany = $sql_przefiltrowany." order by data_otwarcia desc";
    $result3 = $conn->query($sql_przefiltrowany);
    if (@($result3->num_rows > 0)) 
    {
        while ($row3 = $result3->fetch_assoc()) 
        {
            if ($row3["archiwum"]==0)
            {
                $licznik_kont_kredytowych = $licznik_kont_kredytowych + 1;
                echo
                '<div class = "panele2 row mt-4 ml-1 mr-1">

                    <div class = "col mt-3 text-left">
                        <b><p style="">'.$row3["nazwa"].'</p></b>
                        <p style="color:#ffcccb">Wydatki: '.$row3["laczne_wydatki"].' pln</p>
                        <p style="color:#90EE90">Przychody: '.$row3["laczne_przychody"].' pln</p>
                    </div>

                    <div class = "col mt-3 mr-0 text-right">
                        <div class = "btn-group mb-3 d-flex flex-row-reverse">
                            <form action="dashboard.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_konta_kredytowego"/>
                            <button type = "submit" class = "btn-primary" id="usun_konto_kredytowe'.$licznik_kont_kredytowych.'" name="usun_konto_kredytowe"
                            style="border-top-right-radius:10px; border-bottom-right-radius:10px;">Usuń</button>
                            </form>
                            <form action="dashboard.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_konta_kredytowego"/>
                            <button type = "submit" class = "btn-primary" id="archiwizuj_konto_kredytowe'.$licznik_kont_kredytowych.'" name="archiwizuj_konto_kredytowe">Archiwizuj</button>
                            </form>
                            <form action="edytuj_konto_kredytowe.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_konta_kredytowego"/>
                            <textarea name="nazwa_konta_kredytowego" style="visibility:hidden;position:absolute">'.$row3["nazwa"].'</textarea>
                            <textarea name="opis_konta_kredytowego" style="visibility:hidden;position:absolute">'.$row3["opis"].'</textarea>
                            <input type="hidden" value="'.$row3["data_otwarcia"].'" name="data_otwarcia" />
                            <button type = "submit" class = "btn-primary" id="edytuj_konto_kredytowe'.$licznik_kont_kredytowych.'" name="edytuj_konto_kredytowe"
                            style="border-top-left-radius:10px; border-bottom-left-radius:10px;">Edytuj</button>
                            </form>
                        </div>
                        <p>Saldo: '.$row3["saldo_koncowe"].' pln</p>
                        <p>Data otwarcia: '.$row3["data_otwarcia"].'</p>
                    </div>

                </div>';
            }
            if ($row3["archiwum"]==1)
            {
                $licznik_kont_kredytowych = $licznik_kont_kredytowych + 1;
                echo
                '<div class = "panele2 row mt-4 ml-1 mr-1" style="opacity:0.5;">

                    <div class = "col mt-3 text-left">
                        <b><p style="">'.$row3["nazwa"].'</p></b>
                        <p style="color:#ffcccb">Wydatki: '.$row3["laczne_wydatki"].' pln</p>
                        <p style="color:#90EE90">Przychody: '.$row3["laczne_przychody"].' pln</p>
                    </div>

                    <div class = "col mt-3 mr-0 text-right">
                        <div class = "btn-group mb-3 d-flex flex-row-reverse">
                            <form action="dashboard.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_konta_kredytowego"/>
                            <button type = "submit" class = "btn-primary" id="usun_konto_kredytowe'.$licznik_kont_kredytowych.'" name="usun_konto_kredytowe"
                            style="border-top-right-radius:10px; border-bottom-right-radius:10px;">Usuń</button>
                            </form>
                            <form action="dashboard.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_konta_kredytowego"/>
                            <button type = "submit" class = "btn-primary" id="przywroc_konto_kredytowe'.$licznik_kont_kredytowych.'" name="przywroc_konto_kredytowe">Przywróć</button>
                            </form>
                            <form action="edytuj_konto_kredytowe.php" method="post">
                            <input type="hidden" value='.$row3["id"].' name="id_konta_kredytowego"/>
                            <textarea name="nazwa_konta_kredytowego" style="visibility:hidden;position:absolute">'.$row3["nazwa"].'</textarea>
                            <textarea name="opis_konta_kredytowego" style="visibility:hidden;position:absolute">'.$row3["opis"].'</textarea>
                            <input type="hidden" value="'.$row3["data_otwarcia"].'" name="data_otwarcia" />
                            <button type = "submit" class = "btn-primary" id="edytuj_konto_kredytowe'.$licznik_kont_kredytowych.'" name="edytuj_konto_kredytowe"
                            style="border-top-left-radius:10px; border-bottom-left-radius:10px;">Edytuj</button>
                            </form>
                        </div>
                        <p>Saldo: '.$row3["saldo_koncowe"].' pln</p>
                        <p>Data otwarcia: '.$row3["data_otwarcia"].'</p>
                    </div>

                </div>';
            }
        }                        
    }
    else 
    {
        echo "<br><h2>Nie znaleziono żadnych kont!</h2>";
    }
?>