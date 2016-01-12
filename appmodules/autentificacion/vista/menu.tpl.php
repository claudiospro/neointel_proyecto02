<?php
$lugar = 1;
if ( $lugar == 1 )     $base_url = 'http://192.168.1.162/neointelperu_apps/appmodules/';
elseif ( $lugar == 2 ) $base_url = 'http://192.168.1.3/neointelperu_apps/appmodules/';
elseif ( $lugar == 3 ) $base_url = 'http://localhost/neointelperu_apps/appmodules/';

?>
<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <?php  if ( isset($_SESSION['user_name']) ): ?>
        <li class="menu-text"><?php echo $_SESSION['user_name'] ?></li>
      <?php  else: ?>
	<li class="menu-text">...</li>
      <?php endif ?>
      <li class="has-submenu" data-dropdown-menu>
        <a href="#">Menu</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="<?php echo $base_url . 'ventas/index.php' ?>">Ventas</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <?php  if (isset($_SESSION['user_id'])): ?>
        <li><a href="<?php echo $base_url . 'autentificacion/procesos/logout.php' ?>">Salir</a></li>
      <?php endif ?>
    </ul>
  </div>
</div>


