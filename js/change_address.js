/*
This function checks user keypress for return and if true
sends the form for validation
*/
function checkForReturn(e){
    var keyNum = e.keyCode || e.which;
    if (keyNum == 13){
        validateForm();
    }
}

/*
Validates data in the form and if valis submits the form
else returns error message
*/
function validateForm(){
// create object variables from form
 var fname = document.getElementById('fname').value;
 var lname = document.getElementById('lname').value;
 var street = document.getElementById('street').value;
 var line2 = document.getElementById('line2').value;
 var city = document.getElementById('city').value;
 var state = document.getElementById('state').value;
 var zip = document.getElementById('zip').value;
 var form = document.getElementById("changeAddress");
 var er = document.getElementById('error');
 var valid = 0;

 // is fname >0 & < 50 characters
 if(fname.length < 50){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "First name must be less than 50 characters";
    er.style.display = "inline-block";
    return
 }
 // is lname >0 & < 50 characters
 if(lname.length < 50){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Last name must be less than 50 characters";
    er.style.display = "inline-block";
    return
 }

 // is street address > 125 characters
 if(street.length < 126){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Street address must be less than 126 characters";
    er.style.display = "inline-block";
    return
 }
 // is Address Line 2 > 125 characters
 if(line2.length < 126){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Address Line 2 must be less than 126 characters";
    er.style.display = "inline-block";
    return
 }
 // is city > 50 characters
 if(city.length < 50){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "City must be less than 50 characters";
    er.style.display = "inline-block";
    return
 }
 // is state > 30 characters
 if(state.length < 30){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "State must be less than 30 characters";
    er.style.display = "inline-block";
    return
 }
  // is zip less than 10 characters
 if(zip.length < 10){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Zip must be less than 10 characters";
    er.style.display = "inline-block";
    return
 }
// are all the required fields
 var full = true;
 if(fname.length < 1) full = false;
 if(lname.length < 1) full = false;
 if(street.length < 1) full = false;
 if(city.length < 1) full = false;
 if(state.length < 1) full = false;
 if(zip.length < 1) full = false;

 if(full){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    document.getElementById('fname').style.backgroundColor = "#CC99CC";
    document.getElementById('lname').style.backgroundColor = "#CC99CC";
    document.getElementById('street').style.backgroundColor = "#CC99CC";
    document.getElementById('city').style.backgroundColor = "#CC99CC";
    document.getElementById('state').style.backgroundColor = "#CC99CC";
    document.getElementById('zip').style.backgroundColor = "#CC99CC";
    er.innerHTML = "Be sure to fill all the highlighted fields";
    er.style.display = "inline-block";
    return
 }

 // if all checks clear submit the form
 form.submit();
}