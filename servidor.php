<?php
require "conexion.php";

// Get Users
$names =$_GET["names"];

// Updated Values
$updatedID = $_GET['updatedID'];
$updatedName = $_GET['updatedName'];

// Deleted Value
$deletedID = $_GET['deletedID'];

// Added Values
$newUser = $_GET['newUser'];
$newEmail = $_GET['newEmail'];

// Strings to be concatenated
$nombreID = "nombreID";
$emailID = "emailID";
$actualizar = "actualizar";
$borrar = "borrar";

if($names === "showPeople"){

    $result = mysqli_query($con,"SELECT * FROM personas");

    $table .= '<div class = "container">';
    $table .= '<table class="table table-striped table-bordered">';
    $table .= '<tr>';
    $table .= '<th>ID</th>';
    $table .= '<th>Name</th>';
    $table .= '<th>Email</th>';
    $table .= '<th>Edit User</th>';
    $table .= '<th>Delete User</th>';
    $table .= '</tr>';
    while($row = mysqli_fetch_assoc($result))
    {
        $table .= '<tr>';
        $table .= '<td>' .$row['usuario'] . '</td>';
        $table .= '<td id = "'.$nombreID . $row['usuario'] . '">' .$row['nombre'] . '</td>';
        $table .= '<td id = "'.$emailID. $row['usuario'] . '">' .$row['correo'] . '</td>';
        $table .= '<td><input id="' . $row['usuario'] . '"  onclick = "editarUsuario(this.id)"  value = "Edit"  class="btn btn-default" type = "button" /></td>';
        $table .= '<td><input id="' .$borrar. $row['usuario'] . '"  onclick = "deleteUser('. $row['usuario'] . ')"  value = "Delete" class="btn btn-danger" type = "button" /></td>';
        $table .= '<td><input id="' .$actualizar .$row['usuario'] . '"  onclick = "updateUser('. $row['usuario'] . ')"  type = "button" value = "Update" class="btn btn-primary"style="display:none" /></td>';
        $table .= '</tr>';
    }
    $table .= '</table>';
    $table .= '<button onclick = "openModal()" class = "btn btn-primary">' . "Add User". '</button>';
    $table .= '</container>';

    echo $table;
    mysqli_close($con);
}

/******* Update User***********/

if(!empty($updatedName)){

    $client = mysqli_real_escape_string($con, $updatedName);
    $result = mysqli_query($con, "UPDATE personas SET nombre = '$client' WHERE usuario = $updatedID");
    mysqli_close($con);
}

/******* Delete User ***********/

if(!empty($deletedID)){

    $client = mysqli_real_escape_string($con, $updatedName);
    $result = mysqli_query($con, "DELETE FROM personas WHERE usuario = $deletedID");
    mysqli_close($con);
}

/******* Add user ***********/

if(!empty($newUser) && !empty($newEmail)){

    $result = mysqli_query($con, "INSERT into personas values('','$newUser','$newEmail')");
    mysqli_close($con);
}
?>