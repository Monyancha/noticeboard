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
    .panel-primary > .panel-heading, .panel-success > .panel-heading,
    .panel-warning > .panel-heading, .panel-danger > .panel-heading {
        color: #fff;
    }

</style>
<div class="row" style="min-height: 512px">

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-mobile fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><? echo $this->DeviceModel->countDevices(); ?></div>
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
                        <div class="huge"><? echo $this->ItemModel->countNotified(); ?></div>
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
                        <div class="huge"><? echo $this->FeedModel->countFeeds(); ?></div>
                        <div>Feeds Served!</div>
                    </div>
                </div>
            </div>
            <a href="#/feeds">
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
                        <div class="huge"><? echo $this->ItemModel->countItems(); ?></div>
                        <div>Items Posted!</div>
                    </div>
                </div>
            </div>
            <a href="#/content">
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
                <i class="fa fa-clock-o fa-fw"></i> Latest Noticeboard Posts
            </div>
            <div class="panel-body">

                <? if (count($latestItems) == 0) { ?>
                    <h3 class="text-muted text-center">Nothing posted yes!</h3>
                <? } else { ?>
                    <ul class="timeline">
                        <? for ($count = 0; $count < count($latestItems); $count++) { ?>
                            <? $item = $latestItems[$count]; ?>
                            <li class='<?= ($count % 2 == 0) ? "" : "timeline-inverted" ?>'>

                                <div class="timeline-badge <?= $item->notified ? "success" : "danger"; ?>"
                                     data-toggle="tooltip" data-placement="top"
                                     title="<?= $item->notified ? "Notifications sent!" : "Notifications not sent!"; ?>">
                                    <i class="fa fa-<?= $item->notified ? "check" : "close"; ?>"></i>
                                </div>

                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h5 class="timeline-title"><?= limitCharacters($item->title, 40); ?></h5>

                                        <p>
                                            <small class="text-muted">
                                                <i class="fa fa-clock-o"></i>
                                                <?= strtolower(timespan($item->date)); ?> ago in
                                                <code><?= $item->feed; ?></code>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="small"><?= limitCharacters($item->description, 350); ?></p>
                                        <? if (!$item->notified) { ?>
                                            <hr>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <i class="fa fa-bolt"></i> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="" class="btnSendNotification" data-item-id="<?=$item->id;?>">
                                                            Send Notifications
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <? } ?>
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

    function sendNotifications(contents, debugOut) {

        $("#startLoadingAction").click();

        $.ajax({
            type: "POST",
            url: "/dashboard/content/notify",
            data: {ids: contents},
            success: function (res, textStatus, jqXHR) {
                if(debugOut) { console.log(res); }
                else {
                    location.reload();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var err = "<div>";
                err += "<p class='text-muted'>Something went wrong...</p>";
                err += "<p><code>" + textStatus + ": " + errorThrown + "</code></p>";
                err += "</div>";
                BootstrapDialog.show({
                    title: "Oops!",
                    type: BootstrapDialog.TYPE_DANGER,
                    message: err
                });
            },
            complete: function () {
                $("#stopLoadingAction").click();
            }
        });
    }

    $(function () {

        $(".timeline-badge").tooltip();

        $(".btnSendNotification").click(function () {
            var itemId = $(this).attr("data-item-id");
            $(this).addClass('disabled');
            sendNotifications([itemId]);
        });

    });

</script>