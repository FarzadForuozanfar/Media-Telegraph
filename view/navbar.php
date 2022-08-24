<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
elseif ((empty($_SESSION['username_login']['login_statuse'])))
header("Location:index");
?>
<nav class="navbar-dark bg-dark border border-top-0 border-start-0 border-end-0 border-gray-200 px-2 sm:px-4 py-2.5 rounded ">
  <div class="container flex flex-wrap justify-between items-center mx-auto">
    <i href="https://flowbite.com/" class="flex items-center">
      <img src="view/img/Screenshot (612).png" style="border-radius: 100%; width: 42.5px; height: 43px;" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
      <span class="text-transparent bg-clip-text bg-gradient-to-br from-gray-300 to-yellow-400" style="font-size:30px; font-family: 'Courier New', monospace; font-weight:bolder;">Telegraph</span>
    </i>
    <div class="flex items-center md:order-2">

      <button type="button" class="flex mr-3 text-white text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="mr-2 w-8 h-8 rounded-full" src="<?php
                                                    if (!empty($_SESSION['username_login']['profile'])) {
                                                      echo $_SESSION['username_login']['profile'];
                                                    } else if ($_SESSION['username_login']['gender'] == "1") {
                                                      echo "view/img/male.png";
                                                    } else {
                                                      echo "view/img/female.png";
                                                    }
                                                    ?>" alt="user photo">
        <span><?php echo $_SESSION['username_login']['username']; ?></span>
        <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
      <!-- Dropdown menu -->

      <div class="hidden z-10 w-36 bg-gray-300 rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 block" id="user-dropdown" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(319.2px, 62.4px, 0px);">

        <div class="py-1 ps-2 text-sm text-gray-700 dark:text-gray-300" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">

          <div class="cursor-pointer py-2 ">
            <i class="bi bi-person-circle me-2"></i><a href="profile" class=" text-dark py-2 text-decoration-none">Profile</a>
          </div>
          <div class="cursor-pointer py-2">
            <i class="bi bi-file-earmark-plus me-2"></i><a href="#" class=" text-dark py-2 text-decoration-none">Saved</a>
          </div>
          <div class="cursor-pointer py-2">
            <i class="bi bi-gear-fill me-2"></i><a href="#" class="text-dark py-2 text-decoration-none">Setting</a>
          </div>
        </div>
        <div class="py-1 ps-2">
          <i class="bi bi-box-arrow-right me-2"></i><a href="index" class=" text-dark py-2 text-decoration-none"> Sign out</a>
        </div>
      </div>
      <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">

      <ul class="flex wrapper p-1 mt-1 rounded-lg md:flex-row md:space-x-8 text-white">
        <li class="me-1">
          <a href="home" data-tooltip-target="tooltip-home" class="block py-2 pr-4 pl-3 list-menu hover:text-yellow-300">
            <i class="bi bi-house fa-lg" aria-hidden="true"></i>
            <div id="tooltip-home" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
              Home
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </a>
        </li>
        <li class="me-1">
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="block py-2 pr-4 pl-3 list-menu hover:text-yellow-300">
            <i data-tooltip-target="tooltip-post" class="bi bi-plus-square-fill fa-lg">
              <div id="tooltip-post" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                New Post
                <div class="tooltip-arrow" data-popper-arrow></div>
              </div>
            </i>
          </button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-dark">
                <div class="modal-header">
                  <h5 class="modal-title text-lg" id="exampleModalLabel">Add New Post</h5>
                  <button class="btn-close bg-light text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <form action="newPost" enctype="multipart/form-data" id="add-new-post" method="post">
                    <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Caption :</label>
                      <textarea placeholder="what is going on in your mind . . ." name="caption1" required class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3 d-flx">
                      <span>Would you like to share the media with your post?</span>
                      <span class="ms-1">
                        <button onclick="UploadMedia('show')" type="button" class="btn btn-sm btn-primary px-2 py-0 me-3">Yes</button>
                        <button onclick="UploadMedia('hide')" type="button" class="btn btn-sm btn-danger px-2 py-0">No</button>
                      </span>
                      <div id="media" style="display: none;" class="col-12 my-3">
                        <div class="input-group input-group-sm">
                          <input accept="image/*, video/*, audio/*" onchange="CheckSize(this)" type="file" class="form-control" id="fileUpload" name="fileUpload">
                          <button onclick="CheckInput('media','fileUpload')" class="btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm" type="button" id="button-addon1">Done</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                  <button type="submit" form="add-new-post" class="btn btn-primary btn-sm">Post</button>
                </div>
              </div>
            </div>
          </div>
        </li>

        <li class="me-1">
          <button data-tooltip-target="tooltip-activity" id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="inline-flex items-center text-md font-medium text-center py-2 pr-4 pl-3 list-menu hover:text-yellow-300" type="button">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
            </svg>
            <div class="flex relative">
              <div class="inline-flex relative -top-2 right-3 w-3 h-3 bg-red-500 rounded-full border-2 border-white dark:border-gray-900"></div>
            </div>
          </button>
          <div id="tooltip-activity" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-lg opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Notifications
            <div class="tooltip-arrow" data-popper-arrow></div>
          </div>

        </li>
        <li class="m-0">
          <a href="#" data-tooltip-target="tooltip-Messanger" class="block py-2 pr-4 pl-3 list-menu hover:text-yellow-300">
            <i class="bi bi-send-exclamation-fill fa-lg position-relative"></i>
            <div id="tooltip-Messanger" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
              Messanger
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </a>
        </li>
        <li class="input-group d-none d-md-block d-lg-block d-xl-block d-xxl-block">
          <form id="search-form" class="d-flex me-5" role="search">
            <div class="input-group">
              <input onchange="Checktext(this,'dropdownUsersButton')" type="text"name="search-input" id="search-input" type="search" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;" class="form-control" placeholder="# Explore" aria-label="Recipient's username" aria-describedby="button-addon2">
              <button disabled onclick="SearchUser()" id="dropdownUsersButton" data-dropdown-toggle="dropdownUsers" data-dropdown-placement="bottom" class="btn btn-outline-light bi bi-search" type="button" id="button-addon2"></button>
              <div id="dropdownUsers" class="hidden z-10 w-72 bg-dark rounded shadow dark:bg-gray-700">
                <ul id="search-records" class="overflow-y-auto py-1 h-32 scrollbar text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">

                </ul>
              </div>
            </div>
          </form>
        </li>
      </ul>
      <form id="search-form1" class="display-none me-5" role="search">
        <div class="input-group d-block-sm d-block-xs">
          <input name="search-input" type="text" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;" class="form-control" placeholder="# Explore" aria-describedby="button-addon">
          <button onclick="SearchUser1()" id="dropdownUsersButton1" data-dropdown-toggle="dropdownUsers1" data-dropdown-placement="bottom" class="btn btn-outline-light bi bi-search" type="button" id="button-addon"></button>
          <div id="dropdownUsers1" class="hidden z-10 w-72 bg-dark rounded shadow dark:bg-gray-700">
            <ul id="search-records1" class="overflow-y-auto py-1 h-32 scrollbar text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton1">

            </ul>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>