<!-- Start -->
<section id="content">
	<section class="hbox stretch">

<aside>
	<section class="vbox">
    <section class="scrollable wrapper w-f">
      <section class="panel panel-default">
              <header class="panel-heading">
                <span class="h3"><?=$name?></span>
                <a href="<?=base_url()?><?=$dir?>/<?=$table?>/add" data-toggle="ajaxModal" class="btn btn-xs btn-<?=config_item('theme_color');?> pull-right">New <?=$name?></a>
              </header>

              <div class="table-responsive">
                <table id="table-rates" class="table table-striped b-t b-light AppendDataTables">
                  <thead>
                    <tr>
                      <th><?=$table?></th>
                      <th class="col-options no-sort"><?=lang('options')?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($industries as $key => $r) { ?>
                      <tr>
                        <td><?=$r->name?></td>
                        <td>
                          <a class="btn btn-<?=config_item('theme_color');?> btn-sm" href="<?=base_url()?><?=$dir?>/<?=$table?>/edit/<?=$r->id?>" data-toggle="ajaxModal" title="Edit">Edit</a>
                          <a class="btn btn-dark btn-sm" href="<?=base_url()?><?=$dir?>/<?=$table?>/delete/<?=$r->id?>" data-toggle="ajaxModal" title="Delete">Delete</a>
                        </td>
                      </tr>
                    <?php }  ?>
                  </tbody>
                </table>
              </div>

            </section>
          </section>
        </section>
      </aside>
    </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

<!-- end -->