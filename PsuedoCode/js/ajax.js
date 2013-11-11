// JavaScript Document

function generateFields(place) {
    
var destination = document.getElementById(place).value;
var  xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      //var recievedInfo = response; 
    document.getElementById(place).value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","php/airports.php?dest=" + destination, true);
xmlhttp.send(null);
}


function cookieMonsterMake(name, userID) {
//This function will make a cookie for the users browser after they have
//created an account

var cookieDate = new Date(2020, 10, 10);
var FTSID = "ID = FlightTicketingServiceCookie ";

var cookieName = FTSID + " | " + name + "= | " + userID + " | ";

document.cookie = cookieName + "; expires=" + cookieDate.toGMTString();
document.cookie = "logged_in=yes";
}//End cookieMonsterMake function

var PHPResponse = "";

fooBar = 1;
function cookieMonsterEat(elementID) {
//This function will pull our cookie from the users broswer

var otherCookie = document.cookie;
if(!otherCookie) {
    return null;
}
var cookieInfo = new Array;
cookieInfo = otherCookie.split("|");
var userID = cookieInfo[2];

var  xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById(elementID).innerHTML = (xmlhttp.responseText);
    document.getElementById(elementID).value = (xmlhttp.responseText);
    if(xmlhttp.responseText == "David") {
        setInterval("blink()",750);
    }
    }
  }
  
xmlhttp.open("GET","php/pulluserdata.php?userid=" + userID, true);
xmlhttp.send(null);

}//End cookieMonsterEat function


function blink() {

  if(fooBar==0) {
    document.getElementById("davidIsRoot").innerHTML = "<span class=\"wordText\"; \"this.style.color='red';\">!!!ROOT USER!!!</span>"
		
    fooBar=1;
  }
  else {
    document.getElementById("davidIsRoot").innerHTML = "<span class=\"wordText\"; \"this.style.color='green';\">!!!ROOT USER!!!</span>"
    fooBar=0;
  }
}

function checkPassword(userName ,psw) {
/*
var otherCookie = document.cookie;
if(!otherCookie) {
    return null;
}
var cookieInfo = new Array;
cookieInfo = otherCookie.split("|");
var userID = cookieInfo[2];
*/
var password = document.getElementById(psw).value;
var name = document.getElementById(userName).value;

var  xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    var responseFields = xmlhttp.responseText; 
    var splitResponseFields = responseFields.split("|");
    if(splitResponseFields[0] == "OK") {
        alert("ALL GOOD!");
        cookieMonsterMake("name", splitResponseFields[1]);
        window.location = "http://codd.cs.gsu.edu/~bbabbitt1/web/account.html";
    }
    else {
        alert("Your username does not match your password!");
    }
    }
  }
  
xmlhttp.open("GET","php/checkpassword.php?psw=" + password +"&userName=" + name, true);
xmlhttp.send(null);
}//End checkPassword function

function pullAccountInformation(pageID) {
    if(pageID == "account") {
        var otherCookie = document.cookie;
    if(!otherCookie) {
        window.location = "http://codd.cs.gsu.edu/~bbabbitt1/web/userlogin.html";
    }
    }
    
    var otherCookie = document.cookie;
    if(!otherCookie) {
        return null;
    }
    var cookieInfo = new Array;
    cookieInfo = otherCookie.split("|");
    var userID = cookieInfo[2];
    if(userID == "") {
        window.location = "http://codd.cs.gsu.edu/~bbabbitt1/web/userlogin.html";
    }
    var  xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        
        var allFields = (xmlhttp.responseText);
        var splitFields = allFields.split("|");
        document.getElementById("firstNameField").value = splitFields[1];
        document.getElementById("lastNameField").value = splitFields[2];
        document.getElementById("addressFieldOne").value = splitFields[3];
        //For addressFieldTwo, city, state zip
        document.getElementById("addressFieldTwo").value = splitFields[4] + ", " + splitFields[5] + " " + splitFields[6];
        document.getElementById("emailAddressField").value = splitFields[7];
    }
  }
  
xmlhttp.open("GET","php/pullalluserdata.php?userid=" + userID, true);
xmlhttp.send(null);
  
}//End pullAccountInformation function


function checkFlightStatus() {
    //This function will pull flight status information and print it out
    //in a table for the user to see on the flightstatus.html page
    
    
    var flightNumber = document.getElementById("flightStatusBox").value;
    var  xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        
        
        
        var flightInformation = (xmlhttp.responseText);
        document.getElementById("areaForFlightStatus").innerHTML = flightInformation;
    } 
}

xmlhttp.open("GET","php/flightstatus.php?flightnumber=" + flightNumber, true);
xmlhttp.send(null);
}


function bookFlight() {
    //This function will pull our cookie from the users broswer

var otherCookie = document.cookie;
if(!otherCookie) {
    return null;
}
var cookieInfo = new Array;
cookieInfo = otherCookie.split("|");
var userID = cookieInfo[2];

var  xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    if((xmlhttp.responseText) != "") {
        //The user is already logged in.  goto (final -1) book flight page

        window.location = "http://codd.cs.gsu.edu/~bbabbitt1/web/finalbookflight.php?flightNumber=" +
            document.getElementById("flightNumber").value +
            "&secondFlightNumber=" +
            document.getElementById("secondFlightNumber").value +
            
            "&userid=" + userID;
    }
    else {
        //Go to login page   NEEDS TO SAVE THE FLIGHT INFORMATION
        window.location = "http://codd.cs.gsu.edu/~bbabbitt1/web/userlogin.html";
    }
  }
}
  
xmlhttp.open("GET","php/pulluserdata.php?userid=" + userID, true);
xmlhttp.send(null);
    
    
}

 
function checkFieldsAndSubmit() {
//This function will check fields from the finalbookflight.php page, alert
//the user if there is anything wrong, and will then redirect the user to 
//another php page that will save the information and will thank the user.

if(document.getElementById("rowID") == "") {
    alert("Please pick a seat!");
    return;
}

//once all is good, submit the form.
document.finalbookflight.submit();

}


black = new Image();
black.src="images/black.gif";

function getBookedSeats() {
 
 //document.getElementById("image"+imageNumber).src = aRed.src
 var  xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    if((xmlhttp.responseText) != "") {
        
        seatNumber = xmlhttp.responseText.split("|");
        for(i = 0; i < seatNumber.length-1; i++) {
            document.getElementById("image"+seatNumber[i]).src = black.src
        }
        
        
    }
   
  }
}
var flight = document.getElementById("flightNumberField").value;
xmlhttp.open("GET","php/getSeatInfo.php?flight=" + flight, true);
xmlhttp.send(null);
}