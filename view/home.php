<?php
if (empty($_SESSION['username_login']))
    header("Location:index");
?>
<?php if ($_SESSION['username_login']['login_statuse'] == true):?>
    <?php
        include 'header.php';
        include 'navbar.php';
        include 'model/database.php';
        $user_id = $_SESSION['username_login']['id'];
        $user = $db->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
        $posts = $db->query("SELECT * FROM posts WHERE user_id = $user_id ORDER BY time DESC");
    ?>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="d-none d-xxl-block d-xl-block col-3">
                <div class="card gray-container text-white rounded-top">
                    <div class="card-header rounded-top p-0">
                        <img class="img-fluid rounded-top" src="https://picsum.photos/seed/picsum/500/200" alt="">
                    </div>
                    <div class="card-body rounded-top d-block justify-content-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-center">
                                <h5>555</h5>
                                <small>Followes</small>
                            </span>
                            <img class="profile-container rounded-circle" src="https://picsum.photos/id/8/90/90" alt="">
                            <span class="text-center">
                                <h5>111</h5>
                                <small>Following</small>
                            </span>
                        </div>
                        <div class="mt-4 text-center">
                            <h6 class="fs-5">
                                Farzad Foroozanfar
                            </h6>
                            <h6 class="fs-6">
                                @farzad__foroozanfar
                            </h6>
                        </div>
                        <div class="mt-4">
                            <p class="">
                                Im a Web-developer and programmer 💻👨‍💻
                            </p>
                        </div>
                        <hr>
                        <div class="d-grid gap-2 mt-3">
                            <a class="btn btn-outline-warning" href="profile.php">My Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-12 rounded-5">
                <div class="row">
                    <div class="col-12 mb-4">
                        <form method="post" action="new post" style="padding-bottom: 2px !important;" class="gray-container d-block align-items-center p-1 py-3 rounded-4">
                            <div class="d-flex" style="width: 100% !important;">
                                <img class="profile-image" src="https://media-exp1.licdn.com/dms/image/C4E03AQHQ9KZj8Lri1w/profile-displayphoto-shrink_800_800/0/1650810794384?e=1665014400&v=beta&t=aCu3E8I-ss2-3ZbUx9AzeED_jEw1rRmWwO8DPzgJsCY" alt="">
                                <div class="input-group  mx-3 my-2">
                                    <input required type="text" class="form-control bg-dark text-light text-md rounded-lg" placeholder="Tell your friends about your thoughts . . . " aria-describedby="button-addon2">
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
                                    <button onclick="CheckInput('image')" class="btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="button" id="button-addon1">Upload photo Done</button>
                                </div>

                                <div required id="div-video" style="display:none;" class="input-group input-group-sm mb-3 ms-1 ms-lg-4">
                                    <input accept="video/*" onchange="CheckSize(this)" type="file" class="form-control" name="videoUpload" id="videoUpload">
                                    <button onclick="CheckInput('video')" class="btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="button" id="button-addon1">Upload video Done</button>
                                </div>

                                <div required id="div-audio" style="display:none;" class="input-group input-group-sm mb-3 ms-1 ms-lg-4">
                                    <input accept="audio/*" onchange="CheckSize(this)" type="file" class="form-control" id="audioUpload" name="audioUpload">
                                    <button onclick="CheckInput('audio')" class="btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="button" id="button-addon1">Upload audio Done</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <?php foreach($posts as $post): ?>
                        <div class="col-12 mb-3 rounded-4">
                            <div class="card rounded-4 p-3 gray-container rounded-4">
                                <div class="card-header rounded-top p-0 d-flex text-light">
                                    <div class="row">
                                        <img class="profile-image" src="https://media-exp1.licdn.com/dms/image/C4E03AQHQ9KZj8Lri1w/profile-displayphoto-shrink_800_800/0/1650810794384?e=1665014400&v=beta&t=aCu3E8I-ss2-3ZbUx9AzeED_jEw1rRmWwO8DPzgJsCY" alt="">
                                        <div class="col">
                                            <small class="d-block text-muted">
                                                @ <?php echo $user['username']; ?>
                                            </small>
                                            <h6 class="d-flex align-items-end">
                                                <?php echo $user['first_name']." ". $user['last_name']; ?> <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small>
                                            </h6>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-body rounded-top p-0 mt-3 text-light">
                                    <!--<img class="img-fluid rounded-4" src="https://picsum.photos/id/48/700/300" alt="">-->
                                    <p class="mt-3">
                                        <?php echo $post['caption']; ?>
                                    </p>
                                    <br>
                                    <hr>

                                    <div class="d-flex mt-3">
                                        <img class="profile-image me-2" src="https://picsum.photos/id/1/70/70" alt="">
                                        <div class="input-group my-2">
                                            <input type="text" class="form-control" placeholder="Add Comment ..." aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Post</button>
                                        </div>
                                        <span class="d-flex align-items-center mx-4 cursor-pointer ">
                                            <i class="bi bi-heart-fill me-2 text-danger"></i>
                                            <small>12</small>
                                        </span>
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-chat-dots me-2"></i>
                                            <small>12</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 rounded-4">
                        <div class="card rounded-4 p-3 gray-container rounded-4">
                            <div class="card-header rounded-top p-0 d-flex text-light">
                                <div class="row">
                                    <img class="profile-image" src="https://media-exp1.licdn.com/dms/image/C4E03AQHQ9KZj8Lri1w/profile-displayphoto-shrink_800_800/0/1650810794384?e=1665014400&v=beta&t=aCu3E8I-ss2-3ZbUx9AzeED_jEw1rRmWwO8DPzgJsCY" alt="">
                                    <div class="col">
                                        <small class="d-block text-muted">
                                            @Farzad
                                        </small>
                                        <h6 class="d-flex align-items-end">
                                            Farzad Foroozanfar <small class="ms-2" style="color:yellow ; font-weight:bold;">. 1 hr ago</small>
                                        </h6>
                                    </div>

                                </div>

                            </div>
                            <div class="card-body rounded-top p-0 mt-3 text-light">
                                <img class="img-fluid rounded-4" src="https://picsum.photos/id/48/700/300" alt="">
                                <p class="mt-3">
                                    Great programmers are rare. Their productivity is 3 times that of an average developer and 10 times that of a bad developer*. The top 1% of developers in the world don’t just write solid code but have important intangible traits. After working with thousands of developers, we have been able to identify 7 qualities that set a great programmer apart from the crowd.

                                    “The best programmers are up to 28 times better than the worst programmers”

                                    – Robert. L. Glass
                                </p>
                                <br>
                                <hr>

                                <div class="d-flex mt-3">
                                    <img class="profile-image me-2" src="https://picsum.photos/id/1/70/70" alt="">
                                    <div class="input-group my-2">
                                        <input type="text" class="form-control" placeholder="Add Comment ..." aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Post</button>
                                    </div>
                                    <span class="d-flex align-items-center mx-4 cursor-pointer ">
                                        <i class="bi bi-heart-fill me-2 text-danger"></i>
                                        <small>12</small>
                                    </span>
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-chat-dots me-2"></i>
                                        <small>12</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-xxl-block d-xl-block d-lg-block col-xl-3 col-xxl-3 col-6">
                <div id="dropdownSearch" class=" gray-container  rounded shadow ">
                    <div class="p-3">
                        <h5 class="text-light">
                            Recently Activity
                        </h5>
                    </div>
                    <ul class="overflow-y-auto px-3 pb-3 h-48 text-sm" aria-labelledby="dropdownSearchButton">
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