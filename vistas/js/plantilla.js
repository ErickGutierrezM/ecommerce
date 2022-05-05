/**PLANTILLA */

var rutaOculta = $("#rutaOculta").val();


/*=============================================
CUADRÍCULA O LISTA
=============================================*/

var btnList = $(".btnList");

for (var i = 0; i < btnList.length; i++) {

    $("#btnGrid" + i).click(function() {

        var numero = $(this).attr("id").substr(-1);

        $(".list" + numero).hide();
        $(".grid" + numero).show();

        $("#btnGrid" + numero).addClass("backColor");
        $("#btnList" + numero).removeClass("backColor");

    })

    $("#btnList" + i).click(function() {

        var numero = $(this).attr("id").substr(-1);

        $(".list" + numero).show();
        $(".grid" + numero).hide();

        $("#btnGrid" + numero).removeClass("backColor");
        $("#btnList" + numero).addClass("backColor");

    })

}

/**BREADCRUMB */

var pagAct = $(".pagAct").html();

if(pagAct != null){
/**sustituir guiones por espacios en blanco */
var regPagAct = pagAct.replace(/-/g, " ");

$(".pagAct").html(regPagAct);
}

// /**ENLACES DE LA PAGINACION */

// var url=window.location.href;
// var indice = url.split("/");
// var pagActual = indice.pop();
// if(pagActual!="#"){
//     if(isNaN(pagActual)){
//         $("#item1").addClass("active");
//     }
//     else{
//         $("#item"+pagActual).addClass("active");
//         $("#item"+pagActual+"a").removeAttr("href");
//     }
// }

/*=============================================
ENLACES PAGINACIÓN
=============================================*/

var url = window.location.href;

var indice = url.split("/");

var pagActual =indice[5];

if(isNaN(pagActual)){

   $("#item1").addClass("active");
   
}else{

   $("#item"+pagActual).addClass("active");
 
}

