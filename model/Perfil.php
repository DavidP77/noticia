<?php 

require "../config/conexion.php";

Class Perfil{
    
	public function insertar($nombre)
	{
		$sql="INSERT INTO perfil (nombre,estado) VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}
    
	public function editar($id_perfil,$nombre)
	{
		$sql="UPDATE perfil SET nombre='$nombre' WHERE id_perfil='$id_perfil'";
		return ejecutarConsulta($sql);
	}
    
	public function desactivar($id_perfil)
	{
		$sql="UPDATE perfil SET estado='0' WHERE id_perfil='$id_perfil'";
		return ejecutarConsulta($sql);
	}
    
	public function activar($id_perfil)
	{
		$sql="UPDATE perfil SET estado='1' WHERE id_perfil='$id_perfil'";
		return ejecutarConsulta($sql);
	}
    
	public function mostrar($id_perfil)
	{
		$sql="SELECT * FROM perfil WHERE id_perfil='$id_perfil'";
		return ejecutarConsultaSimpleFila($sql);
	}
    
	public function listar()
	{
		$sql="SELECT * FROM perfil order by nombre";
		return ejecutarConsulta($sql);		
	}
}

?>