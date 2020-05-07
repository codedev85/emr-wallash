
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

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Select A Plan</h1>
              </div>
              <form class="user" action="{{ url('subscriptions/'.Auth::user()->id.'/subscribed') }}" method="POST">
                @csrf
                <div class="form-group row">

                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="occupation">Subscription Plan</label>
                    <select class="form-control" name="sub_plan">
                        @foreach($subs as $sub)
                        <option value="{{ $sub->id }}">{{ Ucfirst($sub->plan) }} - {{ number_format($sub->amount) }}</option>
                        @endforeach
                    </select>
                  </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="occupation">Payment Method</label>
                      <select class="form-control" name="payment_method">
                       <option value="card"> Card Payment</option>
                       <option value="cash"> Cash Payment</option>
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

</body>

</html>
