<section id="content">
  <section class="hbox stretch">
    <aside>
      <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> <?=lang('home')?></a></li>
    <li class="active"><?=lang('plugins')?> (beta)</li>
            </ul>
   <div class="row padder">
        <ul class="plugins-list">
            <?php foreach ($plugins as $plug) : ?>
            <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <img src="<?=$plug->image_uri?>" />
                <h3><?=$plug->title?></h3>
                <span class="small">by <?=$plug->author?></span>
                <p><?=$plug->description?></p>
                <?php if (!file_exists("./application/modules/".$plug->route."/.foplugin")) { ?>
                <a class="btn btn-default" href="<?=base_url()?>updates/getplugin/<?=$plug->id;?>"><?=lang('download')?></a>
                <?php } ?>
                <?php if ($plug->has_update == 1) { ?>
                <a class="btn btn-default" href="<?=base_url()?>updates/updateplugin/<?=$plug->id;?>"><?=lang('update')?></a>
                <?php } ?>
                <?php if ($plug->installed == 0) { ?>
                <a class="btn btn-default" href="<?=base_url()?><?=$plug->route;?>/install"><?=lang('install')?></a>
                <?php } ?>
                <?php if ($plug->installed == 1) { ?>
                <a class="btn btn-default" href="<?=base_url()?><?=$plug->route;?>/uninstall"><?=lang('uninstall')?></a>
                <?php } ?>
                <a class="btn btn-default" href="<?=$plug->plugin_uri;?>"><?=lang('visit_website')?></a>
            </li>
            <?php endforeach; ?>
            <?php if (count($plugins) == 0) : ?>
                <tr><td colspan="0"><?=lang('no_plugins_found')?></td></tr>
            <?php endif; ?>
        </ul>
    </div>
<!-- footer -->
<?php if (config_item('hide_branding') == 'FALSE') : ?>
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small><?=lang('powered_by')?> <a class="text-info" href="http://codecanyon.net/item/freelancer-office/8870728">Freelancer Office v.<?=config_item('version')?></a></small>
      </p>
    </div>
  </footer>
<?php endif; ?>
  <!-- / footer -->
  
</div>
</section>
</section>
    </aside>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
</section>