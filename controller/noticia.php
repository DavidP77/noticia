<?php 

require_once "../model/Noticia.php";

$noticia=new Noticia();
$id_noticia 	    = isset($_POST["id_noticia"])? limpiarCadena($_POST["id_noticia"]):"";
$titulo 		    = isset($_POST["titulo"])? limpiarCadena($_POST["titulo"]):"";
$contenido 	        = isset($_POST["contenido"])? limpiarCadena($_POST["contenido"]):"";
$id_categoria 	    = isset($_POST["id_categoria"])? limpiarCadena($_POST["id_categoria"]):"";
$multimedia_imagen 	= isset($_POST["multimedia_imagen"])? limpiarCadena($_POST["multimedia_imagen"]):"";
$multimedia_video 	= isset($_POST["multimedia_video"])? limpiarCadena($_POST["multimedia_video"]):"";
$tipo_multimedia 	= isset($_POST["tipo_multimedia"])? limpiarCadena($_POST["tipo_multimedia"]):"";
$id_usuario         = isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
        $url_multimedia = ($tipo_multimedia == 'imagen') ? $multimedia_imagen : $multimedia_video;
		if (empty($id_noticia)){
			$rspta=$noticia->insertar($titulo,$contenido,$id_categoria,$url_multimedia,$tipo_multimedia,$id_usuario);
			echo $rspta ? "Noticia registrada" : "Noticia no se pudo registrar";
		}
		else {
			$rspta=$noticia->editar($id_noticia,$titulo,$contenido,$id_categoria,$url_multimedia,$tipo_multimedia,$id_usuario);
			echo $rspta ? "Noticia actualizada" : "Noticia no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$noticia->desactivar($id_noticia);
 		echo $rspta ? "Noticia Desactivada" : "Noticia no se puede desactivar";
	break;

	case 'activar':
		$rspta=$noticia->activar($id_noticia);
 		echo $rspta ? "Noticia activada" : "Noticia no se puede activar";
	break;

	case 'mostrar':
		$rspta=$noticia->mostrar($id_noticia);
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$noticia->listar();
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_noticia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_noticia.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_noticia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_noticia.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->titulo,
 			    "2"=>$reg->contenido,
 				"3"=>$reg->categoria,
 				"4"=>($reg->tipo_multimedia == 'imagen')?'<img width="300" height="180" src="'.$reg->multimedia.'">':
                    '<iframe width="300" height="180" src="https://www.youtube.com/embed/'.$reg->multimedia.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
                        encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                "5"=>$reg->nombre,
 				"6"=>$reg->fecha_publicacion,
 				"7"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case 'listarNoticias':
        $rspta = $noticia->listar();
        $data = [];
        while ($reg = $rspta->fetch_object()) {
            $noticiaData = [
                'id_noticia' => $reg->id_noticia,
                'titulo' => $reg->titulo,
                'contenido' => $reg->contenido,
                'categoria' => $reg->categoria,
                'tipo_multimedia' => $reg->tipo_multimedia,
                'multimedia' => $reg->multimedia,
                'nombre' => $reg->nombre,
                'fecha_publicacion' => $reg->fecha_publicacion,
            ];
            $data[] = $noticiaData;
        }
        echo json_encode($data);
   break;

}
?>