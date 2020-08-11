<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
        <button class="btn btn-primary waves-effect waves-light mb-2 tambahData" data-toggle="modal" data-url="<?= base_url(); ?>" data-target="#newSubMenu">Add New</button>
        </div>
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

                        
                        <table id="table" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Submenu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Is Active?</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($submenu as $m) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $m['title']; ?></td>
                                        <td><?= $m['menu']; ?></td>
                                        <td><?= $m['sort']; ?></td>
                                        <td><?= $m['url']; ?></td>
                                        <td><?= $active = ($m['is_active'] != '1' ? 'Inactive' : 'Active');  ?></td>
                                        <td>
                                            <a href="" class="badge badge-success modalUpdate" data-toggle="modal" data-target="#newSubMenu" data-id="<?= $m['id']; ?>" data-url="<?= base_url(); ?>">Update</a>
                                            <a href="<?= base_url('administrator/hapussubmenu/' . $m['id']); ?>" class="badge badge-danger delete-button">Delete</a>
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

<div class="modal fade" id="newSubMenu" role="dialog" aria-labelledby="newSubMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('administrator/submenu'); ?>" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="url" class="form-control" id="url" placeholder="URL">
                    </div>
                    <div class="form-group">
                        <input type="text" name="priority" class="form-control" id="priority" placeholder="Priority">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-group select2" style="width: 100%">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check m-l-1">
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