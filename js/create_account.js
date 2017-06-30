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
 var name = document.getElementById('name').value;
 var mail = document.getElementById('email').value;
 var pw = document.getElementById('pw').value;
 var pw2 = document.getElementById('pw2').value;
 var form = document.getElementById("createAccountForm");
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
    return;
 }
 // Check#2: is password 8 characters or more
 if(pw.length > 7){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Password must be 6 characters or more";
    er.style.display = "inline-block";
    return;
 }
 // Check#3: does password include letters and numbers
 if(/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/g.test(pw)){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Password must contain at least 1 uppercase letter and one number";
    er.style.display = "inline-block";
    return;
 }
 // Check#4: do passwords match
 if(pw == pw2){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Passwords must match";
    er.style.display = "inline-block";
    return;
 }

 // Check#5 password length
 if(pw.length < 50){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Password too long 49 character max";
    er.style.display = "inline-block";
    return;
 }

 // Check#5 name length
 if(name.length < 75){
    valid++;
    er.innerHTML = "";
    er.style.display = "none";
 } else {
    er.innerHTML = "Name too long 49 character max";
    er.style.display = "inline-block";
    return;
 }
 
 // Check #6 Account Type Selected
var select = document.getElementById( 'actType' );
    selIndex = select.selectedIndex;
    if (selIndex == 0) {
    	alert("Plese select account type");
    	return;
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

function accountType(){
	var select = document.getElementById( 'actType' );
	var selIndex = select.selectedIndex;
	var ein = document.getElementById('einField');
	var phone = document.getElementById('telephone');
	if (selIndex == 2) {
		ein.style.display = "inline-block";
		phone.style.display = "none";
	}else{
		ein.style.display = "none";	
		phone.style.display = "inline-block";
	}
	return;
}