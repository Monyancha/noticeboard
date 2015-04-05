<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : search.php
 *  Date : 4/5/15 11:25 AM
 *  Description :
 *  
 */

sleep(1); // DELETE ME?

$query = $this->input->get('query');
$searchItems = searchItems($query);

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

    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-search fa-fw"></i><span class="text-muted"><?=$query;?></span>
                <? if (count($searchItems) > 0) { ?>
                    <span class="small pull-right">Found <? echo count($searchItems)." item(s).";?></span>
                <? } ?>
            </div>
            <div class="panel-body">

                <? if (count($searchItems) == 0) { ?>
                    <h3 class="text-muted text-center">Found no posts!</h3>
                <? } else { ?>
                    <ul class="timeline">
                        <? for ($count = 0; $count < count($searchItems); $count++) { ?>
                            <? $item = $searchItems[$count]; ?>
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
                                        <hr>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-bolt"></i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="" class="btnEdit" ng-click="edit('<?=$item->id;?>')">Edit</a>
                                                </li>
                                                <? if (!$item->notified) { ?>
                                                    <li>
                                                        <a href="" class="btnSendNotification" data-item-id="<?=$item->id;?>">
                                                            Send Notifications
                                                        </a>
                                                    </li>
                                                <? } ?>
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

        $("#pageActions").html(null);

        $(".timeline-badge").tooltip();

        $(".btnSendNotification").click(function () {
            var itemId = $(this).attr("data-item-id");
            $(this).addClass('disabled');
            sendNotifications([itemId]);
        });

    });

</script>