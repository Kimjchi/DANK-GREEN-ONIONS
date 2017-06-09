<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Calculateur de Cursus - Modifier Cursus</title>

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

  <script type="text/javascript" language="Javascript">


    function validForm(){
      var valide = true;
      var semValue = document.FormIdent.sem_label.value;
      var uvValue = document.FormIdent.nom_uv.value;
      $("#alertSem").hide();
      $("#alertUv").hide();
      //mise en majuscule
      var semUpper = semValue.toUpperCase();
      if(semUpper != semValue){
        $("#alertSem").show();
        valide = false;
      }
      var uvUpper = uvValue.toUpperCase();
      if(uvUpper != uvValue){
        $("#alertUv").show();
        valide = false;
      }

      return valide;
    }
  </script>

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
    <header class="intro-header" style="background-image: url('img/modifcursus-bg.png')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>Modifier un cursus</h1>
                        <h2 class="subheading">Imaginez un cursus personalisé.</h2>
                        <hr>
                        <h3><a href="#toto" style="color: white">Totaux</a> - <a href="#diplomable" style="color: white">Progression</a> - <a href="#import" style="color: white">Importer un Cursus</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </header>

  
 <!-- Main Content -->
    <div class="container" >
        <div class="text-center">
            <div>



    


<?php  
include 'formulaire_formation.php';
//$BDD = new PDO('mysql:host=localhost;dbname=projet lo07', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_POST['numero_semestre'], $_POST['sem_label'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat'])) {


  //On regarde si on a le même label de semestre dans le cursus choisi
  $sem = array();
  $reponse4 = $BDD->prepare('SELECT `sem_label` FROM `formation` WHERE `idCursus` = ?');
  $reponse4->execute(array($_POST['idCursus']));
  while ($sem_liste = $reponse4->fetch())
  {
    $sem[]=$sem_liste['sem_label'];
  }
  $identique=FALSE;
  foreach ($sem as $element) {
    //Si le sem existe déjà dans le cursus, on lie l'uv choisi à la table qui existe déjà 
    if ($element == $_POST['sem_label']) {
      $identique = TRUE;
      $reponse5 = $BDD->prepare('SELECT `idFormation` FROM `formation` WHERE `idCursus` = ? AND `sem_label` = ?;');
      $reponse5->execute(array($_POST['idCursus'],$_POST['sem_label']));
      while ($idFormation_existe = $reponse5->fetch())
      {
        $idFormation=$idFormation_existe['idFormation'];
      }
      $reponse5->closeCursor();
    }


  //Sinon, on crée une formation et on récupère l'ID de celle-ci
  }
  $reponse4->closeCursor();

  if(!$identique){
      $requete2 = $BDD->prepare('INSERT INTO `formation`(`idCursus`, `sem_label`) VALUES (?,?)');
      $requete2->execute(array($_POST['idCursus'], $_POST['sem_label']));

      $reponse2 = $BDD->query('SELECT MAX(`idFormation`) FROM `formation`');
      while ($formation = $reponse2->fetch())
      {
        $idFormation=$formation['MAX(`idFormation`)'];
      }
      $reponse2->closeCursor();
      $requete2->closeCursor();
  }


  

  //On crée l'UV dans la base de donnée
  if (!empty($_POST['nom_uv'])){
    $requete3 = $BDD->prepare('INSERT INTO `element_de_formation`(`sigle`, `categorie`, `credit`) VALUES (?,?,?)');
    $requete3->execute(array($_POST['nom_uv'], $_POST['categorie'], $_POST['credit']));




    //On met dans la table appartient

    $requete = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
    $requete->execute(array($_POST['numero_semestre'], $_POST['nom_uv'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat'], $idFormation));

    $requete3->closeCursor();
  }
  //Ou on met l'uv existante dans la table appartient
  else{
    //On met dans la table appartient

    $requete = $BDD->prepare('INSERT INTO `appartient`(`sem_seq`, `sigle`, `affectation`, `utt`, `profil`, `resultat`, `idFormation`)  VALUES (?,?,?,?,?,?,?)');
    $requete->execute(array($_POST['numero_semestre'], $_POST['uv_existe'], $_POST['affectation'], $_POST['utt'], $_POST['profil'], $_POST['resultat'], $idFormation));
  }








  // Termine le traitement de la requête

  $requete->closeCursor();
  



}


//Affichage du cursus
include 'affichage_cursus.php';
include 'agregat_cursus.php';
include 'reglement.php';
?>



    </p>
  </div>
  
</div><!-- /.container -->


<!-- exporter -->
<div class="text-center">

<form method="post" action="exportcursus.php">
<?php
echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
echo "<input type='hidden' name='label' value=".$_POST['label'].">";
?>
  <input type="submit" name="export" class="btn btn-default"value="Exporter en CSV">
</form>

</div>

<hr>
<!-- importer -->
<div class="text-center" id="import">
<h2>Importation de Cursus</h2>
<h3>Veuillez charger un fichier au format .csv</h3><br>
  <form method="POST" enctype="multipart/form-data" action="import.php">
    <input  type="file" name="userfile" value="table" style="margin: 0 auto"><br>
    <?php  
      echo "<input type='hidden' name='idCursus' value=".$_POST['idCursus'].">";
      echo "<input type='hidden' name='label' value=".$_POST['label'].">";
    ?>

    <input class="btn btn-primary" type="submit" name="submit" value="Importer">




  </form>
</div>

            </div>
        </div>
    </div>

    <hr>
</body>
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
