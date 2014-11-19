<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
<link href="<?=$base_url?>public/admin/style.css" rel="stylesheet" type="text/css" />


<?php
 
##captcha##
function randomnya($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function captcha($banyak = 10){
$rand = randomnya($banyak);
$captcha="<script type='text/javascript' src='=base_url.public/admin/jquery-1.10.2.min.js'></script>
<script>
$(document).ready(function(){
        $('#submit').attr('disabled', true);
        $( '#captcha' ).keyup(function() {
            var captcha = $('#captcha').val();
            var c1 = '".$rand."';
                if(captcha !== c1){               
                    $('#test_captcha').html('Plase Wait.....');
                    }else{
                    $('#test_captcha').html('Success');
                        var styles = {
                          backgroundColor : '#ddd',
                          fontWeight: '',
						  background: '#71bb3b',
						  color: '#fff',
                        };
 
                    $('#captcha').css(styles);
                    $('#captcha').attr('readonly', 'readonly');
                    $('#submit').removeAttr('disabled');
                    $('#submit').addClass('button');
                    }
        });
        $('.reload').click(function(){
            $('#captcha').val('');
        }); 
});
</script>
<style>
#isi_c1{color:#800080;font-size: 24px;font-family: comic sans ms,cursive;background-color:#e6e6fa;width:150px;}
#submit{width:150px;}
#captcha{width:150px;}

</style>
    <div id='semua'>
    <div id='isi_c1'>$rand<span > </span></div>
    <input type='text' name='captcha'  class='pendek' id='captcha' required><span class='' id='test_captcha'></span>
    <br>
    <br>
    <input type='submit' name='submit' value='Submit' id='submit' class='button'   >
    </div>";
return $captcha;
}
 
?>
<html>
<head>
<title>Register Page </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Copyright" content="infobatak.com">
<meta name="description" content="Page register infobatak.com">
<meta name="keywords" content="Register Page">
<meta name="author" content="Limbe Gultom">
<meta name="language" content="Bahasa Indonesia">
 
 

 
 
<script type="text/javascript" src="<?=$base_url?>public/admin/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
 
 
function IsEmail(email) {
                  var regex = /^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
                  return regex.test(email);
                }
 
 
 
 
        $( "#username" ).keyup(function() {
            var username = $('#username').val();
         
 
            //alert(username);
                //$(".username").html(username);
                 
                    if(/^[a-zA-Z0-9- ]*$/.test(username) == false) {
                        $("#username").val("");
                        //alert('Karakter hanya bisa a-z atau 0-9.');
                        $(".username").html('<font color=red>Karakter hanya bisa a-z atau 0-9.</font><br><br>');
                    }
 
 
        });
 
        $( "#nama" ).keyup(function() {
            var nama = $('#nama').val();
                 
                    if(/^[a-zA-Z- ]*$/.test(nama) == false) {
                        $("#nama").val("");
                        //alert('Karakter hanya bisa a-z atau 0-9.');
                        $(".nama").html('<font color=red>Karakter hanya bisa a-z , A-Z .</font><br><br>');
                    }
 
 
        });
              
            $('#password_again').on('blur' , function() {
                var password = $('#password').val();
                var password_again = $('#password_again').val();
                 
                if(password !== password_again){                
                        $("#password_again").val("");
                        $(".password_again").html('<font color=red>Password Tidak sama...</font><br><br>');
                    }else{
                        $(".password_again").html('<img src="<?=$base_url?>public/admin/true.png height=18px><br><br>');
                    }
                 
                 
            });
         
         
});
 
 
</script>
 
</head>
 
<body>
<div id="header">
    <div class="inHeaderLogin"></div>
</div>
 
<div id="regForm">
    <div class="headLoginForm">
    <img src="<?=$base_url?>public/logo.png" height="25" /> </div>
     
    <div class="fieldReg">
   
<form action="<?=$base_url?>login/login_akses" method="POST" id="form_login">
     
    <label>Username </label><br>
    <input type="text" name="username" required class="login" id="username"><br>
    <div class="username"></div>
     
    <label>Password</label><br>
    <input type="password" name="password" required class="login" id="password"><br>
     
    <label>Password Again</label><br>
    <input type="password" name="password_again" required class="login" id="password_again"><br>
    <div class="password_again"></div>
     
     
   
    <label>Captcha</label><br>
    <?php echo captcha(5);?>
     
     
    </form>
    </div>
</div>
</body>
</html>

