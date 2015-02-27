
<div class="row">
    <p class="text-muted">Content editing will be done here.</p>

    <div class="list-group col-md-4">
        <?
        $feeds = $this->FeedModel->getFeeds();
        foreach ($feeds as $feed) {
            echo "<a href='' class='list-group-item'>".$feed->title."</a>";
        }
        ?>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Click feed, display items here</p>
            </div>
        </div>
    </div>

</div>