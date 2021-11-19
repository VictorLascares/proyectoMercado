@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                        <form class="mx-1 mx-md-4" method="POST" action="">
                            @csrf
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-floating flex-fill mb-0">
                                    <input type="text" id="form3Example1c" class="form-control" placeholder="Name"/>
                                    <label class="form-label" for="form3Example1c">Name</label>
                                </div>
                            </div>
    
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-floating flex-fill mb-0">
                                    <input type="email" id="form3Example3c" class="form-control" placeholder="name@example.com"/>
                                    <label class="form-label" for="form3Example3c">Email Address</label>
                                </div>
                            </div>
    
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-floating flex-fill mb-0">
                                    <input type="password" id="form3Example4c" class="form-control" placeholder="Password"/>
                                    <label class="form-label" for="form3Example4c">Password</label>
                                </div>
                            </div>
    
                            <div class="form-check d-flex justify-content-center mb-5">
                                <input
                                class="form-check-input me-2"
                                type="checkbox"
                                value=""
                                id="form2Example3c"
                                />
                                <label class="form-check-label" for="form2Example3">
                                I agree all statements in <a href="#!">Terms of service</a>
                                </label>
                            </div>
    
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-lg">Register</button>
                            </div>
    
                        </form>
    
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                        <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection