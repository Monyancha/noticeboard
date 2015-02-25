<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : dashboard.php
 *  Date : 2/21/15 2:49 PM
 *  Description :
 *
 */
?>
<style>
    @import "/assets/css/timeline.css";

    /* Paper theme */
    .panel-primary>.panel-heading, .panel-success>.panel-heading,
    .panel-warning>.panel-heading, .panel-danger>.panel-heading {
        color: #fff;
    }

</style>
<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-mobile fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><? echo  $this->DeviceModel->countDevices(); ?></div>
                        <div>Devices Registered!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-volume-up fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">172</div>
                        <div>Notifications Sent!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-rss fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><? echo  $this->FeedModel->countFeeds(); ?></div>
                        <div>Feeds Served!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tree fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><? echo  $this->FeedModel->countFeedsItems(); ?></div>
                        <div>Items Posted!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-clock-o fa-fw"></i> Timeline
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge"><i class="fa fa-check"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>

                                <p>
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago in <kbd>Adverts</kbd>
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor
                                    perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam
                                    excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta,
                                    debitis.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam,
                                    tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse
                                    debitis optio, tempore. Animi officiis alias, officia repellendus.</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui
                                    est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius
                                    voluptates, ad aut recusandae minus eaque facere.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis
                                    enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam,
                                    voluptatem totam quaerat, magni commodi quisquam.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat
                                    asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit!
                                    Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge info"><i class="fa fa-save"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum
                                    alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae
                                    consequuntur impedit nulla qui! Laborum, atque.</p>
                                <hr>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        <i class="fa fa-gear"></i> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam.
                                    Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci
                                    quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Lorem ipsum dolor</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat
                                    tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat,
                                    animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</div>