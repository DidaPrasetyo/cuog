<!-- MAIN POSTS -->
<div class="main-posts">
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">          
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">User Info</div>
                </div>     
                <div style="padding-top:30px" class="panel-body" >
                    <?php if ($msg != '' && $flag != 1) { ?>
                        <div id="upload-alert" class="alert alert-danger col-sm-12"><?= $msg ?></div>
                    <?php } else if ($msg != '' && $flag == 1) { ?>
                        <div id="upload-alert" class="alert alert-success col-sm-12"><?= $msg ?></div>
                    <?php } ?>
                    <form id="signupform" class="form-horizontal" role="form" action="<?= base_url(); ?>updating" method="POST">
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>
                        <?php foreach ($userInfo as $row) { ?>
                            <?= $row->email ?>
                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?= $row->email ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-md-3 control-label">Username</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $row->username ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fullname" class="col-md-3 control-label">Full name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="fullname" placeholder="Full name" value="<?= $row->fullname ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-3 control-label">New Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Button -->                                        
                                <div class="col-md-offset-3 col-md-9">
                                    <button id="btn-login" class="btn btn-success">Update Info</button>
                                </div>
                            </div>
                        <?php } ?>
                    </form>
                </div>                     
            </div>  
        </div>
    </div>
</div>