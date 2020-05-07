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
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.css" rel="stylesheet">
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Personal Information</h1>
              </div>
              <form class="user" action="{{ url('patients/post/step-two') }}" method="POST">
                @csrf
                <div class="form-group row">

                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="occupation">Occupation</label>
                    <input type="text" name="occupation" class="form-control " value="{{ old('occupation') }}" id="exampleFirstName" placeholder="Occupation">
                    <span class="text-danger">{{ $errors->first('occupation') }}</span>
                  </div>

                </div>
                <div class="form-group row">

                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control " value="{{ old('address') }}" id="exampleFirstName" placeholder="Address">
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                  </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                     <label for="gender">Gender</label>
                        <select name="gender" class="form-control">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                   </div>
                   <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="gender">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control " value="{{ old('phone_number') }}" id="exampleFirstName" placeholder="Phone Number">
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>

                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="marital_status">Marital Statue</label>
                      <select name="marital_status" class="form-control">
                           <option>Single</option>
                           <option>Married</option>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label for="lga">Date of Birth</label>
                      <input type="date" class="form-control" name="dob"/>
                    </div>
                  </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="state">State</label>
                    <select name="state" class="form-control">
                        <option value="">--- Select State ---</option>
                        @foreach($states as $key => $state)

                         <option value="{{ $key }}">{{ $state }}</option>
                         @endforeach

                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label for="lga">LGA</label>
                    <select name="city" class="form-control">

                    </select>
                  </div>
                </div>

               <button type="submit"  class="btn btn-primary btn-user btn-block">Proceed</button>

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

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="state"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/myform/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>

</body>

</html>
