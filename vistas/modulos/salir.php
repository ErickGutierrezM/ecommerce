<?php
session_destroy();

$url = Ruta::ctrRuta();


echo '<script>
swal({
    title: "Has cerrado tu sesión",
    type: "success",
    confirmButtonText: "Cerrar",
    closeOnConfirm: false
},
function(isConfirm){
    if(isConfirm){
		window.location = "'.$url.'";
    }
});
window.location = "'.$url.'";



</script>';
	
