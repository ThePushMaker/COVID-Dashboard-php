<?php require_once "vistas/login_parte_superior.php"?>
     
      <div class="container-login fondoAdmin" style="
        background: -webkit-linear-gradient(to right,  #7183b875, #2b302e75), url(recursos/img/covidfondo1.jpg);
        background: linear-gradient(to right, #7183b875, #2b302e75), url(recursos/img/covidfondo1.jpg);
        background-size: cover;
        background-attachment: fixed;">
        <div class="wrap-login">
            <form class="login-form validate-form" id="formLogin" action="" method="post">

                <span class="nombre-app"><img src="recursos/img/logo.png" style="width: 25px; margin-bottom:10px;"> COVIDATA CENTER (Admin)</span>

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
                        <button type="submit" name="submit" class="login-form-btn">ADMINISTRA</button>
                    </div>
                </div>
                <div style="text-align: center;">
                    <a class="enlace" href="index.php"  style=" margin-top: 20px;"> Incia sesión como <u>usuario</u></a>
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
                url:"bd/login_admin_bd.php",
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
                            title:'¡Ha iniciado sesión como administrador!',
                            confirmButtonColor:'#3085d6',
                            confirmButtonText:'Ingresar'
                        }).then((result) => {
                            if(result.value){
                                window.location.href = "dashboard/interfaz_admin.php";
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