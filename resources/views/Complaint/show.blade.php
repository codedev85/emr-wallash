@include('partials.admin-navbar');


        <!-- Begin Page Content -->
    <div class="container-fluid">


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
            <h1 class="h3 mb-0 text-gray-800"> {{ $findPatient->user['name'] }}'s Health Profile
                - <small class="text-success">({{ $findPatient->user['unique_id'] }}) </small>

            </h1>
            @if($findPatient->status !== 2)
            <a href="{{ url('/prescriptions/'.$findPatient->id.'/add') }}" class="btn btn-primary pull-right"> Add Prescription</a>
            @else
            <span class="text-success">Prescription Given by Doctor {{ $docName->doc_name }}</span>
            @endif
          </div>

         <div class="row">

            <div class="col-lg-6">

            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                Basci Information
                </div>
                <div class="row">
                    <div class="card-body  col-md-5">
                        <h6><b>Name: </b>{{ $findPatient->user['name'] }}</h6>
                        <h6><b>Email: </b>{{ $findPatient->user['email'] }}</h6>
                        <h6><b>Phoe Number: </b>{{ $findPatient->user['phone_number']}}</h6>
                    </div>
                    <div class="col-md-7 mt-3">
                        <h6><b>Address: </b>{{ $findPatient->user['address'] }}</h6>
                        <h6><b>State: </b>{{ $findPatient->user['state'] }}</h6>
                        <h6><b>LGA: </b>{{ $findPatient->user['lga'] }}</h6>
                    </div>
                </div>
            </div>

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Genoty /Blood Group</h6>
                </div>
                <div class="card-body">
                <h5><b>Genotype: </b>{{ $findPatient->user['genotype'] }}</h5>
                <h5><b>Blood Group: </b>{{ $findPatient->user['bloodgroup']}}</h5>
                </div>
            </div>

            </div>

            <div class="col-lg-6">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Job Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                    <h4><b>Occupation:</b>{{ $findPatient->user['occupation'] }}</h4>
                    </div>
                    </div>
                </div>


            </div>

                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Health Summary / Allergies</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample1">
                    <div class="card-body">
                        {{ $findPatient->user['allergies'] }}
                    </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-12">

                <!-- Dropdown Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample5" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Symptoms</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample5">
                        <div class="card-body">
                        <h4>{{ $findPatient->symptoms }}</h4>
                        </div>
                        </div>
                    </div>
                </div>
             </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Complaints History</h1>
            <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Complaints History</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                      <th>Symptoms</th>
                      <th>Unique Id</th>
                      <th>Start Date</th>
                      <th>Slef Medication</th>
                      <th>Status</th>
                      <th>Complaint's Date</th>

                      <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                       @foreach($complaintHistories as  $history)
                          <tr>
                          <td>{{ $history->symptoms }}</td>
                          <td class="text-info">{{ $history->user->unique_id }}</td>
                          <td>{{ $history->start_date->diffForHumans() }}</td>
                          <td>{{ $history->self_medication }}</td>
                          <td>
                              @if($history->status == 0)
                             <div class="box-unread">Unread</div>
                              @elseif($history->status == 1)
                              <div class="box-read">Read</div>
                              @else
                              <div class="box-prescribed">Prescribed</div>
                              @endif

                          </td>
                          <td>{{ $history->created_at->diffforhumans() }}</td>
                          <td>
                              <div class="dropdown no-arrow mb-4">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   Action</button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/complaints/'.$history->id.'/show') }}">View</a>
                                    @if($history->status == 2)
                                    <a class="dropdown-item" href="{{ url('/prescriptions/'.$history->id.'/view') }}">View Prescription</a>
                                    @endif
                                  </div>
                                </div>
                          </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>


      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; WallashGlobal 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>


          <a class="dropdown-item"  href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Logout') }}
        </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin-2.min.js"></script>

</body>

</html>
