var objCal1 = new AMIB.persianCalendar( 'pcal1',
            { extraInputID: "extra", extraInputFormat: "YYYYMMDD" }
        );

let calendar_btn = document.getElementsByClassName("pcalBtn");
console.log(calendar_btn);
calendar_btn[0].setAttribute("id", "para-1");
var elem = document.createElement("img");
elem.setAttribute("src", "view/img/icon.png");
elem.setAttribute("height", "38");
elem.setAttribute("width", "38");
elem.setAttribute("alt", "calendar-icon");
calendar_btn[0].appendChild(elem);
let calendar = document.getElementById("calendar");
calendar.appendChild(calendar_btn[0]);
console.log(calendar);
console.log(screen.width);


