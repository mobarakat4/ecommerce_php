<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container ">
    <a class="navbar-brand" href="dashbord.php"><?php echo lang('adminhome')?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse container-fluid " id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item"><a class="nav-link" href="categories.php"><?php echo lang('categories');?></a></li>
        <li class="nav-item"><a class="nav-link" href="items.php"><?php echo lang('items');?></a></li>
        <li class="nav-item"><a class="nav-link" href="members.php"><?php echo lang('members');?></a></li>
        <li class="nav-item"><a class="nav-link" href="comments.php"><?php echo lang('comments');?></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('stats');?></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><?php echo lang('logs');?></a></li>
        
        
      </ul>
      <ul class="list-unstyle d-flex navbar-nav" >
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-whie" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['username'];?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="members.php?do=edit&id=<?php echo $_SESSION['id']?>"><?php echo lang('edit profile');?></a></li>
            <li><a class="dropdown-item" href="#"><?php echo lang('setting');?></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php"><?php echo lang('log out');?></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>