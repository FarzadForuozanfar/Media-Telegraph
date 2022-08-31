var image = document.querySelector('#div-photo');
var video = document.querySelector('#div-video');
var audio = document.querySelector('#div-audio');

var input_photo = document.getElementById("photoUpload");
var input_video = document.getElementById("videoUpload");
var input_audio = document.getElementById("audioUpload");

function upload_img() {
        image.style.display = "flex";

        video.style.display = "none";

        audio.style.display = "none";

        input_video.value = null;
        input_audio.value = null;

}

function upload_video() {
        image.style.display = "none";

        video.style.display = "flex";

        audio.style.display = "none";

        input_photo.value = null;
        input_audio.value = null;

}

function upload_audio() {
        image.style.display = "none";

        video.style.display = "none";

        audio.style.display = "flex";

        input_video.value = null;
        input_photo.value = null;

}

function UploadMedia(statuse) {
        if (statuse == 'show') {
                document.getElementById("media").style.display = "block";
                document.getElementById("fileUpload").value = null;
        }
        else if (statuse == 'hide') {
                document.getElementById("media").style.display = "none";
                document.getElementById("fileUpload").value = null;
        }

}

function CheckSize(input) {
        const fileSize = input.files[0].size / 1024 / 1024; // in MiB
        if (fileSize > 4) {
                alert('File size exceeds 4 MiB');
                input_photo.value = null;
        }
}
function CheckInput(type, id) {
        let element = document.getElementById(id);
        if (element.files[0] != null) {
                if (type == 'image') {
                        if (element.files[0].type.split('/')[0] != 'image') {
                                element.value = null;
                                alert('Please select a photo to upload');
                        }
                        else {
                                alert("successfully uploaded");
                        }

                }
                else if (type == 'video') {
                        if (element.files[0].type.split('/')[0] != 'video') {
                                element.value = null;
                                alert('Please select a video to upload');
                        }
                        else {
                                alert("successfully uploaded");
                        }
                }
                else if (type == 'audio') {
                        if (element.files[0].type.split('/')[0] != 'audio') {
                                element.value = null;
                                alert('Please select a audio to upload');
                        }
                        else {
                                alert("successfully uploaded");
                        }
                }
                else if (type == 'media') {
                        if (element.files[0].type.split('/')[0] != 'image' && element.files[0].type.split('/')[0] != 'audio' && element.files[0].type.split('/')[0] != 'video') {
                                element.value = null;
                                alert('Please select a media to upload');
                        }
                        else {
                                alert("successfully uploaded");
                        }
                }

        }
        else
                alert("Please first upload an " + type);
}
function ShowHideComments(id) {
        element = document.getElementById(id);
        element.innerHTML = '';
        if (element.getAttribute('name') == 'hide') {
                element.setAttribute('name', 'show');
                element.innerHTML = 'Hide Comments';
        }
        else {
                element.setAttribute('name', 'hide');
                element.innerHTML = 'Show Comments';
        }
}

function Checktext(element, buttonId) {
        if (element.value) {
                document.getElementById(buttonId).disabled = false;
        }
        else {
                document.getElementById(buttonId).disabled = true;
        }
}
// Fetch API AJAX comments
async function SendComment(postId, img, username) {

        let form = document.getElementById("form-comment" + postId);
        let formData = new FormData(form);
        let response = await fetch("addComment", {
                method: "POST",
                body: formData
        });
        let result = await response.text();
        if (result) {
                console.log("Failed to add comment");
                alert(result);
        }
        else {
                console.log("Comment added successfully");
                let Comments_list = document.getElementById("comment-list" + postId);
                let comment = `<div class="list-group-item list-group-item-action bg-gray-800 hover:bg-gray-800 text-white" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex align-items-center mb-1">
                                <img loading="lazy" class="profile-comments" src="${img}" alt="${username}">
                                <a class="ms-2 cursor-pointer">${username}</a>
                        </div>
                        <span>
                                <span class="bg-warning text-gray-900 text-xs font-small px-1 inline-flex items-center rounded dark:bg-gray-700 dark:text-gray-300">
                                        <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        just now
                                </span>
                        </span>
                        </div>
                        <p class="p-0">${document.getElementById("cpation" + postId).value}</p>
                </div>`;
                let comment_cnt = document.getElementById("comments-count-post" + postId).innerHTML;
                comment_cnt++;
                document.getElementById("comments-count-post" + postId).innerHTML = '';
                document.getElementById("comments-count-post" + postId).innerHTML = comment_cnt;
                let comment_div = document.createElement('div');
                comment_div.innerHTML += comment;
                Comments_list.prepend(comment_div);
                document.getElementById("cpation" + postId).value = null;
                document.getElementById("button-" + postId).disabled = true;
        }
}
//search user
function SearchUser(button) {

        const input_search = document.getElementById("search-input");

        if (input_search.value != null) {

                let form = document.getElementById('search-form');
                let formData = new FormData(form);
                fetch("searchUser", {
                        method: "POST",
                        body: formData
                })
                        .then((response) => response.text())
                        .then(response => {
                                let search_container = document.getElementById("search-records");
                                search_container.innerHTML = '';
                                const result = JSON.parse(response);
                                if (result[0]['id'] != null) {
                                        for (const element of result) {
                                                let btn_follow;
                                                if (!element['me']) {
                                                        if (element['follows'] == 1) {
                                                                btn_follow = `
                                                                <div class ="col-5 d-flex justify-content-end px-1">
                                                                        <form id="form-follows-${element['id']}">
                                                                                <button onclick="FollowsProccess(this,${element['id']})" type="button" class="text-yellow-400 btn btn-outline-warning hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5">
                                                                                        Unfollow
                                                                                </button>
                                                                                <input type="hidden" name="following_id" value="${element['id']}">
                                                                                <input type="hidden" name="follower_id" value="${element['my_id']}">
                                                                        </form>
                                                                </div>`
                                                        }
                                                        else {
                                                                btn_follow = `
                                                                <div class ="col-5 d-flex justify-content-end px-1">
                                                                        <form id="form-follows-${element['id']}">
                                                                                <button onclick="FollowsProccess(this,${element['id']})" type="button" class="text-gray-900 bg-yellow hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5">
                                                                                        Follow
                                                                                </button>
                                                                                <input type="hidden" name="following_id" value="${element['id']}">
                                                                                <input type="hidden" name="follower_id" value="${element['my_id']}">
                                                                        </form>
                                                                </div>`

                                                        }
                                                }
                                                else {
                                                        btn_follow = ``;
                                                }
                                                let record = `<div class="col-12 d-flex hover:bg-gray-800 align-items-center">
                                                                        <div class="col-7 text-gray-50">
                                                                                <a href="profile?id=${element['id']}" class="flex items-center py-2 px-1">
                                                                                <img class="mr-2 w-9 h-9 border border-3 p-0 border-warning rounded-full" src="${element['image']}" alt="${element['username']}">
                                                                                ${element['username']}
                                                                                </a>
                                                                        </div>
                                                                        ${btn_follow}
                                                               </div>`;
                                                let list = document.createElement('li');
                                                list.innerHTML = record;
                                                search_container.appendChild(list);

                                        }
                                }
                                else {
                                        let record = `<p class="text-white text-center text-md">!!! not found !!!</p>`;
                                        let list = document.createElement('li');
                                        list.innerHTML = record;
                                        search_container.appendChild(list);
                                }


                        });
        }
        else
                button.setAttribute('data-dropdown-toggle', '')

}

function SearchUser1() {
        let form = document.getElementById('search-form1');
        let formData = new FormData(form);
        fetch("searchUser", {
                method: "POST",
                body: formData
        })
                .then((response) => response.json())
                .then(response => {
                        let search_container = document.getElementById("search-records1");
                        search_container.innerHTML = '';
                        if (response[0]['id'] != null) {
                                for (const element of response) {
                                        let btn_follow;
                                        if (!element['me']) {
                                                if (element['follows'] == 1) {
                                                        btn_follow = `
                                                                <div class ="col-5 d-flex justify-content-end px-1">
                                                                        <form id="form-follows-${element['id']}">
                                                                                <button onclick="FollowsProccess(this,${element['id']})" type="button" class="text-yellow-400 btn btn-outline-warning hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5">
                                                                                        Unfollow
                                                                                </button>
                                                                                <input type="hidden" name="following_id" value="${element['id']}">
                                                                                <input type="hidden" name="follower_id" value="${element['my_id']}">
                                                                        </form>
                                                                </div>`
                                                }
                                                else {
                                                        btn_follow = `
                                                                <div class ="col-5 d-flex justify-content-end px-1">
                                                                        <form id="form-follows-${element['id']}">
                                                                                <button onclick="FollowsProccess(this,${element['id']})" type="button" class="text-gray-900 bg-yellow hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5">
                                                                                        Follow
                                                                                </button>
                                                                                <input type="hidden" name="following_id" value="${element['id']}">
                                                                                <input type="hidden" name="follower_id" value="${element['my_id']}">
                                                                        </form>
                                                                </div>`

                                                }
                                        }
                                        else {
                                                btn_follow = ``;
                                        }
                                        let record = `<div class="col-12 d-flex hover:bg-gray-800 align-items-center">
                                                                <div class="col-7 text-gray-50">
                                                                        <a href="profile?id=${element['id']}" class="flex items-center py-2 px-1">
                                                                        <img class="mr-2 w-9 h-9 border border-3 p-0 border-warning rounded-full" src="${element['image']}" alt="${element['username']}">
                                                                        ${element['username']}
                                                                        </a>
                                                                </div>
                                                                ${btn_follow}
                                                        </div>`;
                                        let list = document.createElement('li');
                                        list.innerHTML = record;
                                        search_container.appendChild(list);
                                }
                        }

                        else {
                                let record = `<p class="text-white text-center text-md">!!! not found !!!</p>`;
                                let list = document.createElement('li');
                                list.innerHTML = record;
                                search_container.appendChild(list);
                        }

                });

}
// like post
function LikePost(element, postId) {
        let like_cnt = document.getElementById("post-like-cnt-" + postId).innerHTML;
        let form = document.getElementById("form-like-" + postId);
        let formData = new FormData(form);
        fetch("likePostProcess", {
                method: "POST",
                body: formData
        }).then(response => {
                if (element.classList.contains('text-white')) {
                        element.classList.add('text-danger');
                        element.classList.add('bi-heart-fill');
                        element.classList.remove('text-white');
                        element.classList.remove('bi-heart');
                        like_cnt++;
                        document.getElementById("post-like-cnt-" + postId).innerHTML = '';
                        document.getElementById("post-like-cnt-" + postId).innerHTML = like_cnt;
                }
                else if (element.classList.contains('text-danger')) {
                        element.classList.remove('text-danger');
                        element.classList.remove('bi-heart-fill');
                        element.classList.add('text-white');
                        element.classList.add('bi-heart');
                        like_cnt--;
                        document.getElementById("post-like-cnt-" + postId).innerHTML = '';
                        document.getElementById("post-like-cnt-" + postId).innerHTML = like_cnt;
                }
        }).catch(error => { console.error(error); });
}
// follow unfollow
function FollowsProccess(button_id, postId) {
        let form = document.getElementById("form-follows-" + postId);

        let formData = new FormData(form);
        fetch("followProccess", {
                method: "POST",
                body: formData
        }).then(response => {

                let statuse = button_id.innerHTML;
                button_id.innerHTML = '';

                if (statuse == 'Unfollow') {
                        button_id.innerHTML = 'Follow';
                        button_id.classList.remove('text-yellow-400');
                        button_id.classList.add('text-gray-900');
                        button_id.classList.remove('btn');
                        button_id.classList.remove('btn-outline-warning');
                        button_id.classList.add('bg-yellow');
                        button_id.classList.remove('hover:bg-yellow');

                }
                else {
                        button_id.innerHTML = 'Unfollow';
                        button_id.classList.add('text-yellow-400');
                        button_id.classList.remove('text-gray-900');
                        button_id.classList.add('btn');
                        button_id.classList.add('btn-outline-warning');
                        button_id.classList.remove('bg-yellow');
                        button_id.classList.add('hover:bg-yellow');
                }
                
        }).catch(error => { console.error(error); });
}
function DeleteStory(story_id){
        let form = document.getElementById('story_id-'+story_id);
        let formData = new FormData(form);

        fetch("deleteStory", {
                method: "post",
                body: formData      
        }).then(response =>{
                let story_container = document.getElementById("story-"+story_id);
                story_container.innerHTML = '';
        }).catch(err => console.error(err));
}