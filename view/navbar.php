<nav class="navbar-dark bg-dark border border-top-0 border-start-0 border-end-0 border-gray-200 px-2 sm:px-4 py-2.5 rounded ">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
    <i href="https://flowbite.com/" class="flex items-center">
        <img src="img/Screenshot (612).png" style="border-radius: 100%; width: 42.5px; height: 43px;" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
        <span class="text-transparent bg-clip-text bg-gradient-to-br from-gray-300 to-yellow-400" style="font-size:30px; font-family: 'Courier New', monospace; font-weight:bolder;">Telegraph</span>
    </i>
    <div class="flex items-center md:order-2">
        
        <button type="button" class="flex mr-3 text-white text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <img class="mr-2 w-8 h-8 rounded-full" src="https://media-exp1.licdn.com/dms/image/C4E03AQHQ9KZj8Lri1w/profile-displayphoto-shrink_800_800/0/1650810794384?e=1665014400&v=beta&t=aCu3E8I-ss2-3ZbUx9AzeED_jEw1rRmWwO8DPzgJsCY" alt="user photo">
            <span>Farzad</span>
            <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
        <!-- Dropdown menu -->
       
        <div class="hidden z-10 w-36 bg-gray-300 rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 block" id="user-dropdown" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(319.2px, 62.4px, 0px);">
                  
            <div class="py-1 ps-2 text-sm text-gray-700 dark:text-gray-300" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                
              <div class="cursor-pointer py-2 ">
                <i class="bi bi-person-circle me-2"></i><a href="#" class=" text-dark py-2 text-decoration-none">Profile</a>
              </div>
              <div class="cursor-pointer py-2">
                <i class="bi bi-file-earmark-plus me-2"></i><a href="#" class=" text-dark py-2 text-decoration-none">Saved</a>
              </div>
              <div class="cursor-pointer py-2">
                <i class="bi bi-gear-fill me-2"></i><a href="#" class="text-dark py-2 text-decoration-none">Setting</a>
              </div>
            </div>
            <div class="py-1 ps-2">
              <i class="bi bi-box-arrow-right me-2"></i><a href="#" class=" text-dark py-2 text-decoration-none"> Sign out</a>
            </div>
          </div>
        <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
    </div>
    <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
        
      <ul class="flex p-1 mt-1 rounded-lg md:flex-row md:space-x-8 text-white">
        <li>
            <a href="#" class="block py-2 pr-4 pl-3 list-menu hover:text-yellow-300">
                <i class="bi bi-house fa-lg" aria-hidden="true"></i>
          </a>
        </li>
        <li>
            <a href="#" class="block py-2 pr-4 pl-3 list-menu hover:text-yellow-300">
                <i class="bi bi-plus-square-fill fa-lg"></i>
          </a>
        </li>
        <li>
            <a href="#" class="block py-2 pr-4 pl-3 list-menu hover:text-yellow-300">
                <i class="bi bi-heart-fill fa-lg position-relative"></i>
          </a>
        </li>
        <li class="">
          <a href="#" class="block py-2 pr-4 pl-3 list-menu hover:text-yellow-300">
            <i class="bi bi-people-fill fa-lg position-relative"></i>
          </a>
        </li>
        <li  class="input-group d-none d-md-block d-lg-block d-xl-block d-xxl-block">
            <form class="d-flex me-5" role="search">
                <div class="input-group">
                  <input type="text" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;" class="form-control" placeholder="# Explore" aria-label="Recipient's username" aria-describedby="button-addon2">
                  <button class="btn btn-outline-light bi bi-search" type="button" id="button-addon2"></button>
                </div>
              </form>        
        </li>
      </ul>
      <form class="display-none me-5" role="search">
        <div class="input-group d-block-sm d-block-xs">
                  <input type="text" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;" class="form-control" placeholder="# Explore" aria-label="Recipient's username" aria-describedby="button-addon2">
                  <button class="btn btn-outline-light bi bi-search" type="button" id="button-addon2"></button>
                </div>
      </form>   
    </div>
    </div>
  </nav>
  