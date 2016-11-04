<div class="header">
<div class="logo logoSize"></div>
<div class="position">
	<nav>
		<ul>
			<li><a href="/coder/">Home</a></li>
			<li><a href="/coder/posts">Posts</a></li>
      <li><a href="/coder/newpost">New Post</a></li>
      <li style='float:right'>
        <select name="userinfo" onchange="location = this.value">
          <option value=''><a class="active" href=""><?php echo ucfirst($this->session->userdata('username'));?></a></option>
          <option value='/coder/logout'>Logout</option>
        </select>
      </li>
		</ul>
	</nav>
</div>
</div>
<h1>Welcome <?php echo $this->session->userdata('username');?></h1>
