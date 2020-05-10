<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.css" rel="stylesheet">
    <!-- Include this in your blade layout -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body class="bg-gradient-primary">

  <div class="container">
    @include('sweet::alert')

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Select Subscription Plan</h1>
              </div>
              <form class="user" action="{{ url('patients/subscription/plan') }}" method="POST">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                      <label>Subdcription Plan</label>
                    <select name="subscription_id" class="form-control">
                        <option value="1">Single Plan - 200</option>
                        <option value="2">Family Plan - 300</option>
                    </select>
                    <br><br>
                  </div>

                {{-- <a href="{{url('patients/preview')}}" class="btn btn-primary btn-user btn-block">Preview</a> --}}
               <button type="submit"  class="btn btn-primary btn-user btn-block">Register</button>

                <hr>
              </form>
              <hr>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
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
