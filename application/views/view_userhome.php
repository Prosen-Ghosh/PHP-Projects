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
<h1>Welcome {username}</h1>
