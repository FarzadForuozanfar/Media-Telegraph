<?php include "controller/check_status.php";
?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php
include 'model/database.php';
include 'controller/functions.php';
include  'controller/calculate_fallows.php';
include 'controller/CheckLike_function.php';
if (!empty($_GET['id'])) {
    $user_id = $_GET['id'];
    $user_login_id = $_SESSION['username_login']['id'];
    $follow_statuse = $db->query("SELECT * FROM follows WHERE follower_user_id = $user_login_id AND following_user_id = $user_id")->num_rows;
} else {
    $user_id = $_SESSION['username_login']['id'];
}
$user_login_follows = Calculate($user_id);
$post_count = $db->query("SELECT COUNT(*) AS cnt FROM posts WHERE user_id = $user_id")->fetch_assoc();
$user = $db->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
$posts = $db->query("SELECT * FROM posts WHERE user_id = $user_id ORDER BY time DESC");

$post_array = array();

foreach ($posts as $post) {
    $post_id = $post['id'];
    $post['likes'] = $db->query("SELECT COUNT(*) AS cnt FROM likes WHERE post_id = $post_id")->fetch_assoc();
    $post['comments'] = $db->query("SELECT * FROM comments INNER JOIN users ON comments.user_id = users.id WHERE post_id = $post_id ORDER BY time DESC");
    $post['comments_count'] = $db->query("SELECT COUNT(*) AS comments_count FROM comments WHERE post_id = $post_id")->fetch_assoc();
    $post_array[] = $post;
}
$_SESSION['username_login']['location'] = "profile";
?>
<div class="d-flex justify-content-center">
    <div class="col-12 col-xxl-8 col-xl-8 col-lg-8 col-md-8">
        <!-- Profile widget -->
        <div class="bg-gray-500 rounded-4 rounded-bottom overflow-hidden">
            <div style="background-image:url(<?php echo $user['cover']; ?> );" class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3">
                        <img src="<?php echo $user['image']; ?>" alt="..." width="105" class="rounded-5 border border-5 border-warning mb-2 img-thumbnail">
                        <div class="d-flex justify-content-end">
                            <?php if ($_SESSION['username_login']['id'] == $user['id']) : ?>
                                <a href="editprofile" class="btn btn-warning btn-sm btn-block">Edit profile</a>
                            <?php else : ?>
                                <form id="form-follows-<?php echo $user['id']; ?>">
                                    <?php if ($follow_statuse == 1) : ?>
                                        <button onclick="FollowsProccess(this,<?php echo $user['id'] ?>)" type="button" class="text-yellow-400 btn btn-outline-warning hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5">Unfollow</button>
                                    <?php else : ?>
                                        <button onclick="FollowsProccess(this,<?php echo $user['id'] ?>)" type="button" class="text-gray-900 bg-yellow hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5">Follow</button>
                                    <?php endif; ?>

                                    <input type="hidden" name="following_id" value="<?php echo $user['id']; ?>">
                                    <input type="hidden" name="follower_id" value="<?php echo $_SESSION['username_login']['id']; ?>">
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="media-body mb-5 pb-3 text-white">
                        <b class="text-xl px-2 p-1 rounded-4 bg-yellow text-gray-600 mt-0 mb-1"><strong>@<?php echo $user['username']; ?></strong></b>
                    </div>
                </div>
            </div>
            <div class="bg-gray-300 py-3 px-1 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><?php echo $post_count['cnt']; ?></h5>
                        <small class="text-muted"> <i class="bi bi-camera-fill mr-1"></i>Post</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><?php echo $user_login_follows['follower']; ?></h5>
                        <small class="text-muted"> <i class="fa-solid fa-users mr-1"></i>Followers</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"><?php echo $user_login_follows['following']; ?></h5>
                        <small class="text-muted"> <i class="bi bi-person-hearts mr-1"></i>Following</small>
                    </li>
                </ul>
            </div>
            <?php if ($user['bio']) : ?>
                <div class="px-4 py-3">
                    <h2 class="mb-1 text-white text-3xl">Bio</h2>
                    <div class="p-4 rounded shadow-lg text-white bg-gray-400">
                        <p class="font-italic mb-0"><?php echo $user['bio']; ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 text-white text-xl">Recent Post</h5>
                    <a href="#" class="btn btn-link border border-warning text-decoration-none text-warning">Show all</a>
                </div>
                <div class="row px-4">
                    <?php foreach ($post_array as $post) : ?>
                        <div class="col-lg-4 col-md-6">
                            <div data-modal-toggle="defaultModal<?php echo $post['id']; ?>" style="height:96%;" class="border w-fill border-4 rounded-3 px-0 my-3 shadow-md cursor-pointer">
                                <?php if ($post['media']) : ?>
                                    <div class="media w-full rounded-4">
                                        <?php $media = explode("/", $post['media']); ?>
                                        <?php if ($media[2] == 'videos') : ?>
                                            <video class="rounded-top" width="100%" controls src="<?php echo $post['media']; ?>"></video>
                                        <?php elseif ($media[2] == 'audios') : ?>
                                            <div style="height: 220px;;" class="d-flex mt-3 justify-content-center">
                                                <audio controls style="width:95%;" src="<?php echo $post['media']; ?>"></audio>
                                            </div>
                                        <?php elseif ($media[2] == 'images') : ?>
                                            <img class="posts rounded-top shadow-sm" src="<?php echo $post['media']; ?>" alt="<?php echo $media[3] ?>">
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="d-flex justify-content-end my-2 px-2">
                                    <span class="d-flex align-items-center mx-4 cursor-pointer ">
                                        <i class="bi bi-heart-fill fs-4 me-2 text-danger"></i>
                                        <small class="text-white"><?php echo $post['likes']['cnt']; ?></small>
                                    </span>
                                    <span class="d-flex text-white align-items-center">
                                        <i class="bi bi-chat-dots fs-4 me-2"></i>
                                        <small id="comments-count-post<?php echo $post['id']; ?>"><?php echo $post['comments_count']["comments_count"]; ?></small>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="defaultModal<?php echo $post['id']; ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">

                            <div class="relative w-full max-w-7xl h-full md:h-auto">

                                <!-- Modal content -->
                                <div class="relative pt-4 m-1 bg-dark text-white rounded-lg shadow dark:bg-gray-700">

                                    <!-- Modal body -->
                                    <div class="row p-2">
                                        <div class="col-12 col-xxl-5 col-xl-5 col-md-5 col-lg-5 bordered-r">
                                            <header class="d-flex px-2 align-items-center" style="border-bottom: 1px solid #aaa; padding-bottom: 5px">
                                                <div class="col-6 d-flex align-items-center">
                                                    <img class="mr-2 w-10 border border-3 border-warning h-10 rounded-full" src="<?php
                                                                                                                                    if (!empty($user['image'])) {
                                                                                                                                        echo $user['image'];
                                                                                                                                    } else if ($user['gender'] == "1") {
                                                                                                                                        echo "view/img/male.png";
                                                                                                                                    } else {
                                                                                                                                        echo "view/img/female.png";
                                                                                                                                    }
                                                                                                                                    ?>" alt="user photo">

                                                    <b><?php echo $user['username']; ?></b>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end px-2">
                                                    <?php if ($user['id'] == $_SESSION['username_login']['id']) : ?>
                                                        <button id="dropdownMenuIconHorizontalButton<?php echo $post['id']; ?>" data-dropdown-toggle="dropdownDots<?php echo $post['id']; ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-50 bg-dark rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                            </svg>
                                                        </button>
                                                        <div id="dropdownDots<?php echo $post['id']; ?>" class="hidden z-10 w-32 bg-dark rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                            <ul class="py-1 text-sm text-gray-50 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                                <li>
                                                                    <p data-modal-toggle="small-modal<?php echo $post['id']; ?>" class="block py-2 px-4 cursor-pointer hover:bg-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">Edit <i class="fa fa-pen ms-4"></i></p>
                                                                </li>
                                                                <li>
                                                                    <p data-modal-toggle="popup-modal<?php echo $post['id']; ?>" class=" block py-2 px-4 cursor-pointer hover:bg-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">Delete <i class="ms-2 bi bi-trash"></i></p>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                    <!-- Dropdown menu -->
                                                    <button type="button" class="text-gray-50 bg-transparent hover:bg-gray-200 hover:text-white rounded-lg text-sm inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal<?php echo $post['id']; ?>">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>

                                                </div>
                                            </header>
                                            <?php if ($post['media']) : ?>
                                                <div class="media w-full rounded-4">
                                                    <?php $media = explode("/", $post['media']); ?>
                                                    <?php if ($media[2] == 'videos') : ?>
                                                        <video class="rounded-top" width="100%" controls src="<?php echo $post['media']; ?>"></video>
                                                    <?php elseif ($media[2] == 'audios') : ?>
                                                        <div class="d-flex mt-3 justify-content-center">
                                                            <audio controls style="width:95%;" src="<?php echo $post['media']; ?>"></audio>
                                                        </div>
                                                    <?php elseif ($media[2] == 'images') : ?>
                                                        <img class="fit rounded-top shadow-sm" src="<?php echo $post['media']; ?>" alt="<?php echo $media[3] ?>">
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="col-12 col-xxl-7 col-xl-7 col-md-7 col-lg-7 mx-0 ps-0">
                                            <div class="row px-4">
                                                <div class="col p-2 d-flex align-items-center">
                                                    <img class="mr-2 border border-3 border-warning w-8 h-8 rounded-full" src="<?php
                                                                                                                                if (!empty($user['image'])) {
                                                                                                                                    echo $user['image'];
                                                                                                                                } else if ($user['gender'] == "1") {
                                                                                                                                    echo "view/img/male.png";
                                                                                                                                } else {
                                                                                                                                    echo "view/img/female.png";
                                                                                                                                }
                                                                                                                                ?>" alt="user photo">

                                                    <b class="me-3"><?php echo $user['username']; ?></b>
                                                    <span class="px-4">
                                                        <span class="bg-warning text-gray-900 text-xs font-small px-1 inline-flex items-center rounded dark:bg-gray-700 dark:text-gray-300">
                                                            <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <?php echo time2str($post['time']); ?>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="code">
                                                    <?php echo $post['caption']; ?>
                                                </div>
                                            </div>

                                            <div id="comment-list<?php echo $post['id']; ?>" class="list-group overflow-y-auto h-64 scrollbar">
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
                                                                <span class="bg-warning text-gray-900 text-xs font-small px-1 inline-flex items-center rounded dark:bg-gray-700 dark:text-gray-300">
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
                                    <!-- Modal footer -->
                                    <div class="d-flex justify-content-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                        <div class="col-lg-7 ps-1 col-md-8 col-12 d-flex justify-content-end">
                                            <form id="form-comment<?php echo $post['id']; ?>" class="input-group my-2">
                                                <input type="hidden" name="post-id" value="<?php echo $post['id'] ?>">
                                                <input onchange="Checktext(this,'button-<?php echo $post['id']; ?>')" required name="caption" id="cpation<?php echo $post['id']; ?>" type="text" required class="form-control" placeholder="Add Comment ..." aria-label="Add Comment ..." aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" type="button" disabled onclick="SendComment('<?php echo $post['id']; ?>','<?php echo $_SESSION['username_login']['profile'] ?>','<?php echo $_SESSION['username_login']['username'] ?>')" id="button-<?php echo $post['id']; ?>">Post</button>
                                            </form>
                                            <span class="d-flex align-items-center mx-4 cursor-pointer ">
                                                <form id="form-like-<?php echo $post['id']; ?>">
                                                    <i onclick="LikePost(this, '<?php echo $post['id']; ?>')" class="bi fs-4 <?php echo CheckLike($_SESSION['username_login']['id'], $post['id']); ?> me-2"></i>
                                                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['username_login']['id']; ?>">
                                                </form>
                                                <small id="post-like-cnt-<?php echo $post['id']; ?>" class="text-lg text-light"><?php if ($post['likes']['cnt']) {
                                                                                                                                    echo $post['likes']['cnt'];
                                                                                                                                } ?>
                                                </small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($user['id'] == $_SESSION['username_login']['id']) : ?>
                            <!-- Delete modal -->
                            <div id="popup-modal<?php echo $post['id']; ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                    <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal<?php echo $post['id']; ?>">
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
                                            <a href="deletePost?id=<?php echo $post['id']; ?>" data-modal-toggle="popup-modal<?php echo $post['id']; ?>" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Yes, I'm sure
                                            </a>
                                            <button data-modal-toggle="popup-modal<?php echo $post['id']; ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit modal -->
                            <div id="small-modal<?php echo $post['id']; ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="block justify-between items-center rounded-t dark:border-gray-600">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="text-gray-50 bg-transparent hover:bg-gray-200 hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="small-modal<?php echo $post['id']; ?>">
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
                                            <form id="edit-post<?php echo $post['id']; ?>" action="editPost" method="post">
                                                <label for="caption" class="block mb-2 text-md font-medium text-white dark:text-gray-400">Caption :</label>
                                                <textarea required name="caption" id="caption<?php echo $post['id']; ?>" rows="4" class="m-0 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "><?php echo $post['caption']; ?></textarea>
                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                <input type="hidden" name="location" value="profile">
                                            </form>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="d-flex justify-content-between px-3 py-2 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                            <button form="edit-post<?php echo $post['id']; ?>" data-modal-toggle="small-modal<?php echo $post['id']; ?>" type="submit" class="text-dark bg-yellow hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center ">Save</button>
                                            <button data-modal-toggle="small-modal<?php echo $post['id']; ?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-2 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>

    <?php include 'footer.php'; ?>