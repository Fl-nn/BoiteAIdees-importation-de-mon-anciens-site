<!DOCTYPE html>
<?php
	session_start();
	define ("INC",1);
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Idea Box</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<link rel="icon" type="img/png" href="img/icon.jpg" />
	<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="icon.ico" /><![endif]--> 
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
		<?php		
			include ("connecter.php");
			include ("connecte.php");
			$autocomplete=0;
			$connecter=connecter();
			$connecte=connecte();
			if ($connecter) {
				include ("membres_rangs/const_su.php");
				$su=super_user();
			}
		?>
    <!-- Navigation -->
    <?php
		include('dropdown.php');
	?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <?php
		include('header.php');
	?>

    <!-- Main Content -->
    <div ><!---//class="container">-->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php
					if (isset ($_GET['portails'])){
							include ("position_portails.php");
					}					
					elseif (isset ($_GET['portails_info'])){
						include ("portails_informations.php");
					}
					elseif (isset ($_GET['deban']) && ($connecter)){
						include ("demande_deban.php");
						
							$autocomplete=1;
					}
					elseif (isset ($_GET['gestion_de_compte']) && ($connecter)){
						include ("gestion_compte.php");
					}
					elseif (isset ($_GET['perso']) && ($connecter)){
						include ("ges_personnage.php");
					}							
					elseif (isset ($_GET['maj_portails']) && ($connecter) && ($su)){
							include ("maj_portails.php");
					}
					elseif (isset ($_GET['liste_noir']) && ($connecter) && ($su)){
							$autocomplete=1;
							include ("ges_liste_noir.php");
							
					}
					elseif (isset ($_GET['guildes']) && ($connecter) && ($su)){
							include ("gesguildes.php");
							$autocomplete=1;
					}
					elseif (isset ($_GET['addguildes']) && ($connecter) && ($su)){
							include ("addguildes.php");
					}
					elseif (isset ($_GET['ajout_compte']) && ($connecter) && ($su)){
						$autocomplete=1;
							include ("add_nouveau_membres.php");
					}
					elseif (isset ($_GET['membres']) && ($connecter) && ($su)){
							include ("ges_membres.php");
					}
					elseif (isset ($_GET['condition'])){
					include ("condition.php");
					}
					elseif (isset ($_GET['candid'])){
					include ("forum.php");
					}
					elseif (isset ($_GET['forum'])){
					include ("forum.php");
					}
					elseif (isset ($_GET['qui-sommes-nous'])){
						include ("information.php");
					}
					elseif (isset ($_GET['rapport'])){
						include ("rapport.php");
					}
					elseif (isset ($_GET['inscription'])  && (!$connecter)){
						include ("creation_compte.php");
					}
					else{
						include ("corp.php");
					}
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
                            <a href="https://twitter.com/?lang=fr">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; MeuteInfo 2016 v1.11.08052016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/lib/jquery.js"></script>
	<?php if($autocomplete==1){?>
		
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.12.3.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<?php
	}
	?>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>
	
    <script src="js/jquery-validate/jquery.validate.js"></script>
    <script src="js/jquery-validate/additional-methods.min.js"></script>
    <script src="js/jquery-validate/localization/messages_fr.js"></script>
        <script>
$("#form").validate();
</script>

    <script src="js/jquery.bootstrap-dropdown-hover.js"></script>


    <script src="js/customscript.js"></script>

</body>

</html>
