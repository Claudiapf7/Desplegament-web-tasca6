<?php

// Incluye el archivo de conexión
require_once('Connexio.php');


class Eliminar{
    public function eliminarProducte($id){
         // Crea una instancia de la clase de conexión
        $conexionObj = new Connexio();
        // Obtiene la conexión a la base de datos
        $conexion = $conexionObj->obtenirConnexio();
        
         // Construye la consulta SQL de actualización
        $consulta = "DELETE FROM productes WHERE id = '$id'";

        // Ejecuta la consulta y redirige a la página principal si tiene éxito
        if ($conexion->query($consulta) === TRUE) {
            header('Location: Principal.php');
            exit();
        } else {
            // Muestra un mensaje de error si la consulta falla
            echo '<p>Error al eliminar el producte: ' . $conexion->error . '</p><a href="Principal.php">Pàgina principal</a>';
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    }
}


// Obtiene el ID del producto de la variable GET
$idProducte = isset($_GET['id']) ? $_GET['id'] : null;
$eliminarProducte = new Eliminar();
$eliminarProducte->eliminarProducte($idProducte);
