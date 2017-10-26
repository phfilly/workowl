<section id="content">
    <section class="hbox stretch">

<aside>
            <section class="vbox">

<section class="scrollable wrapper w-f">
    <section class="panel panel-default">
                <header class="panel-heading">
                 <span class="h3"><?=lang('expenses')?></span>
                <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'add_expenses')) { ?> 
                <a href="<?=base_url()?>expenses/create" data-toggle="ajaxModal" title="<?=lang('create_expense')?>" class="btn btn-sm btn-<?=config_item('theme_color');?> pull-right"><i class="fa fa-plus"></i><?=lang('create_expense')?></a>
                <?php } ?>
                </header>
                <div class="table-responsive">
                  <table id="table-expenses" class="table table-striped b-t b-light AppendDataTables">
                    <thead>
                      <tr>
                      <th style="width:5px; display:none;"></th>
                      <th class=""><?=lang('project')?></th>
                        <th class="col-currency"><?=lang('amount')?></th>
                        <th class=""><?=lang('client')?></th>
                        <th class=""><?=lang('invoiced')?></th>
                        <th class=""><?=lang('category')?></th>
                        <th class=""><?=lang('expense_date')?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($expenses as $key => $e) { 
                    if($e->project != '' || $e->project != 'NULL'){
                      $p = Project::by_id($e->project);
                    }else{ $p = NULL; } ?>
                      <tr>

                  <td style="display:none;"><?=$e->id?></td>

                  <td style="border-left: 2px solid <?php echo ($e->invoiced == '1') ? '#1ab394' : '#e05d6f';?>;">

                        <div class="btn-group">
                        <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>

                        </button>
                            <ul class="dropdown-menu">
                  
                <li>
                <a href="<?=base_url()?>expenses/view/<?=$e->id?>"><?=lang('view_expense')?></a>
                </li>     

                 

                 <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'edit_expenses')) { ?>  
                                
                <li>
                    <a href="<?=base_url()?>expenses/edit/<?=$e->id?>" data-toggle="ajaxModal">
                    <?=lang('edit_expense')?></a>
                </li>

                <?php } if(User::is_admin() || User::perm_allowed(User::get_id(),'delete_expenses')) { ?> 

                 <li>
                    <a href="<?=base_url()?>expenses/delete/<?=$e->id?>" data-toggle="ajaxModal">
                    <?=lang('delete_expense')?></a>
                </li>
                <?php } ?>

                
                        
                </ul>
                        </div>

                        <?php if($e->show_client != 'Yes'){ ?>
                        <a href="<?=base_url()?>expenses/show/<?=$e->id?>" data-toggle="tooltip" data-title="<?=lang('show_to_client')?>" data-placement="right">
                        <i class="fa fa-circle-o text-danger"></i>
                        </a>
                        <?php } ?>

                        <?php if($e->receipt != NULL){ ?>
                          <a href="<?=base_url()?>resource/uploads/<?=$e->receipt?>" target="_blank" data-toggle="tooltip" data-title="<?=$e->receipt?>" data-placement="right">
                          <i class="fa fa-paperclip"></i>
                          </a>
                          <?php } ?>
                      <?=($p != NULL) ? $p->project_title : 'N/A'; ?>
                         


              </td>


                        <td class="col-currency"><strong>
                        <?php
                        $cur = ($p != NULL) ? $p->currency : 'USD'; 
                        $cur = ($e->client > 0) ? Client::client_currency($e->client)->code : $cur;
                        ?>
                        <?=Applib::format_currency($cur, $e->amount)?>
                        </strong>
                        </td>

                        <td>
                        <?php
                        echo ($e->client > 0) ? Client::view_by_id($e->client)->company_name : 'N/A'; ?>
                        </td>

                        <td>
                         <span class="small label label-<?=($e->invoiced == '0') ? 'danger' : 'success';?>">
                         <?=($e->invoiced == '0') ? 'No' :'Yes'; ?>
                         </span>
                        </td>

                        <td>
                        <?php echo App::get_category_by_id($e->category); ?>
                        </td>

                       
                       <td>
                       <?=strftime(config_item('date_format'), strtotime($e->expense_date))?>
                        </td>

                      </tr>
                      <?php  } ?>
                    </tbody>
                  </table>
                </div>
              </section>
              </section>
    
         



        </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->