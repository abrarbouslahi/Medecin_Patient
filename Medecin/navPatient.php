<!DOCTYPE html>
<html lang="en">
<head>
<title>PATIENT</title>
<meta charset="utf-8">    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="../img/favicon.ico" type="../image/x-icon" />
<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">
<meta name = "format-detection" content = "telephone=no" />
<!--CSS-->
<link rel="stylesheet" href="../css/bootstrap.css" >
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/animate.css">
<link rel="stylesheet" href="../css/camera.css">
<link rel="stylesheet" href="../css/contact-form.css">
<link rel="stylesheet" href="../fonts/font-awesome.css">
<!--JS-->
<script src="../js/jquery.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/jquery.easing.1.3.js"></script>
<script src="../js/jquery.mobilemenu.js"></script>
<script src="../js/jquery.equalheights.js"></script> 
<script src="../js/camera.js"></script>
<script src="../js/TMForm.js"></script>
<script src="../js/modal.js"></script>  
<script src="../js/bootstrap-filestyle.js"></script> 

<script>
    $(document).ready(function(){
        jQuery('.camera_wrap').camera();
    });
</script>

<script src="../js/wow/wow.js"></script>
<script src="../js/wow/device.min.js"></script>
<script src="../js/jquery.mobile.customized.min.js"></script>
<script>
    $(document).ready(function () {       
      if ($('html').hasClass('desktop')) {
        new WOW().init();
      }   
    });
</script>



</head>
<body>
<!--header-->
<header class="clearfix">
    <div class="container">
        <h1 class="navbar-brand navbar-brand_"><a href="acc_pat_auth.html"><img src="../img/logo.png" alt="logo" style="width:25%; height:25%"></a></h1>
        <a href="../param_med.php" class="header-link" style="position: absolute; top: 30%; right: -20%;">
            <img src="../img/account.png" alt="Description de l'image" class="image-header" style="width: 16%; height: 16%;">
        </a>
        <div class="box1 clearfix">
            
        </div>
    </div>
    <nav class="navbar navbar-default navbar-static-top tm_navbar clearfix" role="navigation">
        <div class="container">
            <ul class="nav sf-menu clearfix">
          
            <li class="active"><a href="AfficherMedecin.php">Accueil Patient</a></li>
                <li class="index-2.htm"><a href="AfficherMedecin.php">RÉSERVER UN RDV</a>
                <li class="index-3.htm"><a href="mesReservation.php">MES RÉSERVATIONS</a>
                <li class="index-4.htm"><a href="/PROJET/send_message.php">ACCÈS RDV VISIO</a>
                <li class="index-5.htm"><a href="/PROJET/info_mala_med.php">INFORMATIONS MALADIES</a>
                
                    
                </li>
                
                </ul>
                
                <ul class="follow_icon">
                    <li><a href="" class=""></a></li>
                    <li><a href="" class=""></a></li>
                    <li><a href="" class=""></a></li>
                    <li><a href="" class=""></a></li>
                    <li><a href="" class=""></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="slider">  
        <div class="camera_wrap">
            <div data-src="../img/picture1.jpg"><div class="camera-caption fadeIn"><p class="title"><br>Réserver directement un rdv en ligne !</p></div></div>
            <div data-src="../img/picture2.jpg"><div class="camera-caption fadeIn"><p class="title"><br>Plateforme 100 % conçue pour faciliter la prise de rdv !</p></div></div>
            <div data-src="../img/picture3.jpg"><div class="camera-caption fadeIn"><p class="title"><br>Vous pouvez annuler votre rdv jusqu'à 24h avant !</p></div></div>
        </div>
    </div>
       