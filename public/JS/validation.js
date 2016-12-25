// for empty feild check
function isEmpty(str,name){
  if(!str){
    document.getElementById(name).innerHTML = name + " Feild can not be empty.";
    return false;
  }
  else {
    document.getElementById(name).innerHTML = "";
    return true;
  }
}

// For Email validation check

function isValidEmail(str,name){
  var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if(!str.match(format)){
    document.getElementById(name).innerHTML = "This is not a valid email.";
    return false;
  }
  else {
    document.getElementById(name).innerHTML = "";
    return true;
  }
}

// for password validation check

function isValidPassword(str,name){
  var len = str.length;
  var upperAlpha = false;
  var lowerAlpha = false;
  var num = false;
  var errorMsg = "";
  for(var i = 0; i < len; i++){
    if(str[i] >= 'a' && str[i] <= 'z')lowerAlpha = true;
    else if(str[i] >= 'A' && str[i] <= 'Z')upperAlpha = true;
    else if(str[i] >= '0' && str[i] <= '9')num = true;
  }

  if(!lowerAlpha)errorMsg = "Password Must Contain At Least 1 Lowercase character.";
  else if(!upperAlpha)errorMsg = "Password Must Contain At Least 1 Uppercase character.";
  else if(!num)errorMsg = "Password Must Contain At Least 1 Number.";
  if(!upperAlpha || !lowerAlpha || !num){
    document.getElementById(name).innerHTML = errorMsg;
    return false;
  }
  else {
    document.getElementById(name).innerHTML = "";
    return true;
  }
}

// for password match check

function isPasswordMatch(str,name){
  var pass = document.getElementById('password').value;

  if(str != pass){
    document.getElementById(name).innerHTML = "confirm password is not match with password feild.";
    return false;
  }
  else{
    document.getElementById(name).innerHTML = "";
    return true;
  }
}
