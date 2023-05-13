<?php include '../config/sessions.php';?>
<?php include 'header.php';?>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <h1 class="text-white font-light-600">I.M.S</h1>
                        <small class="text-uppercase">inventory management system</small>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="login-form" action="<?php echo FORM_PATH ?>" method="POST">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <!-- form header content -->
                                <h4 class="font-light-300 text-white">Welcome back, <?php if(is_string($user_fullname)) echo $user_fullname ;?></h4>
                                <!-- alert -->
                                <div class="ul-alert alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-content"></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="u-pass">
                                    <input type="hidden" name="u-name" id="u-name" value="<?php echo $user_name;?>">
                                    <div class="input-group-prepend">
                                        <button class="input-group-text bg-warning text-white" id="btn-pass" type="button"><i class="fas fa-eye-slash" id="eye-icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <!-- <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button> -->
                                        <button class="btn btn-info" type="button" id="btn-reset">Home</button>
                                        <button class="btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
<?php include 'footer.php';?>