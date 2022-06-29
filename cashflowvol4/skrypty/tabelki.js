$( document ).ready(function() {
        var licznik = $("#licznik").val();
        var licznikNazwa;
        $( "#dodaj" ).on( "click", function( event ) {
            event.preventDefault();
            var error = $("#error");
            licznikNazwa = $("#licznikNazwa"+licznik).val();
            if ($('#nowa_nazwa').val())
            {
                console.log("Zmienna ustawiona");
                console.log("Wszystkie zmienne ustawione");
                licznik++;
                var lista = $("#lista");
                licznikk=licznik-1;
                var input = $('#nowa_nazwa').val();
                var hidden_input = $('<input type="hidden" style="position:absolute;">');
                hidden_input.attr("name","licznikNazwa"+licznikk);
                hidden_input.attr("id","licznikNazwa"+licznikk);
                hidden_input.val(input);
                var button = $('<button type="button">X</button>');
                button.attr("name","usun"+licznikk);
                button.attr("id","usun"+licznikk);
                button.addClass("przyciskUsun");
                var label = $("<label>");
                label.append(button);
                label.append("&nbsp;&nbsp;");
                label.append(input);
                label.append(hidden_input);
                lista.append(label);
                error.text("");
                $("#licznik").val(licznik);
                $("label").css("border-style","solid");
                $("label").css("border-color","white");
                $("label").css("padding-left","20px");
                $("label").css("padding-right","20px");
                $("label").addClass("m-1");
                $("label").css("padding-left","0");
            }
            else
            { 
                error.text("Proszę podać nazwę przed dodaniem!");
                console.log("Blad");
            }
        });
        $("#lista").on("click", "label", function(event)
        {
            event.preventDefault();
            $(this).hide("fade", 200, function()
            {
                console.log("Rekord usuniety");
                $(this).remove();
            });
        });
});