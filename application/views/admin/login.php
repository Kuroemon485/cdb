<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Login
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="form-box" id="login-box">
        <div class="header">Sign In</div>
        <form action="" method="post" id="login-form">
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="User name"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                </div>          
                <div class="form-group">
                    <input type="checkbox" name="remember-me"/> Remember me
                </div>
            </div>
            <div class="footer">                                                               
                <button type="submit" class="btn bg-olive btn-block" id="login-submit">Sign me in</button>
            </div>
        </form>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="response-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="response-title"></h4>
                </div>
                <div class="modal-body" id="response-message">
                </div>
            </div>
        </div>
    </div>
</section>
</aside>