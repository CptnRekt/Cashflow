$(document).ready(function () {
    console.log("Script.js wczytany");
    var data = new Date(),
    miesiac = '' + (data.getMonth()+1),
    dzien = '' + data.getDate(),
    rok = data.getFullYear();
    $('.date').val([rok, miesiac, dzien].join('-')); 
    $(".lokacja").css("color", "white");
    $("#wyloguj > a").on("click", function () {
        $("#wyloguj_input").val(1);
        document.getElementById("wyloguj").submit();
    });
});
