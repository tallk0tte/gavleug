
/* Funktion för kalendern */
function initialCalendar() {
    var hr = new XMLHttpRequest();
    var url = "calendar.php";
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var year = currentTime.getFullYear();
    showmonth = month;
    showyear = year;
    var vars = "showmonth="+showmonth+"&showyear="+showyear;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("showCalendar").innerHTML = return_data;
        }
    }
    hr.send(vars);
    document.getElementById("showCalendar").innerHTML = "";
}

/* Funktion för att knappen "next month" ska framåt 1 månad */
function next_month() {
    var nextmonth = showmonth + 1;
    if(nextmonth > 12){
        nextmonth = 1;
        showyear = showyear + 1;
    }
    showmonth = nextmonth;
    var hr = new XMLHttpRequest();
    var url = "calendar.php";
    var vars = "showmonth="+showmonth+"&showyear="+showyear;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200){
            var return_data = hr.responseText;
            document.getElementById("showCalendar").innerHTML = return_data;
        }
    }
    hr.send(vars);
    document.getElementById("showCalendar").innerHTML = "";
}

/* Funktion för att knappen "previous month" ska gå bakåt 1 månad */
function prev_month() {
    var previousmonth = showmonth - 1;
    if(previousmonth < 1){
        previousmonth = 12;
        showyear = showyear - 1;
    }
    showmonth = previousmonth;
    var hr = new XMLHttpRequest();
    var url = "calendar.php";
    var vars = "showmonth="+showmonth+"&showyear="+showyear;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200){
            var return_data = hr.responseText;
            document.getElementById("showCalendar").innerHTML = return_data;
        }
    }
    hr.send(vars);
    document.getElementById("showCalendar").innerHTML = "";
}


function overlay() {
    e1 = document.getElementById("overlay");
    e1.style.display = (e1.style.display == "block") ? "none" : "block";
    e1 = document.getElementById("events");
    e1.style.display = (e1.style.display == "block") ? "none" : "block";
    e1 = document.getElementById("eventsBody");
    e1.style.display = (e1.style.display == "block") ? "none" : "block";
}


function show_details(theId) {
    var deets = (theId.id);
    e1 = document.getElementById("overlay");
    e1.style.display = (e1.style.display == "block") ? "none" : "block";
    e1 = document.getElementById("events");
    e1.style.display = (e1.style.display == "block") ? "none" : "block";
    var hr = new XMLHttpRequest();
    var url = "events.php";
    var vars = "deets="+deets;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("events").innerHTML = return_data;
        }
    }
    hr.send(vars);
    document.getElementById("events").innerHTML = "";
    
}
