<?php include 'view/header.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center mt-5">
        <header class="text-light text-center">
            <h1 style="font-family: 'Courier New', monospace;">
                <strong>Media Telegraph</strong>
            </h1>
        </header>
        <div class="col-lg-4 col-md-7 col-sm-10 col-xs-10 mt-4">
            <div class="card bg-gray-light">
                <div class="card-header text-center text-white">
                    <h4>Sign Into Telegraph</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Username">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-warning fs-5" type="button"><b>Sign In</b></button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="kkk">
                                Forget Password?
                            </a>
                        </div>
                        <hr>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn fs-5 btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <b>Create New Account</b>
                            </button>                            
                            <div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mt-5">
                                    <div class="modal-content bg-gray-light">
                                        <div class="modal-header">
                                            <div>
                                                <h2 class="modal-title d-block text-light" id="exampleModalLabel">Sing Up</h2>
                                                <p class="text-secondary d-block">Start For Free Enjoy Our Community</p>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="row mb-3">
                                                    <div class="col ">
                                                        <input type="text" class="form-control" id="firstname" placeholder="First Name">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="lastname" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control" placeholder="Email Address" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">@example.com</span>
                                                </div>
                                                <input type="tel" class="form-control my-3" id="tel" placeholder="Mobile Number">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">@</span>
                                                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <input type="text" name="password" class="form-control" placeholder="Password" id="">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="confirmpassword" class="form-control" placeholder="Confirm Password" id="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="radio">
                                                            <input id="radio-1" name="radio" type="radio" checked>
                                                            <label for="radio-1" class="radio-label">Male</label>
                                                        </div>

                                                        <div class="radio">
                                                            <input id="radio-2" name="radio" type="radio">
                                                            <label  for="radio-2" class="radio-label">Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        
                                                        <div id="calendar" class="input-group flex-nowrap">
                                                            <input placeholder="Birthday" type="text" id="pcal1" class="pdate form-control rounded-3">
                                                        </div>
                                                        <input type="hidden" name="extra" id="extra">
                                                    </div>
                                                </div>
                                                
                                                
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php include 'view/footer.php'; ?>