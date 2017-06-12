<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Calculateur de Cursus - Cursus</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                        <a href="about.html">About</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/cursus-min.png')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>N'attendez plus.</h1>
                        <h2 class="subheading">La révolution commence.</h2>
                        <span class="meta">Grâce à cet outil, vous pourrez calculez différents cursus et savoir si vous êtes diplômable.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

  
 <!-- Main Content -->
    <div class="container" >
        <div class="text-center">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
<form action="cursus.php" method="POST">

<?php

echo "<h3>Remplissage du cursus :</h3></br> " ;

//function pour faire un form avec du texte
function formtext($label,$name,$value){
    echo " <label>".$label."</label> <input type=text name='".$name."' value='".$value."'>";
}
//function pour faire la liste déroulante
function formselect($liste){
    echo " <label>Etudiant</label> ";
    echo "<SELECT name='numero'>";
foreach ($liste as $key => $value) {
    echo "<option value=".$key.">".$value;
}
echo "</select>";
}





formtext("<h4>Label du cursus</h4>","label","");

$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$etu = array();
$reponse = $BDD->query('SELECT * FROM `etudiant`');
while ($etudiant = $reponse->fetch())
{
  $etu[$etudiant['numero']] = $etudiant['numero'].' - '.$etudiant['nom'].' '.$etudiant['prenom'];
}

$reponse->closeCursor();

?>
</br>
<hr>
<br>
<h3>Qui est l'étudiant suivant ce cursus?</h3>
</br>
<a class="btn btn-primary" href="index.php">Je souhaite créer l'étudiant dans la base de données</a>
</br></br>
<button class="btn btn-primary" type="button" data-target="#MonCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="MonCollapse">L'étudiant existe déjà dans la base de données</button>
 
<!-- le contenu masqué -->
 
<section id="MonCollapse" class="collapse">
<div><?php
  formselect($etu);
  ?>
  </div>
</section>
</br></br>

<input type="submit" class="btn btn-default" value="Valider">


</form>
</br>
<hr>
<h2>Sélectionner un cursus existant</h2>
<br>

<?php  

if (isset($_POST['label'], $_POST['numero'])){

  //On créer le cursus  
  $requete1 = $BDD->prepare('INSERT INTO `cursus`(`label`, `numero`) VALUES (?,?)');
  $requete1->execute(array($_POST['label'], $_POST['numero']));



  $requete1->closeCursor();

}

  $reponse2 = $BDD->query('SELECT * FROM `cursus`');
  while ($cursus = $reponse2->fetch())
  {
    echo "<form action='modification_cursus.php' method='POST'> ";
    echo "<input type='hidden' name='idCursus' value=".$cursus['idCursus'].">";
    echo "<input type='hidden' name='label' value=".$cursus['label'].">";
    echo '<input class="btn btn-default" type="submit" value="Label du cursus : ' . $cursus['label'] . " - Numéro de l'étudiant :" . $cursus['numero'] .'">';
    echo "</form>";
  }

  $reponse2->closeCursor(); // Termine le traitement de la requête



?>





            </div>
        </div>
    </div>

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
