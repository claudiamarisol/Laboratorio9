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
$carreraAbreviacion = $row['carreraAbreviacion'];
$id_carrera = $row['id'];

}else if (isset($_POST['Update'])) {
//Para actualizar dato U=UPDATE
$nombres = $_POST['nombres'];
$codigo = $_POST['codigo'];
$carreraAbreviacion = $_POST['carreraAbreviacion'];
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
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<div class="jumbotron text-center" style="margin-bottom:0">
<h1>Laboratorio 9</h1>
<h2>Sistema de detalles de Carreras</h2>
</div>

<div class="container-fluid" style="margin-top: 30px;">
<div class="row">
<div class="col-sm-4">
<form class="form" action="index.php" method="POST">
<input type="hidden" name="id_carrera" value="<?php echo (isset($id_carrera))?$id_carrera:''; ?>">

<div class="form-group">
<label>Nombre: </label>
<input class="form-control" type="text" name="nombres" value="<?php echo (isset($nombres))?$nombres:''; ?>">
</div>
<div class="form-group">
<label>Codigo: </label>
<input class="form-control" type="text" name="codigo" value="<?php echo (isset($codigo))?$codigo:''; ?>">
</div>
<div class="form-group">
<label>CarreraAbreviacion: </label>
<input class="form-control" type="text" name="carreraAbreviacion" value="<?php echo (isset($carreraAbreviacion))?$carreraAbreviacion:''; ?>">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Insertar">
<input class="btn btn-warning" type="submit" name="Update" value="Actualizar">
<input class="btn btn-danger" type="submit" name="Delete" value="Eliminar">
</form>
</div>
<div class="col-sm-8">
<?php
//Consulta SQL para realizar el listado de la tabla R=READ
$query = "SELECT * FROM carreras";
$res = $conn->query($query);
?>
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>ID Carrera</th>
<th>Nombre</th>
<th>Codigo</th>
<th>CarreraAbreviacion</th>
<th>Fechar Registro</th>
<th>Actualizar/Eliminar</th>
</tr>
</thead>
<tbody>
<?php
while ($row = $res->fetch_assoc()) { echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['nombres'] . "</td>";
echo "<td>" . $row['codigo'] . "</td>";
echo "<td>" . $row['carreraAbreviacion'] . "</td>";
echo "<td>" . $row['fecha_registro'] . "</td>";
echo "<td><a href='index.php?id_carrera=" . $row['id'] . "'>Seleccionar</a></td>";
echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>

<footer>
<div class="jumbotron text-left" style="margin-bottom:0">
<p>By CACHI 2023</p>
</div>
</footer>
</body>
</html>
