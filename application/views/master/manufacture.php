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
                                    <input class="form-control" type="text" name="mf_code" id="mf_code" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dept" class="col-4 col-form-label">Manufacture</label>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="mf" id="mf">
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
                        <table id="table_mf" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Manufacture</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </fieldset>
                </div>



            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>