<?php
if (!isset($_POST['submit'])) {
    echo "<p>Debes llenar el formulario</p>";
    exit;
}
if (isset($_POST['submit'])) {
    $nombre = $_POST['fname'];
    $apellidos = $_POST['lname'];
    $email = $_POST['email'];
    $identificacion = $_POST['nid'];
    $profesion = $_POST['profesion'];
    $empresa = $_POST['empresa'];
    $pais = $_POST['pais'];
    $check = $_POST['check'];
    if ($check == false){
        echo "<script>alert('Debe aceptar la utilización de datos')</script>";
        echo "<script>setTimeout(\"location.href='congreso.html'\",800)</script>";
        exit;
    }
    if (empty($nombre) || empty($email) || empty($apellidos) || empty($identificacion) || empty($profesion) || empty($empresa) || empty($pais)) {
        echo "<script>alert('Todos los campos son obligatorios')</script>";
        echo "<script>setTimeout(\"location.href='congreso.html'\",900)</script>";
        exit;
    }
    function IsInjected($str)
    {
        $injections = array(
            '(\n+)',
            '(\r+)',
            '(\t+)',
            '(%0A+)',
            '(%0D+)',
            '(%08+)',
            '(%09+)'
        );
        $inject = join('|', $injections);
        $inject = "/$inject/i";
        if (preg_match($inject, $str)) {
            return true;
        } else {
            return false;
        }
    }
    if (IsInjected($email)) {
        echo "<script>alert('Email invalido')</script>";
        echo "<script>setTimeout(\"location.href='congreso.html'\",900)</script>";
        exit;
    }
    if (!is_numeric($identificacion)) {
        echo "<script>alert('Numero de identificación invalido')</script>";
        echo "<script>setTimeout(\"location.href='congreso.html'\",900)</script>";
        exit;
    }

    $contenido = "$nombre,$email,$apellidos,$email,$identificacion,$profesion,$empresa,$pais\n";
    $archivo = fopen("recibidos/inscripciones.txt","a");
    fwrite($archivo,$contenido);
    echo "<script>alert('Inscripción realizada exitosamente')</script>";
    echo "<script>setTimeout(\"location.href='index.html'\",1000)</script>";
}
