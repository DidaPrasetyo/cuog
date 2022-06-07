<!-- MAIN POSTS -->
<div class="main-posts">
    <div class="container">
        <div class="row">
            <div class="blog-masonry masonry-true">
                <?php if ($img == null) {?>
                    <div class="container post-masonry">
                        <h1 style="height:50vh;">No Image Available Right Now</h1>
                    </div>
                <?php } ?>
                <?php foreach ($img as $row) { ?>
                    <div class="post-masonry col-md-4 col-sm-6">
                        <div class="post-thumb">
                            <img src="https://dida-bucket.s3.amazonaws.com/<?= $row->filename ?>" alt="No Image">
                            <div class="title-over">
                                <h4><a href="#"><?= $row->title ?></a></h4>
                            </div>
                            <div class="post-hover text-center">
                                <div class="inside">
                                    <i class="fa fa-plus"></i>
                                    <span class="date">June 4, 2022</span>
                                    <h4><a href="#"><?= $row->title ?></a></h4>
                                    <p><?= $row->description ?></p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.post-masonry -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>