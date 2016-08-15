$(document).ready(function() {

    (function( carnetize, $, undefined ) {

        // Private Method
        // Dibujando el PreLoad. Hay que mejorarlo
        function addPreload(){
            $(window).load(function(){
                setTimeout(function(){
                    $('#page-loader').fadeOut(500,function(){
                        // console.log("loader");
                    });
                }, 2000);

            })
        }
        // Private Mathod
        // Configuracion del active de los nav-tabs principales
        function activeNavTabs(){
            var links_menu = $(".tab_menu"), tab_menu = [];
            $.each(links_menu, function(key, element){
                tab_menu.push($(element).attr("href"));
            });
            $(tab_menu[0]).addClass('active');

            var btn_menu_start = $(".menu-start li");
            $(btn_menu_start[0]).addClass("active");
            $(btn_menu_start[0]).off("click");
            // $(tab_menu[0]).addClass("fade");
            $(tab_menu[1]).addClass("fade");
            $(tab_menu[2]).addClass("fade");
        }

        //Inicializando los methods
        carnetize.init = function(){
            addPreload();
            activeNavTabs();
        }

    }( window.carnetize = window.carnetize || {}, jQuery ));

    // Boot init
    carnetize.init();
});
