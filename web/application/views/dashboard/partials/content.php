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

</style>
<div id="itemsContent" class="row">


    <div class="btn-toolbar" role="toolbar" aria-label="...">
        <div class="btn-group btn-group-sm" role="group" aria-label="...">
            <button type="button" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> New Item</button>
        </div>

        <div class="btn-group btn-group-sm" role="group" aria-label="...">
            <button type="button" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> Delete Item(s)</button>
        </div>


        <div class="btn-group btn-group-sm" role="group" aria-label="...">
            <button type="button" class="btn btn-warning"><i class="fa fa-info fa-fw"></i> Resend Notifications</button>
        </div>
    </div>

    <br/>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">


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

        $("#addFeed").click(function () {
            return false;
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