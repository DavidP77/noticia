var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$.post("../controller/perfil.php?op=selectPerfil", function(r){
		$("#id_perfil").html(r);
		$("#id_perfil").selectpicker('refresh');
	});
}

function limpiar()
{
	$("#nombre").val("");
	$("#id_perfil").val("");
	$("#email").val("");
	$("#rut").val("");
	$("#login").val("");
	$("#password").val("");
	$("#id_usuario").val("");
}

function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#password").prop('disabled', false);
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
					url: '../controller/usuario.php?op=listar',
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
		url: "../controller/usuario.php?op=guardaryeditar",
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

function mostrar(id_usuario)
{
	$.post("../controller/usuario.php?op=mostrar",{id_usuario : id_usuario}, function(data)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_perfil").val(data.id_perfil);
		$('#id_perfil').selectpicker('refresh');

		$("#nombre").val(data.nombre);
		$("#rut").val(data.rut);
		$("#email").val(data.email);
		$("#login").val(data.login);
		$("#id_usuario").val(data.id_usuario);

 	});
}

function desactivar(id_usuario)
{
	bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(result)
        {
        	$.post("../controller/usuario.php?op=desactivar", {id_usuario : id_usuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function activar(id_usuario)
{
	bootbox.confirm("¿Está Seguro de activar el Usuario?", function(result){
		if(result)
        {
        	$.post("../controller/usuario.php?op=activar", {id_usuario : id_usuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();