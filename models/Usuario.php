<?php

class Usuario{
	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $password;
	private $rol;
	private $imagen;
	private $provincia;
	private $localidad;
	private $direccion;
	private $db;

	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}

	function getProvincia() {
		return $this->provincia;
	}

	function getLocalidad() {
		return $this->localidad;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	function setProvincia($provincia) {
		$this->provincia=$provincia;
	}

	function setLocalidad($localidad) {
		$this->localidad=$localidad;
	}

	function setDireccion($direccion) {
		$this->direccion=$direccion;
	}

	public function save(){
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null, '{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function login(){
		$result = false;
		$email = $this->email;
		$password = $this->password;
		
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);
		
		
		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();
			
			// Verificar la contraseña
			$verify = password_verify($password, $usuario->password);
			
			if($verify){
				$result = $usuario;
			}
		}
		
		return $result;
	}

	//Añido por mustafa
	public function getAll(){
		$usuarios = $this->db->query("SELECT * FROM usuarios ORDER BY id DESC");
		return $usuarios;
	}


	public function getOne(){
		$usuario = $this->db->query("SELECT * FROM usuarios WHERE id = {$this->getId()}");
	
			return $usuario->fetch_object();

	}

	public function delete(){
		$sql = "DELETE FROM usuarios WHERE id={$this->id}";
		$delete = $this->db->query($sql); 
		
		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}

	public function edit(){
		if(isset($_SESSION['admin']) && $_SESSION['admin']== true){
			$sql = "UPDATE usuarios SET nombre='{$this->getNombre()}', apellidos='{$this->getApellidos()}', email='{$this->getEmail()}', rol='{$this->getRol()}', imagen='{$this->getImagen()}'  ";
		}else{
			$sql = "UPDATE usuarios SET nombre='{$this->getNombre()}', apellidos='{$this->getApellidos()}', email='{$this->getEmail()}', rol='{$this->getRol()}', imagen='{$this->getImagen()}'  ";
		}

		if($this->getImagen() != null){
			$sql .= ", imagen='{$this->getImagen()}'";
		}
		
		$sql .= " WHERE id={$this->id};";
		
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}


	
	
}