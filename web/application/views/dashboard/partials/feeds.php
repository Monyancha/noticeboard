<style>
    #feedsContent {
        min-height: 512px;
    }

    .feedRow {
        cursor: pointer;
    }

    #feedsTable_wrapper div.row:first-of-type,
    #feedsTable_wrapper div.row:last-of-type {
        padding-left: 10px;
        padding-right: 10px;
    }

</style>

<div id="feedsContent" class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum euismod enim, in dapibus arcu
                ornare nec. Aliquam erat volutpat. Quisque id nunc vitae augue tempor sodales a non metus. Nullam euismod
                nibh ligula. Nullam placerat ac tortor sed tempor. Phasellus aliquam vehicula erat, vel pharetra eros
                vehicula sit amet. Maecenas orci erat, bibendum sed fringilla in, aliquam eu metus. Aliquam a magna est.
                Vivamus ac ante suscipit, laoreet elit et, sollicitudin elit. Pellentesque sed augue eget eros accumsan gravida.</p>

<!--            <button id="addFeed" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus fa-fw"></i> New Feed</button>-->

        </div>

        <table id="feedsTable" class="table table-responsive display">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Slug</th>
            </tr>
            </thead>
            <tbody>

            <?
            $feeds = $this->FeedModel->getFeeds();
            foreach ($feeds as $feed) {
                echo "<tr data-feed='{$feed->id}' class='feedRow' data-toggle='context' data-target='#context-menu' title='Right-click for actions'>";
                echo "<td>" . $feed->title . "</td>";
                echo "<td>" . $feed->description . "</td>";
                echo "<td>" . $feed->slug . "</td>";
                echo "</tr>";
            }

            ?>

            </tbody>
        </table>

    </div>

    <div id="context-menu">
        <ul class="dropdown-menu" role="menu">
            <li><a tabindex="0" href="" data-action="edit">Edit</a></li>
            <li><a tabindex="1" href="" data-action="remove">Delete</a></li>
        </ul>
    </div>

</div>

<script src="/assets/bower_components/bootstrap-contextmenu/bootstrap-contextmenu.js"></script>
<script>

    var addOrEditFeed = function (title, url, feedId) {
        var templateUrl = '/dashboard/partial/feed_edit';
        if (feedId) {
            templateUrl += "?feed=" + feedId;
        }

        BootstrapDialog.show({
            title: title,
            type: BootstrapDialog.TYPE_PRIMARY,
            message: $('<div></div>').load(templateUrl),
            buttons: [
                {
                    icon: 'fa fa-save',
                    label: 'Save',
                    cssClass: 'btn-primary',
                    autospin: false,
                    action: function (dialogRef) {
                        var $button = this;
                        $button.disable();
                        $button.spin();
                        dialogRef.setClosable(false);

                        // TODO: Validate data
                        var data = $("#feedForm").serializeArray();

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: data,
                            success: function (res, textStatus, jqXHR) {
                                location.reload();
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
                                dialogRef.close();
                            }
                        });


                    }
                }
            ]
        });
    };

    function onAddFeedClick() {
        addOrEditFeed("New Feed", "/dashboard/feed/add");
        return false;
    }

    $(function () {

        var actionsHtml = '<button type="button" onclick="onAddFeedClick()" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Add new feed"><i class="fa fa-plus fa-fw"></i></button>';
        $("#pageActions").html(actionsHtml);
        $("#pageActions button").tooltip();


        $('#feedsTable').DataTable({});


        $('.feedRow').contextmenu({
            onItem: function (context, e) {
                e.preventDefault();
                var feedId = $(context).attr('data-feed');
                var action = $(e.target).attr('data-action');

                switch (action) {
                    case 'remove':
                        BootstrapDialog.confirm({
                            message: 'Do you want to delete this feed?',
                            type: BootstrapDialog.TYPE_WARNING,
                            btnCancelLabel: 'No',
                            btnOKLabel: 'Yes',
                            callback: function (yes) {
                                if (yes) {

                                    $.ajax({
                                        type: "POST",
                                        url: "/dashboard/feed/remove",
                                        data: {id: feedId},
                                        success: function (res, textStatus, jqXHR) {
                                            location.reload();
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

                                }
                            }
                        });

                        break;
                    case 'edit':
                        addOrEditFeed("Edit Feed", "/dashboard/feed/update", feedId);
                        break;
                }
            }
        });

    });
</script>