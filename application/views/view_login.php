<div class="header">
<div class="logo logoSize"></div>
<div class="position">
	<nav>
		<ul style="width: 225px;">
			<li><a class="active" href="/coder/">Home</a></li>
			<li><a href="#post">Posts</a></li>
		</ul>
	</nav>
</div>
</div>
<center>
  <div class="register">
    <h3> Log In Yourself</h3>
    <form action="/coder/login/" method="post">
      <table>
        <tr>
          <td class="title">User Name: </td>
          <td><input type="text" name="userName" value="" placeholder="Enter Your User Name Or Email"></td>
          <td class="error"><?php echo form_error('userName');?></td>
        </tr>
        <tr>
          <td class="title">Password: </td>
          <td><input type="password" name="password" value="" placeholder="Enter Your Password."></td>
          <td class="error"><?php echo form_error('password');?></td>
        </tr>
        <tr>
          <td></td>
          <td class="error"><?php echo $errorMsg;?></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" value="Log In"></td>
        </tr>
      </table>
    </form>
    <label class="title">I Don't Have Any Account <a href="/coder/register">Register Now</a></label>
  </div>
</center>
