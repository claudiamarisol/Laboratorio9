<?php
$hostname = "localhost";
$usuario = "root";
$password = "";
$nombreBD = "laboratorio9_cqcm";

//Crear conexión
$conn = mysqli_connect($hostname, $usuario, $password, $nombreBD);

//CRUD
if (isset($_POST['submit'])) {
//Para insertar datos C=CREATE
$nombres = $_POST['nombres'];
$codigo = $_POST['codigo'];
$carreraAbreviacion = $_POST['carreraAbreviacion'];
$query = "INSERT INTO carreras (nombres, codigo, carreraAbreviacion) VALUES('$nombres','$codigo','$carreraAbreviacion')";
$res = $conn->query($query); header("Refresh:0");
}else if (isset($_GET['id_carrera'])) {
//Para seleccionar dato por un ID
$query = "SELECT * FROM carreras WHERE id ='" . $_GET['id_carrera'] . "'";
$res = $conn->query($query);
$row = $res->fetch_assoc();
$nombres = $row['nombres'];
$codigo = $row['codigo'];
$carreraAbreviacion = $row['emcarreraAbreviacionail'];
$id_carrera = $row['id'];

}else if (isset($_POST['Update'])) {
//Para actualizar dato U=UPDATE
$nombres= $_POST['nombres'];
$codigo = $_POST['codigo'];
$carreraAbreviacion = $_POST['emacarreraAbreviacionil'];
$id_carrera = $_POST['id_carrera'];
$query = "UPDATE carreras SET nombres='$nombres', codigo='$codigo', carreraAbreviacion='$carreraAbreviacion' WHERE id = $id_carrera";
$res = $conn->query($query); header("Refresh:0; url=index.php");

}else if (isset($_POST['Delete'])) {
//Para eliminar un dato D=DELETE
$id_carrera = $_POST['id_carrera'];
$query = "DELETE FROM carreras WHERE id = $id_carrera";
$res = $conn->query($query);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laboratorio 9</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<div style="width:100%; text-align:center">
<h1>Laboratorio 9</h1>
<h2>Sistema de detalles de Carreras</h2>
</div>
<form class="form" action="index.php" method="POST">
<input type="hidden" name="id_carrera" value="<?php echo (isset($id_carrera))?$id_carrera:''; ?>">

<div class="w3-cell-row w3-center w3-padding">
Nombre: <input style="margin:10px;display: inline-block;" type="text" name="nombres" value="<?php echo (isset($nombres))?$nombres:''; ?>">
Codigo: <input style="margin:10px;display: inline-block;" type="text" name="codigo" value="<?php echo (isset($codigo))?$codigo:''; ?>">
CarreraAbreviacion: <input style="margin:10px;display: inline-block;" type="text" name="carreraAbreviacion" value="<?php echo (isset($carreraAbreviacion))?$carreraAbreviacion:''; ?>">
</div>

<div class="w3-cell-row w3-center w3-padding">
<input class="w3-btn w3-blue w3-border w3-margin" type="submit" name="submit" value="Insertar">
<input class="w3-btn w3-orange w3-border w3-margin" type="submit" name="Update" value="Actualizar">
<input class="w3-btn w3-red w3-border w3-margin" type="submit" name="Delete" value="Eliminar">
</div>
</form>
<br>
<?php
//Consulta SQL para realizar el listado de la tabla R=READ
$query = "SELECT * FROM carreras";
$res = $conn->query($query);
?>
<table class="w3-table-all w3-small">
<tr>
<th>ID Carrera</th>
<th>Nombre</th>
<th>Codigo</th>
<th>CarreraAbreviacion</th>
<th>Fechar Registro</th>
<th>Actualizar/Eliminar</th>
</tr>
<?php
while ($row = $res->fetch_assoc()) {
    echo "<tr class='w3-hover-blue' style='cursor:pointer;'>"; echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nombres'] . "</td>";
    echo "<td>" . $row['codigo'] . "</td>";
    echo "<td>" . $row['carreraAbreviacion'] . "</td>";
    echo "<td>" . $row['fecha_registro'] . "</td>";
    echo "<td><a href='index.php?id_carrera=" . $row['id'] . "'>Seleccionar</a></td>";
    echo "</tr>";
    }
    ?>
    </table>
    </body>
    </html>
    