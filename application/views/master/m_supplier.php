<div class="card-box">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">List Data</a></li>
        </ul>
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

        <div class="tab-content">
            <div id="home" class="tab-pane fade active show">
                <br>
                <form id="form_id" method="POST" action="<?=base_url()?>master/m_supplier_add">
                    <div class="row">

                        <div class="col-6 float-left">
                            <h3>Insert data</h3>
                        </div>
                        <div class="col-6">
                            <button id="insert" class="btn btn-success float-right">Submit</button>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <div class="col-lg-10 col-sm-10 col-xs-10 col-md-10 col-xl-3">
                            <fieldset class="form-group">
                                <label for="supp_code">Supplier Code *</label>
                                <input type="text" class="form-control form-control-sm" name="supp_code" id="supp_code" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="supp_name">Supplier Name *</label>
                                <input type="text" class="form-control form-control-sm" name="supp_name" id="supp_name" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="group" class="form-label">Group *</label>
                                <select class="form-control form-control-sm" name="group" id="group" required>
                                    <option value="">-- Select group --</option>
                                    <?php foreach ($supplier_group as $sg) : ?>
                                        <option value="<?= $sg['id'] ?>"><?= $sg['sg'] . ' - ' . $sg['sg_currency'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="npwp" class="form-label">NPWP *</label>
                                <input class="form-control form-control-sm" type="text" name="npwp" id="npwp" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="city" class="form-label">City *</label>
                                <input class="form-control form-control-sm" name="city" id="city" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="address" class="form-label">address *</label>
                                <textarea name="address" id="address" class="form-control form-control-sm"  required>
                            </textarea>
                            </fieldset>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-4">
                            <fieldset class="form-group">
                                <label for="phone" class="form-label">Phone *</label>
                                <input type="number" class="form-control form-control-sm" name="phone" id="phone" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="name">Contact name *</label>
                                <input type="text" class="form-control form-control-sm" name="contact_name" id="contact_name" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="website">Website *</label>
                                <input type="text" class="form-control form-control-sm" name="website" id="website" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="top" class="form-label">TermOfPayment *</label>
                                <select class="form-control form-control-sm" name="top" id="top" required>
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit</option>
                                </select>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="limit_day" class="form-label">Limit (days) *</label>
                                <input class="form-control form-control-sm" type="number" name="limit_day" id="limit_day" required>
                            </fieldset>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-5">
                            <fieldset class="form-group">
                                <label for="ship_mode" class="form-label">Ship Mode *</label>
                                <select name="ship_mode" class="form-control form-control-sm" id="ship_mode" required>
                                    <option value="sea">Sea</option>
                                    <option value="air">Air</option>
                                    <option value="courier">Courier</option>
                                </select>
                            </fieldset>
                            <fieldset>
                                <div class="row m-b-5">
                                    <div class="col-6">
                                        <label for="tax" class="form-label">Tax *</label>
                                        <select name="tax" class="form-control form-control-sm m-b-15" id="tax" required>
                                            <option value="0">NON</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="otax" class="form-label">OTAX 1 *</label>
                                        <select name="otax" class="form-control form-control-sm" id="otax" required>
                                            <option value="0">NON</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tax" class="form-label  m-b-6 m-t-6">OTAX 2 *</label>
                                        <select name="otax2" class="form-control form-control-sm" id="otax2" required>
                                            <option value="0">NON</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                        </div>

                    </div>
            </div>
            </form>
            <div id="menu1" class="tab-pane fade">
                <br>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                <table id="m_supplier" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Supplier Code</th>
                            <th scope="col">Supplier Name</th>
                            <th scope="col">Group</th>
                            <th scope="col">NPWP</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                        <?php foreach ($supplier_data as $sd) : ?>
                            <tr>
                                <td><?= $sd['supp_code']; ?></td>
                                <td><?= $sd['supp_name']; ?></td>
                                <td><?php $q = $this->db->get_where('m_supplier_group', ['id' => $sd['supp_group']])->row_array(); echo $q['sg']; ?></td>
                                <td><?= $sd['supp_npwp']; ?></td>
                                <td><?= $sd['supp_city']; ?></td>
                                <td><?= $sd['supp_phone']; ?></td>
                                <td>
                                    <a href="#" id="delete_supp" data-id="<?= $sd['id'];?>" class="badge badge-danger"> Delete </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--<div class="tab-content">
                        <div class="tab-pane fade active show" id="home-2">
                            <div class="timeline-2">
                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">5 minutes ago</small>
                                        <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">30 minutes ago</small>
                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">59 minutes ago</small>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">1 hour ago</small>
                                        <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">3 hours ago</small>
                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">5 hours ago</small>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="messages-2">

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">Notifications</h5>
                                    <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">API Access</h5>
                                    <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">Auto Updates</h5>
                                    <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col-8">
                                    <h5 class="m-0">Online Status</h5>
                                    <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>
                                </div>
                            </div>

                        </div>
                    </div>-->