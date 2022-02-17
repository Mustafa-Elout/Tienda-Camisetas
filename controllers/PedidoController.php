<?php
require_once 'models/Pedido.php';
require_once 'models/Usuario.php';

class pedidoController{
	
	public function hacer(){
		//Asigno el idi de nuestro usuario y ejecuto la consulta
		$id=$_SESSION['identity']->id;
		$usuario = new Usuario();
		$usuario->setId($id);
		$usr = $usuario->getOne();
		require_once 'views/pedido/hacer.php';
	}
	
	public function add(){
		if(isset($_SESSION['identity'])){
			$usuario_id = $_SESSION['identity']->id;
			$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
			$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
			
			$stats = Utils::statsCarrito();
			$coste = $stats['total'];
				
			if($provincia && $localidad && $direccion){
				// Guardar datos en bd
				$pedido = new Pedido();
				$pedido->setUsuario_id($usuario_id);
				$pedido->setProvincia($provincia);
				$pedido->setLocalidad($localidad);
				$pedido->setDireccion($direccion);
				$pedido->setCoste($coste);
				
				$save = $pedido->save();
				
				// Guardar linea pedido
				$save_linea = $pedido->save_linea();
				
				if($save && $save_linea){
					$_SESSION['pedido'] = "complete";
					//llamr a la funcion decrementarStock
				}else{
					$_SESSION['pedido'] = "failed";
				}
				
			}else{
				$_SESSION['pedido'] = "failed";
			}
			
			header("Location:".base_url.'pedido/confirmado');			
		}else{
			// Redigir al index
			header("Location:".base_url);
		}
	}
	
	public function confirmado(){
		if(isset($_SESSION['identity'])){
			$identity = $_SESSION['identity'];
			$pedido = new Pedido();
			$pedido->setUsuario_id($identity->id);
			
			$pedido = $pedido->getOneByUser();
			
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($pedido->id);
			//modificacion en clase por alberto
			unset($_SESSION['carrito']);
		}
		require_once 'views/pedido/confirmado.php';
	}
	
	public function mis_pedidos(){
		Utils::isIdentity();
		$usuario_id = $_SESSION['identity']->id;
		$pedido = new Pedido();
		
		// Sacar los pedidos del usuario
		$pedido->setUsuario_id($usuario_id);
		$pedidos = $pedido->getAllByUser();
		
		require_once 'views/pedido/mis_pedidos.php';
	}
	
	public function detalle(){
		Utils::isIdentity();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Sacar el pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido = $pedido->getOne();

			//sacar los datos del usuario
			$usuario=new Usuario();
			$usuario->setId($pedido->usuario_id);
			$usuario=$usuario->getOne();
			
			// Sacar los poductos
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($id);
			
			require_once 'views/pedido/detalle.php';
		}else{
			header('Location:'.base_url.'pedido/mis_pedidos');
		}
	}
	
	public function gestion(){
		Utils::isAdmin();
		$gestion = true;
		
		$pedido = new Pedido();
		$pedidos = $pedido->getAll();
		
		require_once 'views/pedido/mis_pedidos.php';
	}
	
	public function estado(){
		Utils::isAdmin();
		if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
			// Recoger datos form
			$id = $_POST['pedido_id'];
			$estado = $_POST['estado'];
			
			// Upadate del pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido->setEstado($estado);
			$pedido->edit();
			
			header("Location:".base_url.'pedido/detalle&id='.$id);
		}else{
			header("Location:".base_url);
		}
	}

	//Añadido por Mustafa

	public function totalGasto(){
		Utils::isAdmin();
		$producto = new Producto();
		$producto = $producto->totalGastadoUsuario();
		
	}

	public function eliminar(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$producto = new Pedido();
			$producto->setId($id);
			
			$delete = $producto->delete();
			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		if(isset($_SESSION['admin'])){
			header('Location:'.base_url.'pedido/gestion');
		}else{
			header('Location:'.base_url.'pedido/mis_pedidos');
		}
		
	}

	public function generarPdf()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            // Sacar la información del usuario
            $usuario = new Usuario();
            $usuario->setId($pedido->usuario_id);
            $usuario = $usuario->getOne();

            // Sacar los poductos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);

            require_once 'views/pedido/generarPdf.php';
        } else {
            header('Location:' . base_url . 'pedido/confirmado');
        }
    }
	
	
}