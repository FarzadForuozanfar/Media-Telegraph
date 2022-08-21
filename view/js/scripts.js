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

function Checktext(element,buttonId)
{
        if(element.value)
        {
                document.getElementById(buttonId).disabled = false;
        }
        else
        {
                document.getElementById(buttonId).disabled = true;
        }
}
// Fetch API AJAX request
async function SendComment(postId,img,username) {

        let form = document.getElementById("form-comment"+postId);
        let formData = new FormData(form);
        let response = await fetch("addComment", {
                method: "POST",
                body: formData
        });
        let result = await response.text();
        if(result)
        {
                console.log("Failed to add comment");
                alert(result);
        }
        else
        {
                console.log("Comment added successfully");
                let Comments_list = document.getElementById("comment-list" + postId);
                let comment = `<div class="list-group-item list-group-item-action bg-gray-800 hover:bg-gray-800 text-white" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex align-items-center mb-1">
                                <img loading="lazy" class="profile-comments" src="${img}" alt="${username}">
                                <a class="ms-2 cursor-pointer">${username}</a>
                        </div>
                        <span>
                                <span class="bg-warning text-gray-50 text-xs font-small px-1 inline-flex items-center rounded dark:bg-gray-700 dark:text-gray-300">
                                        <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        just now
                                </span>
                        </span>
                        </div>
                        <p class="p-0">${document.getElementById("cpation"+postId).value}</p>
                </div>`;
                let comment_cnt = document.getElementById("comments-count-post"+postId).innerHTML;
                comment_cnt++;
                document.getElementById("comments-count-post"+postId).innerHTML = '';
                document.getElementById("comments-count-post"+postId).innerHTML = comment_cnt;
                let comment_div = document.createElement('div');
                comment_div.innerHTML += comment;
                Comments_list.prepend(comment_div);
                document.getElementById("cpation"+postId).value = null;
                document.getElementById("button-"+postId).disabled = true;
        }
}
// like post
function LikePost(element,postId){
        let like_cnt = document.getElementById("post-like-cnt-"+postId).innerHTML;
        let form = document.getElementById("form-like-"+postId);
        let formData = new FormData(form);
        fetch("likePostProcess",{
                method: "POST",
                body: formData
        }).then(response =>{
                if(element.classList.contains('text-white')){
                        element.classList.add('text-danger');
                        element.classList.add('bi-heart-fill');
                        element.classList.remove('text-white');
                        element.classList.remove('bi-heart');
                        like_cnt++;
                        document.getElementById("post-like-cnt-"+postId).innerHTML = '';
                        document.getElementById("post-like-cnt-"+postId).innerHTML = like_cnt;
                }
                else if(element.classList.contains('text-danger')){
                        element.classList.remove('text-danger');
                        element.classList.remove('bi-heart-fill');
                        element.classList.add('text-white');
                        element.classList.add('bi-heart');
                        like_cnt--;
                        document.getElementById("post-like-cnt-"+postId).innerHTML = '';
                        document.getElementById("post-like-cnt-"+postId).innerHTML = like_cnt;
                }
        }).catch(error =>{console.error(error);});
}
// error handling
var objCal1 = new AMIB.persianCalendar('pcal1',
        { extraInputID: "extra", extraInputFormat: "YYYYMMDD" }
);

let calendar_btn = document.getElementsByClassName("pcalBtn");
calendar_btn[0].setAttribute("id", "para-1");
var elem = document.createElement("img");
elem.setAttribute("src", "view/img/icon.png");
elem.setAttribute("height", "38");
elem.setAttribute("width", "38");
elem.setAttribute("alt", "calendar-icon");
calendar_btn[0].appendChild(elem);
let calendar = document.getElementById("calendar");
calendar.appendChild(calendar_btn[0]);



