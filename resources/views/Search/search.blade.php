@include('partials.admin-navbar');


        <!-- Begin Page Content -->
    <div class="container-fluid">


          <!-- Page Heading -->


        <!-- /.container-fluid -->

        <div class="container-fluid">

            <!-- Page Heading -->

            <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                <h1 class="h3 mb-0 text-gray-800">Search Results </h1>
             
              </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Subscriptions Plan</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                      <th>Name</th>
                      <th>Unique Id</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                       @foreach($data as  $user)
                          <tr>
                          <td>{{$user->name}}</td>
                          <td>{{$user->unique_id}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->phone_number}}</td>
                          <td>
                               <div class="dropdown no-arrow mb-4">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   Action</button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/patients/'.$user->id.'/show') }}">View</a>
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
{{-- {{$subs->links()}} --}}
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
</script>
</body>

</html>
