 <div class="card-box">
 <div class="container">
    <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Home</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">List Data</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2">Document Flow</a></li>
  </ul>
    <div class="tab-content">
    <div id="home" class="tab-pane fade active show">
      <h3>Insert Data</h3>
       <div class="row">
                    <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <div class="col-lg-10 col-sm-10 col-xs-10 col-md-10 col-xl-4">
                            <form>
                            <fieldset class="form-group">
                                <label for="doc_status" class="form-label m-b-4">Doc Status *</label>
                                <input type="text" name="doc_status" id="doc_status" class="form-control">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="pr_no" class="form-label">PO No *</label>
                                <input type="text" name="pr_no" class="form-control" id="pr_no">
                            </fieldset>
                             <fieldset class="form-group">
                                <label for="doc_date" class="form-label">Doc Date *</label>
                                <input type="date" name="doc_date" class="form-control" id="doc_date">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="priority" class="form-label">Priority *</label>
                                <select name="priority" class="form-control" id="priority">
                                    <option value=""></option>
                                </select>
                            </fieldset>
                             <fieldset class="form-group">
                                    <label for="etd" class="form-label">ETD</label>
                                    <input type="text" name="etd" id="etd" class="form-control">
                            </fieldset>
                             <fieldset class="form-group">
                                    <label for="wo_type" class="form-label">WO Order Type *</label>
                                    <input type="text" name="wo_type" class="form-control" id="wo_type">
                            </fieldset>  
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <fieldset class="form-group">
                                    <label for="supplier" class="form-label">Supplier *</label>
                                    <input type="text" name="supplier" class="form-control" id="supplier">
                            </fieldset>  
                            <fieldset class="form-group">
                                    <label for="currency" class="form-label">Currency *</label>
                                    <input type="text" name="currency" class="form-control" id="currency">
                            </fieldset>
                            <fieldset class="form-group">
                                <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tax1" class="form-label">Tax 1</label>
                                        <select name="tax1" class="form-control" id="tax1">
                                            <option value=""></option>
                                        </select>  
                                    </div>
                                    <div class="col-6">
                                        <label for="time" class="form-label">Tax 2</label>
                                        <select name="tax2" class="form-control" id="tax2">
                                            <option value=""></option>
                                        </select>  
                                    </div>
                                    </div>
                                    </fieldset> 
                            <fieldset class="form-group">
                               <div class="row">
                                    <div class="col-6">
                                        <label for="bd" class="form-label">Tax 3</label>
                                        <select name="tax3" class="form-control" id="tax3">
                                            <option value=""></option>
                                        </select>    
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="project_area" class="form-label">Project Area</label>
                                        <select name="project_area" class="form-control" id="project_area">
                                            <option value=""></option>
                                        </select>  
                                    </div>
                                    <div class="col-7">
                                        <label for="form_project" class="form-label">*</label>
                                        <input type="text" name="form_project" id="form_project" class="form-control">
                                    </div>
                                </div>
                            </fieldset> 
                            <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="cost_center" class="form-label">Cost Center</label>
                                        <select name="cost_center" class="form-control" id="cost_center">
                                            <option value=""></option>
                                        </select>  
                                    </div>
                                    <div class="col-7">
                                        <label for="form_cost" class="form-label">*</label>
                                        <input type="text" name="form_cost" id="form_cost" class="form-control">
                                    </div>
                                </div>
                            </fieldset> 
                        </div>

                         <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                             <fieldset class="form-group">
                                <label for="pr_no" class="form-label">PR No *</label>
                                <select class="form-control" name="pr_no" id="pr_no">
                                    <option value=""></option>
                                </select>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="category" class="form-label">Category *</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Consignment</option>
                                </select>
                            </fieldset>
                           <fieldset class="form-group">
                                <label for="term" class="form-label">Term *</label>
                                <select class="form-control" name="term" id="term">
                                    <option value="">Credit</option>
                                </select>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="prepare_by" class="form-label">Prepare By *</label>
                                <input type="text" class="form-control" name="prepare_by" id="prepare_by">
                            </fieldset> 
                            <fieldset class="form-group">
                                <label for="verified_by" class="form-label">Verified By *</label>
                                <input type="text" class="form-control" name="verified_by" id="verified_by">
                            </fieldset> 
                             <fieldset class="form-group">
                                <label for="aproval_by" class="form-label">Aproval By *</label>
                                <input type="text" class="form-control" name="aproval_by" id="aproval_by">
                            </fieldset>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                        <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-10">
                                        <button type="submit" value="submit" name="submit" id="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                        </fieldset>
                        </div>
                        </form>

                    </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>List Data</h3>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <table id="tbl_notif" class="table table-bordered table-bordered nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">PO No</th>
                                <th scope="col">Doc Date</th>
                                <th scope="col">Category</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">PR No</th>
                                <th scope="col">Prepare By</th>
                                <th scope="col">Verified By</th>
                                <th scope="col">Approval By</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                    <tbody id="show_data">
                </tbody>
             </table>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Document Flow</h3>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <table id="tbl_notif" class="table table-bordered table-bordered nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">WO No</th>
                            </tr>
                        </thead>
                    <tbody id="show_data">
                </tbody>
             </table>
    </div>
  </div>
</div>
</div>
