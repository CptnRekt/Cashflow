$(document).ready( function() {
    $("#rodzaj_konta").on("click", function()
    {
        //console.log("wybrano selecta");
        if ($("#rodzaj_konta").val()=="inne")
        {
            $("#rodzaj_konta_text").css("visibility","visible");
            $("#rodzaj_konta_text").css("position","static");
        }
        else
        {
            $("#rodzaj_konta_text").css("visibility","hidden");
            $("#rodzaj_konta_text").css("position","absolute");
        }
    });
});