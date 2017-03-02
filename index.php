<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <title>Inventario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<br/><br/>
<!--Examinar-->

<div id="overlay"></div>
<div id="specialBox">
    <div id = "box-header"></div>
    <button onmousedown="openModal()" id = "closeButton"></button><br/><br/><br/>
        <label>Name: </label><input type = "text" id = "addUserID"/><br/><br/>
        <label>Email: </label><input type = "email" id = "addEmailID"/><br/><br/><br/>
    <button onmousedown="addNewUser()" style="margin-left: 40%;" class = "btn btn-success">Add New user</button><br/>
</div>

<div id="wrapper">
    <div id="information"></div>
</div>

<script type="text/javascript">

    function showResult() {

        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        } else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("information").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","servidor.php?names="+"showPeople", true);
        xmlhttp.send();
    }

    showResult();

    function editarUsuario(userID)
    {
        var nombreID = "nombreID" + userID;
        var emailID = "emailID" + userID;
        var borrar = "borrar" + userID;
        var actualizar = "actualizar" + userID;
        var editarNombreID = nombreID + "-editar";

        var nombreDelUsuario = document.getElementById(nombreID).innerHTML; // getting nombreID text

        var parent = document.querySelector("#" +nombreID); // getting a reference to parent element

        if(parent.querySelector("#" + editarNombreID) === null){ // checking if element is inside of another element
            document.getElementById(nombreID).innerHTML = '<input id = "'+ editarNombreID +'" type = "text" value="' + nombreDelUsuario + '"/>';
            document.getElementById(borrar).disabled = "true";
            document.getElementById(actualizar).style.display = "block";
        }
    }

    function updateUser(userID)
    {
        if (window.XMLHttpRequest) {

            xmlhttp=new XMLHttpRequest();
        } else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        var updatedName = document.getElementById("nombreID"+userID+"-editar").value;

        xmlhttp.onreadystatechange=function() {
            if (this.readyState === 4 && this.status === 200) {
                showResult();
            }
        }
        xmlhttp.open("GET","servidor.php?updatedID="+userID + "&updatedName=" + updatedName, true);
        xmlhttp.send();

    }

    function deleteUser(userID)
    {
        var respuesta = confirm("Estas seguro de borrar este usuario?");
        if (respuesta === true) {

            if (window.XMLHttpRequest) {

            xmlhttp=new XMLHttpRequest();
        } else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function() {
            if (this.readyState === 4 && this.status === 200) {
                showResult();
            }
        }
        xmlhttp.open("GET","servidor.php?deletedID="+userID, true);
        xmlhttp.send();
        } else {
            console.log("borrar usuario fue cancelado");
        }
    }

    function openModal()
    {
        var overlay = document.getElementById('overlay');
        var specialBox = document.getElementById('specialBox');
        overlay.style.opacity = .5;
        if(overlay.style.display == "block"){
            overlay.style.display = "none";
            specialBox.style.display = "none";
        } else {
            overlay.style.display = "block";
            specialBox.style.display = "block";
        }

        document.getElementById("addUserID").value = "";
        document.getElementById("addEmailID").value = "";
    }

    function addNewUser()
    {
        overlay.style.display = "none";
        specialBox.style.display = "none";

        if (window.XMLHttpRequest) {

            xmlhttp=new XMLHttpRequest();
        } else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        var newUser = document.getElementById("addUserID").value;
        var newEmail = document.getElementById("addEmailID").value;

        xmlhttp.onreadystatechange=function() {
            if (this.readyState === 4 && this.status === 200) {
                showResult();
            }
        }
        xmlhttp.open("GET","servidor.php?newUser="+newUser + "&newEmail="+ newEmail, true);
        xmlhttp.send();

        document.getElementById("addUserID").value = "";
        document.getElementById("addEmailID").value = "";
    }

</script>
</body>
</html>