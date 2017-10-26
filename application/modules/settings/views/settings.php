<section id="content">
    <section class="hbox stretch">
        <aside class="aside aside-md bg-white b-l b-r small">
            <section class="vbox">
                <header class="dk header b-b">
                    <a class="btn btn-icon btn-default btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show" data-target="#setting-nav"><i class="fa fa-reorder"></i></a>
                    <p class="h3"><?=lang('settings')?></p>
                </header>
                <section>
                    <section>
                        <section id="setting-nav" class="hidden-xs">
                            <ul class="nav nav-pills nav-stacked no-radius">
                            <?php                
                            $menus = $this->db->where('hook','settings_menu_admin')->where('visible',1)->order_by('order','ASC')->get('hooks')->result();
                            foreach ($menus as $menu) { ?>
                                <li class="<?php echo ($load_setting == $menu->route) ? 'active' : '';?>">
                                    <a href="<?=base_url()?>settings/?settings=<?=$menu->route?>">
                                        <i class="fa fa-fw <?=$menu->icon?>"></i>
                                        <?=lang($menu->name)?>
                                    </a>
                                </li>
                            <?php } ?>
                            </ul>
                        </section>
                    </section>
                </section>
            </section>
        </aside>

        <aside>
            <section class="vbox">

                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-10 m-b-xs">
                            <?php if($load_setting == 'templates'){  ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-<?=config_item('theme_color');?>" title="Filter" data-toggle="dropdown"><i class="fa fa-cogs"></i> <?=lang('choose_template')?><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=user"><?=lang('account_emails')?></a></li>
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=bugs"><?=lang('bug_emails')?></a></li>
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=project"><?=lang('project_emails')?></a></li>
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=task"><?=lang('task_emails')?></a></li>
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=invoice"><?=lang('invoicing_emails')?></a></li>
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=ticket"><?=lang('ticketing_emails')?></a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=extra"><?=lang('extra_emails')?></a></li>
                                        <li><a href="<?=base_url()?>settings/?settings=templates&group=signature"><?=lang('email_signature')?></a></li>
                                    </ul>
                                </div>
                            <?php }
                            $set = array('theme','customize');
                            if( in_array($load_setting, $set)){  ?>
                                <a href="<?=base_url()?>settings/?settings=customize" class="btn btn-<?=config_item('theme_color');?>"><i class="fa fa-code text"></i>
                                    <span class="text"><?=lang('custom_css')?></span>
                                </a>
                            <?php } ?>
                            <?php $set = array('payments');
                            if(in_array($load_setting, $set)){ ?>

                             <a href="<?=base_url()?>settings/?settings=payments&view=currency" class="btn btn-<?=config_item('theme_color');?>">
                                        <?=lang('currencies')?></a>

                            <?php }
                            $set = array('system', 'validate');
                            if( in_array($load_setting, $set)){  ?>
                            <a href="<?=base_url()?>settings/?settings=system&view=categories" class="btn btn-<?=config_item('theme_color');?>"><?=lang('category')?>
                            </a>
                            <a href="<?=base_url()?>settings/?settings=system&view=slack" class="btn btn-<?=config_item('theme_color');?>">Slack</a>
                            <a href="<?=base_url()?>settings/?settings=system&view=project" class="btn btn-<?=config_item('theme_color');?>"><?=lang('project_settings')?>
                            </a>

                    




                                <a href="<?=base_url()?>settings/database" class="btn btn-<?=config_item('theme_color');?>"><i class="fa fa-cloud-download text"></i>
                                    <span class="text"><?=lang('database_backup')?></span>
                                </a>
                                <a href="<?=base_url()?>settings/vE" class="btn btn-<?=config_item('theme_color');?>"><i class="fa fa-credit-card text"></i>
                                    <span class="text"><?=lang('check_license')?></span>
                                </a>
                            <?php } ?>

                            <?php if($load_setting == 'email'){  ?>
                                <a href="<?=base_url()?>settings/?settings=email&view=alerts" class="btn btn-<?=config_item('theme_color');?>"><i class="fa fa-inbox text"></i>
                                    <span class="text"><?=lang('alert_settings')?></span>
                                </a>
                            <?php } ?>

                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper">
                    <!-- Load the settings form in views -->
                    <?=$this->load->view($load_setting)?>
                    <!-- End of settings Form -->
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>