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
    <meta name="description" content="A simple, efficient notice board for USIU.">
    <meta name="author" content="Salama AB">

    <title>USIU Notice Board</title>

    <link rel="icon" type="image/png" href="/assets/img/favicon.png"/>

    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/assets/plugin/coin-slider/coin-slider-styles.css" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">

    <link href="/assets/css/main.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <i class="fa fa-info-circle"></i> <span class="light">USIU</span> Notice Board
            </a>
        </div>

        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
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
                    <a class="page-scroll" href="/dashboard">Dashboard</a>
                </li>
                <li>
                    <a class="page-scroll" href="#team">Team</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="intro" data-0="background-position:0px 0px" data-100000="background-position:0px -50000px;">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="brand-heading">Notice Board</h1>

                    <p class="intro-text">
                        A simple, efficient notice board for USIU.
                        <br/>
                        <? /*
                        <kbd style="font-size: .5em;">
                            APT 2080-A: Introduction to Software Engineering<br/>
                            Spring 2015
                        </kbd> */ ?>
                    </p>
                    <a href="#about" class="btn btn-circle page-scroll">
                        <i class="fa fa-angle-double-down animated"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="about" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>About Project</h2>

            <p>Not many people really take time to read the various notice boards on campus. Often, they contain timely
                and urgent information that many miss because they didn’t pass near a notice board, could not read the
                small black font on the bright white paper or simply because the information was buried under a tonne of
                other &quot;non-important&quot; information.</p>

            <p>We would like to change that by supplementing and eventually replacing the physical notice board with a
                <code>mobile app</code>. Because we carry our phones everywhere and rarely turn them off, a mobile app
                that presents
                the notice board’s information in a very efficient way would prevent students from missing those
                important alerts, messages or sign up sheets on the notice board.</p>
        </div>
    </div>


    <div id="app_shot" class="row col-lg-12 hidden-md hidden-sm hidden-xs hidden-print center-block">
        <h2>and it looks like this...</h2>

        <div class="col-lg-4">
            <div id="andro_slider" class="_slider center-block">

                <a href="#">
                    <img class="img-responsive" src="/assets/img/shot_2.png">
                </a>

                <a href="#">
                    <img class="img-responsive" src="/assets/img/shot_1.png">
                </a>

                <a href="#">
                    <img class="img-responsive" src="/assets/img/shot_3.png">
                </a>

            </div>

        </div>

        <div class="col-lg-4">
            <div id="ios_slider" class="_slider center-block">

                <a href="#">
                    <img class="img-responsive" src="/assets/img/shot_1.png">
                </a>

            </div>
        </div>

        <div class="col-lg-4">
            <div id="win_slider" class="_slider center-block">

                <a href="#">
                    <img class="img-responsive" src="/assets/img/shot_3.png">
                </a>

                <a href="#">
                    <img class="img-responsive" src="/assets/img/shot_1.png">
                </a>

                <a href="#">
                    <img class="img-responsive" src="/assets/img/shot_2.png">
                </a>

            </div>
        </div>

    </div>

</section>

<section id="download" class="content-section text-center">
    <div class="download-section">
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Download App</h2>

                <p>You can get your copy of <kbd>USIU Notice Board</kbd> app today.</p>

                <ul class="list-inline buttons-list">

                    <li>
                        <a href="https://www.dropbox.com/s/4vlzq9cpv65u2fw/USIUBoard-prerelease.apk?dl=0"
                           target="_blank"
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
                    <small>
                        <strong>USIU Notice Board</strong> app requires you to run <strong>Android 2.3 or
                            above</strong> and allow installation from <em>unknown sources</em>.
                        <strong>iOS 8+</strong> still in development.
                    </small>
                </p>

            </div>
        </div>
    </div>
</section>

<section id="team" class="content-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Our Awesome Team</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <p class="large">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam
                    veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>

        <div class="row">

            <? foreach ($team as $handle => $member) { ?>
                <div class="team-member col-sm-3">
                    <div class="team-pop"
                         data-container="body"
                         data-toggle="popover"
                         data-placement="bottom"
                         data-html="true"
                         data-title="<?= $member['name'].", ".$member['country'];?>"
                         data-content='<?= html_escape("<div class='team-member-quote'>".
                             limitCharacters($member['quote'], 500, "...&nbsp;<a href='#'><small>Read More</small>&nbsp;&raquo;</a>") .
                             "</div>".
                             "<div class='small well well-sm'>
                                ".$member['major'].", <b>".$member['speciality']."</b>
                             </div>"
                         ); ?>'>
                        <img src="<?=$member['profile'];?>" class="img-responsive img-circle" alt="<?=$member['name'];?>"
                             data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Click for member info">
                        <h4><?=$member['name'];?></h4>
                    </div>

                    <p class="text-muted"><?=$member['position'];?></p>
                    <? if ($member['social']) { ?>
                        <ul class="list-inline social-buttons">
                            <? foreach ($member['social'] as $serviceName => $socialProfile) { ?>
                                <li><a href="<?=$socialProfile;?>"><i class="fa fa-<? echo $serviceName; ?>"></i></a></li>
                            <? } ?>
                        </ul>
                    <? } ?>

                    <? if ($member['saying']) { ?>
                        <blockquote><?=$member['saying'];?></blockquote>
                    <? } ?>

                </div>

            <? } ?>

        </div>


    </div>
</section>

<section id="contact" class="container content-section contact-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Contact</h2>

            <p>Feel free to email us to provide some feedback on our project, give us suggestions, or to just say
                hello!</p>

            <p><a href="mailto:aksalj@aksalj.me">feedback@aksalj.me</a>
            </p>
            <ul class="list-inline buttons-list">
                <li>
                    <a href="https://facebook.com/aksalj" class="btn btn-default btn-md"><i
                            class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                </li>
                <li>
                    <a href="https://twitter.com/aksalj" class="btn btn-default btn-md"><i
                            class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                </li>
                <li>
                    <a href="https://github.com/aksalj" class="btn btn-default btn-md"><i
                            class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                </li>
                <li>
                    <a href="https://plus.google.com/+SalamaAB" class="btn btn-default btn-md"><i
                            class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                </li>
            </ul>
        </div>
    </div>
</section>


<footer>
    <div class="container text-center">
        <p>&copy; Salama AB 2015</p>
        <small class="text-muted">
            USIU and associated texts, images and other materials are the property of <a href="http://www.usiu.ac.ke/" target="_blank">
                United States International University - Africa.</a>
            <br/>
            Their use in this project is authorized by the student agreement.
        </small>
    </div>
</footer>

<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/bower_components/jquery.easing/js/jquery.easing.min.js"></script>
<!--<script src="/assets/bower_components/skrollr/dist/skrollr.min.js"></script>-->
<script src="/assets/plugin/coin-slider/coin-slider.js"></script>
<script src="/assets/js/welcome.js"></script>

</body>

</html>
