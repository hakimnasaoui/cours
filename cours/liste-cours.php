<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{


    $db->where("cne", $_SESSION['login']);
    $etudiant = $db->getOne("etudiants");
    if(!isset($etudiant["cne"]))
        header("location:index.php");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mes Cours</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if(isset($_SESSION['login']))
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Mes Cours</h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mes Cours
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th  style="text-align: center;">#</th>
                                            <th  style="text-align: center;">Code du cours</th>
                                            <th  style="text-align: center;">Nom du cours </th>
                                            <th  style="text-align: center;">Chapitre du cours</th>
                                             <th  style="text-align: center;">Date d'insertion</th>
                                             <th  style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
//filtrage par deparement | session | professeur
$db->where("departement", $etudiant["departement"]);
$db->where("session", $etudiant["session"]);
$db->where("professeur", $etudiant["professeur"]);
$cours = $db->get("cours");
$i = 0;
foreach($cours as $cour)
{
?>


                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo htmlentities($cour['code']);?></td>
                                            <td><?php echo htmlentities($cour['nom']);?></td>
                                            <td><?php echo htmlentities($cour['chapitre']);?></td>
                                            <td><?php echo htmlentities($cour['dateInsertion']);?></td>
                                            <td>
                                                <?php if(isset($cour['fichiers']) && !empty($cour['fichiers'])): ?>
                                                    <a href="./admin/cours/<?php echo $cour['fichiers']?>">
                                                        <button class="btn btn-primary">T??l??charger</button>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
<?php 
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>





        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
