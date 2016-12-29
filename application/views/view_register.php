<div class="header">
<div class="logo logoSize"></div>
<div class="position">
	<nav>
		<ul style="width: 225px;">
			<li><a class="active" href="/coder/">Home</a></li>
			<li><a href="/coder/posts">Posts</a></li>
		</ul>
	</nav>
</div>
</div>
<center>
  <div class="register">
    <h3> Register Your Self</h3>
    <form action="" method="post">
      <table>
        <tr>
          <td class="title">Name: </td>
          <td><input type="text" name="name" value="{name}" placeholder="Enter Your Full Name" onblur="isName(this.value,this.name)"></td>
          <td class="error" id="name">{errName}</td>
        </tr>
        <tr>
          <td class="title">User Name: </td>
          <td><input type="text" name="userName" value="{userName}" placeholder="Enter a Unique User Name" onblur="isEmpty(this.value,this.name)" ></td>
          <td class="error" id="userName">{errUserName}</td>
        </tr>
        <tr>
          <td class="title">Email: </td>
          <td><input type="text" name="email" value="{email}" placeholder="Enter Email: example@something.com" onblur="emailValidation(this.value,this.name)"></td>
          <td class="error" id="email">{errEmail}</td>
        </tr>
        <tr>
          <td class="title">Password: </td>
          <td><input type="password" name="password" value="{password}" placeholder="Enter Password" onblur="passwordValidation(this.value,this.name);"></td>
          <td class="error" id="password">{errPassword}</td>
        </tr>
        <tr>
          <td class="title">Confrim Password: </td>
          <td><input type="password" name="confrimPassword" value="{confrimPassword}" placeholder="Re-Enter Password" onblur="confrimPasswordValidation(this.value,this.name)"></td>
          <td class="error" id="confrimPassword">{errConfrimPassword}</td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" value="Register"></td>
        </tr>
      </table>
    </form>
    <label class="title">I All Ready have An <a href="/coder/login">Account</a></label>
  </div>
</center>

<script>
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
function isUniqueUser(str){
  alert(str + 'U');
  var flag = false;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
		alert('f');
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText);
      flag = this.responseText;
    }
    else return flag;
  };
  xhttp.open("GET", "C:/xampp/htdocs/coder/application/controllers/checkUniqueUser.php?username="+str, true);
  xhttp.send();
}

function userNameValidation(str,name){
  alert(str+" "+name);
  if(isEmpty(str,name)){
    //alert(isUniqueUser(str));
    if(!isUniqueUser(str)){
        document.getElementById(name).innerHTML = "User Name Already Taken,Plz Try Another one.";
        return false;
    }
    else {
      document.getElementById(name).innerHTML = "";
      return true;
    }
  }
}
</script>
