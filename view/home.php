<?php
if (empty($_SESSION['username_login']))
    header("Location:index");
?>
<?php if ($_SESSION['username_login']['login_statuse'] == true) : ?>
    <?php
    include 'header.php';
    include 'navbar.php';
    include 'model/database.php';
    include 'controller/functions.php';
    include 'controller/CheckLike_function.php';
    $post_array = array();
    $user_id = $_SESSION['username_login']['id'];
    $user = $db->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
    $posts = $db->query("SELECT * , users.id AS id_user, posts.id AS id_post, follows.id AS id_follows FROM users INNER JOIN posts ON posts.user_id = users.id inner JOIN follows on user_id = following_user_id WHERE follows.follower_user_id = $user_id ORDER BY time DESC");
    foreach ($posts as $post) {
        $post_id = $post['id_post'];
        $post['likes'] = $db->query("SELECT COUNT(*) AS cnt FROM likes WHERE post_id = $post_id")->fetch_assoc();
        $post['comments'] = $db->query("SELECT * FROM comments INNER JOIN users ON comments.user_id = users.id WHERE post_id = $post_id ORDER BY time DESC");
        $post['comments_count'] = $db->query("SELECT COUNT(*) AS comments_count FROM comments WHERE post_id = $post_id")->fetch_assoc();
        $post_array[] = $post;
    }
    ?>


    <div class="container-fluid mt-4">
        <div class="row">
            <div class="d-none d-xxl-block d-xl-block col-3">
                <div class="card gray-container text-white rounded-top">
                    <div class="card-header rounded-top p-0">
                        <img loading="lazy" class="img-fluid rounded-top" src="<?php echo $_SESSION['username_login']['cover']  ?>" alt="">
                    </div>
                    <div class="card-body rounded-top d-block justify-content-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-center">
                                <h5>555</h5>
                                <small>Followes</small>
                            </span>
                            <img loading="lazy" class="profile-container rounded-circle" style="width: 90px !important; height: 90px !important;" src="<?php
                                                                                                                                                        if (!empty($_SESSION['username_login']['profile'])) {
                                                                                                                                                            echo $_SESSION['username_login']['profile'];
                                                                                                                                                        } else if ($_SESSION['username_login']['gender'] == "1") {
                                                                                                                                                            echo "view/img/male.png";
                                                                                                                                                        } else {
                                                                                                                                                            echo "view/img/female.png";
                                                                                                                                                        }
                                                                                                                                                        ?>" alt="">
                            <span class="text-center">
                                <h5>111</h5>
                                <small>Following</small>
                            </span>
                        </div>
                        <div class="mt-4 text-center">
                            <h6 class="fs-5">
                                <?php echo $user['first_name'] . " " . $user['last_name']; ?>
                            </h6>
                            <h6 class="fs-6 mt-1">
                                @<?php echo $user['username']; ?>
                            </h6>
                        </div>
                        <div class="mt-4">
                            <p class="text-center">
                                <?php echo $user['bio']; ?>
                            </p>
                        </div>
                        <hr>
                        <div class="d-grid gap-2 mt-3">
                            <a class="btn btn-outline-warning" href="profile">My Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-12 rounded-5">
                <div class="row">
                    <div class="col-12 mb-4">
                        <form enctype="multipart/form-data" method="post" action="newPost" style="padding-bottom: 2px !important;" class="gray-container d-block align-items-center p-1 py-3 rounded-4">
                            <div class="d-flex" style="width: 100% !important;">
                                <img loading="lazy" class="profile-image" src="<?php
                                                                                if (!empty($_SESSION['username_login']['profile'])) {
                                                                                    echo $_SESSION['username_login']['profile'];
                                                                                } else if ($_SESSION['username_login']['gender'] == "1") {
                                                                                    echo "view/img/male.png";
                                                                                } else {
                                                                                    echo "view/img/female.png";
                                                                                }
                                                                                ?>" alt="profile image">
                                <div class="input-group  mx-3 my-2">
                                    <input required type="text" name="caption2" class="form-control bg-dark text-light text-md rounded-lg" placeholder="Tell your friends about your thoughts . . . " aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Post</button>
                                </div>
                            </div>
                            <!---->
                            <div class="d-flex px-2 mt-3 justify-content-between" style="width: 100% !important;">

                                <button type="button" onclick="upload_img()" class="bg-gray-800 ms-lg-5 ms-2 px-3 py-2 hover:bg-gray-700 active:bg-gray-400 rounded-4">
                                    <i class="bi bi-image-fill text-success"></i>
                                    <p class="text-light inline-block ms-1"> Photo</p>
                                </button>
                                <button type="button" onclick="upload_video()" class="bg-gray-800  px-3 py-2 hover:bg-gray-700 active:bg-gray-400 rounded-4">
                                    <i class="bi bi-play-btn-fill text-danger"></i>
                                    <p class="text-light inline-block ms-1"> Video</p>
                                </button>
                                <button type="button" onclick="upload_audio()" class="bg-gray-800 me-lg-5 me-2 px-3 py-2 hover:bg-gray-700 active:bg-gray-400 rounded-4">
                                    <i class="bi bi-mic-fill text-warning"></i>
                                    <p class="text-light inline-block ms-1"> Audio</p>
                                </button>
                            </div>
                            <div class="mx-lg-5 mx-2 mt-4">
                                <div id="div-photo" style="display:none;" class="input-group input-group-sm mb-3 ms-1 ms-lg-4">
                                    <input accept="image/*" onchange="CheckSize(this)" type="file" class="form-control" id="photoUpload" name="photoUpload">
                                    <button onclick="CheckInput('image','photoUpload')" class="btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="button" id="button-addon1">Upload photo Done</button>
                                </div>

                                <div required id="div-video" style="display:none;" class="input-group input-group-sm mb-3 ms-1 ms-lg-4">
                                    <input accept="video/*" onchange="CheckSize(this)" type="file" class="form-control" name="videoUpload" id="videoUpload">
                                    <button onclick="CheckInput('video','videoUpload')" class="btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="button" id="button-addon1">Upload video Done</button>
                                </div>

                                <div required id="div-audio" style="display:none;" class="input-group input-group-sm mb-3 ms-1 ms-lg-4">
                                    <input accept="audio/*" onchange="CheckSize(this)" type="file" class="form-control" id="audioUpload" name="audioUpload">
                                    <button onclick="CheckInput('audio','audioUpload')" class="btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="button" id="button-addon1">Upload audio Done</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <?php foreach ($post_array as $post) : ?>
                        <div class="col-12 mb-3 rounded-4">
                            <div class="card rounded-4 p-3 gray-container rounded-4">
                                <div class="card-header rounded-top p-0 d-flex text-light">
                                    <div class="col-12 d-flex">
                                        <div class="col-10 p-0 m-0 d-flex">
                                            <img loading="lazy" class="profile-image me-1" src="<?php
                                                                                                if (!empty($post['image'])) {
                                                                                                    echo $post['image'];
                                                                                                } else if ($post['gender'] == "1") {
                                                                                                    echo "view/img/male.png";
                                                                                                } else {
                                                                                                    echo "view/img/female.png";
                                                                                                } ?>" alt="profile img">
                                            <div class="col-lg-5">
                                                <span>
                                                    <small data-popover-target="popover-user-profile<?php echo $post['id_user']; ?>" class="d-block text-muted cursor-pointer">
                                                        @<?php echo $post['username']; ?>
                                                    </small>
                                                </span>
                                                <div id="popover-user-profile<?php echo $post['id_user']; ?>" role="tooltip" class="inline-block absolute invisible z-10 w-64 text-sm font-light text-gray-50 bg-dark rounded-lg border border-gray-200 shadow-sm opacity-0 transition-opacity duration-300 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(278.4px, 218.4px, 0px);">
                                                    <div class="p-3">
                                                        <div class="flex justify-between items-center mb-2">
                                                            <a href="#">
                                                                <img loading="lazy" class="w-10 h-10 rounded-full" src="<?php echo $post['image'] ?>" alt="<?php echo $post['first_name']; ?>">
                                                            </a>
                                                            <?php if ($_SESSION['username_login']['id'] != $post['id_user']) : ?>
                                                                <div>
                                                                    <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow</button>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <p class="text-base font-semibold leading-none text-gray-50 dark:text-white">
                                                            <span><?php echo $post['first_name'] . " " . $post['last_name']; ?></span>
                                                        </p>
                                                        <p class="mb-3 text-sm font-normal">
                                                            <a href="#" class="hover:underline">@<?php echo $post['username']; ?></a>
                                                        </p>
                                                        <p class="mb-4 text-sm font-light"><?php echo $post['bio'] ?></p>
                                                        <ul class="flex text-sm font-light">
                                                            <li class="mr-2">
                                                                <a href="#" class="hover:underline">
                                                                    <span class="font-semibold text-gray-50 dark:text-white">799</span>
                                                                    <spa>Following
                                                                    </spa>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="hover:underline">
                                                                    <span class="font-semibold text-gray-50 dark:text-white">3,758</span>
                                                                    <span>Followers</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(123.2px, 0px, 0px);"></div>
                                                </div>

                                                <span>
                                                    <h6 class="d-flex ms-1 align-items-end">
                                                        <?php echo $post['first_name'] . " " . $post['last_name']; ?> <small class="ms-2" style="color:yellow ; font-weight:bold;"><?php echo time2str($post['time']); ?></small>
                                                    </h6>
                                                </span>
                                            </div>
                                        </div>
                                        <?php if ($_SESSION['username_login']['id'] == $post['id_user']) : ?>
                                            <div class="col-2 d-flex justify-content-end">
                                                <button id="dropdownMenuIconButton<?php echo $post['id_post']; ?>" data-dropdown-toggle="dropdownDots<?php echo $post['id_post']; ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-50 gray-container rounded-lg dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                    </svg>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdownDots<?php echo $post['id_post']; ?>" class="hidden z-10 w-32 bg-dark rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                    <ul class="py-1 text-sm text-gray-50 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                        <li>
                                                            <p data-modal-toggle="small-modal<?php echo $post['id_post']; ?>" class="block py-2 px-4 cursor-pointer hover:bg-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">Edit <i class="fa fa-pen ms-4"></i></p>
                                                        </li>
                                                        <li>
                                                            <p data-modal-toggle="popup-modal<?php echo $post['id_post']; ?>" class=" block py-2 px-4 cursor-pointer hover:bg-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">Delete <i class="ms-2 bi bi-trash"></i></p>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <!-- Delete modal -->
                                <div id="popup-modal<?php echo $post['id_post']; ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal<?php echo $post['id_post']; ?>">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this post?</h3>
                                                <a href="deletePost?id=<?php echo $post['id_post']; ?>" data-modal-toggle="popup-modal<?php echo $post['id_post']; ?>" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                    Yes, I'm sure
                                                </a>
                                                <button data-modal-toggle="popup-modal<?php echo $post['id_post']; ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit modal -->
                                <div id="small-modal<?php echo $post['id_post']; ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="block justify-between items-center rounded-t dark:border-gray-600">
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="text-gray-50 bg-transparent hover:bg-gray-200 hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="small-modal<?php echo $post['id_post']; ?>">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <div class="block">
                                                    <?php if ($post['media']) : ?>
                                                        <?php $media = explode("/", $post['media']); ?>
                                                        <?php if ($media[2] == 'images') : ?>
                                                            <div class="w-full h-64">
                                                                <img class="responsive" src="<?php echo $post['media']; ?>" alt="<?php echo $media[3] ?>">
                                                            </div>
                                                        <?php elseif ($media[2] == 'videos') : ?>
                                                            <video class="rounded-4" width="100%" controls src="<?php echo $post['media']; ?>"></video>
                                                        <?php elseif ($media[2] == 'audios') : ?>
                                                            <center><audio class="rounded-4" controls width="95%" style="width: 95% !important;" src="<?php echo $post['media']; ?>"></audio></center>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6">

                                                <label for="caption" class="block mb-2 text-md font-medium text-white dark:text-gray-400">Caption :</label>
                                                <textarea id="caption" rows="4" class="m-0 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "><?php echo $post['caption']; ?></textarea>

                                            </div>
                                            <!-- Modal footer -->
                                            <div class="d-flex justify-content-between px-3 py-2 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                                <button data-modal-toggle="small-modal<?php echo $post['id_post']; ?>" type="button" class="text-dark bg-yellow hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center ">Save</button>
                                                <button data-modal-toggle="small-modal<?php echo $post['id_post']; ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-2 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body rounded-top p-0 mt-3 text-light">
                                    <?php if ($post['media']) : ?>

                                        <?php if ($media[2] == 'videos') : ?>
                                            <div class="media w-full h-96 rounded-4">
                                                <video class="rounded-4" width="100%" controls src="<?php echo $post['media']; ?>"></video>
                                            <?php elseif ($media[2] == 'audios') : ?>
                                                <div class="media w-full text-light rounded-4">
                                                    <center><audio class="rounded-4" controls width="95%" style="width: 95% !important;" src="<?php echo $post['media']; ?>"></audio></center>

                                                <?php elseif ($media[2] == 'images') : ?>
                                                    <div class="media w-full h-96 rounded-4">
                                                        <img class="responsive" src="<?php echo $post['media']; ?>" alt="<?php echo $media[3] ?>">
                                                    <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <p class="mt-3 text-light">
                                                    <?php echo $post['caption']; ?>
                                                </p>
                                                <br>
                                                <hr>

                                                <div class="d-flex mt-3">
                                                    <img loading="lazy" class="profile-image me-2 d-none d-xxl-block d-xl-block d-lg-block d-md-block" src="<?php if (!empty($_SESSION['username_login']['profile'])) {
                                                                                                                                                                echo $_SESSION['username_login']['profile'];
                                                                                                                                                            } else if ($_SESSION['username_login']['gender'] == "1") {
                                                                                                                                                                echo "view/img/male.png";
                                                                                                                                                            } else {
                                                                                                                                                                echo "view/img/female.png";
                                                                                                                                                            } ?>" alt="">
                                                    <form id="form-comment<?php echo $post['id_post']; ?>" class="input-group my-2">
                                                        <input type="hidden" name="post-id" value="<?php echo $post['id_post'] ?>">
                                                        <input onchange="Checktext(this,'button-<?php echo $post['id_post']; ?>')" required name="caption" id="cpation<?php echo $post['id_post']; ?>" type="text" required class="form-control" placeholder="Add Comment ..." aria-label="Add Comment ..." aria-describedby="button-addon2">
                                                        <button class="btn btn-outline-secondary" type="button" disabled onclick="SendComment('<?php echo $post['id_post']; ?>','<?php echo $_SESSION['username_login']['profile'] ?>','<?php echo $_SESSION['username_login']['username'] ?>')" id="button-<?php echo $post['id_post']; ?>">Post</button>
                                                    </form>
                                                    <span class="d-flex align-items-center mx-4 cursor-pointer ">
                                                        <form id="form-like-<?php echo $post['id_post']; ?>">
                                                            <i onclick="LikePost(this, '<?php echo $post['id_post']; ?>')" class="bi fs-4 <?php echo CheckLike($_SESSION['username_login']['id'], $post['id_post']); ?> me-2"></i>
                                                            <input type="hidden" name="post_id" value="<?php echo $post['id_post']; ?>">
                                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['username_login']['id']; ?>">
                                                        </form>
                                                        <small id="post-like-cnt-<?php echo $post['id_post']; ?>" class="text-lg text-light"><?php if ($post['likes']['cnt']) {
                                                                                                                                                    echo $post['likes']['cnt'];
                                                                                                                                                } ?>
                                                        </small>
                                                    </span>
                                                    <span id="show-hide-comments" onclick="ShowHideComments('tooltip-show-comments<?php echo $post['id_post']; ?>')" data-tooltip-target="tooltip-show-comments<?php echo $post['id_post']; ?>" class="d-flex align-items-center text-light cursor-pointer">
                                                        <i data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $post['id_post']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $post['id_post']; ?>" class="bi bi-chat-dots fs-4 me-2">
                                                        </i>
                                                        <small id="comments-count-post<?php echo $post['id_post']; ?>" class="text-lg text-light"><?php echo $post['comments_count']["comments_count"]; ?></small>
                                                        <div name="hide" id="tooltip-show-comments<?php echo $post['id_post']; ?>" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                                                            Show Comments
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>
                                                    </span>
                                                </div>
                                                <div class="row mt-4 px-1">
                                                    <div class="collapse" id="collapse<?php echo $post['id_post']; ?>">
                                                        <div id="comment-list<?php echo $post['id_post']; ?>" class="list-group overflow-y-auto h-32 scrollbar">
                                                            <?php foreach ($post['comments'] as $comment) : ?>
                                                                <div>
                                                                    <div class="list-group-item list-group-item-action bg-gray-800 hover:bg-gray-800 text-white" aria-current="true">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <div class="d-flex align-items-center mb-1">
                                                                                <img loading="lazy" class="profile-comments" src="<?php
                                                                                                                                    if (!empty($comment['image'])) {
                                                                                                                                        echo $comment['image'];
                                                                                                                                    } else if ($comment['gender'] == "1") {
                                                                                                                                        echo "view/img/male.png";
                                                                                                                                    } else {
                                                                                                                                        echo "view/img/female.png";
                                                                                                                                    } ?>" alt="">
                                                                                <a class="ms-2 cursor-pointer"><?php echo $comment['first_name'] . " " . $comment['last_name']; ?></a>
                                                                            </div>
                                                                            <span>
                                                                                <span class="bg-warning text-gray-50 text-xs font-small px-1 inline-flex items-center rounded dark:bg-gray-700 dark:text-gray-300">
                                                                                    <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                                                    </svg>
                                                                                    <?php echo time2str($comment['time']); ?>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                        <p class="p-0"><?php echo $comment['text']; ?></p>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                </div>
                            <?php endforeach; ?>

                            </div>
                        </div>
                        <div class="d-none d-xxl-block d-xl-block d-lg-block col-xl-3 col-xxl-3 col-6">
                            <div id="dropdownSearch" class=" gray-container  rounded shadow ">
                                <div class="p-3">
                                    <h5 class="text-light">
                                        Recently Activity
                                    </h5>
                                </div>
                                <ul class="overflow-y-auto px-3 pb-3 h-48 scrollbar text-sm" aria-labelledby="dropdownSearchButton">
                                    <li class="mb-3">
                                        <a class="text-decoration-none " href="#">
                                            <div class="row bg-gray-700 p-1 mx-1 rounded-4">
                                                <img loading="lazy" class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
                                                <div class="col">
                                                    <h6 class="d-flex align-items-end text-light">
                                                        Farzad Foroozanfar
                                                    </h6>
                                                    <p class="d-block text-muted">
                                                        liked your post <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small> </p>

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="text-decoration-none " href="#">
                                            <div class="row bg-gray-700 p-1 mx-1 rounded-4">
                                                <img loading="lazy" class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
                                                <div class="col">
                                                    <h6 class="d-flex align-items-end text-light">
                                                        Farzad Foroozanfar
                                                    </h6>
                                                    <p class="d-block text-muted">
                                                        liked your post <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small> </p>

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="text-decoration-none " href="#">
                                            <div class="row bg-gray-700 p-1 mx-1 rounded-4">
                                                <img loading="lazy" class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
                                                <div class="col">
                                                    <h6 class="d-flex align-items-end text-light">
                                                        Farzad Foroozanfar
                                                    </h6>
                                                    <p class="d-block text-muted">
                                                        liked your post <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small> </p>

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="text-decoration-none " href="#">
                                            <div class="row bg-gray-700 p-1 mx-1 rounded-4">
                                                <img class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
                                                <div class="col">
                                                    <h6 class="d-flex align-items-end text-light">
                                                        Farzad Foroozanfar
                                                    </h6>
                                                    <p class="d-block text-muted">
                                                        liked your post <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small> </p>

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="text-decoration-none " href="#">
                                            <div class="row bg-gray-700 p-1 mx-1 rounded-4">
                                                <img class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
                                                <div class="col">
                                                    <h6 class="d-flex align-items-end text-light">
                                                        Farzad Foroozanfar
                                                    </h6>
                                                    <p class="d-block text-muted">
                                                        liked your post <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small> </p>

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="text-decoration-none" href="#">
                                            <div class="row bg-gray-700 p-1 mx-1 rounded-4">
                                                <img class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
                                                <div class="col">
                                                    <h6 class="d-flex align-items-end text-light">
                                                        Farzad Foroozanfar
                                                    </h6>
                                                    <p class="d-block text-muted">
                                                        liked your post <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small> </p>

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-3">
                                        <a class="text-decoration-none" href="#">
                                            <div class="row bg-gray-700 p-1 mx-1 rounded-4">
                                                <img class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
                                                <div class="col">
                                                    <h6 class="d-flex align-items-end text-light">
                                                        Farzad Foroozanfar
                                                    </h6>
                                                    <p class="d-block text-muted">
                                                        liked your post <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small> </p>

                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        <?php endif; ?>
        <?php include 'footer.php'; ?>