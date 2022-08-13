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

function CheckSize(input) {
        const fileSize = input.files[0].size / 1024 / 1024; // in MiB
        if (fileSize > 4) {
                alert('File size exceeds 4 MiB');
                input_photo.value = null;
        }
        console.log(input.files[0].type.split('/')[0]);
}
function CheckInput(type) {
        if (input_photo.files[0] != null) {
                if (type == 'image') {
                        if(input_photo.files[0].type.split('/')[0] != 'image') {
                                input_photo.value = null;
                                alert('Please select a photo to upload');
                        }
                }

                else if (type == 'video') {
                        if(input_photo.files[0].type.split('/')[0] != 'video') {
                                input_photo.value = null;
                                alert('Please select a video to upload');
                        }
                }
                else if (type == 'audio') {
                        if(input_photo.files[0].type.split('/')[0] != 'audio') {
                                input_photo.value = null;
                                alert('Please select a audio to upload');
                        }
                }
        }
        else
                alert("Please first upload an " + type);
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