@include('partials.admin-navbar');

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Profile Setting</h1>
          </div>

         <div class="row">

            <div class="col-lg-6">

            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="d-sm-flex align-items-center justify-content-between   card-header py-3">
                    <h5 class="h5 mb-0 text-gray-800">
                        Profile Setting
                    </h5>
                    <a href="{{ url('/prescriptions/add') }}" class="btn btn-info pull-right"> Update Basic Information</a>
                  </div>


                <div class="row">
                    <div class="card-body  col-md-5">
                        <h6><b>Name: </b>{{ $findPatient->name }}</h6>
                        <h6><b>Email: </b>{{ $findPatient->email }}</h6>
                        <h6><b>Phoe Number: </b>{{ $findPatient->phone_number }}</h6>
                    </div>
                    <div class="col-md-7 mt-3">
                        <h6><b>Address: </b>{{ $findPatient->address }}</h6>
                        <h6><b>State: </b>{{ $findPatient->state }}</h6>
                        <h6><b>LGA: </b>{{ $findPatient->lga }}</h6>
                    </div>
                </div>
            </div>

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="d-sm-flex align-items-center justify-content-between  card-header py-3">
                    <h5 class="h5 mb-0 text-gray-800">
                       Genotype/BloodGroup
                    </h5>
                    <a href="{{ url('/prescriptions/add') }}" class="btn btn-info pull-right"> Update Health status</a>
                  </div>
                <div class="card-body">
                <h5><b>Genotype: </b>{{ $findPatient->genotype }}</h5>
                <h5><b>Blood Group: </b>{{ $findPatient->bloodgroup}}</h5>
                </div>
            </div>

            </div>

            <div class="col-lg-6">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <div class="d-sm-flex align-items-center justify-content-between  card-header py-3">
                        <h5 class="h5 mb-0 text-gray-800">
                            Job Status
                        </h5>
                        <a href="{{ url('/prescriptions/add') }}" class="btn btn-info pull-right"> Update Job Status</a>
                      </div>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                    <h4><b>Occupation:</b>{{ $findPatient->occupation }}</h4>
                    </div>
                    </div>
                </div>


            </div>

            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <div class="d-sm-flex align-items-center justify-content-between  card-header py-3">
                    <h5 class="h5 mb-0 text-gray-800">
                        Allergies
                    </h5>
                    <a href="{{ url('/prescriptions/add') }}" class="btn btn-info pull-right"> Update Allergies</a>
                  </div>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    {{ $findPatient->allergies }}
                </div>
                </div>
            </div>
@if($findPatient->subscription !== NULL)
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <div class="d-sm-flex align-items-center justify-content-between  card-header py-3">
                        <h5 class="h5 mb-0 text-gray-800">
                           Payment Plan
                        </h5>
                        <a href="{{ url('/payment/'.Auth::user()->id.'/plan') }}" class="btn btn-info pull-right"> Update Payment Plan</a>
                      </div>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample1">
                    <div class="card-body">
                        {{ $findPatient->subscription->plan }} - {{ (  $findPatient->subscription->amount ) }}
                    </div>
                    </div>
                </div>
                @endif

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

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
