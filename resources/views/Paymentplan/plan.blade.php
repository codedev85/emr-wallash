@include('partials.admin-navbar');


        <!-- Begin Page Content -->
    <div class="container-fluid">


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
            <h1 class="h3 mb-0 text-gray-800"> Payment Plan </h1>
          </div>



            <div class="col-lg-12">

                <!-- Dropdown Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample5" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Payment Plan</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample5">
                        <div class="card-body">
                       <form action="{{ url('/payment/'.Auth::user()->id .'/update') }}" method="POST">
                        @csrf
                        @method('PUT');
                        <label>Payment Plan <span class="text-info">( Current Plan : {{ $userPlan->subscription->plan}} - {{ $userPlan->subscription->amount }} ) </span></label>

                        <div>
                           <select class="form-control" name="payment_plan">
                            <option value="{{ $userPlan->subscription->id }}">{{ $userPlan->subscription->plan }} - {{ $userPlan->subscription->amount }}</option>
                               @foreach($subs as $sub)

                               <option value="{{ $sub->id }}">{{ Ucfirst($sub->plan) }} - {{ number_format($sub->amount) }}</option>
                               @endforeach
                           </select>
                        </div>
<br>
                        <label>Payment Method <span class="text-info">( Current Payment Method: - {{ ucfirst($userPlan->payment_method)}}  Payment) </span></label>

                        <div>
                           <select class="form-control" name="payment_method">
                               <option value="{{ $userPlan->payment_method }}">
                                {{ Ucfirst($userPlan->payment_method) }} Payment
                              </option>
                                    <option value="card">Card Payment</option>
                                    <option value="bank">Bank Payment</option>
                           </select>
                        </div>

                         <br>
                     <button class="btn btn-info">Update Payment Plan</button>
                       </form>
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
