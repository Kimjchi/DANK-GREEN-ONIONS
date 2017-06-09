<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Calculateur de cursus</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="css/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">DGO Corp.</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="etudiants.php">Etudiants</a>
                    </li>
                    <li>
                        <a href="cursus.php">Cursus</a>
                    </li>
                    <li>
                        <a href="contact.html">About</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Calculateur de Cursus</h1>
                        <hr class="small">
                        <span class="subheading">Un projet web par Jérémy Kim et Tam Nguyen.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
 <div class="text-center">
 <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
    <h1>Dank website</h1>
    <h2>Veuillez renseigner les informations de l'étudiant.</h2>
    <p class="lead">
        

<form action="etudiants.php" method="POST">

<?php

//function pour faire un form avec du texte
function formtext($name,$label){
    echo "<div class='row control-group'>";
    echo "<div class='form-group col-xs-12 floating-label-form-group controls'>";
    echo " <label>".$label."</label> <input type=text  class='form-control' placeholder='".$label."' name=".$name.">";
    echo "</div></div>";
}
//function pour faire la liste déroulante
function formselect($liste,$nomselect,$label2){
    echo " <label>".$label2."</label> ";
    echo "<SELECT class='form-control' name=".$nomselect.">";
foreach ($liste as $key) {
    echo "<option name=".$key.">".$key;
}
echo "</select>";
}

formtext('numero','Numéro');
formtext('nom','Nom');
formtext('prenom','Prénom');


echo "<br>";

$admission = array('TC','BR');
formselect($admission,'admission','Admission');

$filiere = array('?','MPL','MSI','MRI','LIB.');
formselect($filiere,'filiere','Filière');






?>
<br>
<input type="submit" class="btn btn-default" value="Valider">

</form>

<br>
Pour remplir le cursus d'un étudiants déjà inscrits, cliquez <a href="cursus.php" style="color: blue">ici.</a>

    </p>
  </div>
</div>
</div><!-- /.container -->        



    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="https://twitter.com/uttroyes?lang=fr">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/UTTroyes/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                       
                    </ul>
                    <p class="copyright text-muted">Projet LO07 - P17</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
