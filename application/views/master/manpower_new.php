<div class="row">
    <div class="col-12">
    <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30"><?= $title;?></h4>

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                    <form method="POST" action="<?= base_url();?>master/manpower_new">
                        <fieldset class="form-group">
                            <label for="mp_id" class="form-label">No. ID *</label>
                            <input class="form-control" type="text" name="mp_id" id="mp_id" value="<?php if(isset($_POST["mp_id"])) echo $_POST["mp_id"]; ?>">
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="mp_gender" class="form-label">Gender *</label>
                            <select name="mp_gender" id="mp_gender" class="form-control select2" style="width: 100%">
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="mp_dept" class="form-label">Department *</label>
                            <select name="mp_department" id="mp_department" class="form-control select2" style="width: 100%">
                                <option value="">Select an options</option>
                                <?php foreach ($dept as $d) :; ?>
                                    <option value="<?= $d['department_code']; ?>"><?= $d['department_code']; ?> - <?= $d['department']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="mp_position" class="form-label">Position *</label>
                            <input class="form-control" type="text" name="mp_position" id="mp_position" value="<?php if(isset($_POST["mp_position"])) echo $_POST["mp_position"]; ?>">
                        </fieldset>
                        <a href="<?= base_url('master/manpower_new'); ?>"><button type="submit" class="btn btn-primary waves-effect waves-light mb-2">Submit data</button></a>
                </div>

                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                    <fieldset>
                        <div class="form-group">

                            <label for="mp_nik" class="form-label">NIK *</label>
                            <input class="form-control m-b-10" type="text" name="mp_nik" id="mp_nik" value="<?php if(isset($_POST["mp_nik"])) echo $_POST["mp_nik"]; ?>">
                        </div>
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
                        </div>
                    </fieldset>
                    <fieldset>
                        <label for="mp_poh" class="form-label">Point of Hire *</label>
                        <select name="mp_poh" id="mp_poh" class="form-control select2" style="width: 100%">
                            <option value="">Select an options</option>
                            <option value="HO">Head Office</option>
                            <option value="SITE">Site</option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <label for="mp_doh" class="form-label m-t-15">Date of hire *</label>
                        <input type="text" name="mp_doh" class="form-control" placeholder="dd/mm/yyyy" id="mp_doh">
                        <input type="hidden" name="today" id="today" value="<?= date('m/d/yy'); ?>">
                    </fieldset>                    
                </div>

                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                    <fieldset class="form-group">
                        <label for="mp_name" class="form-label">Name *</label>
                        <input class="form-control" type="text" name="mp_name" id="mp_name" value="<?php if(isset($_POST["mp_name"])) echo $_POST["mp_name"]; ?>">
                    </fieldset>
                    <fieldset>
                        <label for="mp_mpstatus" class="form-label">Emp status *</label>
                        <select name="mp_mpstatus" id="mp_mpstatus" class="form-control select2" style="width: 100%">
                            <option value="PERMANENT">Permanent</option>
                            <option value="PERCOBAAN">Percobaan</option>
                            <option value="HARIAN">Harian</option>
                            <option value="KONTRAK">Kontrak</option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <label for="mp_status" class="form-label m-t-15">Status *</label>
                        <select name="mp_status" id="mp_status" class="form-control select2" style="width: 100%">
                            <option value="AKTIF">Aktif</option>
                            <option value="RESIGN">Resign</option>
                            <option value="PHK">PHK</option>
                            <option value="MUTASI">Mutasi</option>
                        </select>
                    </fieldset>                   
                    
                    <fieldset>         
                    <label for="ls" class="form-label m-t-15">Long service</label>               
                        <input class="form-control" type="text" name="ls" id="ls" readonly>
                    </fieldset>
                    </form>
                </div>

            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div>