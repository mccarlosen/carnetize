$(document).ready(function(){

    (function( carnetizeUsers, $, undefined ) {

        // Consiguiendo la lista de usuarios
        function loadListUsers(){
            $("#box-list-users").load("/system_users #div-list-users", function(){
            });
        };

        // refresh_list-users
        function refreshListUsers(){
            $("#refresh_list_users").on('click', function(){
                loadListUsers();
            })
        }

        // AddNew Users...........

        // Method Public init
        carnetizeUsers.init = function(){
            loadListUsers();
            refreshListUsers();
        }

    }( window.carnetizeUsers = window.carnetizeUsers || {}, jQuery ));

carnetizeUsers.init();
})
