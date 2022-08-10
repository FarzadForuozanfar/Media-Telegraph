<?php include 'header.php';?>
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
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Username">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class="focus:outline-none text-dark bg-yellow hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300  rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900" type="button"><b>Sign In</b></button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="kkk" class="text-blue-800">
                                Forget Password?
                            </a>
                        </div>
                        <hr>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn fs-5 btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <b>Create New Account</b>
                            </button>
                            <form action="../controller/register.php" method="post" enctype="multipart/form-data" role="form">
                            
                            <div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mt-5">
                                    <div class="modal-content bg-gray-light border-0">
                                        <div class="modal-header">
                                            <div>
                                                <h1 class="modal-title display-4 d-block text-light" id="exampleModalLabel"><b>Sign Up</b></h1>
                                                <p class="text-secondary d-block">Start For Free Enjoy Our Community</p>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col ">
                                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control" name="email" placeholder="Email Address" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">@example.com</span>
                                                </div>
                                                <input type="tel" class="form-control my-3" id="tel" name="phone" placeholder="Mobile Number">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">@</span>
                                                    <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
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
                                                            <input id="radio-1" value="male" name="gender" type="radio" checked>
                                                            <label for="radio-1" class="radio-label">Male</label>
                                                        </div>

                                                        <div class="radio">
                                                            <input id="radio-2" value="female" name="gender" type="radio">
                                                            <label  for="radio-2" class="radio-label">Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        
                                                        <div id="calendar" class="input-group flex-nowrap">
                                                            <input placeholder="Birthdate" name="birthdate" type="text" id="pcal1" class="pdate form-control rounded-3">
                                                        </div>
                                                        <input type="hidden" name="extra" id="extra">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" value="Sign Up" class="btn btn-warning">
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
</div>
<?php include 'footer.php'; ?>