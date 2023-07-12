<?php
session_start(); 
require_once "../model/Usuario.php";

$usuario=new Usuario(); 

$id_usuario     = isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";
$nombre		    = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$password       = isset($_POST["password"])? limpiarCadena($_POST["password"]):"";
$login          = isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$email          = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$id_perfil      = isset($_POST["id_perfil"])? limpiarCadena($_POST["id_perfil"]):"";

switch ($_GET["op"]){ 
	case 'guardaryeditar':
		$clavehash=hash("SHA256",$password);

		if (empty($id_usuario)){
			$rspta=$usuario->insertar($nombre,$clavehash,$login,$email,$id_perfil);
			echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
		}else { 
			$rspta=$usuario->editar($id_usuario,$nombre,$login,$email,$id_perfil,$clavehash,$password);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($id_usuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($id_usuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($id_usuario);
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_usuario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_usuario.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->login,
 				"3"=>$reg->email,
 				"4"=>$reg->perfil,
 				"5"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, 
 			"iTotalRecords"=>count($data), 
 			"iTotalDisplayRecords"=>count($data), 
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'verificar':
		$login=$_POST['login'];
	    $clave=$_POST['clave'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);

		$rspta=$usuario->verificar($login, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        $_SESSION['id_usuario']=$fetch->id_usuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['login']=$fetch->login;
	        $_SESSION['perfil']=$fetch->perfil;	 
	        $_SESSION['email']=$fetch->email;	
	        $_SESSION['id_perfil']=$fetch->id_perfil;                

	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
        session_unset();
        session_destroy();
        header("Location: ../view/login.html");
	break;
}
?>