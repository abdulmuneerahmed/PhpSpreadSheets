<?php
//form.php
session_start();
if(isset($_SESSION["username"]))
{
 header("location:form.php");
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RealMilk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="jquery/jquery-3.2.1.min.js"></script>
</head>
<body>
        <div class="container">
            <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                             <div class="loginform">
                                     <div class="form"> 
                                            <form autocomplete="off">
                                                <div class="form-group">
                                                         <label for="username">
                                                             username:
                                                         </label>
                                                         <input type="text" id="username" class="form-control username" placeholder="UserId" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                         <label for="password">
                                                             Password:
                                                         </label>
                                                         <input type="password" id="password" class="form-control password" placeholder="password" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                         <button type="button" class="button btn btn-success" name="button" id="login">Login</button>
                                                </div>
                                                <div class="error">

                                                </div>
                                            </form>
                                     </div>
                              </div>
                        </div>
                      <div class="col-sm-4"></div>
            </div>
        </div>
        
</body>
</html>

<script>
        $(document).ready(function(){
                $('.form-control').click(function(){
                        $('.error').empty();
                });
                $("#login").click(function(){
                        let username = $('.username').val();
                        let password = $('.password').val();
                        // console.log(username,password);
                        if(username !=='' && password !==""){
                                $.post(
                                        'validate.php',
                                        {
                                                username:username,
                                                password:password
                                        },
                                        function(data,status){
                                                // console.log(data);
                                                
                                                if(data=='success'){
                                                        $('body').load("form.php");
                                                       
                                                }
                                                else{
                                                         $(".error").html("<span class='text-danger wrong'>Wrong Username and Password</span>");
                                                }
                                        }
                                );
                        }
                        else{
                                 (username === "" && password === "") ? $(".error").html("<span class='text-danger'>Incomplete Username and Password</span>") : (username === "") ? $(".error").html("<span class='text-danger'>Incomplete Username</span>") : $(".error").html("<span class='text-danger'>Incomplete Password</span>");
                        }
                });
        });
</script>