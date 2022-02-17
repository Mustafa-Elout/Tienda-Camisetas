<?php
require_once 'models/Categoria.php';
require_once 'models/Producto.php';

class categoriaController{
	
	public function index(){
		Utils::isAdmin();
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		
		require_once 'views/categoria/index.php';
	}
	
	public function ver(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Conseguir categoria
			$categoria = new Categoria();
			$categoria->setId($id);
			$categoria = $categoria->getOne();
			
			// Conseguir productos;
			$producto = new Producto();
			$producto->setCategoria_id($id);
			$productos = $producto->getAllCategory();
		}
		
		require_once 'views/categoria/ver.php';
	}
	
	public function crear(){
		Utils::isAdmin();
		require_once 'views/categoria/crear.php';
	}
	
	public function save(){
		Utils::isAdmin();
	    if(isset($_POST) && isset($_POST['nombre'])){
			// Guardar la categoria en bd
			$categoria = new Categoria();
			$categoria->setNombre($_POST['nombre']);
			$save = $categoria->save();
		}
		//Añadido
		if ($save) {
            $_SESSION['creado'] = "complete";
        }
        else{
            $_SESSION['creado'] = 'failed';
        }
		header("Location:".base_url."categoria/index");
	}

	//Funciones añadidas
	public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;
            
            $categoria = new Categoria();
            $categoria->setId($id);
            
            $cat = $categoria->getOne();
            
            require_once 'views/categoria/crear.php';
            
        }else{
            header('Location:'.base_url.'Categoria/index');
        }
    }

	public function eliminar(){
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            
            $delete = $categoria->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }   
        header('Location:'.base_url.'Categoria/index');
    }
	public function guardado()
    {
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                if ($nombre) {
                    $categoria = new Categoria();
                    $categoria->setNombre($nombre);

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $categoria->setId($id);
                        $cambiado = $categoria->edit();
                    }

                    if ($cambiado) {
                        $_SESSION['editado'] = "complete";
                    }
                } else {
                    $_SESSION['editado'] = "failed";
                }
            } 
        }
            header("Location:" . base_url . 'categoria/index'); 
    }
}