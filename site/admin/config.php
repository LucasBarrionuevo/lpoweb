
<?php 
session_start();
// Conectar a la base de datos
$connection = mysqli_connect('localhost', 'root', '', 'live_news_project');

// Verificar la conexión
if (!$connection) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Aquí puedes continuar con tu lógica

// Cerrar la conexión al final (opcional, si ya no se necesita)
// mysqli_close($connection);
?>
