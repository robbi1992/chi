
<nav class="navbar navbar-inverse navcustomgmf">
  <div class="container">
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-nav-gmf pull-right">
		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('users')->name_users; ?> <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#"><span>Change Password</span></a></li>
				<li><a href="<?php echo site_url('/site/logout'); ?>"><span>Sign out</span></a></li> 
			</ul>
		</li>
		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="<?php echo site_url('/setting/users_group'); ?>"><span>Group Users</span></a></li>
				<li><a href="<?php echo site_url('/setting/users'); ?>"><span>Users Management</span></a></li> 
				<li><a href="<?php echo site_url('/setting/menu_management'); ?>"><span>Menu Management</span></a></li> 
			</ul>
		</li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>