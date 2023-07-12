<?php
session_start(); 
require_once "../model/Perfil.php";

$perfil=new Perfil(); 

$id_perfil      = isset($_POST["id_perfil"])? limpiarCadena($_POST["id_perfil"]):"";
$nombre		    = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){ 
	case 'guardaryeditar':

		if (empty($id_perfil)){
			$rspta=$perfil->insertar($nombre);
			echo $rspta ? "Perfil registrado" : "No se pudieron registrar todos los datos del Perfil";
		}
		else {
			$rspta=$perfil->editar($id_perfil,$nombre);
			echo $rspta ? "Perfil actualizado" : "Perfil no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$perfil->desactivar($id_perfil);
 		echo $rspta ? "Perfil Desactivado" : "Perfil no se puede desactivar";
	break;

	case 'activar':
		$rspta=$perfil->activar($id_perfil);
 		echo $rspta ? "Perfil activado" : "Perfil no se puede activar";
	break;

	case 'mostrar':
		$rspta=$perfil->mostrar($id_perfil);
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$perfil->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_perfil.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_perfil.')" title="Desactivar perfil"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_perfil.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_perfil.')" title="Activar perfil"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectPerfil':
		$rspta  = $perfil->listar();
        echo '<option value="" selected>Seleccione una opción</option>';
 		while ($reg = $rspta->fetch_object()){
 			echo '<option value=' .$reg->id_perfil. '>' .$reg->nombre. '</option>';
		}
	break;
}
?>