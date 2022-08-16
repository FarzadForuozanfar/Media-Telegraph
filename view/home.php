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
    $post_array = array();
    $user_id = $_SESSION['username_login']['id'];
    $user = $db->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
    $posts = $db->query("SELECT * , users.id AS id_user, posts.id AS id_post FROM users INNER JOIN posts ON posts.user_id = users.id ORDER BY time DESC");
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
                        <img loading="lazy" class="img-fluid rounded-top" src="https://picsum.photos/seed/picsum/500/200" alt="">
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
                        <form method="post" action="newPost" style="padding-bottom: 2px !important;" class="gray-container d-block align-items-center p-1 py-3 rounded-4">
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
                            <div class="d-flex px-3 mt-3 justify-content-between" style="width: 100% !important;">

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
                                    <div class="row">
                                        <img loading="lazy" class="profile-image" src="<?php
                                                                        if (!empty($post['image'])) {
                                                                            echo $post['image'];
                                                                        } else if ($post['gender'] == "1") {
                                                                            echo "view/img/male.png";
                                                                        } else {
                                                                            echo "view/img/female.png";
                                                                        } ?>" alt="profile img">
                                        <div class="col">
                                            <small data-popover-target="popover-user-profile<?php echo $post['id_user']; ?>" class="d-block text-muted cursor-pointer">
                                                @<?php echo $post['username']; ?>
                                            </small>
                                            <div id="popover-user-profile<?php echo $post['id_user']; ?>" role="tooltip" class="inline-block absolute invisible z-10 w-64 text-sm font-light text-gray-50 bg-dark rounded-lg border border-gray-200 shadow-sm opacity-0 transition-opacity duration-300 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(278.4px, 218.4px, 0px);">
                                                <div class="p-3">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <a href="#">
                                                            <img loading="lazy" class="w-10 h-10 rounded-full" src="<?php echo $post['image'] ?>" alt="<?php echo $post['first_name']; ?>">
                                                        </a>
                                                        <div>
                                                            <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow</button>
                                                        </div>
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

                                            <h6 class="d-flex justify-content-between align-items-end">
                                                <?php echo $post['first_name'] . " " . $post['last_name']; ?> <small class="ms-2" style="color:yellow ; font-weight:bold;"><?php echo time2str($post['time']); ?></small>
                                            </h6>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-body rounded-top p-0 mt-3 text-light">
                                    <?php if ($post['media']) : ?>
                                        <div class="media w-full h-96 rounded-4">
                                            <?php $media = explode("/", $post['media']); ?>
                                            <?php if ($media[2] == 'videos') : ?>
                                                <video class="rounded-4" width="100%" controls src="<?php echo $post['media']; ?>"></video>
                                            <?php elseif ($media[2] == 'audios') : ?>
                                                <audio class="rounded-4" controls width="100%" autoplay="true" src="<?php echo $post['media']; ?>"></audio>
                                            <?php elseif ($media[2] == 'images') : ?>
                                                <img class="responsive" src="<?php echo $post['media']; ?>" alt="<?php echo $media[3] ?>">
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <p class="mt-3">
                                        <?php echo $post['caption']; ?>
                                    </p>
                                    <br>
                                    <hr>

                                    <div class="d-flex mt-3">
                                        <img loading="lazy" class="profile-image me-2" src="<?php if (!empty($_SESSION['username_login']['profile'])) {
                                                                                    echo $_SESSION['username_login']['profile'];
                                                                                } else if ($_SESSION['username_login']['gender'] == "1") {
                                                                                    echo "view/img/male.png";
                                                                                } else {
                                                                                    echo "view/img/female.png";
                                                                                } ?>" alt="">
                                        <form method="post" action="add_comment" class="input-group my-2">
                                            <input type="text" required class="form-control" placeholder="Add Comment ..." aria-label="Add Comment ..." aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Post</button>
                                        </form>
                                        <span class="d-flex align-items-center mx-4 cursor-pointer ">
                                            <i class="bi fs-4 bi-heart-fill me-2 text-danger"></i>
                                            <small class="text-lg"><?php if ($post['likes']['cnt']) {
                                                                        echo $post['likes']['cnt'];
                                                                    } ?></small>
                                        </span>
                                        <span id="show-hide-comments" onclick="ShowHideComments('tooltip-show-comments<?php echo $post['id_post']; ?>')" data-tooltip-target="tooltip-show-comments<?php echo $post['id_post']; ?>" class="d-flex align-items-center cursor-pointer">
                                            <i data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $post['id_post']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $post['id_post']; ?>" class="bi bi-chat-dots fs-4 me-2">
                                            </i>
                                            <small class="text-lg"><?php echo $post['comments_count']["comments_count"]; ?></small>
                                            <div name="hide" id="tooltip-show-comments<?php echo $post['id_post']; ?>" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                                                Show Comments
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="row mt-4 px-1">
                                        <div class="collapse" id="collapse<?php echo $post['id_post']; ?>">
                                            <div class="list-group overflow-y-auto h-32 scrollbar">
                                                <?php foreach ($post['comments'] as $comment) : ?>
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
                                    <img loading="lazy"  class="profile-image" src="https://picsum.photos/id/9/70/70" alt="">
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