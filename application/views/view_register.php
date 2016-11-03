<div class="header">
<div class="logo logoSize"></div>
<div class="position">
	<nav>
		<ul style="width: 225px;">
			<li><a class="active" href="/coder/">Home</a></li>
			<li><a href="#news">Posts</a></li>
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
          <td><input type="text" name="name" value="" placeholder="Enter Your Full Name"></td>
          <td class="error"><?php echo form_error('name');?></td>
        </tr>
        <tr>
          <td class="title">User Name: </td>
          <td><input type="text" name="userName" value="" placeholder="Enter a Unique User Name"></td>
          <td class="error"><?php echo form_error('userName');?></td>
        </tr>
        <tr>
          <td class="title">Email: </td>
          <td><input type="text" name="email" value="" placeholder="Enter Email: example@something.com"></td>
          <td class="error"><?php echo form_error('email');?></td>
        </tr>
        <tr>
          <td class="title">Password: </td>
          <td><input type="password" name="password" value="" placeholder="Enter Password"></td>
          <td class="error"><?php echo form_error('password');?></td>
        </tr>
        <tr>
          <td class="title">Confrim Password: </td>
          <td><input type="password" name="confrimPassword" value="" placeholder="Re-Enter Password"></td>
          <td class="error"<?php echo form_error('confrimPassword');?>></td>
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
