@include('partials.admin-navbar');


        <!-- Begin Page Content -->
    <div class="container-fluid">


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
            <h1 class="h3 mb-0 text-gray-800"> {{ $prescription->user->name }}'s Health Profile
                - <small class="text-success">({{ $prescription->user['unique_id'] }}) </small>

            </h1>
            @if($prescription->complaint->status !== 2)
            <a href="{{ url('/prescriptions/'.$prescription->id.'/add') }}" class="btn btn-primary pull-right"> Add Prescription</a>
            @else
            <span class="text-success">Prescription Given by Doctor {{ Ucfirst($prescription->doc_name) }}</span>
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
                        <h6><b>Name: </b>{{ $prescription->user['name'] }}</h6>
                        <h6><b>Email: </b>{{ $prescription->user['email'] }}</h6>
                        <h6><b>Phoe Number: </b>{{ $prescription->user['phone_number']}}</h6>
                    </div>
                    <div class="col-md-7 mt-3">
                        <h6><b>Address: </b>{{ $prescription->user['address'] }}</h6>
                        <h6><b>State: </b>{{ $prescription->user['state'] }}</h6>
                        <h6><b>LGA: </b>{{ $prescription->user['lga'] }}</h6>
                    </div>
                </div>
            </div>

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Prescription</h6>
                </div>
                <div class="card-body">
               <h5>{{ $prescription->prescription}}</h5>

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
                    <h6 class="m-0 font-weight-bold text-primary">Symptoms</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                    <h4>{{ $prescription->complaint->symptoms }}</h4>
                    </div>
                    </div>
                </div>


            </div>

                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Drugs</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample1">
                    <div class="card-body">
                       <?php

                      $jsonDecode = json_decode( $prescription->formula);

                       ?>

                       <ul>
                        @foreach($jsonDecode as $arrayData)
                           <li class="text-info">{{ $arrayData }}</li>
                           @endforeach
                       </ul>
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
                        <h6 class="m-0 font-weight-bold text-primary">Add Prescription</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample5">
                        <div class="card-body">

                        </div>
                        </div>
                    </div>
                </div>
             </div>
          </div>

        </div>

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
