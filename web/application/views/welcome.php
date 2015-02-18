<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : landing.php
 *  Date : 2/13/15 10:53 AM
 *  Description :
 *
 */
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>USIU Notice Board</title>

	<!-- Bootstrap Core CSS -->
	<link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="/assets/css/grayscale.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand page-scroll" href="#page-top">
				<i class="fa fa-info-circle"></i>  <span class="light">USIU</span> Notice Board
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
			<ul class="nav navbar-nav">
				<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
				<li class="hidden">
					<a href="#page-top"></a>
				</li>
				<li>
					<a class="page-scroll" href="#about">About</a>
				</li>
				<li>
					<a class="page-scroll" href="#download">Download</a>
				</li>
				<li>
					<a class="page-scroll" href="#contact">Contact</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>

<!-- Intro Header -->
<header class="intro">
	<div class="intro-body">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h1 class="brand-heading">Notice Board</h1>
					<p class="intro-text">
                        A simple, efficient notice board for USIU.
                        <br/>
                        <kbd style="font-size: .5em;">
                                APT 2080-A: Introduction to Software Engineering<br/>
                                Spring 2015
                        </kbd>
                    </p>
					<a href="#about" class="btn btn-circle page-scroll">
						<i class="fa fa-angle-double-down animated"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- About Section -->
<section id="about" class="container content-section text-center">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<h2>About Project</h2>

			<p>Not many people really take time to read the various notice boards on campus. Often, they contain timely and urgent information that many miss because they didn’t pass near a notice board, could not read the small black font on the bright white paper or simply because the information was buried under a tonne of other &quot;non-important&quot; information.</p>
			<p>We would like to change that by supplementing and eventually replacing the physical notice board with a mobile app. Because we carry our phones everywhere and rarely turn them off, a mobile app that presents the notice board’s information in a very efficient way would prevent students from missing those important alerts, messages or sign up sheets on the notice board.</p>
		</div>


        <div id="app_shot" class="col-lg-12">
            <h2>Screen Shots</h2>
            <img class="img-responsive" src="/assets/img/shot_1.png">
            <img class="img-responsive" src="/assets/img/shot_2.png">
            <img class="img-responsive" src="/assets/img/shot_3.png">
        </div>

	</div>
</section>

<!-- Download Section -->
<section id="download" class="content-section text-center">
	<div class="download-section">
		<div class="container">
			<div class="col-lg-8 col-lg-offset-2">
				<h2>Download App</h2>
				<p>You can get your copy of <kbd>USIU Notice Board</kbd> app today.</p>

                <ul class="list-inline buttons-list">

                    <li>
                        <a href="https://www.dropbox.com/s/4vlzq9cpv65u2fw/USIUBoard-prerelease.apk?dl=0" target="_blank"
                           class="btn btn-default btn-lg">
                            <i class="fa fa-download fa-fw"></i> <span>Download</span></a>
                    </li>

                    <li>
                        <a href="https://bitbucket.com/usiu/noticeboard" target="_blank"
                           class="btn btn-default btn-lg">
                            <i class="fa fa-bitbucket fa-fw"></i> <span>Source Code</span></a>
                    </li>

                </ul>

                <p class="text-muted" style="font-size: .95em;">
                    <small><strong>USIU Notice Board</strong> app requires you to run <strong>Android 2.3 or above</strong> and allow installation from <em>unknown sources</em>.</small>
                </p>

			</div>
		</div>
	</div>
</section>

<!-- Contact Section -->
<section id="contact" class="container content-section text-center">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<h2>Contact</h2>
			<p>Feel free to email us to provide some feedback on our project, give us suggestions, or to just say hello!</p>
			<p><a href="mailto:aksalj@aksalj.me">feedback@aksalj.me</a>
			</p>
			<ul class="list-inline buttons-list">
				<li>
					<a href="https://twitter.com/aksalj" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
				</li>
				<li>
					<a href="https://github.com/aksalj" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
				</li>
				<li>
					<a href="https://plus.google.com/+SalamaAB" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
				</li>
			</ul>
		</div>
	</div>
</section>


<!-- Footer -->
<footer>
	<div class="container text-center">
		<p>&copy; Salama AB 2015</p>
	</div>
</footer>

<!-- jQuery -->
<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="/assets/bower_components/jquery.easing/js/jquery.easing.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/assets/js/grayscale.js"></script>

</body>

</html>
