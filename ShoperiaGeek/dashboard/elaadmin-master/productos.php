<?php

$host="localhost";
$user="root";
$pass="";
$db="shoperiageek";
include_once "conexion.php";
$con=mysqli_connect($host,$user,$pass,$db);

if(isset($_REQUEST['idBorrar'])){
    $id=mysqli_real_escape_string($con,$_REQUEST['idBorrar']??'');
    $query="DELETE from producto where idProducto='".$id."';";
    $res=mysqli_query($con,$query);
    if($res){
        ?>
        <div class="alert alert-warning float-right" role="alert">
            <strong>Producto borrado exitosamente</strong>
        </div>

        <?php
    }else{
        ?>
        <div class="alert alert-danger float-right" role="alert">
            <strong>Error al borrar <?php echo mysqli_error($con);?></strong>
        </div>
        <?php
    }
}

?>


<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Productos</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>

                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Descripcion</th>
                                <th>Franquisia</th>
                                <th>Categoria</th>

                                <?php
                                $id1=mysqli_real_escape_string($con, $_REQUEST['id']??'');
                                $query1="SELECT idEmpleado,acceso from empleado where idEmpleado='". $_SESSION['idEmpleado']."'; ";
                                $res1=mysqli_query($con,$query1);
                                $row1=mysqli_fetch_assoc($res1);

                                if($row1['acceso'] =='Administrador'){
                                    ?>
                                    <th>Acciones
                                        <a href="dashboard.php?modulo=crearProducto"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </th>
                                    <?php
                                }
                                ?>





                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $query="SELECT idProducto,nombreProducto,precio,descripcion,franquicia,categoria from producto;  ";
                            $res=mysqli_query($con,$query);


                            while($row=mysqli_fetch_assoc($res)){

                                ?>

                                <tr>
                                    <th> <?php echo $row['nombreProducto']  ?> </th>
                                    <th> <?php echo $row['precio']  ?> </th>
                                    <th> <?php echo $row['descripcion']  ?> </th>
                                    <th> <?php echo $row['franquicia']  ?> </th>
                                    <th> <?php echo $row['categoria']  ?> </th>

                                    <?php
                                    $id1=mysqli_real_escape_string($con, $_REQUEST['id']??'');
                                    $query1="SELECT idEmpleado,acceso from empleado where idEmpleado='". $_SESSION['idEmpleado']."'; ";
                                    $res1=mysqli_query($con,$query1);
                                    $row1=mysqli_fetch_assoc($res1);

                                    if($row1['acceso'] =='Administrador'){
                                        ?>
                                        <th>
                                            <a href="dashboard.php?modulo=editarProducto&id=<?php echo $row['idProducto'] ?>" style="margin-right: 10%"><i class="fa fa-edit"></i></a>
                                            <a href="dashboard.php?modulo=productos&idBorrar=<?php echo $row['idProducto'] ?>" class="text-danger borrar"><i class="fa fa-trash"></i></a>
                                        </th>
                                        <?php
                                    }
                                    ?>




                                </tr>

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

