$(document).ready(function () {
    $(".rodzaj_transakcji_przychod").css("color", "#90EE90");
    $(".rodzaj_transakcji_wydatek").css("color", "#ffcccb");  
    $(".divy_przychod_wydatki > input").css("text-align", "center");
    $("#filtry_przychod_wydatki").on("click", function () {
        console.log("wybrano selecta");
        $(".divy_przychod_wydatki").css("visibility", "hidden");
        $(".divy_przychod_wydatki").css("position", "absolute");
        if ($("#filtry_przychod_wydatki").val() == "przychod") {
            $("#przychod_div").css("visibility", "visible");
            $("#przychod_div").css("position", "static");
        }
        if ($("#filtry_przychod_wydatki").val() == "wydatki") {
            $("#wydatki_div").css("visibility", "visible");
            $("#wydatki_div").css("position", "static");
        }
        if ($("#filtry_przychod_wydatki").val() == "obojetne") {
            $("#przychod_div > input").val("");
            $("#wydatki_div > input").val("");
        }
    });
    $(".pokaz_button").on("click", function () {
        $(".divy_przychod_wydatki").css("visibility", "hidden");
        $(".divy_przychod_wydatki").css("position", "absolute");
        $(".pokaz_button").removeClass("klikniety_pokaz_button");
        $(".pokaz_button").addClass("nieklikniety_pokaz_button");
        if ($(this).attr("id") == "pokaz_przychody_button") {
            $("#filtry_przychod_wydatki").removeClass("filtry_przychod_wydatki_visible");
            $("#filtry_przychod_wydatki").addClass("filtry_przychod_wydatki_hidden");
            $("#przychod_div").css("visibility", "visible");
            $("#przychod_div").css("position", "static");
            $(".rodzaj_transakcji_przychod").parent().parent().css("visibility", "visible");
            $(".rodzaj_transakcji_przychod").parent().parent().css("position", "static");
            $(".rodzaj_transakcji_wydatek").parent().parent().css("visibility", "hidden");
            $(".rodzaj_transakcji_wydatek").parent().parent().css("position", "absolute");
        }
        if ($(this).attr("id") == "pokaz_wydatki_button") {
            $("#filtry_przychod_wydatki").removeClass("filtry_przychod_wydatki_visible");
            $("#filtry_przychod_wydatki").addClass("filtry_przychod_wydatki_hidden");
            $("#wydatki_div").css("visibility", "visible");
            $("#wydatki_div").css("position", "static");
            $(".rodzaj_transakcji_przychod").parent().parent().css("visibility", "hidden");
            $(".rodzaj_transakcji_przychod").parent().parent().css("position", "absolute");
            $(".rodzaj_transakcji_wydatek").parent().parent().css("visibility", "visible");
            $(".rodzaj_transakcji_wydatek").parent().parent().css("position", "static");
        }
        if ($(this).attr("id") == "pokaz_wszystko_button") {
            $("#filtry_przychod_wydatki").removeClass("filtry_przychod_wydatki_hidden");
            $("#filtry_przychod_wydatki").addClass("filtry_przychod_wydatki_visible");
            $(".rodzaj_transakcji_przychod").parent().parent().css("visibility", "visible");
            $(".rodzaj_transakcji_przychod").parent().parent().css("position", "static");
            $(".rodzaj_transakcji_wydatek").parent().parent().css("visibility", "visible");
            $(".rodzaj_transakcji_wydatek").parent().parent().css("position", "static");
        }
        $(this).removeClass("nieklikniety_pokaz_button");
        $(this).addClass("klikniety_pokaz_button");
    });
});