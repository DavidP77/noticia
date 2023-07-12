<?php 
require "../config/conexion.php";

Class Usuario{

	public function insertar($nombre,$clavehash,$login,$email,$id_perfil)
	{
		$sql="INSERT INTO usuario (nombre,password,login,email,estado,id_perfil)
		VALUES ('$nombre','$clavehash','$login','$email','1','$id_perfil')";
		return ejecutarConsulta($sql);
	}

	public function editar($id_usuario,$nombre,$login,$email,$id_perfil,$clavehash,$password)
	{
		if($password != ""){
			$pass = ",password='$clavehash'";
		}else{
			$pass="";
		}
		$sql="UPDATE usuario SET nombre='$nombre',login='$login',email='$email',id_perfil='$id_perfil'$pass WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($id_usuario)
	{
		$sql="UPDATE usuario SET estado='0' WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql);
	}

	public function activar($id_usuario)
	{
		$sql="UPDATE usuario SET estado='1' WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($id_usuario)
	{
		$sql="SELECT * FROM usuario WHERE id_usuario='$id_usuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql="SELECT u.id_usuario,u.nombre,u.login,u.email,u.estado,p.nombre perfil
		      FROM usuario u INNER JOIN perfil p ON u.id_perfil=p.id_perfil";
		return ejecutarConsulta($sql);		
	}

	public function verificar($login,$clave)
    {
    	$sql="SELECT u.id_usuario,u.nombre,u.email,u.login,p.nombre perfil,p.id_perfil
    	FROM usuario u 
    	INNER JOIN perfil p ON
    	u.id_perfil=p.id_perfil
    	WHERE u.login='$login' AND u.password='$clave' AND u.estado='1'";
    	return ejecutarConsulta($sql);  
    }

	public function getUserApprover()
	{

		$sql="SELECT email FROM usuario where id_perfil='4'";
		return ejecutarConsulta($sql);
	}
}

?>