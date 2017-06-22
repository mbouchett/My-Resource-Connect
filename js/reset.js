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
 var mail = document.getElementById('email').value;
 var pw0 = document.getElementById('pw0').value;
 var pw1 = document.getElementById('pw1').value;
 var pw2 = document.getElementById('pw2').value;
 var form = document.getElementById("resetForm");
 var er = document.getElementById('error');
 var valid = 0;
 // Check #1: is email valid
 if(validateEmail(mail)){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Not a valid email address<br>Please correct and try again.";
    er.style.display = "inline-block";
    return
 }
 // Check#2: is password 6 characters or more
 if(pw1.length > 5){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Password must be 6 characters or more";
    er.style.display = "inline-block";
    return
 }
 // Check#3: does password include letters and numbers
 if(/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/g.test(pw1)){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Password must contain at least 1 letter and one number";
    er.style.display = "inline-block";
    return
 }
 // Check#4: do passwords match
 if(pw1 == pw2){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Passwords must match";
    er.style.display = "inline-block";
    return
 }

 // Check#5 password length
 if(pw1.length < 50){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Password too long 49 character max";
    er.style.display = "inline-block";
    return
 }
 // if all checks clear submit the form
 form.submit();
}

/*
takes email as a parameter returns boolean true if valid else returns false
*/
function validateEmail(email){
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
       return true;
   }else return false;
}