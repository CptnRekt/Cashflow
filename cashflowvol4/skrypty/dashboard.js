$(document).ready( function() {   
    $(function () {
        $("#accordion").accordion({
            heightStyle: "fill",
            collapsible: true,
            active: false,
            event: "click"
        });
    });
    $(".divy_saldo_przychod_wydatki > input").css("text-align", "center");
    $("#filtry_saldo_przychod_wydatki").on("click", function () {
        console.log("wybrano selecta");
        $(".divy_saldo_przychod_wydatki").css("visibility", "hidden");
        $(".divy_saldo_przychod_wydatki").css("position", "absolute");
        if ($("#filtry_saldo_przychod_wydatki").val() == "saldo_poczatkowe") {
            $("#saldo_poczatkowe_div").css("visibility", "visible");
            $("#saldo_poczatkowe_div").css("position", "static");
        }
        if ($("#filtry_saldo_przychod_wydatki").val() == "saldo_koncowe") {
            $("#saldo_koncowe_div").css("visibility", "visible");
            $("#saldo_koncowe_div").css("position", "static");
        }
        if ($("#filtry_saldo_przychod_wydatki").val() == "przychod") {
            $("#przychod_div").css("visibility", "visible");
            $("#przychod_div").css("position", "static");
        }
        if ($("#filtry_saldo_przychod_wydatki").val() == "wydatki") {
            $("#wydatki_div").css("visibility", "visible");
            $("#wydatki_div").css("position", "static");
        }
    });
});