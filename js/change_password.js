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
 var pw1 = document.getElementById('pw1').value;
 var pw2 = document.getElementById('pw2').value;
 var form = document.getElementById("changePassword");
 var er = document.getElementById('error');
 var valid = 0;
 // Check#2: is password 6 characters or more
 if(pw1.length > 5){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "<span class='icon-warning red'><'span>Password must be 6 characters or more";
    er.style.display = "inline-block";
    return
 }
 // Check#3: does password include letters and numbers
 if(/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/g.test(pw1)){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "<span class='icon-warning red'><'span>Password must contain at least 1 letter and one number";
    er.style.display = "inline-block";
    return
 }
 // Check#4: do passwords match
 if(pw1 == pw2){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "<span class='icon-warning red'><'span>Passwords must match";
    er.style.display = "inline-block";
    return
 }

 // Check#5 password length
 if(pw1.length < 50){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "<span class='icon-warning red'><'span>Password too long 49 character max";
    er.style.display = "inline-block";
    return
 }
 // if all checks clear submit the form
 form.submit();
}