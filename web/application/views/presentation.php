<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : presentation.php
 *  Date : 4/8/15 11:42 AM
 *  Description :
 *
 */
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Notice Board</title>


    <meta name="description" content="A simple, efficient notice board for USIU.">
    <meta name="author" content="Salama AB">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=yes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link href="/assets/bower_components/bootswatch/paper/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/introduction.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/introduction-anims.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/plugin/jmpress.js"></script>

    <script type="text/javascript">
        $.jmpress("template", "auto", {
            children: function(idx) {
                return {
                    y: 400,
                    x: -300 + idx * 300,
                    template: "auto",
                    scale: 0.3,
                    rotate:  0
                }
            }
        });
    </script>

</head>
<body>

<div id="jmpress" data-template="auto">

    <section id="start" class="text-center">
        <h3 style="margin-top: 150px">
            Press <kbd>spacebar</kbd> to Start
        </h3>

        <p class="text-info" style="padding:10px; position: absolute; bottom: 0; left: 0; right: 0;">
            use <code>&larr;</code> and <code>&rarr;</code> to navigate.
        </p>
    </section>

    <section id="home" class="text-center">

        <div data-jmpress="zoom">
            <h1>Notice Board</h1>
            <p>Simple, efficient notice board for USIU.</p>
        </div>

        <code style="font-size: 1.5em;" data-jmpress="fade after 500ms">
            <span data-jmpress="drive-down after 500ms">Salama A. Balekage</span>
            <br/>
            <span data-jmpress="drive-left after 500ms">Cyrus Koroma</span>
            <br/>
            <span data-jmpress="drive-right after 500ms">Joshua Muhindo</span>
            <br/>
            <span data-jmpress="drive-up after 500ms">Joshua Mwamba</span>
        </code>

        <div data-jmpress="fade after 500ms" style="position: absolute; bottom: 0; left: 0; right: 0;">
            <small class="text-muted">
                USIU and associated texts, images and other materials are the property of <a href="http://www.usiu.ac.ke/" target="_blank">
                    United States International University - Africa.</a>
                <br/>
                Their use in this project is authorized as part of the course work for <b>APT 2080: Intro to Software Engineering</b>.
            </small>
        </div>

        <section id="problem">
            <h1>the problem...</h1>
            <p data-jmpress="fade">
                Not many people really take time to read the various notice boards on campus.
            </p>
            <div data-jmpress="fade after 500ms">
                <p>Often, notice boards contain timely and urgent information that many students miss because they:</p>
                <ul>
                    <li data-jmpress="drive-left after 500ms"><p>didn't  happen to pass near a notice board</p></li>
                    <li data-jmpress="drive-left after 500ms"><p>could not read the small black font on the bright white paper</p></li>
                    <li data-jmpress="drive-left after 500ms"><p>or simply because the information was buried under a ton of other &quot;non-important&quot; information.</p></li>
                </ul>
            </div>


        </section>

        <section id="solution">
            <h1>the solution...</h1>
            <p data-jmpress="fade">
                We would like to change that by supplementing and eventually replacing the physical notice boards with a
                <span class="label label-success">mobile app</span>.
            </p>

            <p data-jmpress="fade after 500ms">
                We carry our phones everywhere and rarely turn them off. <br/>
                A mobile app would prevent students from missing those important notice board posts:</p>
            <ul data-jmpress="fade after 500ms">
                <li data-jmpress="drive-left after 500ms">Alerts</li>
                <li data-jmpress="drive-left after 500ms">Announcements</li>
                <li data-jmpress="drive-left after 500ms">Adverts</li>
                <li data-jmpress="drive-left after 500ms">Schedules and timetables</li>
                <li data-jmpress="drive-left after 500ms">Sign up sheets</li>
            </ul>

            <p data-jmpress="fade after 500ms">
                The app would get notified every time new content is posted.
            </p>
        </section>

    </section>

    <section id="implementation">
        <h1>the implementation</h1>
        <p data-jmpress="fade after 500ms">
            Simple <kbd>Client-Server</kbd> architecture in which a <code>web</code> application serves an <code>Android</code> and <code>iOS</code> app.
        </p>

        <p data-jmpress="fade after 500ms">
            The apps and web service interact with 3 cloud services:
        </p>
        <ul style="font-size: 1.5em;">
            <li data-jmpress="fade after 500ms">SMS provider <code>Twilio</code></li>
            <li data-jmpress="fade after 500ms">Android Push Notification provider <code>Google Cloud Messaging</code></li>
            <li data-jmpress="fade after 500ms">iOS Push Notification provider <code>Apple Notification Services</code></li>
        </ul>

        <p data-jmpress="fade after 500ms">
            The web service runs on <code>OpenShift</code>
        </p>


        <section id="deploy" class="transp-section" data-rotate="65" data-y="500">
            <h3>Deployment Diagram</h3>
            <div>
                <img class="img-responsive" src="/assets/img/intro/deployment.png">
            </div>

            <section id="tech" data-rotate="-65" data-y="550">
                <h1>Technologies/ Tools/ Platforms</h1>

                <div style="padding: 50px;">
                    <div class="pull-left" style="width: 150px;">
                        <ul style="font-size: 1.5em;">
                            <li data-jmpress="drive-left after 100ms">PHP</li>
                            <li data-jmpress="drive-left after 200ms">JavaScript</li>
                            <li data-jmpress="drive-left after 300ms">HTML</li>
                            <li data-jmpress="drive-left after 400ms">CSS</li>
                            <li data-jmpress="drive-left after 300ms">Java</li>
                            <li data-jmpress="drive-left after 200ms">Swift</li>
                        </ul>
                    </div>

                    <div class="pull-left" style="width: 180px;">
                        <ul style="font-size: 1.5em;">
                            <li data-jmpress="drive-left after 100ms">Google (<code>GCM</code>)</li>
                            <li data-jmpress="drive-left after 200ms">Apple (<code>APNS</code>)</li>
                            <li data-jmpress="drive-left after 300ms">OpenShift</li>
                            <li data-jmpress="drive-left after 200ms">Android</li>
                            <li data-jmpress="drive-left after 100ms">iOS</li>
                        </ul>
                    </div>

                    <div class="pull-left" style="width: 150px;">
                        <ul style="font-size: 1.5em;">
                            <li data-jmpress="drive-left after 100ms">CodeIgniter</li>
                            <li data-jmpress="drive-left after 200ms">AngularJS</li>
                            <li data-jmpress="drive-left after 300ms">Bootstrap</li>
                            <li data-jmpress="drive-left after 200ms">jQuery</li>
                        </ul>
                    </div>

                    <div class="pull-left" style="width: 200px;">
                        <ul style="font-size: 1.5em;">
                            <li data-jmpress="drive-left after 100ms">MySQL</li>
                            <li data-jmpress="drive-left after 200ms">SQlite (<kbd>planned</kbd>)</li>
                        </ul>
                    </div>

                </div>

            </section>

        </section>



        <section id="web">
            <h1>Web Service</h1>

            <p data-jmpress="fade">This simple <code>PHP</code> application offers the following: </p>

            <ul style="font-size: 1.5em;">
                <li data-jmpress="drive-left after 500ms">Marketing of the mobile app. <span class="label label-default">Marketing</span></li>
                <li data-jmpress="drive-left after 500ms">Registration of feeds by school staff. <span class="label label-warning">Dashboard</span></li>
                <li data-jmpress="drive-left after 500ms">Service of feed URLs to mobile app. <span class="label label-primary">API</span></li>
                <li data-jmpress="drive-left after 500ms">Regular monitoring feeds for new content. <span class="label label-primary">API</span></li>
                <li data-jmpress="drive-left after 500ms">Sending <code>Push</code> and <code>SMS</code> notifications. <span class="label label-warning">Dashboard</span></li>
                <li data-jmpress="drive-left after 500ms">Registration and removal of student phone (device and number). <span class="label label-primary">API</span></li>
            </ul>

            <section id="marketing">
                <h1>Marketing</h1>
                <p data-jmpress="fade">
                    Single-page web app markets the notice board mobile app.<br/>
                    It allows students to download that app. And staff to access the dashboard.
                </p>

                <div data-jmpress="fade after 500ms" style="max-height: 250px; overflow: hidden">
                    <img class="img-responsive" src="/assets/img/intro/marketing.png" />
                </div>

                <p data-jmpress="drive-up after 500ms" class="text-center" style="margin-top:30px;">
                    <a href="<?=base_url();?>" target="_blank" class="btn btn-lg btn-primary">Open App</a>
                </p>

            </section>

            <section id="dashboard">
                <h1>Dashboard</h1>
                <p data-jmpress="fade">
                    Single-page angular app to manage the system’s content.<br/>
                    It allows staff to:</p>
                <ul style="font-size: 1.5em;">
                    <li data-jmpress="drive-left after 500ms">Add, update and remove feeds (categories of posts).</li>
                    <li data-jmpress="drive-left after 500ms">Set, update notifications type (<code>Push</code> or <code>SMS</code> or both).</li>
                    <li data-jmpress="drive-left after 500ms">Set, update providers settings.</li>
                    <li data-jmpress="drive-left after 500ms">Add, update and remove feed content (posts).</li>
                    <li data-jmpress="drive-left after 500ms">Send notifications.</li>
                </ul>

                <section id="dash_shot" class="transp-section" data-rotate="-45" data-x="400" data-y="200" data-scale="0.1">
                    <div>
                        <img class="img-responsive img-thumbnail" src="/assets/img/intro/dashboard.png" />
                    </div>

                    <p class="text-center" style="margin-top:10px;">
                        <a href="<?=base_url("dashboard");?>" target="_blank" class="btn btn-lg btn-primary">Open App</a>
                    </p>
                </section>

            </section>


            <section id="api">
                <h1>API</h1>
                <p data-jmpress="fade">
                    Simple interface for the app to interact with the web service.<br/>
                    Some of the endpoints include:
                </p>
                <ul style="font-size: 1.5em;">
                    <li data-jmpress="drive-left after 500ms"><code>GET</code> from <kbd>/api/feeds</kbd> to get a list of the registered feeds.</li>
                    <li data-jmpress="drive-left after 500ms"><code>GET</code> from <kbd>/api/feed/:name</kbd> to get the RSS of feed <code>:name</code>.</li>
                    <li data-jmpress="drive-left after 500ms"><code>POST</code> to <kbd>/api/register</kbd> to register a student's device and phone number.</li>
                    <li data-jmpress="drive-left after 500ms"><code>POST</code> to <kbd>/api/sync</kbd> to sync all feeds and send notifications.
                        Called every minute by a job scheduler.
                        Used only when pulling content from school’s <code>CMS</code>.</li>
                </ul>

                <p data-jmpress="fade after 500ms">API authenticates clients (apps) using their <code>User-Agent</code>. Will definitely fix that in production!</p>

            </section>

        </section>

        <section id="app">
            <h1>Mobile App</h1>
            <p data-jmpress="fade">This simple app displays the board's content and receive push notifications</p>
            <p data-jmpress="fade after 500ms">Top features include:</p>
            <ul style="font-size: 1.5em;">
                <li data-jmpress="drive-left after 500ms">Push and SMS Registration</li>
                <li data-jmpress="drive-left after 500ms">Fetch feeds URLs from web service.</li>
                <li data-jmpress="drive-left after 500ms">Fetch and list feeds content.</li>
                <li data-jmpress="drive-left after 500ms">Render content posted as <code>HTML</code></li>
            </ul>

            <section id="screens">
                <h1>Screens / Activities / Scenes</h1>

                <div style="margin: -10px;">
                    <div data-jmpress="fade" class="pull-left" style="width: 180px;">
                        <h5>Splash</h5>
                        <ul style="font-size: 1.2em;">
                            <li data-jmpress="drive-left after 500ms">Terms of service</li>
                            <li data-jmpress="drive-left after 500ms">
                                Registrations
                                <ul>
                                    <li data-jmpress="drive-left after 500ms">Phone number</li>
                                    <li data-jmpress="drive-left after 500ms">Device UUID</li>
                                </ul>

                            </li>
                        </ul>
                    </div>

                    <div data-jmpress="fade after 1000ms" class="pull-left" style="width: 200px;">
                        <h5>Board Content</h5>
                        <ul style="font-size: 1.2em;">
                            <li data-jmpress="drive-left after 500ms">Feed(selected) posts</li>
                            <li data-jmpress="drive-left after 500ms">
                                Each post:
                                <ul>
                                    <li data-jmpress="drive-left after 500ms">Title, short description</li>
                                    <li data-jmpress="drive-left after 500ms">Image, published date</li>
                                </ul>

                            </li>
                            <li data-jmpress="drive-left after 500ms">
                                Side bar
                                <ul>
                                    <li data-jmpress="drive-left after 500ms">List feeds</li>
                                    <li data-jmpress="drive-left after 500ms">Switch selected feed</li>
                                </ul>

                            </li>
                        </ul>
                    </div>

                    <div data-jmpress="fade after 1000ms" class="pull-left" style="width: 200px;">
                        <h5>Post Detail</h5>
                        <ul style="font-size: 1.2em;">
                            <li data-jmpress="drive-left after 500ms">Display post details</li>
                            <li data-jmpress="drive-left after 500ms">Content can include <code>HTML</code> with followable links</li>
                        </ul>
                    </div>

                    <div data-jmpress="fade after 1000ms" class="pull-left">
                        <h5>Post Image</h5>
                        <ul style="font-size: 1.2em;">
                            <li data-jmpress="drive-left after 500ms">Display post full size image</li>
                        </ul>
                    </div>

                </div>

            </section>

            <section id="android">
                <h1>Android</h1>

                <div id="andro_shots">
                    <img data-jmpress="drive-right" class="img-responsive" src="/assets/img/screenshots/nexus_1.png" width="193">
                    <img data-jmpress="drive-up after 500ms" class="img-responsive" src="/assets/img/screenshots/nexus_2.png" width="193">
                    <img data-jmpress="drive-left after 500ms" class="img-responsive" src="/assets/img/screenshots/nexus_3.png" width="193">
                </div>

                <style>
                    #andro_shots img {
                        margin-left: 50px;
                        display: inline;
                    }
                </style>


            </section>

            <section id="ios">
                <h1>iOS <kbd data-jmpress="fade">still in development</kbd></h1>

                <div id="ios_shots">
                    <img data-jmpress="drive-right after 500ms" class="img-responsive" src="/assets/img/screenshots/iphone_1.png" width="193">
                    <img data-jmpress="drive-up after 500ms" class="img-responsive" src="/assets/img/screenshots/iphone_2.png" width="193">
                    <img data-jmpress="drive-left after 500ms" class="img-responsive" src="/assets/img/screenshots/iphone_3.png" width="193">
                </div>

                <style>
                    #ios_shots img {
                        margin-left: 50px;
                        display: inline;
                    }
                </style>

            </section>

        </section>

    </section>

    <section id="ccl">
        <h1>Where do we go from here?</h1>

        <br/>

        <p data-jmpress="drive-down after 500ms"><i class="fa fa-apple fa-fw"></i> Complete the iOS version.</p>
        <p data-jmpress="drive-left after 500ms"><i class="fa fa-key fa-fw"></i> Proper API client authentication.</p>
        <p data-jmpress="drive-right after 500ms"><i class="fa fa-bug fa-fw"></i> Iron out as many bugs as we can find.</p>
        <p data-jmpress="drive-up after 500ms"><i class="fa fa-server fa-fw"></i> Request deployment (trial) by the university.</p>

        <section id="end" class="text-center" data-rotate="90" data-x="0" data-y="800">
            <h1 style="margin-top: 100px; margin-bottom: 100px">Thank you!</h1>

            <p data-jmpress="expand">
                App available for download from <code>http://usiu.aksalj.me</code> <br/>
                Source code available<sup>*</sup> at <code>https://bitbucket.org/usiu/noticeboard</code>
            </p>

            <div class="text-muted" data-jmpress="fade after 500ms" style="font-size:.8em; position: absolute; bottom: 0; left: 0; right: 0;">
                <p>
                    <sup><b>*</b></sup> On invitation only.
                </p>
            </div>
        </section>
    </section>

</div>

<script type="text/javascript">
    $(function() {
        $('#jmpress').jmpress({
            stepSelector: "section",
            hash: { use: false }
        });
    });
</script>

</body>
</html>