var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}

function limpiar()
{
	$("#nombre").val("");
	$("#idperfil").val("");
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
					url: '../controller/perfil.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,
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
		url: "../controller/perfil.php?op=guardaryeditar",
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

function mostrar(id_perfil)
{
	$.post("../controller/perfil.php?op=mostrar",{id_perfil : id_perfil}, function(data)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		var estado = (data.estado == 1) ? "Activado":"Desactivado";

		$("#nombre").val(data.nombre);
		$("#estado").val(estado);
		$("#id_perfil").val(id_perfil);

 	});
}

function desactivar(id_perfil)
{
	bootbox.confirm("¿Está Seguro de desactivar el perfil?", function(result){
		if(result)
        {
        	$.post("../controller/perfil.php?op=desactivar", {id_perfil : id_perfil}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function activar(id_perfil)
{
	bootbox.confirm("¿Está Seguro de activar el Perfil?", function(result){
		if(result)
        {
        	$.post("../controller/perfil.php?op=activar", {id_perfil : id_perfil}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();