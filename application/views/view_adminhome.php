<div class="header">
<div class="logo logoSize"></div>
<div class="position">
	<nav>
		<ul>
			<li><a href="/coder/">Home</a></li>
			<li><a href="/coder/posts/userPosts">Posts</a></li>
      <li><a href="/coder/adminhome/getAllUsers">Users</a></li>
      <li><a href="/coder/adminhome/getAllBlockedUser">Block Users</a></li>
      <li><a href="/coder/posts/userBlockedPosts">Block Posts</a></li>
      <li style='float:right'>
        <select name="userinfo" onchange="location = this.value">
					<option value=''>Option</option>
          <option value="/coder/adminhome/profile"><a class="active" href=""><?php echo ucfirst($this->session->userdata('username'))." Profile";?></a></option>
          <option value='/coder/logout'>Logout</option>
        </select>
      </li>
		</ul>
	</nav>
</div>
</div>
<h1>Welcome <?php echo $this->session->userdata('username');?></h1>
