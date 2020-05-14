@include('partials.admin-navbar');
    <!-- Begin Page Content -->

      <!-- /.container-fluid -->
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> {{ $findPatient->name }}'s health Profile <br>
                {{-- @if(Auth::user()->id == $findPatient->id) --}}
                <a href="{{ url('upload/'.$findPatient->id) }}"><button class="btn btn-sm btn-primary">Add Avatar</button></a>
                {{-- @endif --}}
            </h1>

            {{-- @if($findPatient->avater) --}}
            <img src="{{asset('storage/'.$findPatient->avatar)}}" class="img-thumbnail"  width="140" height="140"/>

            {{-- @else
                <img id="image" src="{{asset('/img/avatar2.png')}}" /> --}}
            {{-- @endif --}}

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
                        <h6><b>Name: </b>{{$findPatient->last_name}}  {{ $findPatient->name }}</h6>
                        <h6><b>Email: </b>{{ $findPatient->email }}</h6>
                        <h6><b>Phone Number: </b>{{ $findPatient->phone_number }}</h6>

                          <h6><b>Age :</b>{{$age}} years old</h6>

                    </div>
                    <div class="col-md-7 mt-3">
                        <h6><b>Address: </b>{{ $findPatient->address }}</h6>
                        {{-- @if($findPatient->state['name'] != Null)
                        <h6><b>State: </b>{{ Ucfirst($findPatient->state['name']) }} State</h6>
                        <h6><b>LGA: </b>{{ $findPatient->lga['name'] }}</h6>
                        @endif --}}
                    </div>
                </div>
            </div>

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Genotype /Blood Group</h6>
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
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Job Details</h6>
                    </a>
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
                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Allergies</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample1">
                <div class="card-body">
                    {{ $findPatient->allergies }}
                </div>
                </div>
            </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

        <div class="container-fluid">
@if(!$complaints->isEmpty())
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Complaints</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Complaints</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Unique Id</th>
                      <th>Email</th>
                      <th>Phone Mumber</th>
                      <th>Symptoms</th>
                      <th>Start Date</th>
                      <th>Self Medication</th>
                      <th>Status</th>
                      <th>Date Sent</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as  $history)

                          <tr>
                          <td>{{ $history->user['name'] }}</td>
                          <td>{{ $history->user['last_name'] }}</td>
                          <td class="text-info">{{ $history->user['unique_id'] }}</td>
                          <td>{{ $history->user['email']}}</td>
                          <td>{{ $history->user['phone_number'] }}</td>
                          <td>{{ $history->symptoms }}</td>
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
                          <td>{{ $history->created_at }}</td>
                          <td>
                              <div class="dropdown no-arrow mb-4">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   Action</button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
@endif
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
    <script>
$(document).ready(function(){

 $('#search').keyup(function(){

        var query = $(this).val();

        if(query != '')
        {
         var _token = $('input[name="_token"]').val();

         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){

           $('#searchList').fadeIn();
                    $('#searchList').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){
        $('#search').val($(this).text());
        $('#searchList').fadeOut();
    });

});



// $("#image").click(function() {
//     $("input[id='my_file']").click();
// });
</script>
</body>

</html>
