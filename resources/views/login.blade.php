<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
</head>

<body>
    <div class="container-fluid" style="height: 100vh;">
        <div class="main-panel w-100 h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-4">
                    <form class="card" action="{{Route('login')}}" method="POST">
                        @csrf
                        <div class="card-header">
                            <div class="card-title">Login Form</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group p-1">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="form-group p-1">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="p-1">
                                <button class="btn btn-success">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
