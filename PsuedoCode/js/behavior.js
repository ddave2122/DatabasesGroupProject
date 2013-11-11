// JavaScript Document

$(document).ready(function() {

  $("nav#global a").click(function(){
    $("nav#global a").removeClass("fpo");
    $(this).addClass("fpo");
    });
  
});

function generateFields() {
    
var fromDest = document.getElementById("fromTextField").value;
var toDest = document.getElementById("toTextField").value;
var  xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      var recievedInfo = response.Text.split(","); 
    document.getElementById("fromTextField").innerHTML=recievedInfo[0];
    docuemt.getElementById("toTextField").innerHTML=recievedInfo[1];
    }
  }
xmlhttp.open("GET","ajaxbonus2.php?from=" + fromDest +"&to=" + toDest, true);
xmlhttp.send(null);
}

function checkNewAccountFields() {
    var incorrectFields = "";
    
    if(document.getElementById("firstNameField").value == "") {
        incorrectFields += "first Name ";
    }
    if(document.getElementById("lastNameField").value == "") {
        incorrectFields += "last name ";
    }
    if(document.getElementById("addressFieldOne").value == "") {
        incorrectFields += "address field 1 ";
    }
    if(document.getElementById("cityAddressField").value == "") {
        incorrectFields += "address field 2 ";
    }
    if(document.getElementById("stateAddressField").value == "") {
        incorrectFields += "address field 3 ";
    }
    if(document.getElementById("zipCodeAddressField").value == "") {
        incorrectFields += "address field 3 ";
    }
    if(document.getElementById("billingAddressFieldOne").value == "") {
        incorrectFields += "billing address field 1 ";
    }
    if(document.getElementById("billingCityAddressField").value == "") {
        incorrectFields += "billing address field 2 ";
    }
    if(document.getElementById("billingStateAddressField").value == "") {
        incorrectFields += "billing address field 3";
    }
    if(document.getElementById("billingZipCodeAddressField").value == "") {
        incorrectFields += "billing address field 3";
    }
    if(document.getElementById("creditCardNumberField").value == "") {
        incorrectFields += "credit card number ";
    }
    if(document.getElementById("creditCardExpField").value == "") {
        incorrectFields += "credit card EXP ";
    }
    if(document.getElementById("creditCardCVVField").value == "") {
        incorrectFields += "credit card CVV";
    }
    
    //Find out which credit card is selected and store it
    for (i=0;i<document.newAccount.creditCardButton.length;i++){
        if (document.newAccount.creditCardButton[i].checked==true){
            if(i == 0) {
               document.getElementById("creditCardType").value = "AMEX"; 
            }
            if(i == 1) {
               document.getElementById("creditCardType").value = "VISA"; 
            }
            if(i == 2) {
               document.getElementById("creditCardType").value = "Discover"; 
            }
            if(i == 3) {
               document.getElementById("creditCardType").value = "Mastercard"; 
            }
        
        
        }
    }
    
    if(incorrectFields != "") {
        alert("Please ensure that the following fields are checked: " + <br /> + incorrectFields);
        incorrectFields = "";
    return false;
    }
    else {
   
        document.newAccount.submit();
    }

}//End checkNewAccountFields

function copyAddressField() {
    // This function will copy the residency address into the billing address 
    // fields if the checkbox is checked on the createNewAccount.html page
    if(document.getElementById("addressCheckBox").checked) {
        document.getElementById("billingAddressFieldOne").value = document.getElementById("addressFieldOne").value
        document.getElementById("billingCityAddressField").value = document.getElementById("cityAddressField").value
        document.getElementById("billingStateAddressField").value = document.getElementById("stateAddressField").value
        document.getElementById("billingZipCodeAddressField").value = document.getElementById("zipCodeAddressField").value
    }
    else {
        document.getElementById("billingAddressFieldOne").value = "";
        document.getElementById("billingCityAddressField").value = "";
        document.getElementById("billingStateAddressField").value = "";
        document.getElementById("billingZipCodeAddressField").value = "";
    }
}//End copyAddressFields function



a = new Image();
a.src="images/a.gif";
aRed = new Image();
aRed.src="images/aRed.gif";
imageSelected="image10";

function selectImage(imageNumber) {
    //alert(document.getElementById("image"+imageNumber).src);
    if(document.getElementById("image"+imageNumber).src == "http://codd.cs.gsu.edu/~bbabbitt1/web/images/black.gif") {
        alert("That seat is already booked");
        return;
    }
    document.getElementById(imageSelected).src = a.src;
    document.getElementById("image"+imageNumber).src = aRed.src
    imageSelected = "image" + imageNumber;
    document.getElementById("rowID").value = imageNumber;
}

function checkPasswords() {
    if(document.getElementById("passwordFieldOne").value != document.getElementById("passwordFieldTwo").value) {
        alert("The two passwords do not match!");
        document.getElementById("passwordFieldOne").value = "";
        document.getElementById("passwordFieldTwo").value = "";
    }
}