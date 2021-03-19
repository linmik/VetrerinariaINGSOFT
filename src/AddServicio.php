<?php
require('.\database\connection.php');

$sql = "mysql:host=$servername;dbname=$mydb;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
//

//POST
$nombre_servicio = $_POST['nombre_servicio'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];

/* GET File Variables */
$tmpName = $_FILES['attachment']['tmp_name'];
$fileType = $_FILES['attachment']['type'];
$fileName = $_FILES['attachment']['name'];
$target_dir = "upload/servicios/";
$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file($tmpName)) {
    //EXISTE?
    if (file_exists($target_file)) {
        echo '<script language="javascript">';
        echo 'alert(Sorry, file already exists.")';
        echo '</script>';
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")';
        echo '</script>';
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded.")';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {

            echo '<script language="javascript">';
            echo 'alert("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.")';
            echo '</script>';
            //Conexión
            try {
                $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
//                echo "Connected successfully";
            } catch (PDOException $error) {
                echo 'Connection error: ' . $error->getMessage();
            }
            //
            $my_Insert_Statement = $my_Db_Connection->prepare(
                "INSERT INTO servicio VALUES
(null,:nombre_servicio,:codigo, :descripcion,:costo, :imagen,
'0', '0' ,'1')");

            $my_Insert_Statement ->execute(array(
                ':nombre_servicio'=>$nombre_servicio,
                ':codigo'=>$codigo,
                ':descripcion'=>$descripcion,
                ':costo'=>$costo,
                ':imagen'=>$fileName,
            ));

        } else {
            echo '<script language="javascript">';
            echo 'alert("Sorry, there was an error uploading your file.")';
            echo '</script>';
        }
    }

}

?>
<script>
    window.location.replace("Index.php");
</script>
