<?php

class Usuario
{
    private $cod_usuario;
    private $nombre_usuario;
    private $email;
    private $tipo_usuario;
    private $categoria_cliente;
    private $estado_usuario;


    public function __construct($cod_usuario = null, $nombre_usuario = '', $email = '', $tipo_usuario = '', $categoria_cliente = '', $estado_usuario = '')
    {
        $this->cod_usuario = $cod_usuario;
        $this->nombre_usuario = $nombre_usuario;
        $this->email = $email;
        $this->tipo_usuario = $tipo_usuario;
        $this->categoria_cliente = $categoria_cliente;
        $this->estado_usuario = $estado_usuario;
    }


    public function save(
        $nombre_usuario,
        $email,
        $hashed_password,
        $tipo_usuario,
        $categoria_cliente,
        $estado_usuario,
        $hash_validacion
    )
    {
        include("../../config/db.php");

        $query = "INSERT INTO usuarios(
            nombre_usuario, 
            email, 
            clave_usuario, 
            tipo_usuario, 
            categoria_cliente,
            estado_usuario,
            hash_validacion) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?)"; 

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        $stmt->bind_param(
            'sssssss', // 's' indica tipo string
            $nombre_usuario,
            $email,
            $hashed_password,
            $tipo_usuario,
            $categoria_cliente,
            $estado_usuario,
            $hash_validacion
        );

        $result = $stmt->execute(); // Ejecutar la consulta
        if ($result === false) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close(); // Cerrar la declaración
    }


    public static function findAll()
    {
        include("../../config/db.php"); 

        $query = "SELECT * FROM usuarios"; 

        $result = $conn->query($query); 

        if ($result === false) {
            die("Error al ejecutar la consulta: " . $conn->error);
        }

        $usuarios = []; 

        while ($row = $result->fetch_assoc()) {
            $usuarios[] = new Usuario(
                $row['cod_usuario'],
                $row['nombre_usuario'],
                $row['email'],
                $row['tipo_usuario'],
                $row['categoria_cliente'],
                $row['estado_usuario']
            );
        }

        $result->free(); // Liberar el resultado
        return $usuarios;
    }


    public static function findByemail($email)
    {
        include("../../config/db.php");

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email); 
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        return $usuario;
    }


    public static function delete($cod_usuario)
    {
    }
}