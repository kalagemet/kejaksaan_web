<!DOCTYPE html>
<html lang="en" dir="">
<?php echo view('admin/layout/head');?>

<body class="bg-gradient-primary" id="page-top">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="min-height: 500px;">
                            <div style="background-image: url(/assets/img/kejaksaan_logo.svg)"
                                class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Portal Admin</h1>
                                    </div>
                                    <form method="post" action="" class="user">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingat saya</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block">
                                        </input>
                                        <hr>
                                    </form>
                                    <hr>
                                    <?php if (!empty(session()->getFlashdata('message'))) {
                                        echo '<div class="card bg-warning text-white shadow">
                                                <div class="card-body">
                                                    <div class="text-white-50 small">'.
                                                        session()->getFlashdata('message').
                                                    '</div>
                                                </div>
                                            </div>';
                                        } elseif (!empty(session()->getFlashdata('error'))) {
                                            echo '<div class="card bg-danger text-white shadow">
                                                <div class="card-body">
                                                    <div class="text-white-50 small">'.
                                                        session()->getFlashdata('error').
                                                    '</div>
                                                </div>
                                            </div>';
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- End of Content -->
</body>

</html>