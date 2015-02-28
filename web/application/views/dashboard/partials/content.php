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

            <table id="contentTable" class="table table-responsive display">
                <thead>
                <tr>
                    <th><input type="checkbox" id="chkAllItems" data-toggle="tooltip" data-placement="top" title="Check All"></th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Feed</th>
                    <th>Author</th>
                </tr>
                </thead>
                <tbody>

                <?
                foreach ($items as $item) {
                    echo "<tr data-item='{$item->id}' class='itemRow' data-toggle='context' data-target='#context-menu' title='Right-click for more actions'>";
                    echo "<td><input type='checkbox' class='itemCheckBox'></td>";
                    echo "<td>" . $item->date . "</td>";
                    echo "<td>" . limitCharacters($item->title) . "</td>";
                    echo "<td>" . limitCharacters($item->description) . "</td>";
                    echo "<td>" . $item->feed . "</td>";
                    echo "<td>" . $item->author . "</td>";
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
    $(function () {

        var actionsHtml = '<button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Post new content"><i class="fa fa-plus fa-fw"></i></button> &nbsp;';
        actionsHtml += '<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete selected content"><i class="fa fa-trash fa-fw"></i></button> &nbsp;';
        actionsHtml += '<button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Send notifications of selected content"><i class="fa fa-paper-plane fa-fw"></i></button> &nbsp;';
        $("#pageActions").html(actionsHtml);
        $("#pageActions button").tooltip();

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

        $("#itemRow").contextmenu({
            onItem: function (context, e) {
                e.preventDefault();
                var itemId = $(context).attr('data-item');
                var action = $(e.target).attr('data-action');
            }
        });

    });
</script>