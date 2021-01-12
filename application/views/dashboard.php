<div class="row">
    <div class="col-sm-12">
        <!--div class="btn-group pull-right m-t-15">
            <button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light"
                    data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i
                        class="fa fa-cog"></i></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>

        </div-->
        <h4 class="page-title"><?= $title; ?></h4>
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-layers float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">User Request</h6>
                    <h2 class="m-b-20" data-plugin="counterup">1,587</h2>
                    <!-- <span class="label label-success"> +11% </span> <span class="text-muted">From previous period</span> -->
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-paypal float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">PO Open</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup">46,782</span></h2>
                    <!-- <span class="label label-danger"> -29% </span> <span class="text-muted">From previous period</span> -->
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-chart float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">PR Open</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup">15</span></h2>
                    <!-- <span class="label label-pink"> 0% </span> <span class="text-muted">From previous period</span> -->
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-rocket float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">User Online</h6>
                    <h2 class="m-b-20" data-plugin="counterup">1</h2>
                    <!-- <span class="label label-warning"> +89% </span> <span class="text-muted">Last year</span> -->
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-8">
                <div class="card-box">

                    <h4 class="header-title m-t-0 m-b-20">Statistics Sample</h4>

                    <div class="text-center">
                        <ul class="list-inline chart-detail-list m-b-0">
                            <li class="list-inline-item">
                                <h6 style="color: #3db9dc;"><i class="zmdi zmdi-circle-o m-r-5"></i>Series A</h6>
                            </li>
                            <li class="list-inline-item">
                                <h6 style="color: #1bb99a;"><i class="zmdi zmdi-triangle-up m-r-5"></i>Series B</h6>
                            </li>
                            <li class="list-inline-item">
                                <h6 style="color: #818a91;"><i class="zmdi zmdi-square-o m-r-5"></i>Series C</h6>
                            </li>
                        </ul>
                    </div>

                    <div id="morris-bar-stacked" style="height: 320px;"></div>

                </div>
            </div><!-- end col-->

            <div class="col-xs-12 col-lg-12 col-xl-4">
                <div class="card-box">

                    <h4 class="header-title m-t-0 m-b-30">Trends Monthly</h4>

                    <div class="text-center m-b-20">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-secondary">Today</button>
                            <button type="button" class="btn btn-sm btn-secondary">This Week</button>
                            <button type="button" class="btn btn-sm btn-secondary">Last Week</button>
                        </div>
                    </div>

                    <div id="morris-donut-example" style="height: 265px;"></div>

                    <div class="text-center">
                        <ul class="list-inline chart-detail-list mb-0 m-t-10">
                            <li class="list-inline-item">
                                <h6 style="color: #3db9dc;"><i class="zmdi zmdi-circle-o m-r-5"></i>English</h6>
                            </li>
                            <li class="list-inline-item">
                                <h6 style="color: #1bb99a;"><i class="zmdi zmdi-triangle-up m-r-5"></i>Italian</h6>
                            </li>
                            <li class="list-inline-item">
                                <h6 style="color: #818a91;"><i class="zmdi zmdi-square-o m-r-5"></i>French</h6>
                            </li>
                        </ul>
                    </div>

                </div>
            </div><!-- end col-->


        </div>

    </div>
</div>