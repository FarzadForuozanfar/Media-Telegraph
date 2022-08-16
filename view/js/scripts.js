var image = document.querySelector('#div-photo');
var video = document.querySelector('#div-video');
var audio = document.querySelector('#div-audio');

var input_photo = document.getElementById("photoUpload");
var input_video = document.getElementById("videoUpload");
var input_audio = document.getElementById("audioUpload");

function upload_img() {
        image.style.display = "flex";
        input_photo.required = true;

        video.style.display = "none";
        input_video.required = false;

        audio.style.display = "none";
        input_audio.required = false;

        input_video.value = null;
        input_audio.value = null;
        
}

function upload_video() {
        image.style.display = "none";
        input_photo.required = false;

        video.style.display = "flex";
        input_video.required = true;

        audio.style.display = "none";
        input_audio.required = false;

        input_photo.value = null;
        input_audio.value = null;
        
}

function upload_audio() {
        image.style.display = "none";
        input_photo.required = false;

        video.style.display = "none";
        input_video.required = false;

        audio.style.display = "flex";
        input_audio.required = true;

        input_video.value = null;
        input_photo.value = null;
        
}

function UploadMedia(statuse){
        if(statuse == 'show')
        {
                document.getElementById("media").style.display = "block";
                document.getElementById("fileUpload").value = null;
        }
        else if(statuse == 'hide')
        {
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
function CheckInput(type,id) {
        let element = document.getElementById(id);
        if (element.files[0] != null) {
                if (type == 'image') {
                        if(element.files[0].type.split('/')[0] != 'image') {
                                element.value = null;
                                alert('Please select a photo to upload');
                        }
                        else
                        {
                                alert("successfully uploaded");
                        }
                        
                }
                else if (type == 'video') {
                        if(element.files[0].type.split('/')[0] != 'video') {
                                element.value = null;
                                alert('Please select a video to upload');
                        }
                        else
                        {
                                alert("successfully uploaded");
                        }
                }
                else if (type == 'audio') {
                        if(element.files[0].type.split('/')[0] != 'audio') {
                                element.value = null;
                                alert('Please select a audio to upload');
                        }
                        else
                        {
                                alert("successfully uploaded");
                        }
                }
                else if (type == 'media') {
                        if(element.files[0].type.split('/')[0] != 'image' && element.files[0].type.split('/')[0] != 'audio' && element.files[0].type.split('/')[0] != 'video') {
                                element.value = null;
                                alert('Please select a media to upload');
                        }
                        else
                        {
                                alert("successfully uploaded");
                        }
                }

        }
        else
                alert("Please first upload an " + type);
}
function ShowHideComments(id)
{
        element = document.getElementById(id);
        element.innerHTML ='';
        if(element.getAttribute('name') == 'hide')
        {
                element.setAttribute('name','show');
                element.innerHTML = 'Hide Comments';
        }
        else
        {
                element.setAttribute('name','hide');
                element.innerHTML = 'Show Comments'; 
        }
}

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