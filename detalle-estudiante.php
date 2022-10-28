<?php
session_start();
require 'conexion.php';
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP MYSQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">

    <?php
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conexion,$_GET['id']);
        $sql = "SELECT E.*,P.nombre as pais FROM `estudiantes` E INNER JOIN paises P ON P.id=E.id_pais WHERE md5(E.id)='$id'";
        $res = $conexion->query($sql);
        if($res->num_rows>0){
            $datos = $res->fetch_object();
        }else{
            $_SESSION['mensaje']="No existe el estudiante";
            $_SESSION['error']=true;
            header("location:index.php");
            exit;
        }
    }




    if(isset($_SESSION['mensaje'])){
        if(!$_SESSION['error']){
            ?>
            <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['mensaje'];?>
            </div>
        <?php   
        }else{
            ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['mensaje'];?>
            </div>
        <?php   
        }
        unset($_SESSION['mensaje']);
        unset($_SESSION['error']);
    }

    ?>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Editar estudiante
                            <a href="index.php" class="btn btn-danger float-end">Regresar</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="guardar.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <div class="mb-3">
                                <label for=""><b>Nombre:</b></label>
                                <?php echo $datos->nombre;?>
                            </div>

                            <div class="mb-3">
                                <label for=""><b>Apellido:</b></label>
                               <?php echo $datos->apellido;?>
                            </div>

                            <div class="mb-3">
                                <label for=""><b>Edad:</b></label>
                                <?php echo $datos->edad;?> años
                            </div>

                            <div class="mb-3">
                                <label for=""><b>Pais:</b></label>
                                        <?php echo $datos->pais;  ?>
                                       
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>