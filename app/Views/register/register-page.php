<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <?php if (!empty(session()->getFlashdata('notification-success'))) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('notification-success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <?php } ?>
                    <?php if (!empty(session()->getFlashdata('notification-danger'))) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('notification-danger'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <?php } ?>
                    <form class="user" action="<?php echo site_url(); ?>register/process" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="firstname"
                                    id="firstname" placeholder="First Name" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="lastname" id="lastname"
                                    placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email"
                                placeholder="Email Address" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" name="password"
                                    id="password" placeholder="Password" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" name="repeatPassword"
                                    id="repeatPassword" placeholder="Repeat Password" required>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-user btn-block" type="submit">
                            Register Account
                        </button>
                        <hr>
                    </form>
                    <hr>
                    <div class="text-center">
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?php echo site_url(); ?>login">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>