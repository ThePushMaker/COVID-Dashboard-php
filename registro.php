<?php require_once "vistas/login_parte_superior.php"?>
     
      <div class="container-login">
        <div class="wrap-login">
            <form class="login-form validate-form" id="formRegistro" action="" method="post">

                <span class="nombre-app"><img src="recursos/img/logo.png" style="width: 25px; margin-bottom:10px;"> COVIDATA CENTER (Cliente)</span>

                <span class="login-form-title">REGISTRARSE</span>

                <div class="wrap-input100" data-validate = "Nombre incorrecto">
                    <input class="input100" type="text" id="nombre" name="nombre" placeholder="Nombre">
                    <span class="focus-efecto"></span>
                </div>

                <div class="wrap-input100" data-validate = "Apellido incorrecto">
                    <input class="input100" type="text" id="apellido" name="apellido" placeholder="Apellido">
                    <span class="focus-efecto"></span>
                </div>

                <div class="wrap-input100" data-validate = "Email incorrecto">
                    <input class="input100" type="text" id="email" name="email" placeholder="Correo electrónico">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="submit" class="login-form-btn">CREA TU CUENTA</button>
                    </div>
                </div>
                <div style="text-align: center;">
                    <a class="enlace" href="index.php"  style=" margin-top: 20px;"> Incia sesión como <u>cliente</u></a>
                </div>
            </form>
        </div>
    </div>     
        
        
    <script type="text/javascript">
    
$('#formRegistro').submit(function(e){
    e.preventDefault();
    var nombre = $.trim($("#nombre").val());    
    var apellido =$.trim($("#apellido").val());  
    var email = $.trim($("#email").val());    
    var password =$.trim($("#password").val());  

    if(nombre.length == "" || apellido.length == "" || email.length == "" || password == ""){
        Swal.fire({
            type:'warning',
            title:'Por favor llene todos los campos',
        });
        return false; 
      }else{
            $.ajax({
                url: "bd/registrar.php",
                type: "POST",
                dataType: "json",
                data: {nombre:nombre, apellido:apellido, email:email, password:password},
                success: function(data){  
                    console.log(data);          
                    nombre = data[0].nombre;
                    apellido = data[0].apellido;
                    email = data[0].email;
                    password= data[0].password;     
                }        
            });  

          $.ajax({
             url:"bd/login.php",
             type:"POST",
             datatype: "json",
             data: {nombre:nombre, apellido:apellido, email:email, password:password}, 
             success:function(data){               
                 if(data == "null"){
                     Swal.fire({
                         type:'error',
                         title:'El email o la contraseña son incorrectos',
                     });
                 }else{
                     Swal.fire({
                         type:'success',
                         title:'¡Usuario registrado!',
                         confirmButtonColor:'#3085d6',
                         confirmButtonText:'Ingresar'
                     }).then((result) => {
                         if(result.value){
                             window.location.href = "index.php";
                         }
                     })
                     
                 }
             }    
          });
      }     
 });

    </script>  
    
  
    </body>
</html>