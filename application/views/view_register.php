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
          <td><input type="text" name="name" value="<?php echo set_value('name');?>" placeholder="Enter Your Full Name" onblur="isName(this.value,this.name)"></td>
          <td class="error" id="name"><?php echo form_error('name');?></td>
        </tr>
        <tr>
          <td class="title">User Name: </td>
          <td><input type="text" name="userName" value="<?php echo set_value('userName');?>" placeholder="Enter a Unique User Name" onblur="usernameCheck(this.value,this.name);"></td>
          <td class="error" id="userName"><?php echo form_error('userName');?></td>
        </tr>
        <tr>
          <td class="title">Email: </td>
          <td><input type="text" name="email" value="<?php echo set_value('email');?>" placeholder="Enter Email: example@something.com" onblur="emailValidation(this.value,this.name);"></td>
          <td class="error" id="email"><?php echo form_error('email');?></td>
        </tr>
        <tr>
          <td class="title">Password: </td>
          <td><input type="password" name="password" value="<?php echo set_value('password');?>" placeholder="Enter Password" onblur="passwordValidation(this.value,this.name);"></td>
          <td class="error" id="password"><?php echo form_error('password');?></td>
        </tr>
        <tr>
          <td class="title">Confrim Password: </td>
          <td><input type="password" name="confrimPassword" value="<?php echo set_value('confrimPassword');?>" placeholder="Re-Enter Password" onblur="confrimPasswordValidation(this.value,this.name)"></td>
          <td class="error" id="confrimPassword"><?php echo form_error('confrimPassword');?></td>
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
