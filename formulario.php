<?php 
session_start();
include_once('frontend/login.php');
if (isset($_POST['add'])){
    $database = new ConectarDB();
    $db = $database->open();
    try{
        $stmt = $db->prepare("INSERT INTO comentario (Nombre, Opinion) VALUES
        (:Nombre, :Opinion)"); 
        $_SESSION['message']=($stmt->execute(array(':Nombre'=>$_POST['Nombre'],':Opinion'
        =>$_POST['Opinion']))) ? '
        Contacto agregado correctamente' : 'Algo salio mal, No se pudo agregar el contacto';

    }catch (PDOException $e){
        $_SESSION['message']= $e->getMessage();
    }
    $database->close();
}else{
    $_SESSION['message']= 'Rellene el Formulario';

}
header('location: principal-vista.php');

?>