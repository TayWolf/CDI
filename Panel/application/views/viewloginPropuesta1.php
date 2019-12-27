<!DOCTYPE html>
<!-- saved from url=(0048)http://uxliner.com/niche/main/pages-login-2.html -->
<html lang="en" style="height: auto; min-height: 100%;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="shortcut icon" href="http://localhost/CDI/Panel/content/images/icon/cdi.png">
<title>Iniciar sesión CDI</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="content/css/stylePropuesta/bootstrap.min.css">

<!-- Google Font -->
<link href="./Niche Admin - Powerful Bootstrap 4 Dashboard and Admin Template_files/css" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="content/css/stylePropuesta/style.css">
<link rel="stylesheet" href="content/css/stylePropuesta/font-awesome.min.css">
<link rel="stylesheet" href="content/css/stylePropuesta/et-line-font.css">
<link rel="stylesheet" href="content/css/stylePropuesta/themify-icons.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="login-page sty1" style="height: auto; min-height: 100%;">
  <div class="row">
    <div class="col-md-8">
      <img id="fdologin2" src="http://localhost/CDI/Panel/content/images/fondologin2.jpg">
    </div>
    <div class="login-box sty1 col-md-4 align-content-center">
      <div class="login-box-body sty1">
        <p class="login-box-msg nigga h4"  style="color: #293a4a;">INICIA SESIÓN</p>
        <form id="sign_in" method="POST" action="http://localhost/CDI/Panel/">
          <div class="form-group has-feedback">
            <input type="text" class="form-control sty1" id="correo"  name="correo" placeholder="Usuario"  onclick="javascript: limpia(this);" onBlur="javascript: verifica(this);">
          </div>
          <br><br>
          <div class="form-group has-feedback">
            <input type="password" class="form-control sty1" name="password" id="password" placeholder="Contraseña"  onclick="javascript: limpia(this);" onBlur="javascript: verifica(this);">
          </div>
          <br>
          <!-- <div class="col-12 col-md-8">
            <div class="checkbox icheck" hidden>
              <label>
              <input type="checkbox">
              Remember Me </label>
            </div>
            <br><br>
            /.col
            /.col 
          </div> -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-flat" style="background: #293a4a; color: white;">Entrar</button>
          </div>
        </form>
      <!-- /.social-auth-links -->
      <!-- <div class="m-t-2">Don't have an account? <a href="http://uxliner.com/niche/main/pages-register2.html" class="text-center">Sign Up</a></div> -->
      </div>
    <!-- /.login-box-body --> 
    </div>
  </div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="content/plugins/bootstrap/js/jsPropuesta/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="content/plugins/bootstrap/js/jsPropuesta/bootstrap.min.js"></script>

<!-- template --> 
<script src="content/plugins/bootstrap/js/jsPropuesta/niche.js"></script>

<script>
  function limpia(element)
  {
    element.value = "";
  }

  function verifica(element)
  {
    if(element.value == "")
    element.value = "";
  }
</script>

</body></html>