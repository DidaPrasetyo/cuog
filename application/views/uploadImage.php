<!-- MAIN POSTS -->
<div class="main-posts">
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">          
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Upload Image</div>
                </div>     
                <div style="padding-top:30px" class="panel-body" >
                    <?php if ($msg != '' && $flag != 1) { ?>
                        <div id="upload-alert" class="alert alert-danger col-sm-12"><?= $msg ?></div>
                    <?php } else if ($msg != '' && $flag == 1) { ?>
                        <div id="upload-alert" class="alert alert-success col-sm-12"><?= $msg ?></div>
                    <?php } ?>
                    <form id="uploadform" class="form-horizontal" role="form" action="<?= base_url() ?>uploading" method="POST" enctype="multipart/form-data">
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            <input id="title" type="text" class="form-control" name="title" placeholder="Image Title" maxlength="30" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                            <textarea id="desc" class="form-control" name="desc" placeholder="Description" required></textarea>
                        </div>
                         <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            <input type="file" class="form-control" id="uploadFile" name="uploadFile" />
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button id="btn-login" class="btn btn-success">Upload</button>
                            </div>
                        </div>  
                    </form>
                </div>                     
            </div>  
        </div>
    </div>
</div>