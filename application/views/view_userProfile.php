<div class="header">
<div class="logo logoSize"></div>
<div class="position">
	<nav>
		<ul>
			<li><a href="/coder/userhome">Home</a></li>
			<li><a href="/coder/posts">Posts</a></li>
      <li><a href="/coder/posts/newpost">New Post</a></li>
			<li><a href="/coder/posts/mypost">My Post</a></li>
      <li style='float:right'>
        <select name="userinfo" onchange="location = this.value">
          <option value='/coder/userhome/profile'><a class="active" href="">{username}</a></option>
					<option value='/coder/userhome/profile'><a class="active" href="">{username} Profile</a></option>
          <option value='/coder/logout'>Logout</option>
        </select>
      </li>
		</ul>
	</nav>
</div>
</div>
<center>
  <h1>User Profile</h1>
  <form action="/coder/userhome/save" method="post">
    <table>
      <tr><td>User Name:</td><td> <input type="text" value="{username}" name="username" readonly=""></td></tr>
      <tr><td>Full Name:</td><td> <input type="text" value="{name}" name="name" ></td></tr>
      <tr><td>Email:</td><td> <input type="text" value="{email}" name="email" readonly=""></td></tr>
      <tr><td>Address:</td><td> <input type="text" value="{address}" name="address" ></td></tr>
      <tr><td>Facebook URL:</td><td> <input type="text" value="{url}" name="url" ></td></tr>
      <tr><td>Country: </td><td><input type="text" value="{country}" name="country" ></td></tr>
      <tr><td> </td><td><input type="submit" value="Save" name="submit" ></td></tr>
    </table>
  </form>
  <center>
