<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : notifications.php
 *  Date : 2/25/15 2:05 PM
 *  Description :
 *  
 */


$notificationSettings = getNotificationsSettings();
$smsSettings = getSMSSettings();
$pushSettings = getPushSettings();

// Service Providers
$gcmSettings = $pushSettings->GCM;
$apnsSettings = $pushSettings->APNS;
$twilioSettings = $smsSettings->twilio;

// Notifications types
$smsAndPushOn = $notificationSettings->sms && $notificationSettings->push;
$smsOn = !$smsAndPushOn && $notificationSettings->sms;
$pushOn = !$smsAndPushOn && $notificationSettings->push;


?>
<style>
    #notifsContent {
        min-height: 512px;
        padding: 10px;
    }

    .tab-pane {
        padding: 5px;
    }

    #actions {
        padding: 10px;
    }
</style>

<div class="row" id="notifsContent">

    <div class="col-lg-6">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Notifications Type</h3>
            </div>

            <div class="panel-body">
                <form id="typeForm">

                    <div class="radio">
                        <label>
                            <input type="radio" name="notificationsSettings" value="sms" <? if($smsOn) echo "checked"; ?>>
                            SMS Only&mdash;Send only SMS notifications
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="notificationsSettings" value="push" <? if($pushOn) echo "checked"; ?>>
                            Push Only&mdash;Send only Push notifications
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="notificationsSettings" value="both" <? if($smsAndPushOn) echo "checked"; ?>>
                            Both&mdash;Send both SMS and Push notifications.
                        </label>
                    </div>

                    <div id="actions" class="">
                        <a class="btn btn-primary" href="" id="btnSaveType">
                            <i class="fa fa-save fa-fw"></i>
                            <span class="text">Save</span>
                        </a>
                        &nbsp;
                        <a class="btn btn-warning" href="" id="btnRestoreType">
                            <i class="fa fa-refresh fa-fw"></i> <span class="text">Restore Defaults</span>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Push Notifications Providers</h3>
            </div>

            <div class="panel-body">
                <div role="tabpanel" id="pushTabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#gcm" aria-controls="gcm" role="tab" data-toggle="tab">Google's GCM</a>
                        </li>
                        <li role="presentation">
                            <a href="#apns" aria-controls="apns" role="tab" data-toggle="tab">Apple's APNS</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="gcm">
                            <form id="gcmForm">
                                <div class="form-group">
                                    <label for="API_KEY">API Key</label>
                                    <input type="text" class="form-control" name="API_KEY" placeholder="Enter API key"
                                           value="<?=$gcmSettings->API_KEY; ?>">
                                </div>
                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="apns">
                            <form id="apnsForm">
                                <div class="form-group">
                                    <label for="token">Token</label>
                                    <input type="text" class="form-control" name="token" placeholder="Enter token"
                                           value="<?=$apnsSettings->token; ?>" disabled>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

                <div id="actions" class="">
                    <a class="btn btn-primary" href="" id="btnSavePush">
                        <i class="fa fa-save fa-fw"></i>
                        <span class="text">Save</span>
                    </a>
                    &nbsp;
                    <a class="btn btn-warning" href="" id="btnRestorePush">
                        <i class="fa fa-refresh fa-fw"></i> <span class="text">Restore Defaults</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">SMS Notifications Providers</h3>
            </div>

            <div class="panel-body">
                <div role="tabpanel" id="pushTabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#twilio" aria-controls="twilio" role="tab" data-toggle="tab">Twilio SMS</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="twilio">
                            <form id="twilioForm">

                                <div class="form-group">
                                    <label for="sid">Account SID</label>
                                    <input type="text" class="form-control" name="sid" placeholder="Enter account sid"
                                           value="<?=$twilioSettings->sid; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="token">Auth Token</label>
                                    <input type="text" class="form-control" name="token" placeholder="Enter auth token"
                                           value="<?=$twilioSettings->token; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="sender">Sender</label>
                                    <input type="text" class="form-control" name="sender" placeholder="Enter sender"
                                           value="<?=$twilioSettings->sender; ?>">
                                </div>

                            </form>
                        </div>

                    </div>

                </div>

                <div id="actions" class="">
                    <a class="btn btn-primary" href="" id="btnSaveSMS">
                        <i class="fa fa-save fa-fw"></i>
                        <span class="text">Save</span>
                    </a>
                    &nbsp;
                    <a class="btn btn-warning" href="" id="btnRestoreSMS">
                        <i class="fa fa-refresh fa-fw"></i> <span class="text">Restore Defaults</span>
                    </a>
                </div>

            </div>
        </div>
    </div>




</div>

<script>
    $("#pageActions").html('');

    $('ul.nav-tabs li a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });


    /**
     *
     * @param data
     * @returns {*}
     */
    var cleanUpProvidersArray = function (data) {
        for(var key in data) { // Prep form data to be received as Array( [PROVIDER] => Array( [KEY] => VALUE ))
            var temp = data[key];
            var provider = {};
            for(var idx in temp) {
                var obj = temp[idx];
                provider[obj.name] = obj.value;
            }
            data[key] = provider;
        }

        return data;
    };

    var saveNotificationsSettings = function (kind, button, data, debugOut) {
        var btnLabel = button.children('span.text');

        button.addClass('disabled');
        btnLabel.text("Saving...");

        $.ajax({
            type: "POST",
            url: "/dashboard/notifications/" + kind,
            data: data,
            success: function (res, textStatus, jqXHR) {
                if(debugOut) console.log(res);
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
                button.removeClass('disabled');
                btnLabel.text('Save');
            }
        });
    };


    $("#btnSaveType").click(function () {
        saveNotificationsSettings("type", $(this), $("#typeForm").serializeArray());
        return false;
    });

    $("#btnSavePush").click(function () {
        var data = {
            GCM: $("#gcmForm").serializeArray(),
            APNS: $("apnsForm").serializeArray()
        };
        saveNotificationsSettings("push", $(this), cleanUpProvidersArray(data));
        return false;
    });

    $("#btnSaveSMS").click(function () {
        var data = {
            twilio: $("#twilioForm").serializeArray()
        };
        saveNotificationsSettings("sms", $(this), cleanUpProvidersArray(data));
        return false;
    });


</script>