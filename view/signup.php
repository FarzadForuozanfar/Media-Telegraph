<?php include 'header.php'; ?>

<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <?php if (!empty($_SESSION['errors'])) : ?>
                <div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                        <span class="font-medium">Ensure that these requirements are met:</span>
                        <ul class="mt-1.5 ml-4 text-red-700 list-disc list-inside">
                            <?php for($i = 0; $i < count($_SESSION['errors']); $i++):?>
                                <li>
                                    <?php echo $_SESSION['errors'][$i];?>
                                </li>
                            <?php endfor;?>
                        </ul>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php $_SESSION['errors'] = null; ?>
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <form action="register" method="post" id="sign-up" enctype="multipart/form-data" role="form">
                <div class="card bg-gray-light border-0">
                    <div class="card-header">
                        <div>
                            <h1 class="display-4 d-block text-light"><b>Sign Up</b></h1>
                            <p class="text-secondary d-block mt-2">Start For Free Enjoy Our Community</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col ">
                                <input required type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
                            </div>
                            <div class="col">
                                <input required type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input required type="email" class="form-control" name="email" placeholder="Email Address" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                        <input required type="tel" class="form-control my-3" id="tel" name="phone" placeholder="Mobile Number">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input required type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input required type="password" name="password" class="form-control" placeholder="Password" id="">
                            </div>
                            <div class="col">
                                <input required type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" id="">
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
                                    <label for="radio-2" class="radio-label">Female</label>
                                </div>
                            </div>
                            <div class="col">

                                <div id="calendar" class="input-group flex-nowrap">
                                    <input placeholder="Birthdate" name="birthdate" type="text" id="pcal1" class="pdate form-control rounded-3">
                                </div>
                                <input type="hidden" name="extra" id="extra">
                            </div>
                        </div>
                        <div class="card-footer d-grid gap-2 mx-auto">
                            <a href="index" class="btn btn-outline-primary text-gray-900 hover-text-gray-50">already have an account</a>
                            <button form="sign-up" class="focus:outline-none text-dark bg-yellow hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300  rounded-lg text-lg py-1 dark:focus:ring-yellow-900" type="submit">Sign Up</button>
                        </div>


                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
<script src="view/js/js-persian-cal.min.js"></script>
<script src="view/js/calculator.js"></script>
<?php include 'footer.php'; ?>