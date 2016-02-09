<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">
        <a href="<?php echo $base_url . 'autentificacion' ?>" title="Usuario: <?php echo $_SESSION['user_full_name'] ?>"><img src="../../static/logo-mini.png" /></a>
      </li>
      <li class="has-submenu" data-dropdown-menu>
        <a href="#">Menu</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="<?php echo $base_url . 'ventas' ?>">Ventas</a></li>
          <?php if (array_search('Barrido', explode(' ',trim($_SESSION['resources']))) !== false): ?>
            <li><a href="<?php echo $base_url . 'barrido' ?>">Barrido de Ventas</a></li>
          <?php endif ?>
          <?php if (array_search('Base', explode(' ',trim($_SESSION['resources']))) !== false): ?>
            <li><a href="<?php echo $base_url . 'base' ?>">Base</a></li>
          <?php endif ?>
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


