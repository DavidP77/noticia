<?php 
require_once "../model/Categoria.php";

$categoria=new Categoria();

$id_categoria=isset($_POST["id_categoria"])? limpiarCadena($_POST["id_categoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_categoria)){
			$rspta=$categoria->insertar($nombre);
			echo $rspta ? "Categoría registrada" : "Categoría no se pudo registrar";
		}
		else {
			$rspta=$categoria->editar($id_categoria,$nombre);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$categoria->desactivar($id_categoria);
 		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
	break;

	case 'activar':
		$rspta=$categoria->activar($id_categoria);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
	break;

	case 'mostrar':
		$rspta=$categoria->mostrar($id_categoria);
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$categoria->listar();
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
                "0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_categoria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_categoria.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_categoria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_categoria.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case 'selectCategoria':
		$rspta  = $categoria->listar();        
        echo '<option value="" selected>Seleccione una opción</option>';
 		while ($reg = $rspta->fetch_object()){
 			echo '<option value=' .$reg->id_categoria. '>' .$reg->nombre. '</option>';
		}
	break;

	case 'listarCategoriasActivas':
        $rspta = $categoria->listarCategoriasActivas();
        $data = [];
        while ($reg = $rspta->fetch_object()) {
            $categoriaData = [
                'id_categoria' => $reg->id_categoria,
                'nombre' => $reg->nombre
            ];
            $data[] = $categoriaData;
        }
        echo json_encode($data);
   break;
}
?>