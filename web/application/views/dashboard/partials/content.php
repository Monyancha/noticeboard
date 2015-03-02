<?
$feeds = $this->FeedModel->getFeeds();
$items = array();
foreach($feeds as $feed) {
    $feedItems = $this->ItemModel->getFeedItems($feed->id);
    foreach($feedItems as $item) {
        $item->feed = $feed->title;
        $item->date = date("D, d M Y H:i:s T", strtotime($item->date));
        array_push($items, $item);
    }
}
?>


<style>
    #itemsContent {
        min-height: 512px;
    }

    .itemRow {
        cursor: pointer;
    }

    #contentTable {
        font-size: .9em;
    }

    #contentTable_wrapper div.row:first-of-type,
    #contentTable_wrapper div.row:last-of-type {
        padding-left: 10px;
        padding-right: 10px;
    }

</style>

<? // Actions  ?>
<span style="display: none;" class="hiddenActions">
    <span id="newContentHiddenAction" ng-click="addNewContent()"></span>
    <span id="editContentHiddenAction" ng-click="editContent()">
        <input type="hidden" ng-model="currentContent">
    </span>
</span>

<div id="itemsContent" class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum euismod enim, in dapibus arcu
                    ornare nec. Aliquam erat volutpat. Quisque id nunc vitae augue tempor sodales a non metus. Nullam euismod
                    nibh ligula. Nullam placerat ac tortor sed tempor. Phasellus aliquam vehicula erat, vel pharetra eros
                    vehicula sit amet. Maecenas orci erat, bibendum sed fringilla in, aliquam eu metus. Aliquam a magna est.
                    Vivamus ac ante suscipit, laoreet elit et, sollicitudin elit. Pellentesque sed augue eget eros accumsan gravida.</p>

            </div>

            <table id="contentTable" class="table table-responsive display" width="100%">
                <thead>
                <tr>
                    <th><input type="checkbox" id="chkAllItems" data-toggle="tooltip" data-placement="top" title="Check All"></th>
                    <th>Date</th>
                    <th width="25%">Title</th>
                    <th width="30%">Description</th>
                    <th width="15%">Feed</th>
                    <th width="15%">Author</th>
                    <th>Notifications</th>
                </tr>
                </thead>
                <tbody>

                <?
                foreach ($items as $item) {
                    echo "<tr data-item='{$item->id}' class='itemRow' data-toggle='context' data-target='#context-menu' title='Right-click for more actions'>";
                    echo "<td><input type='checkbox' class='itemCheckBox' value='{$item->id}'></td>";
                    echo "<td>" . $item->date . "</td>";
                    echo "<td>" . limitCharacters($item->title) . "</td>";
                    echo "<td>" . limitCharacters($item->description) . "</td>";
                    echo "<td>" . $item->feed . "</td>";
                    echo "<td>" . $item->author . "</td>";

                    if($item->notified) {
                        echo "<td><kbd>Sent</kbd></td>";
                    } else {
                        echo "<td><code>Not Sent</code></td>";
                    }
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

</div>

<script src="/assets/bower_components/bootstrap-contextmenu/bootstrap-contextmenu.js"></script>
<script>


    /**
     *
     * @returns {Array}
     */
    var getSelectedContent = function () {
        var result = [];
        $(".itemCheckBox").each(function (){
            if($(this).is(":checked")){
                result.push($(this).val());
            }
        });
        return result;
    };

    /**
     *
     * @param data
     */
    var postContentAction = function (url, data) {
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
            }
        });
    };

    $(function () {

        var actionsHtml = '<button id="btnAddContent" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Post new content"><i class="fa fa-plus fa-fw"></i></button> &nbsp;';
        actionsHtml += '<button id="btnDeleteContent" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete selected content"><i class="fa fa-trash fa-fw"></i></button> &nbsp;';
        actionsHtml += '<button id="btnNotifyContent" type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Send notifications of selected content"><i class="fa fa-paper-plane fa-fw"></i></button> &nbsp;';
        $("#pageActions").html(actionsHtml);
        $("#pageActions button").tooltip();

        $("#btnAddContent").click(function(){
            $("#newContentHiddenAction").click();
            return false;
        });

        $("#btnDeleteContent").click(function(){
            var ids = getSelectedContent();
            if(ids.length > 0) {
                BootstrapDialog.confirm({
                    message: 'Do you want to delete the selected post(s)?',
                    type: BootstrapDialog.TYPE_WARNING,
                    btnCancelLabel: 'No',
                    btnOKLabel: 'Yes',
                    callback: function (yes) {
                        if (yes) {
                            $("#startLoadingAction").click();
                            postContentAction("/dashboard/content/remove", {ids: ids});
                        }
                    }
                });
            }
            return false;
        });

        $("#btnNotifyContent").click(function(){
            var ids = getSelectedContent();
            if(ids.length > 0) {
                BootstrapDialog.confirm({
                    message: 'Do you want to sent notifications of the selected post(s)?',
                    type: BootstrapDialog.TYPE_WARNING,
                    btnCancelLabel: 'No',
                    btnOKLabel: 'Yes',
                    callback: function (yes) {
                        if (yes) {
                            $("#startLoadingAction").click();
                            postContentAction("/dashboard/content/notify", {ids: ids});
                        }
                    }
                });
            }
            return false;
        });

        $('#contentTable').DataTable({
            "order": [[ 1, "desc" ]],
            "columnDefs": [
                {
                    "targets": 0,
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 1,
                    "visible": false
                }
            ]
        });

        var checkAllItems = $("#chkAllItems");
        checkAllItems.tooltip();
        checkAllItems.change(function () {
            var checked = $(this).is(":checked");
            $(".itemCheckBox").prop('checked',checked);
        });

        $(".itemRow").contextmenu({
            onItem: function (context, e) {
                e.preventDefault();
                var itemId = $(context).attr('data-item');
                var action = $(e.target).attr('data-action');
                switch (action) {
                    case 'remove':
                        BootstrapDialog.confirm({
                            message: 'Do you want to delete this post?',
                            type: BootstrapDialog.TYPE_WARNING,
                            btnCancelLabel: 'No',
                            btnOKLabel: 'Yes',
                            callback: function (yes) {
                                if (yes) {
                                    postContentAction("/dashboard/content/remove", {ids: [itemId]});
                                }
                            }
                        });

                        break;
                    case 'edit':
                        $("#editContentHiddenAction input").val(itemId);
                        $("#editContentHiddenAction").click();
                        break;
                }
            }
        });

    });
</script>