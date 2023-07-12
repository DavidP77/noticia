<?php 

require "../config/Conexion.php";

Class Categoria
{    
	public function insertar($nombre)
	{
		$sql="INSERT INTO categoria (nombre, estado) VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}
    
	public function editar($id_categoria,$nombre)
	{
		$sql="UPDATE categoria SET nombre='$nombre' WHERE id_categoria='$id_categoria'";
		return ejecutarConsulta($sql);
	}
    
	public function desactivar($id_categoria)
	{
		$sql="UPDATE categoria SET estado='0' WHERE id_categoria='$id_categoria'";
		return ejecutarConsulta($sql);
	}
    
	public function activar($id_categoria)
	{
		$sql="UPDATE categoria SET estado='1' WHERE id_categoria='$id_categoria'";
		return ejecutarConsulta($sql);
	}
    
	public function mostrar($id_categoria)
	{
		$sql="SELECT * FROM categoria WHERE id_categoria='$id_categoria'";
		return ejecutarConsultaSimpleFila($sql);
	}
    
	public function listar()
	{
		$sql="SELECT * FROM categoria order by nombre";
		return ejecutarConsulta($sql);		
	}
    
	public function listarCategoriasActivas()
	{
		$sql="SELECT DISTINCT c.id_categoria,c.nombre 
        FROM noticia n 
        INNER JOIN categoria c ON n.id_categoria=c.id_categoria 
        WHERE c.estado=1 AND n.estado=1 ";
		return ejecutarConsulta($sql);		
	}
}

?>