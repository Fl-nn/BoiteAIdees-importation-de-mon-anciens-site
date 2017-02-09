<?php
	if(!defined ("INC")){
		
		header("location:index.php");
		exit;
	}
	$n = rand(0,1000);
if($n<=333){
?><header class="intro-header" style="background-image: url('img/home.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1><font color="black">Meuteinfo</font></h1>
                        <hr class="small">
                        <span class="subheading"><font color="black">La meute d'illmatar</font></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php
}
elseif(($n>333)&&($n<=665)){
?>
	<header class="intro-header" style="background-image: url('img/home0.jpeg')">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					<div class="site-heading">
						<h1><font color="white">Meuteinfo</font></h1>
						<hr class="small">
						<span class="subheading"><font color="white">La meute d'illmatar</font></span>
					</div>
				</div>
			</div>
		</div>
	</header>
<?php
}
elseif($n>665){
?>
	<header class="intro-header" style="background-image: url('img/home00.jpg')">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					<div class="site-heading">
						<h1><font color="white">Meuteinfo</font></h1>
						<hr class="small">
						<span class="subheading"><font color="white">La meute d'illmatar</font></span>
					</div>
				</div>
			</div>
		</div>
	</header>
<?php
}
?>