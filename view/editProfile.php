<?php
include 'header.php';
include 'navbar.php';
include 'model/database.php';
$user_id = $_SESSION['username_login']['id'];
$user = $db->query("SELECT * FROM `users` WHERE `id` = $user_id")->fetch_assoc();
?>

<div class="container">
    <div class="row p-1 rounded-lg justify-content-center">
        <div class="col-lg-7 bg-white rounded-lg p-1 px-2 border col-md-10 col-sm-12 mt-5 ">
            <h1 class="mb-2 text-3xl text-dark font-extrabold tracking-tight leading-none ">
                Edit Profile
            </h1>
            <hr>
            <form method="post" action="editPersonalInfo">
                <div class="row mt-2">
                    <div class="col d-flex align-items-center">
                        <img class="profile-image" src="<?php echo $user['image']; ?>" alt="<?php echo $user['username']; ?>">
                        <div class="d-block">
                            <p class="ms-2 font-semibold">
                                <?php echo $user['username']; ?>
                            </p>
                            <a data-modal-toggle="small-modal" class="ms-2 text-sm text-blue-500 cursor-pointer font-semibold ">
                                Change Profile Image
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 col-12 mb-3">
                        <?php if(!isset($_SESSION['editProfile_error']['firstname'])): ?>
                            <div class="relative">
                                <input name="firstname" required type="text" value="<?php echo $user['first_name']?>" id="small_outlined" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="small_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">First Name</label>
                            </div>
                        <?php else : ?>
                            <div>
                                <div class="relative">
                                    <input name="firstname" type="text" id="outlined_error" aria-describedby="outlined_error_help" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                    <label for="outlined_error" class="absolute text-sm text-red-600 dark:text-red-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">First Name</label>
                                </div>
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Opps !</span> <?php echo $_SESSION['editProfile_error']['firstname']; ?>.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-6 col-12">
                        <?php if(!isset($_SESSION['editProfile_error']['lastname'])): ?>
                            <div class="relative">
                                <input name="lastname" required value="<?php echo $user['last_name']?>" type="text" id="small_outlined" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="small_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">Last Name</label>
                            </div>
                        <?php else: ?>
                            <div>
                                <div class="relative">
                                    <input name="lastname" type="text" id="outlined_error" aria-describedby="outlined_error_help" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                    <label for="outlined_error" class="absolute text-sm text-red-600 dark:text-red-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Last Name</label>
                                </div>
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Opps !</span> <?php echo $_SESSION['editProfile_error']['lastname']; ?>.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 col-12 mb-3">
                        <?php if(!isset($_SESSION['editProfile_error']['email'])): ?>
                            <div class="relative">
                                <input name="email" required type="email" value="<?php echo $user['email']?>" id="small_outlined" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="small_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">Email</label>
                            </div>
                        <?php else: ?>
                            <div>
                                <div class="relative">
                                    <input name="email" type="email" id="outlined_error" aria-describedby="outlined_error_help" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                    <label for="outlined_error" class="absolute text-sm text-red-600 dark:text-red-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Email</label>
                                </div>
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Opps !</span> <?php echo $_SESSION['editProfile_error']['email']; ?>.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6 col-12">
                        <?php if(!isset($_SESSION['editProfile_error']['username'])): ?>
                            <div class="relative">
                                <input name="username" required value="<?php echo $user['username']?>" type="text" id="small_outlined" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="small_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">Username</label>
                            </div>
                        <?php elseif($_SESSION['editProfile_error']['username'] == "Username is required please fill field"): ?>
                            <div>
                                <div class="relative">
                                    <input name="username" type="text" id="outlined_error" aria-describedby="outlined_error_help" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                    <label for="outlined_error" class="absolute text-sm text-red-600 dark:text-red-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Username</label>
                                </div>
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Opps !</span> <?php echo $_SESSION['editProfile_error']['username']; ?>.</p>
                            </div>
                        <?php else: ?>
                            <div>
                                <div class="relative">
                                    <input name="username" value="<?php if(isset($_SESSION['invalid_username'])) echo $_SESSION['invalid_username']; ?>" type="text" id="outlined_error" aria-describedby="outlined_error_help" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                    <label for="outlined_error" class="absolute text-sm text-red-600 dark:text-red-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Username</label>
                                </div>
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Opps !</span> <?php echo $_SESSION['editProfile_error']['username']; ?>.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row px-3 my-3">

                    <label for="message" class="block p-0 mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Bio :</label>
                    <textarea name="bio" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php echo $user['bio']; ?></textarea>

                </div>
                <div class="d-grid mt-3 px-2 gap-2">
                    <button type="submit" class="relative mt-1 p-2 text-xl inline-flex items-center justify-center mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-50 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                      Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Small Modal -->
    <form enctype="multipart/form-data" method="post" action="changeProfile" id="form-profile">
        <div id="small-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center p-1 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl px-2 font-medium text-gray-900 dark:text-white">
                            Change Profile Image
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="small-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-3 space-y-6">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input name="file_input" required accept="image/*" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none " id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or JPEG (MAX. 600x400px).</p>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-content-between p-3 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button  data-modal-toggle="small-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                        <button  data-modal-toggle="small-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<?php
    unset($_SESSION['invalid_username']);
    unset($_SESSION['editProfile_error']);
?>
?>
<?php include 'footer.php'; ?>