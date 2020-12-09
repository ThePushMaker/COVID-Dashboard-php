<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}

?>

<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Reportes de Covid-19 en México</h1>
    
    
    
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
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Crear reporte</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="fontSize-tabla table table-striped table-bordered table-condensed" style="width:100%;">
                        <thead class="text-center">
                            <tr>
                                <th>#Num</th>
                                <th>Municipio</th>
                                <th>Ciudad</th>                                
                                <th>Dirección</th>  
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
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">

                <label for="descripcion" class="col-form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion">
                </div>

                <div class="form-group">
                <label for="municipio" class="col-form-label">Municipio:</label>
                <input type="text" class="form-control" id="municipio">
                </div>  

                <div class="form-group">
                <label for="ciudad" class="col-form-label">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad">
                </div>   
 
                <div class="form-group">
                <label for="direccion" class="col-form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion">
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

                <label for="descripcion" class="col-form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion1"readonly>

                <label for="municipio" class="col-form-label">Municipio:</label>
                <input type="text" class="form-control" id="municipio1" readonly> 

                <label for="ciudad" class="col-form-label">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad1" readonly>
 
                <label for="direccion" class="col-form-label">Dirección:</label>
                <input type="text" class="form-control" id="direccion1" readonly> 

    
                <label for="fechaReporte" class="col-form-label">Fecha Reporte:</label>
                <input type="text" class="form-control" id="fechaReporte1" readonly>
    

                <label for="estatus1" class="col-form-label">Estatus:</label>
                <input type="text" class="form-control" id="estatus1" readonly>
      

            </div>
        </form>    
        </div>
    </div>
</div>  


<!--Modificar perfil-->
<div class="modal fade" id="modalCRUDPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPerfil">    
            <div class="modal-body">

                <label for="descripcion" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="email">

                <label for="municipio" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" > 

                <label for="ciudad" class="col-form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido" >
      

            </div>
        </form>    
        </div>
    </div>
</div>  




<script type="text/javascript">

    $(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='fontSize-tabla btn btn-primary btnVerMas'>Ver</button><button class='fontSize-tabla btn btn-primary btnEditar'>Modificar</button><button class='fontSize-tabla btn btn-danger btnBorrar'>Ocultar</button></div></div>"  
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
    
$("#btnNuevo").click(function(){
    
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Crear Reporte");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro

//botón Ver mas    
$(document).on("click", ".btnVerMas", function(){

    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    usuario = fila.find('td:eq(1)').text();
    descripcion=fila.find('td:eq(5)').text();
    municipio = fila.find('td:eq(1)').text();
    ciudad = fila.find('td:eq(2)').text();
    direccion = fila.find('td:eq(3)').text();
    fechaReporte = fila.find('td:eq(4)').text();
    estatus = fila.find('td:eq(6)').text();
    
    $("#usuario1").val(usuario);
    $("#descripcion1").val(descripcion);
    $("#municipio1").val(municipio);
    $("#ciudad1").val(ciudad);
    $("#direccion1").val(direccion);
    $("#fechaReporte1").val(fechaReporte);
    $("#estatus1").val(estatus);
    
    $(".modal-header").css("background-color", "#00825a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Detalle de reporte");            
    $("#modalCRUDVerMas").modal("show");  
    
});

//botón EDITAR    
$(document).on("click", ".btnEditar", function(){

    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    municipio = fila.find('td:eq(1)').text();
    ciudad = fila.find('td:eq(2)').text();
    direccion = fila.find('td:eq(3)').text();
    descripcion=fila.find('td:eq(5)').text();
    
    $("#municipio").val(municipio);
    $("#ciudad").val(ciudad);
    $("#direccion").val(direccion);
    $("#descripcion").val(descripcion);
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Modificar Reporte");            
    $("#modalCRUD").modal("show");  
    
});

 

//botón Perfil    
$(document).on("click", "#modificarPerfil", function(){

fila = $(this).closest("tr");
id = parseInt(fila.find('td:eq(0)').text());
nombre = fila.find('td:eq(1)').text();
ciudad = fila.find('td:eq(2)').text();
direccion = fila.find('td:eq(3)').text();
descripcion=fila.find('td:eq(5)').text();

$("#nombre").val(nombre);
$("#ciudad").val(ciudad);
$("#direccion").val(direccion);
$("#descripcion").val(descripcion);

opcion = 2; //editar

$(".modal-header").css("background-color", "#4e73df");
$(".modal-header").css("color", "white");
$(".modal-title").text("Modificar Perfil");            
$("#modalCRUDPerfil").modal("show");  

});


//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    tablaPersonas.row(fila.parents('tr')).remove().draw();
    /*
    opcion = 3 //borrar
        $.ajax({
            url: "../bd/crud2.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
        */
      
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    descripcion = $.trim($("#descripcion").val());
    municipio = $.trim($("#municipio").val());
    ciudad = $.trim($("#ciudad").val());
    direccion = $.trim($("#direccion").val());    
    fechaReporte = $.trim($("#fechaReporte").val()); 
    estatus="En proceso";
    usuario="Juan Perez";

    $.ajax({
        url: "../bd/crud2.php",
        type: "POST",
        dataType: "json",
        data: {usuario:usuario, descripcion:descripcion, municipio:municipio, ciudad:ciudad, direccion:direccion, fechaReporte:fechaReporte, id:id, estatus:estatus, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;         
            municipio = data[0].municipio;
            ciudad = data[0].ciudad;
            direccion = data[0].direccion;
            fechaReporte = data[0].fechaReporte;
            descripcion = data[0].descripcion;
            usuario=data[0].usuario;
            console.log(usuario);
            estatus = data[0].estatus;
            document.querySelector('#estatus4').style.color = "#008000";    
            if(opcion == 1){tablaPersonas.row.add([id,municipio,ciudad,direccion, fechaReporte, descripcion, estatus]).draw();}
            else{tablaPersonas.row(fila).data([id,municipio,ciudad,direccion, fechaReporte, descripcion, estatus]).draw();}
        }   
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});
</script>

</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>