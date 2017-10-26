<section id="content">
  <section class="hbox stretch">
 
    <!-- .aside -->
    <aside>
      <section class="vbox">
        <header class="header bg-white b-b b-light">
          <a href="<?=base_url()?>calendar/settings" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?> pull-right"><i class="fa fa-cog"></i> <?=lang('calendar_settings')?></a>

          <?php  if(User::is_admin()){ ?>
          <a href="<?=base_url()?>calendar/add_event" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?> pull-right"><i class="fa fa-calendar-plus-o"></i> <?=lang('add_event')?></a>
          <?php } ?>
          <p class="h3"><?=lang('calendar')?></p>
        </header>
        <section class="scrollable wrapper">
            <?php 
            if (User::is_admin()) { ?>
                <div class="calendar" id="calendar"></div>
            <?php } ?>
        </section>

    </section>
  </aside>
  <!-- /.aside -->

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>
