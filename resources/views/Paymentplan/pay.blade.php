
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


    <div class="card mb-4 mt-5">
        <div class="card-header ">
         Payment
        </div>
        <div class="row">
            <div class="card-body  col-md-5">
                <h6><b>Name: </b>{{ $user->name }}</h6>
                <h6><b>Email: </b>{{ $user->email }}</h6>
                <h6><b>Phoe Number: </b>{{ $user->phone_number }}</h6>
            </div>
            <div class="col-md-7 mt-3">
                <h6><b>Subscription Plan: </b>{{ $user->subscription->plan }}</h6>
                <h6><b>Amount: </b>{{ number_format($user->subscription->amount) }}</h6>
                @if($user->subscription->plan == 2)
                <a href="https://paystack.com/pay/dibtb5nn-0"class="btn btn-danger">Subscribe To {{ $user->subscription->plan }} Plan</a>
                @else
                <a href="https://paystack.com/pay/9mbelrlw4f" class="btn btn-danger">Subscribe To {{ $user->subscription->plan }} Plan</a>
                @endif
                {{-- @include('Payment-form.pay'); --}}
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
