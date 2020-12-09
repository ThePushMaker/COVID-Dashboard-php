<?php require_once "vistas/login_parte_superior.php"?>

     
      <div class="container-login">
        <div class="wrap-login">
            <form class="login-form validate-form" id="formLogin" action="" method="post">

                <span class="nombre-app"><img src="recursos/img/logo.png" style="width: 25px; margin-bottom:10px;"> COVIDATA CENTER (Cliente)</span>

                <span class="login-form-title">INICIAR SESIÓN</span>

                <div class="wrap-input100" data-validate = "Email incorrecto">
                    <input class="input100" type="text" id="email" name="email" placeholder="Correo electronico">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="submit" class="login-form-btn">CONECTATE</button>
                    </div>
                </div>
                <div style="text-align: center;">
                    <a  class="enlace" href="registro.php" >  <u>Registrate</u> como usuario</a>
                </div>
                <div style="text-align: center;">
                     <a class="enlace" href="login_admin.php"  style=" margin-top: 20px; color:007bff;"> Incia sesión como <u>admin</u></a>
                </div>
            </form>
        </div>
    </div>     
        
    <script type="text/javascript">

$('#formLogin').submit(function(e){
   e.preventDefault();
   var email = $.trim($("#email").val());    
   var password =$.trim($("#password").val());    
    
   if(email.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Por favor ingrese un email y contraseña',
      });
      return false; 
    }else{
        $.ajax({
           url:"bd/login.php",
           type:"POST",
           datatype: "json",
           data: {email:email, password:password}, 
           success:function(data){               
               if(data == "null"){
                   Swal.fire({
                       type:'error',
                       title:'El email o la contraseña son incorrectos',
                   });
               }else{
                   Swal.fire({
                       type:'success',
                       title:'¡Ha iniciado sesión como cliente!',
                       confirmButtonColor:'#3085d6',
                       confirmButtonText:'Ingresar'
                   }).then((result) => {
                       if(result.value){
                           window.location.href = "dashboard/interfaz_user.php";
                       }
                   })
                   
               }
           }    
        });
    }     
});


function AlertIt() {
    Swal.fire({
        type:'warning',
        title:'Email: admin@gmail.com <br> contraseña: admin <br>----------------<br> Email: demo@gmail.com <br> contraseña: demo',
    });
    }

    </script>  
  
    </body>
</html>
