<style>
    #feedsContent {
        min-height: 512px;
    }

    .feedRow {
        cursor: pointer;
    }

    .toolbar {
        float: left;
    }
</style>

<div id="feedsContent" class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">
            <table id="feedsTable" class="display">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
                </tr>
                </thead>
                <tbody>

                <?
                $feeds = $this->FeedModel->getFeeds();
                foreach ($feeds as $feed) {
                    echo "<tr data-feed='{$feed->id}' class='feedRow' data-toggle='context' data-target='#context-menu' title='Right-click for actions'>";
                    echo "<td>" . $feed->title . "</td>";
                    echo "<td>" . $feed->description . "</td>";
                    echo "<td><code>" . $feed->url . "</code></td>";
                    echo "</tr>";
                }

                ?>

                </tbody>
            </table>
        </div>
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

    $(function () {
        $('#feedsTable').DataTable({
            "dom": '<"toolbar">frtip'
        });
        var toolbarHtml = '<a id="addFeed" class="btn btn-sm btn-primary btn-outline"><i class="fa fa-plus fa-fw"></i>New Feed</a>' +
            '<br/>&nbsp;&nbsp;';
        $("div.toolbar").html(toolbarHtml);

        $("#addFeed").click(function () {
            addOrEditFeed("New Feed", "/dashboard/feed/add");
            return false;
        });

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