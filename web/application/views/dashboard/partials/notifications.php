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

$notificationSettings = $this->SettingsModel->getSettings('notification');
$smsSettings = $this->SettingsModel->getSettings('sms');
$pushSettings = $this->SettingsModel->getSettings('push');

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
                <form id="settingsForm">

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
                        <a class="btn btn-primary" href=""><i class="fa fa-save fa-fw"></i> Save</a>&nbsp;

                        <a class="btn btn-warning" href=""><i class="fa fa-refresh fa-fw"></i> Restore Defaults</a>
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
                    <a class="btn btn-primary" href=""><i class="fa fa-save fa-fw"></i> Save</a>&nbsp;

                    <a class="btn btn-warning" href=""><i class="fa fa-refresh fa-fw"></i> Restore Defaults</a>
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
                    <a class="btn btn-primary" href=""><i class="fa fa-save fa-fw"></i> Save</a>&nbsp;

                    <a class="btn btn-warning" href=""><i class="fa fa-refresh fa-fw"></i> Restore Defaults</a>
                </div>

            </div>
        </div>
    </div>




</div>

<script>
    $('ul.nav-tabs li a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
</script>