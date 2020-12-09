<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../login_admin.php");
}

?>

<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Reportes de los usuarios</h1>
    
    
    
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM reportes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="container">  
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaRegistrosAdmin" class="fontSize-tabla table table-striped table-bordered table-condensed" style="width:100%;">
                        <thead class="text-center">
                            <tr>
                                <th>#Num</th>
                                <th>Nombre usuario</th>
                                <th>Municipio</th>                                
                                <th>Ciudad</th>  
                                <th>Direccion</th>
                                <th>Fecha de reporte</th>
                                <th>Descripción</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['usuario'] ?></td>
                                <td><?php echo $dat['municipio'] ?></td>
                                <td><?php echo $dat['ciudad'] ?></td>
                                <td><?php echo $dat['direccion'] ?></td>
                                <td><?php echo $dat['fechaReporte'] ?></td>
                                <td><?php echo $dat['descripcion'] ?></td>
                                <?php
                                    if ($dat['estatus'] == 'En proceso') {
                                        echo "<td id='estatus4' class='verde'>".$dat['estatus']."</td>";
                                    }
                                    elseif($dat['estatus'] == 'Confirmado'){
                                        echo "<td id='estatus4' class='azul'>".$dat['estatus']."</td>";
                                    }
                                    elseif($dat['estatus'] == 'Rechazado'){
                                        echo "<td id='estatus4' class='rojo'>".$dat['estatus']."</td>";
                                    }
                                    else{
                                        echo "<td id='estatus4'>".$dat['estatus']."</td>";
                                    }
                                ?>                   
                                <td></td>
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
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUDx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas3">    
            <div class="modal-body">

                <div class="form-group">
                <label for="estatus" class="col-form-label">Estatus:</label>

                    <select name="Estatus" class="form-control" id="estatus1">
                        <option value="En proceso">En proceso</option> 
                        <option value="Rechazado">Rechazado</option> 
                        <option value="Confirmado">Confirmado</option>
                    </select>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn-guardar btn btn-dark" >Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<!--Modal para VER MÁS-->
<div class="modal fade" id="modalCRUDVerMas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formVerMasAdmin1">    
            <div class="modal-body">

                <label for="usuario" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" readonly>
    

                <label for="descripcion" class="col-form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion"readonly>

                <label for="municipio" class="col-form-label">Municipio:</label>
                <input type="text" class="form-control" id="municipio" readonly> 

                <label for="ciudad" class="col-form-label">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad" readonly>
 
                <label for="direccion" class="col-form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion" readonly> 

    
                <label for="fechaReporte" class="col-form-label">Fecha Reporte:</label>
                <input type="text" class="form-control" id="fechaReporte" readonly>
    

                <label for="estatus1" class="col-form-label">Estatus:</label>
                <input type="text" class="form-control" id="estatus" readonly>
      

            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>
<!--FIN del cont principal-->

<script type="text/javascript">

$(document).ready(function(){
    tablaRegistrosAdmin = $("#tablaRegistrosAdmin").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='fontSize-tabla btn btn-primary btnVerMas'>Ver reporte</button><button class='fontSize-tabla btn btn-primary btnEditar'>Modificar estatus</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
 
    
var fila; //capturar la fila para editar o borrar el registro

//botón Ver mas    
$(document).on("click", ".btnVerMas", function(){

    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    usuario = fila.find('td:eq(1)').text();
    descripcion=fila.find('td:eq(6)').text();
    municipio = fila.find('td:eq(2)').text();
    ciudad = fila.find('td:eq(3)').text();
    direccion = fila.find('td:eq(4)').text();
    fechaReporte = fila.find('td:eq(5)').text();
    estatus = fila.find('td:eq(7)').text();
    
    $("#usuario").val(usuario);
    $("#descripcion").val(descripcion);
    $("#municipio").val(municipio);
    $("#ciudad").val(ciudad);
    $("#direccion").val(direccion);
    $("#fechaReporte").val(fechaReporte);
    $("#estatus").val(estatus);
    
    $(".modal-header").css("background-color", "#00825a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Detalle de reporte");            
    $("#modalCRUDVerMas").modal("show");  
    
});

//botón EDITAR    
$(document).on("click", ".btnEditar", function(){

    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    usuario = fila.find('td:eq(1)').text();
    descripcion=fila.find('td:eq(6)').text();
    municipio = fila.find('td:eq(2)').text();
    ciudad = fila.find('td:eq(3)').text();
    direccion = fila.find('td:eq(4)').text();
    fechaReporte = fila.find('td:eq(5)').text();
    estatus=fila.find('td:eq(7)').text();
    
    $("#usuario").val(usuario);
    $("#descripcion").val(descripcion);
    $("#municipio").val(municipio);
    $("#ciudad").val(ciudad);
    $("#direccion").val(direccion);
    $("#fechaReporte").val(fechaReporte);
    $("#estatus1").val(estatus);
    
    opcion = 4; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Modificar Estatus");            
    $("#modalCRUDx").modal("show");   
});

    
$("#formPersonas3").submit(function(e){
    e.preventDefault();    

    estatus = document.getElementById("estatus1").options[document.getElementById("estatus1").selectedIndex].text;
    //console.log(estatus)
    //console.log(opcion)

    $.ajax({
        url: "../bd/crud2.php",
        type: "POST",
        dataType: "json",
        data: { estatus:estatus, id:id, opcion:opcion},
        success: function(data){  
            //console.log(data);
            estatus = data[0].estatus;
            id = data[0].id;   
            if(opcion == 4){tablaRegistrosAdmin.row(fila).data([id,usuario,municipio,ciudad,direccion, fechaReporte, descripcion, estatus]).draw();}            
        }        
    });  
    $("#modalCRUDx").modal("hide");  
});    
    
});

</script>

<?php require_once "vistas/parte_inferior.php"?>