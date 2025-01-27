<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-sticky-note"></i>
        </div>
        <div class="sidebar-brand-text mx-3">InnovaNotes</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Consulta de menu-->

    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                       FROM `user_menu`  JOIN `user_access_menu`
                       ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                       WHERE `user_access_menu`. `role_id` = $role_id
                       ORDER BY `user_access_menu`.`menu_id` ASC ";

    $menu = $this->db->query($queryMenu)->result_array();
    //var_dump($menu);
    //die;
    ?>
    <!-- MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <h7> <?= $m['menu']; ?></h7>
        </div>

        <?php

        $menuId = $m['id'];

        $querySubMenu = "SELECT *
FROM  `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`. `id`  
WHERE `user_sub_menu`.`menu_id` = $menuId
AND `user_sub_menu`. `is_active` = 1

";
        $subMenu = $this->db->query($querySubMenu)->result_array();

        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
            </li>


        <?php endforeach; ?>
        <hr class="sidebar-divider">
    <?php endforeach; ?>

    <!--  <div class="sidebar-heading">
            Admin
        </div>

        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="fas fa-project-diagram"></i>
                <span>Pagina principal</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Usuarios
        </div>

        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-user"></i>
                <span>Mi perfil</span></a>
        </li>
        <hr class="sidebar-divider">-->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/cerrarsesion/'); ?>" Post="<?= $user['email']; ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar sesión</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->