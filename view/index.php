<?php include 'header.php'; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <?php if (!empty($_SESSION['error'])) : ?>
                <div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                        <span class="font-medium"><?php echo $_SESSION['error']; ?></span>

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
    <?php
        $_SESSION = null;
        session_destroy();

    ?>
    <div class="row justify-content-center mt-5">
        <header class="text-light text-center">
            <h1 style="font-family: 'Courier New', monospace;">
                <strong>Media Telegraph</strong>
            </h1>
        </header>
        <div class="col-lg-4 col-md-7 col-sm-10 col-xs-10 mt-4">
            <div class="card bg-gray-light">
                <div class="card-header text-center text-white">
                    <h2 class="fs-3">Sign Into Telegraph</h2>
                </div>
                <div class="card-body">
                    <form action="login" id="sign-in" method="post" role="form">
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating">
                            <input required type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="flex mt-3 items-center mr-4">
                            <input id="yellow-checkbox" type="checkbox" value="" class="w-5 h-5 text-yellow-500 bg-gray-100 rounded border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="yellow-checkbox" class="ml-2 font-medium text-gray-900 dark:text-gray-300">Remember Me</label>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button form="sign-in" class="focus:outline-none text-dark bg-yellow hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300  rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900" type="submit"><b>Sign In</b></button>
                        </div>

                    </form>
                    <div class="text-center mt-3">
                        <a href="kkk" class="text-blue-800">
                            Forget Password?
                        </a>
                    </div>
                    <hr>
                    <div class="d-grid gap-2 mt-3">
                        <a href="signup" class="btn fs-5 btn-outline-warning text-dark">
                            <b>Create New Account</b>
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php'; ?>