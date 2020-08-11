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
                        <button id="test" class="btn btn-primary waves-effect waves-light mb-2">Create</button>
                        <table id="mp_table" class="table table-bordered table-bordered nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">No. ID</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Project Area</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Login Status</th>
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

<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Modal title</h4>
    <div class="custom-modal-body">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                    <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <form>
                                <fieldset class="form-group">
                                    <label for="mp_id" class="form-label">No. ID *</label>
                                    <input class="form-control" type="text" name="mp_id" id="mp_id" readonly>
                                    <span class="help-block"></span>
                                    <input type="hidden" name="method" id="method">
                                    <input type="hidden" name="id" id="id">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label for="username" class="form-label">Username *</label>
                                    <input class="form-control" type="text" name="username" id="username">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label for="mp_gender" class="form-label">Gender *</label>
                                    <select name="mp_gender" id="mp_gender" class="form-control select2" style="width: 100%">
                                        <option value="MALE">Male</option>
                                        <option value="FEMALE">Female</option>
                                    </select>
                                    <span class="help-block"></span>
                                </fieldset>
                                <fieldset class="form-group">
                                    <label for="mp_dept" class="form-label">Department *</label>
                                    <select name="mp_department" id="mp_department" class="form-control select2" style="width: 100%">
                                        <option value="">Select an options</option>
                                        <?php foreach ($dept as $d) :; ?>
                                            <option value="<?= $d['department_code']; ?>"><?= $d['department_code']; ?> - <?= $d['department']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"></span>
                                </fieldset>
                                <fieldset class="form-group">
                                    <label for="mp_position" class="form-label">Position *</label>
                                    <input class="form-control" type="text" name="mp_position" id="mp_position" value="<?php if (isset($_POST["mp_position"])) echo $_POST["mp_position"]; ?>">
                                    <span class="help-block"></span>
                                </fieldset>                                
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <fieldset>
                                <div class="form-group">
                                    <label for="mp_nik" class="form-label">NIK *</label>
                                    <input class="form-control m-b-10" type="text" name="mp_nik" id="mp_nik" value="<?php if (isset($_POST["mp_nik"])) echo $_POST["mp_nik"]; ?>">
                                    <span class="help-block"></span>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                    <label for="password" class="form-label">Password *</label>
                                    <input class="form-control" type="password" name="password" id="password">
                                </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label for="mp_pa" class="form-label">Project Area *</label>
                                    <select name="mp_pa" id="mp_pa" class="form-control select2" style="width: 100%">
                                        <option value="">Select an options</option>
                                        <?php foreach ($project_area as $pa) :; ?>
                                            <option value="<?= $pa['projectarea_code']; ?>"><?= $pa['projectarea_code']; ?> - <?= $pa['projectarea_area']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block mp_pa"></span>
                                </div>
                            </fieldset>
                            <fieldset>
                                <label for="mp_poh" class="form-label">Point of Hire *</label>
                                <select name="mp_poh" id="mp_poh" class="form-control select2" style="width: 100%">
                                    <option value="">Select an options</option>
                                    <option value="HO">Head Office</option>
                                    <option value="SITE">Site</option>
                                </select>
                                <span class="help-block"></span>
                            </fieldset>
                            <fieldset>
                                <label for="mp_doh" class="form-label m-t-15">Date of hire *</label>
                                <input type="text" name="mp_doh" class="form-control" placeholder="dd/mm/yyyy" id="mp_doh">
                                <input type="hidden" name="today" id="today" value="<?= date('m/d/yy'); ?>">
                                <span class="help-block"></span>
                            </fieldset>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <div class="form-group">
                                <label for="mp_name" class="form-label">Name *</label>
                                <input class="form-control" type="text" name="mp_name" id="mp_name" value="<?php if (isset($_POST["mp_name"])) echo $_POST["mp_name"]; ?>" required>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                    <label for="role" class="form-label">Role *</label>
                                    <select name="role" id="role" class="form-control select2" style="width: 100%">
                                        <option value="">Select an options</option>
                                        <?php foreach ($role as $r) :; ?>
                                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <fieldset>
                                <label for="email" class="form-label">Email *</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </fieldset>
                            <fieldset>
                                <label for="mp_status" class="form-label m-t-15">Status *</label>
                                <select name="mp_status" id="mp_status" class="form-control select2 m-b-20" style="width: 100%">
                                    <option value="AKTIF">Aktif</option>
                                    <option value="RESIGN">Resign</option>
                                    <option value="PHK">PHK</option>
                                    <option value="MUTASI">Mutasi</option>
                                </select>
                                <span class="help-block"></span>
                            </fieldset>
                            <fieldset>
                                <label for="ls" class="form-label m-t-15">Long service</label>
                                <input class="form-control" type="text" name="ls" id="ls" readonly>
                                <a href="javascript:void(0)" type="btn btn-primary" id="btnSave" class="btn btn-primary" style="float: right">Submit</a>
                                <span class="help-block"></span>
                            </fieldset>
                        </div>

                        </form>

                    </div><!-- end row -->
                </div>
            </div><!-- end col -->
        </div>
    </div>
</div>