<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <button class="btn btn-primary waves-effect waves-light mb-2 tambahData" data-toggle="modal" data-target="#newrole">Add New role</button>
        </div>
        <h4 class="page-title"><?= $title; ?></h4>

    </div>
</div>
<!-- end row -->
<div class="card col-lg-12">
    <div class="card-body">
        <div class="row">
            <div class="col-lg">
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                <table id="table" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col" width=5%>#</th>
                            <th scope="col">Role</th>
                            <th scope="col" width=10%>Is Active?</th>
                            <th scope="col">Description</th>
                            <th scope="col" width=20%>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($role as $r) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $r['role']; ?></td>
                                <td><?= $active = ($r['is_active'] == '1' ? 'Active' : 'Inactive'); ?></td>
                                <td><?= $r['deskripsi']; ?></td>
                                <td>
                                    <a href="<?= base_url('administrator/roleaccess/') . $this->enkripsi->encode($r['id']); ?>" class="badge badge-warning">Access</a>
                                    <a href="" class="badge badge-success modalUpdate" data-toggle="modal" data-target="#newrole" data-id="<?= $r['id']; ?>" data-url="<?= base_url(); ?>">Update</a>
                                    <a href="<?= base_url('administrator/rolehapus/'.$r['id']); ?>" class="badge badge-danger delete-button" data-url="<?= base_url(); ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="newrole" tabindex="-1" role="dialog" aria-labelledby="newroleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newroleLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('administrator/role'); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="role" class="form-control" id="role" placeholder="Role Name">
                    </div>
                    <div class="form-group">
                        <textarea type="textbox" name="deskripsi" class="form-control" id="deskripsi" placeholder="Description" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check m-l-3">
                            <input class="form-check-input" name="is_active" type="checkbox" value="1" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>