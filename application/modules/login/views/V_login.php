<div class="container">
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <img class="img-profile col-lg-5" src="<?= base_url('assets/img/logopupr.png'); ?>">
                                    <h1 class="h4 text-gray-900 mb-4">Sign In</h1>
                            </div>
                            <?php
                            if (isset($_GET['alert'])){
                                if ($_GET['alert'] == 'logout'){
                                    echo "<div class='alert alert-success alert-dismissible fade show' 
                                role='alert'>
                                <strong>Berhasil</strong> Logout.
                                <button type='button' class='close' data-dismiss='alert' 
                                aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                                }   
                                
                            }
                            echo $this->session->flashdata('pesan'); ?>
                            <form class="user" method="POST" action="<?= base_url('login/login_aksi'); ?>">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="username" name="username" placeholder="Enter Username...">
                                </div>
                                <div class="form-group">
                                <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-user"
                                        id="Password" name="password" placeholder="Enter Password...">
                                </div>
                                <div class="form-group">
                                <label for="sebagai">login Sebagai :</label>
                                    <select name="sebagai" id="sebagai" class= "form-control">
                                        <option value="admin">Admin</option>
                                        <option value="member">Member</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    login
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('Register'); ?>">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>