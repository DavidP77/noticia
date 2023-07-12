var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$.post("../controller/categoria.php?op=selectCategoria", function(r){
        $("#id_categoria").html(r);
        $('#id_categoria').selectpicker('refresh');
	});

}

$("#tipo_multimedia").on('change', function() {
    var opcionSeleccionada = $(this).val();
    toggleSelectBox(opcionSeleccionada);
});

function toggleSelectBox(opcionSeleccionada){
    if(opcionSeleccionada == 'imagen'){
        $("#box_imagen").removeClass("hide");
        $("#box_video").addClass("hide");
        $("#multimedia_video").val("");
    }    
    if(opcionSeleccionada == 'video'){
        $("#box_video").removeClass("hide");
        $("#box_imagen").addClass("hide");
        $("#multimedia_imagen").val("");
    }
}

function limpiar()
{
	$("#id_noticia").val("");
	$("#titulo").val("");
	$("#contenido").val("");	
	$("#id_categoria").val("");
    $('#id_categoria').selectpicker('refresh');	
	$("#multimedia_imagen").val("");
	$("#multimedia_video").val("");
	$("#tipo_multimedia").val(0);
    $('#tipo_multimedia').selectpicker('refresh');	
}

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

function cancelarform()
{
	limpiar();
	mostrarform(false);
}

function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,
	    "aServerSide": true,
		"ajax":
				{
					url: '../controller/noticia.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,
		"bLengthChange": false,
	    "order": [[ 0, "desc" ]]
	}).DataTable();
}

function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../controller/noticia.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(id_noticia)
{

	$.post("../controller/noticia.php?op=mostrar",{id_noticia : id_noticia}, function(data)
	{
		data = JSON.parse(data);		
		mostrarform(true);
//alert("data-->"+JSON.stringify(data))
		$("#id_categoria").val(data.id_categoria);
		$('#id_categoria').selectpicker('refresh');	

		$("#titulo").val(data.titulo);
		$("#contenido").val(data.contenido);

        $("#tipo_multimedia").val(data.tipo_multimedia);
		$('#tipo_multimedia').selectpicker('refresh');

        if(data.tipo_multimedia == 'imagen'){ 
            /*$("#box_imagen").removeClass("hide");
            $("#box_video").addClass("hide");*/
            toggleSelectBox(data.tipo_multimedia);
		    $("#multimedia_imagen").val(data.multimedia);
        }else{/*
            $("#box_video").removeClass("hide");
            $("#box_imagen").addClass("hide");*/
            toggleSelectBox(data.tipo_multimedia);
		    $("#multimedia_video").val(data.multimedia);
        }    
        
 		$("#id_noticia").val(data.id_noticia);
/*
         data-->{"id_noticia":"4",
         "titulo":"Museo de Arte Moderno Chiloé",
         "contenido":"Las instalaciones del Museo de Arte Moderno Chiloé, al igual que los asentamientos rurales de la isla, corresponden a un grupo de construcciones de madera que tienen distintas funciones específicas.",
         "tipo_multimedia":"imagen",
         "id_categoria":"1",
         "nombre":"Arte","estado":"1"}

         if(opcionSeleccionada == 'imagen'){
            $("#box_imagen").removeClass("hide");
            $("#box_video").addClass("hide");
            $("#multimedia_video").val("");
        }    
        if(opcionSeleccionada == 'video'){
            $("#box_video").removeClass("hide");
            $("#box_imagen").addClass("hide");
            $("#multimedia_imagen").val("");
        }
*/


 	})
}

function desactivar(id_noticia)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../controller/noticia.php?op=desactivar", {id_noticia : id_noticia}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function activar(id_noticia)
{
	bootbox.confirm("¿Está Seguro de activar el Artículo?", function(result){
		if(result)
        {
        	$.post("../controller/noticia.php?op=activar", {id_noticia : id_noticia}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();