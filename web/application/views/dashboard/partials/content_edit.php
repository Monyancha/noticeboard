<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : content_edut.php
 *  Date : 2/28/15 3:45 PM
 *  Description :
 *
 */
$feeds = $this->FeedModel->getFeeds();
$itemId = $this->input->get("content");
$item = ($itemId >= 0) ? $this->ItemModel->getItem($itemId) : null;
$itemFeed = null;
$title = null;
$desc = null;
$content = null;
$author = $user->name;
$image = null;
$link = null;

if ($item) {
    $itemFeed = $item->feed;
    $title = $item->title;
    $desc = $item->description;
    $content = $item->content;
    $author = $item->author;
    $image = $item->image;
    $link = $item->link;
}

?>

<style>
    @import "/assets/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css";

    #editContent {
        min-height: 512px;
    }

    #itemTabs div.tab-content {
        padding: 15px;
    }
</style>

<? // Actions  ?>
<span style="display: none;" class="hiddenActions">
    <span id="backToContentHiddenAction" ng-click="backToContent()"></span>
</span>

<div id="editContent" class="row">

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum euismod enim, in dapibus arcu
        ornare nec. Aliquam erat volutpat. Quisque id nunc vitae augue tempor sodales a non metus.</p>

    <div class="panel panel-default">
        <div class="panel-body">
            <form id="itemForm">
                <? if ($itemId) { ?>
                    <input type="hidden" name="id" value="<?= $itemId; ?>">
                <? } ?>

                <div role="tabpanel" id="itemTabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#meta" aria-controls="meta" role="tab" data-toggle="tab">Publishing</a>
                        </li>

                        <li role="presentation">
                            <a href="#cont" aria-controls="cont" role="tab" data-toggle="tab">Content</a>
                        </li>

                        <li role="presentation">
                            <a href="#img" aria-controls="img" role="tab" data-toggle="tab">Image and link</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="meta">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title"
                                       value="<?= $title; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="feed">Feed</label>
                                <select name="feed" class="form-control">
                                    <? foreach ($feeds as $feed) { ?>
                                        <option
                                            value="<?= $feed->id; ?>" <?= $itemFeed === $feed->id ? "selected" : ""; ?>>
                                            <?= $feed->title; ?>
                                        </option>
                                    <? } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" name="author" placeholder="Enter author"
                                       value="<?= $author; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter description"
                                          required><?= $desc; ?></textarea>
                            </div>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="img">
                            <div class="form-group">
                                <label for="image">Post Image</label>
                                <input type="url" class="form-control" name="image" placeholder="http://www.site.com/image.png"
                                       value="<?= $image; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="url">External link</label>
                                <input type="url" class="form-control" name="link" placeholder="http://www.site.com/post.html"
                                       value="<?= $link; ?>">
                            </div>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="cont">
                            <textarea id="postContent" name="content" class="form-control"
                                      placeholder="Enter content" required><?= $content; ?></textarea>
                        </div>

                    </div>

                </div>


            </form>
        </div>
    </div>

</div>
<script src="/assets/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
<script>

    var actionsHtml = '<button id="btnSaveContent" type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Save"><i class="fa fa-save fa-fw"></i></button> &nbsp;';
    actionsHtml += '<button id="btnDiscardContent" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Discard"><i class="fa fa-close fa-fw"></i></button> &nbsp;';
    $("#pageActions").html(actionsHtml);
    $("#pageActions button").tooltip();

    $("#btnSaveContent").click(function () {
        $("#startLoadingAction").click();

        var data = $("#itemForm").serializeArray();
        var editMode = false;
        var url = "/dashboard/content/";
        for(var idx in data) {
            if(data[idx].name == "id") {
                editMode = true;
                break;
            }
        }
        if(editMode) { url += "update"; }
        else { url += "add"; }

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (res, textStatus, jqXHR) {
                $("#backToContentHiddenAction").click();
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
            }
        });

        return false;
    });

    $("#btnDiscardContent").click(function () {
        $("#backToContentHiddenAction").click();
        return false;
    });

    $('#itemTabs ul.nav-tabs li a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $(function () {
        $('#postContent').wysihtml5({
            toolbar: {
                "fa": true,
                "html": true
            }
        });
    });

</script>