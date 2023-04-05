<?php

require 'flight/Flight.php';

//Lee los Datos y los muestras a cualquier interfaz que solicite dichos datos
Flight::register('db','PDO',array('mysql:host=localhost:3307;dbname=api','root','root'));
Flight::route('GET /alumnos', function () {
$sentencia = Flight::db()->prepare("SELECT * FROM `alumnos`");
$sentencia->execute();
$datos = $sentencia->fetchALL();
Flight ::json($datos);
});

//Recepciona los datos por metodo post y hace una insercion

Flight::route('POST /alumnos', function (){
$nombres = (Flight::request()->data->nombres);
$apellidos = (Flight::request()->data->apellidos);

$sql="INSERT INTO alumnos (nombres,apellidos) VALUES(?,?)";
$sentencia = Flight::db()->prepare($sql);
$sentencia->bindParam(1,$nombres);
$sentencia->bindParam(2,$apellidos);
$sentencia->execute();

Flight::jsonp(["Alumnos agregado!"]);

print_r($nombres);

});

//Flight::route('DELETE /alumnos', function (){

//});

//BORRAR REGISTRO

Flight::route('DELETE /alumnos', function (){

   $id = (Flight::request()->data->id);
   $sql ="DELETE FROM alumnos WHERE id=?";
   $sentencia = Flight::db()->prepare($sql);
   $sentencia->bindParam(1,$id);
   $sentencia->execute();
   
   Flight::jsonp(["Alumno Borrado"]);
   
   //print_r($id);

});

//Actualizar Datos
Flight::route('PUT /alumnos', function (){
   
   
    $id = (Flight::request()->data->id);
   $nombres = (Flight::request()->data->nombres);
   $apellidos = (Flight::request()->data->apellidos);
   print_r($id);
   print_r($nombres);
   print_r($apellidos);
   
   $sql ="UPDATE alumnos SET nombres=? ,apellidos=? WHERE id=?";
   
   $sentencia = Flight::db()->prepare($sql);
   
   $sentencia->bindParam(1,$nombres);
   $sentencia->bindParam(2,$apellidos);
   $sentencia->bindParam(3,$id);
   $sentencia->execute();
flight::jsonp(["Alumno Modificado"]);
});

Flight::route('GET /alumnos/@id', function($id){

    $sentencia = Flight::db()->prepare("SELECT * FROM `alumnos` WHERE id=?");
    $sentencia->bindParam(1,$id);
    $sentencia->execute();
    $datos = $sentencia->fetchALL();
    Flight ::json($datos);

    //print_r($id);

});

Flight::start();
