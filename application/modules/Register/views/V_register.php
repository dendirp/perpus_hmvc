<div class="container">
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Sign Up</h1>
                            </div>
                            <?= $this->session->flashdata('pesan'); ?>
                            <form class="user" method="POST" action="<?= base_url('Register/tambah'); ?>">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="username" name="username" placeholder="Member">
                                </div>
                                <div class="form-group">
                                <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-user"
                                        id="Password" name="password" placeholder="Enter Password...">
                                </div>
                                <div class="form-group">
                                    <label for="sebagai">Daftar Sebagai :</label>
                                    <input type="text" class="form-control form-control-user"
                                    placeholder="Member" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('login'); ?>">I have Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>