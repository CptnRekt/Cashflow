$(document).ready(function () {
    $("#rodzaj_kategorii_transakcji").on("click", function () {
        if ($("#rodzaj_kategorii_transakcji").val() == "inne") {
            $("#rodzaj_konta_text").css("visibility", "visible");
            $("#rodzaj_konta_text").css("position", "static");
        }
        else {
            $("#rodzaj_konta_text").css("visibility", "hidden");
            $("#rodzaj_konta_text").css("position", "absolute");
        }
    });
    $("#kategoria_transakcji").on("click", function () {
        if ($("#kategoria_transakcji").val() == "inne") {
            $("#kategoria_transakcji_text").css("visibility", "visible");
            $("#kategoria_transakcji_text").css("position", "static");
        }
        else {
            $("#kategoria_transakcji_text").css("visibility", "hidden");
            $("#kategoria_transakcji_text").css("position", "absolute");
        }
    });
});