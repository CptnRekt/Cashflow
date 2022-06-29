var operacja_konta = $("<div>");
$(".lokacja").css("color", "white");
$(".linia_pion").css("height", "400px");
$(".linia_pion").css("border-left", "1px solid white");
$(".linia_pion").css("border-right", "1px solid white");
$(".linia_pion").css("max-width", "1px");
$(".linia_pion").css("padding", "0px");
$(".button").css("width", "100%");
$(".button").css("height", "66px");

$(".button").on("click", function () {
    console.log(operacja_konta);
    operacja_konta.remove();
    operacja_konta = $('<div id="operacja_konta" class="col"><h2 class="mb-3" id="nazwa_operacji_konta"></h2><form id="formularz_edycji_konta_uzytkownika" action="index.php" method="post"><p id="p_pot">Potwierdź zmiany hasłem: </p><input type="password" name="potwierdzenie_haslem_input"><br><br><input type="submit" name="edytuj_konto_uzytkownika_button" value="Potwierdź"><input id="anuluj_edycje_konta_uzytkownika" type="button" name="anuluj_edycje_konta_uzytkownika_button" value="Anuluj"></form></div>');
    $("#dane_konta").css("visibility", "hidden");
    $("#dane_konta").css("position", "absolute");
    $("#dane_konta").after(operacja_konta);
    $("#nazwa_operacji_konta").html($(this).html());
    if ($(this).attr("id") == "zmien_login") {
        $("#p_pot").before($('<p>Podaj nowy login: </p><input type="text" name="login_uzytkownika"><br><br>'));
    }
    else if ($(this).attr("id") == "zmien_haslo") {
        $("#p_pot").before($('<p>Podaj nowe hasło: </p><input type="text" name="nowe_haslo_uzytkownika"><br><br>'));
    }
    else if ($(this).attr("id") == "usun_konto") {
        $("#p_pot").before($('<input type="hidden" name="usun_konto_uzytkownika" value="1"><p>Jesteś tego pewien / pewna?</p>'));
    }
    else {
        operacja_konta.remove();
    }
});
$(document).on("click", "#anuluj_edycje_konta_uzytkownika", function () {
    console.log("anulowanie");
    $("#dane_konta").css("visibility", "visible");
    $("#dane_konta").css("position", "static");
    operacja_konta.remove();
});