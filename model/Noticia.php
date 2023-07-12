<?php 

require "../config/Conexion.php";

Class Noticia{

	public function insertar($titulo,$contenido,$id_categoria,$url_multimedia,$tipo_multimedia,$id_usuario)
	{
        $sql = "INSERT INTO noticia (titulo, contenido, multimedia, tipo_multimedia, estado, id_usuario, id_categoria)
        VALUES ('$titulo', '$contenido', '$url_multimedia', '$tipo_multimedia', '1', '$id_usuario', '$id_categoria')";
		return ejecutarConsulta($sql);
	}

	public function editar($id_noticia,$titulo,$contenido,$id_categoria,$url_multimedia,$tipo_multimedia,$id_usuario)
	{ 
		$sql="UPDATE noticia SET 
		titulo='$titulo',
		contenido='$contenido',
		id_categoria='$id_categoria',
		multimedia='$url_multimedia',
		tipo_multimedia='$tipo_multimedia' 
		WHERE id_noticia='$id_noticia'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($id_noticia)
	{
		$sql="UPDATE noticia SET estado='0' WHERE id_noticia='$id_noticia'";
		return ejecutarConsulta($sql);
	}

	public function activar($id_noticia)
	{
		$sql="UPDATE noticia SET estado='1' WHERE id_noticia='$id_noticia'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($id_noticia)
	{
		$sql="SELECT n.id_noticia,n.titulo,n.contenido,n.multimedia,n.tipo_multimedia,c.id_categoria,c.nombre,n.estado
		FROM noticia n 
		INNER JOIN categoria c ON n.id_categoria=c.id_categoria 
		INNER JOIN usuario u ON n.id_usuario=u.id_usuario 
		WHERE n.id_noticia='$id_noticia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT n.id_noticia,n.titulo,n.contenido,c.nombre categoria,n.tipo_multimedia,n.multimedia,u.nombre,DATE_FORMAT(n.fecha_publicacion, '%d-%m-%Y %H:%i:%s') AS fecha_publicacion, n.estado,n.id_categoria
		FROM noticia n 
		INNER JOIN categoria c ON n.id_categoria=c.id_categoria 
		INNER JOIN usuario u ON n.id_usuario=u.id_usuario
        WHERE n.estado=1 and c.estado=1";
		return ejecutarConsulta($sql);		
	}

}

?>