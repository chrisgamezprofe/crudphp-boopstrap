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
                            Lista de estudiantes
                            <a href="crear-estudiantes.php" class="btn btn-success float-end">Agregar nuevo</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>EDAD</th>
                                    <th>PAIS</th>
                                    <th>ACCIONES</th>
                                </tr>
                                <?php
                                        $res = $conexion->query("SELECT E.*,P.nombre as pais FROM `estudiantes` E INNER JOIN paises P ON P.id=E.id_pais");

                                        while($fila = $res->fetch_object()){
                                            ?>
                                        <tr>
                                            <td><?php echo $fila->id;  ?></td>
                                            <td><?php echo $fila->nombre;  ?></td>
                                            <td><?php echo $fila->apellido;  ?></td>
                                            <td><?php echo $fila->edad;  ?></td>
                                            <td><?php echo $fila->pais;  ?></td>
                                            <td>
                                                <a href="editar-estudiante.php?id=<?php echo md5($fila->id);  ?>" class="btn btn-primary">
                                                    Editar
                                                </a>
                                                <a href="detalle-estudiante.php?id=<?php echo md5($fila->id);  ?>" class="btn btn-success">
                                                    Ver
                                                </a>

                                                <form action="guardar.php" method="POST" class="d-inline">
                                                    
                                                <button class="btn btn-danger" type="submit" name="btnEliminar" value="<?php echo md5($fila->id);  ?>">
                                                    Eliminar
                                                </button>
                                                </form>

                                            </td>
                                        </tr>
                                        <?php   
                                        } 
                                    ?>
                                

                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>