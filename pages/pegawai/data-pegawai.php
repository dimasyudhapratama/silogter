<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Pegawai</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="modal fade bs-example-modal-lg" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button style="margin-left:10px;margin-bottom: 10px;" class="btn btn-primary btn-sm" data-target="#modaladd" data-toggle="modal">Tambah Data</button>
                    <table class="data-table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No.</th>
                            <th class="table-plus datatable-nosort">Name</th>
                            <th>Start Date</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
            <!-- multiple select row Datatable start -->
<!--            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">-->
<!--                <div class="clearfix mb-20">-->
<!--                    <div class="pull-left">-->
<!--                        <h5 class="text-blue">Data Table with multiple select row</h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <table class="data-table stripe hover multiple-select-row nowrap">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th class="table-plus datatable-nosort">Name</th>-->
<!--                            <th>Age</th>-->
<!--                            <th>Office</th>-->
<!--                            <th>Address</th>-->
<!--                            <th>Start Date</th>-->
<!--                            <th>Salart</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Gloria F. Mead</td>-->
<!--                            <td>25</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>20</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>25</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>20</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>18</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
            <!-- multiple select row Datatable End -->
            <!-- Export Datatable start -->
<!--            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">-->
<!--                <div class="clearfix mb-20">-->
<!--                    <div class="pull-left">-->
<!--                        <h5 class="text-blue">Data Table with Export Buttons</h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <table class="stripe hover multiple-select-row data-table-export nowrap">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th class="table-plus datatable-nosort">Name</th>-->
<!--                            <th>Age</th>-->
<!--                            <th>Office</th>-->
<!--                            <th>Address</th>-->
<!--                            <th>Start Date</th>-->
<!--                            <th>Salart</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Gloria F. Mead</td>-->
<!--                            <td>25</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>20</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>25</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>2829 Trainer Avenue Peoria, IL 61602 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>20</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>18</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Sagittarius</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="table-plus">Andrea J. Cagle</td>-->
<!--                            <td>30</td>-->
<!--                            <td>Gemini</td>-->
<!--                            <td>1280 Prospect Valley Road Long Beach, CA 90802 </td>-->
<!--                            <td>29-03-2018</td>-->
<!--                            <td>$162,700</td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
            <!-- Export Datatable End -->
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</div>