<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto si es necesario
$password = "root";
$dbname = "sistema_boletos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre_cliente = $_POST['nombre_cliente'];
$correo_cliente = $_POST['correo_cliente'];
$parque_acuatico = $_POST['parque_acuatico'];
$cantidad_boletos = $_POST['cantidad_boletos'];

// Insertar en la base de datos
$sql = "INSERT INTO compras (nombre_cliente, correo_cliente, parque_acuatico, cantidad_boletos)
        VALUES ('$nombre_cliente', '$correo_cliente', '$parque_acuatico', $cantidad_boletos)";

if ($conn->query($sql) === TRUE) {
    echo "Compra registrada con éxito";

    // Enviar correo de confirmación
    $to = $correo_cliente;
    $subject = "Confirmación de compra de boletos";
    $message = "Gracias por tu compra, $nombre_cliente.\n\nHas comprado $cantidad_boletos boletos para el parque $parque_acuatico.";
    $headers = "From: redhatxd@gmail.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "<br>Correo de confirmación enviado.";
    } else {
        echo "<br>No se pudo enviar el correo de confirmación.";
    }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
