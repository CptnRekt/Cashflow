<?php
    $sql3 = 'select t1.data_transakcji, t2.przychod, t3.wydatek from transakcje_kont_kredytowych t1 left join 
    (select id, data_transakcji, rodzaj_transakcji, sum(kwota) as przychod from transakcje_kont_kredytowych where rodzaj_transakcji="Przychód" and wykonane=0
    and id_konta_kredytowego='.$_SESSION["id_konta_kredytowego"].' group by data_transakcji)
    t2 on (t1.data_transakcji=t2.data_transakcji) left join 
    (select id, data_transakcji, rodzaj_transakcji, sum(kwota) as wydatek from transakcje_kont_kredytowych where rodzaj_transakcji="Wydatek" and wykonane=0
    and id_konta_kredytowego='.$_SESSION["id_konta_kredytowego"].' group by data_transakcji)
    t3 on (t1.data_transakcji=t3.data_transakcji) where t1.id_konta_kredytowego='.$_SESSION["id_konta_kredytowego"].' group by t1.data_transakcji';
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) 
    {
        while ($row3 = $result3->fetch_assoc()) 
        {
            if ($row3["data_transakcji"] != "0000-00-00")
            {
                echo 'kursywa_przychody_wydatki["data"].labels.push("'.$row3["data_transakcji"].'");';
                if ($row3["przychod"])
                {
                    echo 'kursywa_przychody_wydatki["data"]["datasets"][0].data.push("'.$row3["przychod"].'");
                    kursywa_przychody_wydatki["data"]["datasets"][0].backgroundColor.push("rgba(0,255,0,0.4)");
                    kursywa_przychody_wydatki["data"]["datasets"][0].borderColor.push("rgba(0,255,0,0.4)");';
                }
                else
                {
                    echo 'kursywa_przychody_wydatki["data"]["datasets"][0].data.push("0");
                    kursywa_przychody_wydatki["data"]["datasets"][0].backgroundColor.push("rgba(0,255,0,0.4)");
                    kursywa_przychody_wydatki["data"]["datasets"][0].borderColor.push("rgba(0,255,0,0.4)");';
                }
                if ($row3["wydatek"])
                {
                    echo 'kursywa_przychody_wydatki["data"]["datasets"][1].data.push("'.$row3["wydatek"].'");
                    kursywa_przychody_wydatki["data"]["datasets"][1].backgroundColor.push("rgba(255,0,0,0.4)");
                    kursywa_przychody_wydatki["data"]["datasets"][1].borderColor.push("rgba(255,0,0,0.4)");';
                }
                else
                {
                    echo 'kursywa_przychody_wydatki["data"]["datasets"][1].data.push("0");
                    kursywa_przychody_wydatki["data"]["datasets"][1].backgroundColor.push("rgba(255,0,0,0.4)");
                    kursywa_przychody_wydatki["data"]["datasets"][1].borderColor.push("rgba(255,0,0,0.4)");';
                }
            }
        }
    }
?>