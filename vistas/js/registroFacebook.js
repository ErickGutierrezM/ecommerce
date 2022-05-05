$(".facebook").click(function(){

    FB.login(function(response){
 
		validarUsuario();
 
 
	}, {escope: 'public_profile, email'})

})

/**VALIDAR INGREESO */

function validarUsuario(){
    FB.getLoginStatus(function (response){
        statusChangeCallback(response);

    })
}

/**VALIDAR EL ESTAOD DE CAMBIO */

function statusChangeCallback(response){
    if(response.status === 'conected'){
        textApi();
    }else{
        swal({
            title: "Error",
            text: "Ha ocurrido un error al ingresae con Facebook, intenta de nuevo",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
        },
        function(isConfirm){
            if(isConfirm){
                window.location = localStorage.getItem("rutaActual");
            }

        });
    }
}

/**INGRESO A LA API */

function testApi(){
    FB.api('/me?fields=id,name,email,picture',function(response){
        if(response.email == "undefined"){
            swal({
                title: "Error",
                text: "Para ingresar es necesario proporcionar la informacion de correo electrónico",
                type: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            },
            function(isConfirm){
                if(isConfirm){
                    window.location = localStorage.getItem("rutaActual");
                }
    
            });
        }else{
            var email = response.email;
            console.log("email",email);
            var nombre = response.nombre;
            console.log("nombre",nombre);

            var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";
            console.log("foto",foto);

            var datos = new FormData();
            datos.append("email",email);
            datos.append("nombre",nombre);
            datos.append("foto",foto);

            $.ajax({

            })


        }
    })
}