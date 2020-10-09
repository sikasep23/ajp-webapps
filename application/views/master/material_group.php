<div class="row">
    <div class="col-sm-12">

        <div class="btn-group m-t-15">

        </div>

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <button id="add" class="btn btn-primary waves-effect waves-light mb-2">Create</button>
                        <table id="table" class="table table-bordered table-bordered nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">PlantCost Cat</th>
                                    <th scope="col">PlantCost Subcat</th>
                                    <th scope="col">Logistic Cat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="show_data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal-master-group" class="modal-demo">
    <button type="button" class="pull-right" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Material Master</h4>

    <div class="custom-modal-body">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <form id="form">
                                <fieldset class="form-group">
                                    <label for="code" class="form-label">Code *</label>
                                    <input class="form-control" type="text" name="code" id="code" readonly>
                                    <span class="help-block"></span>
                                    <input type="hidden" name="method" id="method">
                                    <input type="hidden" name="id" id="id">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label for="group" class="form-label">Group *</label>
                                    <input class="form-control" type="text" name="group" id="group">
                                </fieldset>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <fieldset>
                                <div class="form-group">
                                    <label for="type" class="form-label">Type *</label>
                                    <select class="form-control" name="type" id="type">
                                        <option>-- Pilih Option --</option>
                                        <option value="SPAREPART">Sparepart</option>
                                        <option value="FUEL">Fuel</option>
                                        <option value="OIL">Oil</option>
                                        <option value="SERVICE">Service</option>
                                        <option value="ASSET">Asset</option>
                                        <option value="OTHER">Other</option>
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="plc-cat" class="form-label">PlaintCost Cat *</label>
                                <select class="form-control" name="plc-cat" id="plc-cat">
                                    <option>-- Pilih Option --</option>
                                    <option value="OTHER OPR">Other Opr</option>
                                    <option value="CONSUMABLE COST">Consumable Cost</option>
                                    <option value="R/M COST">R/M Cost</option>
                                </select>
                                <fieldset></fieldset>
                                <fieldset></fieldset>
                                <fieldset></fieldset>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <div class="form-group">
                                <label for="plc-subcat" class="form-label">PlaintCost Subcat *</label>
                                <select class="form-control" name="plc-subcat" id="plc-subcat">
                                    <option>-- Pilih Option --</option>
                                    <option value="FUEL">Fuel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="logistic-cat" class="form-label">Logistic Cat *</label>
                                <select class="form-control" name="logistic-cat" id="logistic-cat">
                                    <option>-- Pilih Option --</option>
                                    <option value="FUEL">Fuel</option>
                                    <option value="SPAREPART">Sparepart</option>
                                    <option value="TYRE">Tyre</option>
                                    <option value="NON SPAREPART">Non Sparepart</option>
                                    <option value="ASSET">Asset</option>
                                </select>
                            </div>
                            <fieldset class="form-group">
                                <a href="javascript:void(0)" type="btn btn-primary" id="btnSave" class="btn btn-primary" style="float: right">Submit</a>
                                <span class="help-block"></span>
                            </fieldset>
                            <fieldset></fieldset>
                            <fieldset></fieldset>
                        </div>

                        </form>

                    </div><!-- end row -->
                </div>
            </div><!-- end col -->
        </div>
    </div>
</div>