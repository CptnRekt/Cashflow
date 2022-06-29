<?php
    require("sesja.php");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashyflow.pl - analiza finansowa</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

<nav class="navbar sticky-top navbar-dark bg-dark row">
 <div class="col pr-0 ml-0 mr-0 mt-1 mb-1 align-self-start">
     <h1 class="navbar-brand mr-2">Cashyflow.pl</h1>
     <?php 
        echo '<br> <span><a class="lokacja" href="index.php">'.$_SESSION["login"].'</a> / 
        <a class="lokacja" href="dashboard.php">dashboard</a> / 
        <a class="lokacja" href="edytuj_konto_kredytowe.php">'.$_SESSION["nazwa_konta_kredytowego"].'</a> / 
        <a class="lokacja" href="podsumowanie_transakcji.php">analiza finansowa konta</a></span>';
     ?>
  </div>
  <div class="col pl-0 pr-0 ml-0 mr-0 mt-1 mb-2 align-self-end d-flex flex-row-reverse">
  <button class="navbar-toggler ml-2 mr-2 mb-3" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  </div>
  <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
    <div class="navbar-nav text-center">
      <a class="nav-item nav-link active" href="dashboard.php">Home / dashboard / strona główna</a>
      <a class="nav-item nav-link" href="index.php">Ustawienia konta</a>
      <form id="wyloguj" action="index.php" method="post">
      <input type="hidden" id="wyloguj_input" name="wyloguj"/>
      <a class="nav-item nav-link" href="#">Wyloguj</a>
      </form>
    </div>
  </div>
</nav>

<div class="row btn-group mt-4 ml-5">
    <a href="edytuj_konto_kredytowe.php"><button class="button btn-primary" style="border-bottom-left-radius:10px;
        border-top-left-radius:10px;">Powrót do transakcji</button></a>
    <button class="button btn-primary pokaz_button klikniety_pokaz_button" id="pokaz_wszystko_button">Wszystko</button>
    <button class="button btn-primary pokaz_button nieklikniety_pokaz_button" id="pokaz_przychody_wydatki_button">Przychody / Wydatki</button>
    <button class="button btn-primary pokaz_button nieklikniety_pokaz_button" id="pokaz_saldo_button" style="border-bottom-right-radius:10px; border-top-right-radius:10px;">Saldo</button>
</div>

<div class="container-fluid row mb-5" style="">

    <div class="col text-center panele2 ml-5 mt-4 p-4 szuk" style="overflow:auto;background-color:rgb(225,217,209);">
    <canvas id="kursywa_przychody_wydatki" width="400" height="120"></canvas>
    </div>

</div>

<footer class="bg-dark w-100">
  <div class="p-4 w-100">
    <div class="row">

    <div class="col mb-md-0 align-self-start text-left">
        <p style="font-size: 0.8em"><strong>
                Uwaga! Transakcje zarchiwizowane lub bez daty, nie są wliczane do zestawienia.
        </strong></p>
    </div>
      
      <div class="col text-right">
          <?php
            $laczne_wydatki = 0;
            $laczne_przychody = 0;
            $saldo_poczatkowe = 0;
            $saldo_koncowe = 0;
            $sql3 = 'select saldo_poczatkowe, saldo_koncowe, laczne_przychody, laczne_wydatki
            from konta_kredytowe where id='.$_SESSION["id_konta_kredytowego"];
            $result3 = $conn->query($sql3);
            if (@($result3->num_rows > 0)) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    $laczne_wydatki = $row3["laczne_wydatki"];
                    $laczne_przychody = $row3["laczne_przychody"];
                    $saldo_poczatkowe = $row3["saldo_poczatkowe"];
                    $saldo_koncowe = $row3["saldo_koncowe"];
                }
            }
            echo
            '<span>Łączne wydatki: '.$laczne_wydatki.' pln</span> <br>
            <span>Łączne przychody: '.$laczne_przychody.' pln</span> <br>
            <span>Całkowite saldo: '.$saldo_koncowe.' pln</span>';
        ?>
      </div>
      
    </div>
  </div>
</footer>

</body>

<script>
    $(".lokacja").css("color","white");
    $(".pokaz_button").on("click", function()
    {
        console.log("wybrano");
        $(".pokaz_button").removeClass("klikniety_pokaz_button");
        $(".pokaz_button").addClass("nieklikniety_pokaz_button");
        if ($(this).attr("id") == "pokaz_wszystko_button")
        {
            kursywa_przychody_wydatki.getDatasetMeta(0).hidden=false;
            kursywa_przychody_wydatki.getDatasetMeta(1).hidden=false;
            kursywa_przychody_wydatki.getDatasetMeta(2).hidden=false;
        }
        if ($(this).attr("id") == "pokaz_przychody_wydatki_button")
        {
            kursywa_przychody_wydatki.getDatasetMeta(0).hidden=false;
            kursywa_przychody_wydatki.getDatasetMeta(1).hidden=false;
            kursywa_przychody_wydatki.getDatasetMeta(2).hidden=true;
        }
        if ($(this).attr("id") == "pokaz_saldo_button")
        {
            kursywa_przychody_wydatki.getDatasetMeta(0).hidden=true;
            kursywa_przychody_wydatki.getDatasetMeta(1).hidden=true;
            kursywa_przychody_wydatki.getDatasetMeta(2).hidden=false;
        }
        $(this).removeClass("nieklikniety_pokaz_button");
        $(this).addClass("klikniety_pokaz_button");
        kursywa_przychody_wydatki.update();
    });
    const ctx = document.getElementById("kursywa_przychody_wydatki").getContext("2d");
    const kursywa_przychody_wydatki = new Chart(ctx, {
        data: {
            labels: [],
            datasets: [{
                label: 'Przychód',
                type: "bar",
                backgroundColor: [],
                borderColor: []
            },{
                label: 'Wydatki',
                type: "bar",
                backgroundColor: [],
                borderColor: []
            },{
                label: 'Saldo',
                type: "line",
                pointRadius: 2,
                borderWidth: 1,
                backgroundColor: [],
                borderColor: [] 
            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    <?php
        require("skrypty_php/wczytaj_kursywe_przychodow_wydatkow.php");
    ?>
    var calkowite_saldo_wykres = 0;
    for(var i=0; i<kursywa_przychody_wydatki["data"]["datasets"][0].data.length; i++)
    {
        calkowite_saldo_wykres = (calkowite_saldo_wykres + parseFloat(kursywa_przychody_wydatki["data"]["datasets"][0].data[i]))
            - parseFloat(kursywa_przychody_wydatki["data"]["datasets"][1].data[i]);
        console.log(calkowite_saldo_wykres);
        kursywa_przychody_wydatki["data"]["datasets"][2].data[i] = calkowite_saldo_wykres;
        kursywa_przychody_wydatki["data"]["datasets"][2].backgroundColor.push("rgba(0, 128, 128, 1)");
        kursywa_przychody_wydatki["data"]["datasets"][2].borderColor.push("rgba(0, 128, 128, 1)");
    }
    kursywa_przychody_wydatki.update();
</script>
    <script src="skrypty/script.js"></script>
</html>

<?php
    $conn->close();
?>