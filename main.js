$(document).ready(function () {
    let endpoint = "Api.php";
   
    $.ajax({
        url: endpoint,
        type: 'POST',
        accepts: "application/json",
        crossDomain: true,
        data:{
            HTTPS_CLASE_MARCA : "seeq/1R.aEYuQ",
            HTTPS_CLASE : "$2y$10$IZWalCdInZzIilt2dG0/3.B4enMRTHGH1vAZkw1ATlfNpbAhtAMpO",
            HTTPS_METODO_MARCA : "ej/R8CVHmaH/w",
            HTTPS_METODO : "$2y$12$e/FuS0461cTjQ1DU9XqEmerkOWF0oziDrjQwE8U/9SBou86M9ka2m"
        },
        success: function (res) {
            console.log(res);
        //    $("#prueba").html(res);
        },
    });
    // $.ajax({
    //     url: endpoint,
    //     type: 'GET',
    //     accepts: "application/json",
    //     crossDomain: true,
    //     data:{
    //         HTTPS_ARCHIVO : "service_ejemplo",
    //         HTTPS_METODO : "ejemplo"
    //     },
    //     success: function (res) {
    //         console.log(res);
    //     },
    // });


});