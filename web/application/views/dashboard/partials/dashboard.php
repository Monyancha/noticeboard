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

$latestItems = getLatestItems(15);

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
                        <div class="huge"><? echo  $this->ItemModel->countNotified(); ?></div>
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
                        <div class="huge"><? echo  $this->ItemModel->countItems(); ?></div>
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

                <? if(count($latestItems) == 0) {?>
                    <h3 class="text-muted text-center">Nothing posted yes!</h3>
                <? } else { ?>
                    <ul class="timeline">
                        <? for($count = 0; $count < count($latestItems); $count++) { ?>
                            <? $item = $latestItems[$count]; ?>
                            <li class='<?= ($count%2==0)? "":"timeline-inverted" ?>'>

                                <div class="timeline-badge <?= $item->notified ? "success" : "warning";?>"
                                     data-toggle="tooltip" data-placement="top"
                                     title="<?= $item->notified ? "Notifications sent!" : "Notifications not sent!";?>">
                                    <i class="fa fa-<?= $item->notified ? "check" : "close"; ?>"></i>
                                </div>

                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title"><?=limitCharacters($item->title,30);?></h4>

                                        <p>
                                            <small class="text-muted">
                                                <i class="fa fa-clock-o"></i> <?=timespan($item->date);?> ago in <code><?=$item->feed;?></code>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p><?=limitCharacters($item->description, 200);?></p>
                                        <hr>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-bolt"></i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Send Notifications</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Edit</a></li>
                                                <li><a href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <? } ?>
                    </ul>
                <? } ?>
            </div>
        </div>
    </div>


</div>

<script>
    $("#pageActions").html('');
    $(".timeline-badge").tooltip();
</script>