<!-- .aside -->
<aside class="bg-<?=config_item('sidebar_theme')?> b-r aside-md hidden-print <?=(config_item('hide_sidebar') == 'TRUE') ? 'nav-xs' : ''; ?>" id="nav">
  <section class="vbox">
      <section class="scrollable">
        <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
          <!-- nav -->
          <nav class="nav-primary hidden-xs">
            <ul class="nav">
            <?php
                $user_id = User::get_id();
                $badge = array();
                $timer_on = App::counter('project_timer',array('status'=>'1'));
                if($timer_on > 0){ $badge['menu_projects'] = '<b class="badge bg-danger pull-right">'.$timer_on.'<i class="fa fa-refresh fa-spin"></i></b>'; }

                $unread = App::counter('messages',array('user_to'=>User::get_id(),'status' => 'Unread'));
                if($unread > 0){ $badge['menu_messages'] = '<b class="badge bg-primary pull-right">'.$unread.'</b>'; }


                $menus = $this->db->where('access',3)->where('visible',1)->where('parent','')->where('hook','main_menu_staff')->order_by('order','ASC')->get('hooks')->result();
                foreach ($menus as $menu) {
                    $sub = $this->db->where('access',3)->where('visible',1)->where('parent',$menu->module)->where('hook','main_menu_staff')->order_by('order','ASC')->get('hooks');
                    $perm = TRUE;
                    ?>

                  <?php if($menu->permission != '') { $perm = User::perm_allowed($user_id, $menu->permission); } ?>

                    <?php if($perm){ ?>
                    <?php if ($sub->num_rows() > 0) {
                        $submenus = $sub->result(); ?>
                        <li class="<?php
                            foreach ($submenus as $submenu) {
                                if($page == lang($submenu->name)){echo  "active"; }
                            }
                        ?>">
                            <a href="<?=base_url()?><?=$menu->route?>">
                                <i class="fa <?=$menu->icon?> icon"> <b class="bg-<?=config_item('theme_color');?>"></b></i>
                                <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i></span>
                                <span><?=lang($menu->name)?></span> </a>
                            <ul class="nav lt">
                            <?php foreach ($submenus as $submenu) { ?>
                            <li class="<?php if($page == lang($submenu->name)){echo  "active"; }?>">
                                <a href="<?=base_url()?><?=$submenu->route?>">
                                    <?php if (isset($badge[$submenu->module])) { echo $badge[$menu->module]; } ?>
                                    <i class="fa <?=$submenu->icon?> icon"> <b class="bg-<?=config_item('theme_color');?>"></b></i>
                            <span><?=lang($submenu->name)?></span> </a> </li>
                            <?php } ?>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="<?php if($page == lang($menu->name)){echo  "active"; }?>">
                            <a href="<?=base_url()?><?=$menu->route?>">
                            <?php if (isset($badge[$menu->module])) { echo $badge[$menu->module]; } ?>
                            <i class="fa <?=$menu->icon?> icon"> <b class="bg-<?=config_item('theme_color');?>"></b>
                        </i>
                        <span><?=lang($menu->name)?></span> </a> </li>
                    <?php } ?>
                <?php } ?>
                <?php } ?>

              </ul> </nav>
              <!-- / nav -->
            </div>
          </section>

          <footer class="footer lt hidden-xs b-t b-dark">
            <div id="chat" class="dropup">

            </div>
            <div id="invite" class="dropup">

            </div>
            <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon"> <i class="fa fa-angle-left text"></i>
              <i class="fa fa-angle-right text-active"></i> </a>
            <div class="btn-group hidden-nav-xs">

            </div>
          </footer>



</section>
</aside>
<!-- /.aside -->
