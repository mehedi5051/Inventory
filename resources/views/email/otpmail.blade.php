<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>OTP Code</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="border p-4 shadow-sm">
          <h5 class="text-center mb-4">Verification Code</h5>

          <p>Dear {{User_Name}},</p>
          <p>Please use the OTP below to proceed:</p>

          <div class="alert alert-success text-center fs-4 fw-bold">
            {{$otp}}
          </div>

          <p>This OTP will expire in {{Expiry_Time}} minutes.</p>

          <p class="small text-muted">
            For security reasons, do not share this code with anyone.
          </p>

          <hr>
          <p class="mb-0">{{Company_Name}}</p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>