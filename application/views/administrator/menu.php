<div class="row">
    <div class="col-sm-12">
        <!--div class="btn-group pull-right m-t-15">
            <button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light"
                    data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i
                        class="fa fa-cog"></i></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>

        </div-->
        <h4 class="page-title"><?= $title; ?></h4>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                        <button class="btn btn-primary waves-effect waves-light mb-2 tambahData" data-toggle="modal" data-url="<?= base_url(); ?>" data-target="#newMenu">Add New</button>
                        <table id="table" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Is Active?</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($menu as $m) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $m['menu']; ?></td>
                                        <td><?= $m['icon']; ?></td>
                                        <td><?= $m['sort']; ?></td>
                                        <td><?= $active = ($m['is_active'] == '1' ? 'Active' : 'Inactive'); ?></td>
                                        <td>
                                            <a href="" class="badge badge-success modalUpdate" data-toggle="modal" data-target="#newMenu" data-id="<?= $m['id']; ?>" data-url="<?= base_url(); ?>">Update</a>
                                            <a href="<?= base_url('administrator/hapusmenu/' . $this->enkripsi->encode($m['id'])); ?>" class="badge badge-danger delete-button">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="newMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('administrator/menu'); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="menu" class="form-control" id="menu" placeholder="Menu Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="icon" class="form-control" id="icon" placeholder="Menu Icon">
                    </div>
                    <div class="form-group">
                        <input type="text" name="sort" class="form-control" id="sort" placeholder="Priority">
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