<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">  
                <h4 class="m-0 font-weight-bold text-primary"> 
                    Database Admin
                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" 
                    data-target="#tambahadmin">
                    <i class="fas fa-user-plus"></i> Add      
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <div class="tabel-responsive">
                    <?php // var_dump($admin); ?>
                    <table class="table table-bordered" id="dataTable">
                    <thead align="center">
                        <tr>
                            <th width="1%">No</th>
                            <th width="20%">Username</th>
                            <th width="20%">Password</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         $no = '1';
                        foreach($admin as $a):
                        ?>
                            <tr>
                                <td align="center"><?= $no++; ?></td>
                                <td><?= $a->username; ?></td>
                                <td><?= md5($a->password); ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-sm btn-warning" 
                                    data-toggle="modal" data-target="#ubahAdmin<?= $a->id; ?>">
                                    <i class="fas fa-edit"></i> Edit      
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                    data-toggle="modal" data-target="#deleteAdminModal<?= $a->id; ?>">
                                    <i class="fas fa-trash"></i> Delete     
                                    </button>
                                </td>
                             </tr>  
                        <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

<!-- modal add -->
<div class="modal fade" id="tambahadmin" tabindex="-1" aria-labelledby="exampleModalLabel" 
aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah Admin</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?= base_url('admin/tambah'); ?>">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username"
            placeholder="Enter Your Username..." >
          </div>
          <div class="mb-3">
            <label for="password"
             class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password"
            placeholder="Enter Your Password..." >
          </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal add -->

<!-- modal edit -->
<?php foreach($admin as $a) : ?>
<div class="modal fade" id="ubahAdmin<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" 
aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Edit Data Admin</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?= base_url('admin/edit'); ?>">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="hidden" name="id" value="<?= $a->id; ?>">
            <input type="text" class="form-control" id="username" name="username" value="<?= $a->username; ?>">
          </div>
          <div class="mb-3">
            <label for="password"class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $a->password; ?>">
          </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
<!-- akhir modal edit -->

<!-- Modal Hapus -->
    <?php
    foreach ($admin as $a) :
    ?>
        <div class="modal fade" id="deleteAdminModal<?php echo $a->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">Delete data?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Yes" for <b>confirm</b>, or "No" for <b>cancel</b></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                        <a class="btn btn-danger" href="<?= base_url('Admin/delete/') . $a->id; ?>">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- akhir modal hapus -->

  
