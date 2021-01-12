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
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="action_stat" id="action_stat" value="added">
                            <div class="form-group row ">
                                <label for="sg_code" class="col-4 col-form-label">Code *</label>
                                <div class="col-8">
                                    <input class="form-control form-control-sm" type="text" name="code" id="code" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sg" class="col-4 col-form-label">Storage *</label>
                                <div class="col-8">
                                    <input class="form-control form-control-sm" type="text" name="storage" id="storage">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sg" class="col-4 col-form-label">Project *</label>
                                <div class="col-8">
                                    <select name="project" id="project" class="form-control form-control-sm">
                                        <option value="">Select project</option>
                                        <?php foreach ($project as $p) : ?>
                                            <option value="<?= $p['id']?>"><?= $p['projectarea_code'].'-'.$p['projectarea_area'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sg" class="col-4 col-form-label">Type *</label>
                                <div class="col-8">
                                    <input class="form-control form-control-sm" type="text" name="type" id="type">
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
                        <table id="storage_table" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Project area</th>
                                    <th scope="col">Storage</th>
                                    <th scope="col">Type</th>
                                    <th width="20%" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="show_data">
                            </tbody>
                        </table>
                    </fieldset>
                </div>



            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>