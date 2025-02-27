<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">

        </div>
        <h4 class="page-title"><?= $title; ?></h4>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                    <form id="form">
                        <fieldset class="form-group">
                            <h4 id="title-form" class="header-title m-t-0 m-b-30">Input Data</h4>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="action_stat" id="action_stat" value="added">
                            <div class="form-group row ">
                                <label for="dept_code" class="col-4 col-form-label">Code *</label>
                                <div class="col-8">
                                    <input class="form-control form-control-sm" type="text" name="mu_code" id="mu_code" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dept" class="col-4 col-form-label">Model unit</label>
                                <div class="col-8">
                                    <input class="form-control form-control-sm" type="text" name="mu" id="mu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dept" class="col-4 col-form-label">Manufacture</label>
                                <div class="col-8">
                                    <select class="form-control form-control-sm select2" name="mu_manufacture" id="mu_manufacture">
                                        <option></option>
                                    <?php foreach ($manufacture as $m):?>
                                        <option value="<?= $m['manufacture_code'];?>"><?= $m['manufacture'];?></option>
                                    <?php endforeach?>
                                    </select>
                                </div>
                            </div>
                            <div style="float: right">
                                <a href="javascript:void(0)" type="btn btn-primary" id="btnSave" class="btn btn-primary">Save</a>
                                <a href="javascript:void(0)" type="button" id="cancel" class="btn btn-danger">Cancel</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-8">
                    <fieldset class="form-group">
                        <table id="mu_table" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Model Name</th>
                                    <th scope="col">Manufacture</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>