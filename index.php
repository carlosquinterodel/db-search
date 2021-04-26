<?php
//Conexion a db
$host = "localhost";
$dbname = "lunatic";
$username = "root";
$password = "root";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$where="where";
if(isset($_REQUEST['nombres']) && $_REQUEST['nombres'] != ""){
    $where = $where = $where." nombres = '".$_REQUEST['nombres']."'";
}
if(isset($_REQUEST['edad']) && $_REQUEST['edad'] != ""){
    if($where != "where"){
        $where = $where." ".$_REQUEST['operacion']." ";
    }
    $where = $where." edad = '".$_REQUEST['edad']."'";
}
if(isset($_REQUEST['email']) && $_REQUEST['email'] != ""){
    if($where != "where"){
        $where = $where." ".$_REQUEST['operacion']." ";
    }
    $where = $where." email = '".$_REQUEST['email']."'";
}
if(isset($_REQUEST['sexo']) && $_REQUEST['sexo'] != ""){
    if($where != "where"){
        $where = $where." ".$_REQUEST['operacion']." ";
    }
    $where = $where." sexo_id = '".$_REQUEST['sexo']."'";
}
if($where == "where"){
    $where = "";
}
$sql = "select * from persona ".$where;
echo $where;
$q = $cnx->prepare($sql);

$result = $q->execute();
$persons = $q->fetchAll();
//var_dump($persons[0]["nombres"]);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="">
        <div class="col-6">
            <table class="table table-dark table-borderless">
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="nombres" value="<?php echo $_GET['nombres'] ?>"></td>
                </tr>
                <tr>
                    <td>edad</td>
                    <td><input type="text" name="edad" value="<?php echo $_GET['edad'] ?>"></td>
                </tr>
                <tr>
                    <td>Correo electronico</td>
                    <td><input type="text" name="email" value="<?php echo $_GET['email'] ?>"></td>
                </tr>
                <tr>
                    <td>Sexo</td>
                    <td><select name="sexo" id="">
                        <option value="">Ninguno</option>
                        <option value="1">Hombre</option>
                        <option value="2">Mujer</option>
                        <option value="2">Intersexual</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Operacion</td>
                    <td><select name="operacion" id="">
                        <option value="and">Y</option>
                        <option value="or">O</option>
                    </select></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Filtrar"></td>
                </tr>
            </table>
        </div>
    

        <br><br>
        <table class="table table-success table-striped"> 
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Correo electronico</th>
                <th>Sexo</th>
            </tr>
            <?php 
                for ($i=0; $i < count($persons); $i++) { 
            ?>
            <tr>
                <td><?php echo $persons[$i]["nombres"] ?></td>
                <td><?php echo $persons[$i]["edad"] ?></td>
                <td><?php echo $persons[$i]["email"] ?></td>
                <td><?php 
                    if($persons[$i]["sexo_id"]  == '1' ){
                        echo  "Hombre";
                    }elseif($persons[$i]["sexo_id"]  == '2'){
                        echo  "Mujer";
                     }else{
                        echo "Intersexual";
                     } ?></td>
            </tr>
            <?php 
                }
            ?>
        </table>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</html>
