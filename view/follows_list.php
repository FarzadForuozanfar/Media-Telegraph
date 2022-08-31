<!-- follower Modal -->
<?php
    if($_SESSION['username_login']['location'] == "home")
        $id_user_proccess = $post['id_user'];
    else
        $id_user_proccess = $user_id;
?>
<div class="modal fade" id="follower-modal<?php echo $id_user_proccess?>" tabindex="-1" aria-labelledby="follower-modalLabel<?php echo $id_user_proccess?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header text-white">
                <h1 class="modal-title text-lg" id="follower-modalLabel<?php echo $id_user_proccess?>">Followers List</h1>
                <button type="button" class="text-gray-100 bg-transparent hover:bg-gray-50 hover:text-gray-50 rounded-lg text-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="modal-body overflow-y-auto h-52 scrollbar">
                <?php GetFollows($id_user_proccess, "follower"); ?>
            </div>
        </div>
    </div>
</div>
<!-- following Modal -->
<div class="modal fade" id="following-modal<?php echo $id_user_proccess?>" tabindex="-1" aria-labelledby="following-modalLabel<?php echo $id_user_proccess?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header text-white">
                <h1 class="modal-title text-lg" id="following-modalLabel<?php echo $id_user_proccess?>">Following List</h1>
                <button type="button" class="text-gray-100 bg-transparent hover:bg-gray-50 hover:text-gray-50 rounded-lg text-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="modal-body overflow-y-auto h-52 scrollbar">
                <?php GetFollows($id_user_proccess, "following"); ?>
            </div>
        </div>
    </div>
</div>