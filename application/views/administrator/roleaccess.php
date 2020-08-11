<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <a href="<?= base_url('administrator/role');?>"><button class="btn btn-primary waves-effect waves-light mb-2">Back</button></a>
        </div>
        <h4 class="page-title"><?= $title; ?></h4>

    </div>
</div>
<!-- end row -->
<div class="card col-lg-12">
    <div class="card-body">
        <div class="row">
            <div class="col-lg">
                <?= $this->session->flashdata('message'); ?>
                <H5>Role : <?= $role['role']; ?></H5>
                <table id="table" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col" width=5%>#</th>
                            <th scope="col">Sub Menu</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($menu as $m) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $m['submenu']; ?></td>
                                <td><?= $m['menu']; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="" <?= check_access($role['id'], $m['mid'], $m['smid']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['mid']; ?>" data-submenu="<?= $m['smid']; ?>" data-url="<?= base_url(); ?>" data-encode="<?= $this->enkripsi->encode($role['id']); ?>">
                                        <?= (check_access($role['id'], $m['mid'], $m['smid']) == 'checked' ? 'Allowed access' : 'Disallow access'); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>