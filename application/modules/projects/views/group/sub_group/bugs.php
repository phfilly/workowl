<section class="panel panel-default">


<header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                  <div class="col-sm-12 m-b-xs">
                  <a href="<?=base_url()?>projects/bugs/add/<?=$project_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('new_bug')?></a> 

                     

                    </div>
                  </div>
                </header>
    <div class="table-responsive">
                  <table id="table-bugs" class="table table-striped b-t b-light AppendDataTables small">
                    <thead>
                      <tr>
                        <th class="col-sm-3"><?=lang('issue_title')?></th>
                        <th><?=lang('date')?></th>
                        <th><?=lang('status')?></th>
                        <th><?=lang('severity')?></th>
                        <th class="col-options no-sort"></th>
                      </tr>
                    </thead>
                    <tbody>
      <?php foreach (Project::has_bugs($project_id) as $key => $b) { 
                $issue_title = $b->issue_title ? $b->issue_title : $b->issue_ref;

                switch ($b->bug_status) {
                  case 'Resolved':
                    $status_label = 'success'; 
                      break;
                    case 'Verified':
                      $status_label = 'success'; 
                      break;
                    case 'Confirmed':
                     $status_label = 'info';
                      break;
                    case 'Pending':
                         $status_label = 'primary'; 
                      break;
                  default:
                     $status_label = 'default'; 
                    break;
                }
                ?>
            
                      <tr>                        
                        <td style="border-left: 2px solid <?php echo ($b->bug_status == 'Resolved') ? '#16a085': '#e05d6f'; ?>; ">

                        

               <a class="pull-left thumb-sm avatar text-info" data-toggle="tooltip" data-original-title="<?=User::displayName($b->reporter)?>" href="<?=base_url()?>projects/view/<?=$b->project?>?group=bugs&view=bug&id=<?=$b->bug_id?>" data-toggle="tooltip" data-placement="right" title = "">

        
      <img src="<?=User::avatar_url($b->reporter); ?>" class="img-rounded" style="border-radius: 6px;">
      
      <?=word_limiter($issue_title,4)?>
          </a>

                        </td>

                        <td class="small"><?=$b->reported_on?></td>



                        


          
                        <td>
                        <span class="label label-<?=$status_label?>"><?=lang(strtolower($b->bug_status))?></span></td>
                        <td><?=ucfirst($b->severity)?></td>
                        <td>
<?php if (!User::is_client() || $b->reporter == User::get_id()) { ?>
                        

<?php if (!User::is_client()){ ?>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-h"></i>
                    </button>
                <ul class="dropdown-menu">
                          
<li>
  <a href="<?=base_url()?>projects/bugs/status/<?=$b->project?>/?id=<?=$b->bug_id?>&s=unconfirmed">
          <?=lang('unconfirmed')?>
  </a>
</li>
<li>
  <a href="<?=base_url()?>projects/bugs/status/<?=$b->project?>/?id=<?=$b->bug_id?>&s=confirmed">
          <?=lang('confirmed')?>
  </a>
</li>
<li>
  <a href="<?=base_url()?>projects/bugs/status/<?=$b->project?>/?id=<?=$b->bug_id?>&s=pending">
            <?=lang('pending')?>
  </a>
</li>
<li>
  <a href="<?=base_url()?>projects/bugs/status/<?=$b->project?>/?id=<?=$b->bug_id?>&s=resolved">
            <?=lang('resolved')?>
  </a>
</li>
<li>
  <a href="<?=base_url()?>projects/bugs/status/<?=$b->project?>/?id=<?=$b->bug_id?>&s=verified">
            <?=lang('verified')?>
  </a>
</li>
                </ul>
              </div>

              <?php } ?>
                        
                        <a class="btn btn-xs btn-<?=config_item('theme_color')?>" href="<?=base_url()?>projects/bugs/edit/<?=$b->project?>/?id=<?=$b->bug_id?>" data-toggle="ajaxModal"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-xs btn-dark" href="<?=base_url()?>projects/bugs/delete/<?=$b->project?>/?id=<?=$b->bug_id?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i></a>
                        
          <?php } ?>
          </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

<!-- End details -->
 </section>