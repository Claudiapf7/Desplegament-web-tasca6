<?php

require_once('Connexio.php');

Class Crear{
    public function crear($nom, $descripcio, $preu, $categoria){
        //la variable id no la demanem ja que és autoincremental!
        if (!isset($nom) || !isset($descripcio) || !isset($preu) || !isset($categoria)) {
            echo '<p>Es necessiten tots els camps per crear el producte.</p>';
            return;
        }
        // Crea una instancia de la clase de conexión
        $conexionObj = new Connexio();
        // Obtiene la conexión a la base de datos
        $conexion = $conexionObj->obtenirConnexio();

        
        // Escapa las variables para prevenir SQL injection
        $nom = $conexion->real_escape_string($nom);
        $descripcio = $conexion->real_escape_string($descripcio);
        $preu = $conexion->real_escape_string($preu);
        $categoria = $conexion->real_escape_string($categoria);
        
        // Construye la consulta SQL de actualización
        $consulta = "UPDATE productes
                     SET nom = '$nom', descripció = '$descripcio', preu = '$preu', categoria_id = '$categoria'
                     WHERE id = '$id'";
        
        "INSERT INTO 'productes'('nom', 'descripció', 'preu', 'categoria_id) "
        . "VALUES ('$nom','$descripcio','$preu','$categoria')";

        // Ejecuta la consulta y redirige a la página principal si tiene éxito
        if ($conexion->query($consulta) === TRUE) {
            header('Location: Principal.php');
            exit();
        } else {
            // Muestra un mensaje de error si la consulta falla
            echo '<p>Error al crear el producte: ' . $conexion->error . '</p>';
        }

        // Cierra la conexión a la base de datos
        $conexion->close();

    }
}
   
// Obtiene los valores del formulario (si existen)

$nom = isset($_POST['nom']) ? $_POST['nom'] : null;
$descripcio = isset($_POST['descripcio']) ? $_POST['descripcio'] : null;
$preu = isset($_POST['preu']) ? $_POST['preu'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

// Crea una instancia de la clase Actualitzar y llama al método actualizar
$crearProducto = new Crear();
$crearProducto->crear($nom, $descripcio, $preu, $categoria);

?>
