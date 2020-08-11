   <div class="navbar-custom">
       <div class="container">
           <div id="navigation">
               <?php
                $role = $this->session->userdata('role_id');

                $queryMenu = "SELECT user_menu.id, user_menu.icon, menu FROM user_menu JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id WHERE user_access_menu.role_id = $role AND is_active = '1' GROUP BY user_access_menu.menu_id ORDER BY user_menu.sort ASC";
                $menu = $this->db->query($queryMenu)->result_array();
                
                ?>

               <ul class="navigation-menu">
                   <?php foreach ($menu as $m) : ?>
                       <li class="has-submenu">
                           <a href="#"><i class="<?= $m['icon']; ?>"></i> <span> <?= $m['menu']; ?> </span> </a>

                           <?php
                            $menuid = $m['id'];
                            $qSubMenu = "SELECT * FROM user_sub_menu JOIN user_access_menu ON user_sub_menu.id = user_access_menu.submenu_id WHERE user_sub_menu.menu_id = $menuid AND user_access_menu.role_id = $role AND user_sub_menu.is_active = 1 ORDER BY sort ASC";

                            $subMenu = $this->db->query($qSubMenu)->result_array();

                            ?>
                           <ul class="submenu">
                               <?php foreach ($subMenu as $sm) :  ?>
                                   <li><a href="<?= base_url().$sm['url']; ?>"><?= $sm['title']; ?></a></li>
                               <?php endforeach ?>
                           </ul>
                       </li>
                   <?php endforeach ?>

               </ul>

           </div>
       </div>
   </div>
   </header>

   <div class="wrapper">
       <div class="container">