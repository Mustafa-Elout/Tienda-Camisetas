<?php
require_once 'models/Usuario.php';
require_once 'models/Pedido.php';
require_once 'config/parameters.php';

class usuarioController{
	
	public function index(){
		echo "Controlador Usuarios, Acción index";
	}
	
	public function registro(){
		require_once 'views/usuario/registro.php';
	}


	public function save(){

		if(isset($_POST)){
			
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;
			$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
			$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

			
			
			
			if($nombre && $apellidos && $email && $password ){
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setPassword($password);
				$usuario->setRol("user");
				
				
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$usuario->setId($id);
					
					$edit = $usuario->edit();
				}else{
				$usuario->setProvincia($provincia);
				$usuario->setLocalidad($localidad);
				$usuario->setDireccion($direccion);

					$save = $usuario->save();
				}
				
				if($save){
					$_SESSION['register'] = "complete";
					$_SESSION['editar'] = "failed";
				}
				if($edit){
					$_SESSION['register'] = "failed";
					$_SESSION['editar'] = "complete";
				}
			}else{
				$_SESSION['register'] = "failed";
				$_SESSION['editar'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
			$_SESSION['editar'] = "failed";
		}
		if($_SESSION['editar'] == "complete"){
			header("Location:".base_url.'usuario/gestionUsuario');
		}
		if($_SESSION['register'] == "complete"){
			header("Location:".base_url.'Usuario/registro');
		}
		
	}
	
	

	public function login(){
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);
			
			$identity = $usuario->login();
			
			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;
				
				if($identity->rol == 'admin'){
					$_SESSION['admin'] = true;
				}
				
			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}
		
		}
		header("Location:".base_url);
	}
	
	public function logout(){
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}
		
		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}

		//modificacion en clase por alberto
		session_destroy();
		header("Location:".base_url);
	}


	//Editado por mustafa

	public function crear(){
		Utils::isAdmin();
		require_once 'views/usuario/crear.php';
	}

	public function gestion(){
		Utils::isAdmin();
		
		$usuario = new Usuario();
		$usuarios = $usuario->getAll();
		
		
		require_once 'views/usuario/gestion.php';
	}
	public function gestionUsuario(){
		Utils::isIdentity();
		$id_usuario = $_SESSION['identity']->id;
		$usuario = new Usuario();
		$usuario->setId($id_usuario);
		$usuarios = $usuario->getOne();
		
		require_once 'views/usuario/gestion.php';
	}

	public function editar(){
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$edit = true;
			
			$usuario = new Usuario();
			$usuario->setId($id);
			
			$usr = $usuario->getOne();
			
			require_once 'views/usuario/crear.php';
			
		}else{
			header('Location:'.base_url.'Usuario/gestion');
		}
	}

	public function eliminar(){
		Utils::isAdmin();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$usuario = new Usuario();
			$usuario->setId($id);
			
			$delete = $usuario->delete();
			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'Usuario/gestion');
	}
	public function saveAdmin(){
		//Moificado la linea de abajo
		Utils::isAdmin();
		if(isset($_POST)){
			
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$rol = isset($_POST['rol']) ? $_POST['rol'] : false;
			
			if($nombre && $apellidos && $email && $rol){
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setRol($rol);

				// Guardar la imagen *añadido
				if(isset($_FILES['imagen'])){
					$file = $_FILES['imagen'];
					$filename = $file['name'];
					$mimetype = $file['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

						if(!is_dir('uploads/images')){
							mkdir('uploads/images', 0777, true);
						}

						$usuario->setImagen($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
					}
				}

				//modificado hsata el siguiebte comentario
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$usuario->setId($id);
					
					$save = $usuario->edit();
				}else{
					$save = $usuario->save();
				}
				//$save = $usuario->save();
				if($save){
					$_SESSION['register'] = "complete";
					$_SESSION['editar'] = "complete";
				}else{
					$_SESSION['register'] = "failed";
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'Usuario/gestion');
	}
	
} // fin clase