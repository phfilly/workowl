<section id="content">
  <section class="hbox stretch">

<aside>
      <section class="vbox">

<section class="scrollable wrapper">
  <section class="panel panel-default">
                <header class="panel-heading">
                 <span class="h3"><?=lang('payments')?> </span>
                </header>
                <div class="table-responsive">
                  <table id="table-payments" class="table table-striped b-t b-light AppendDataTables">
                    <thead>
                      <tr>
                      <th style="width:5px; display:none;"></th>
                        <th class=""><?=lang('invoice')?></th>
                        <th class=""><?=lang('client')?></th>
                        <th class="col-date"><?=lang('payment_date')?></th>
                        <th class="col-date"><?=lang('invoice_date')?></th>
                        <th class="col-currency"><?=lang('amount')?></th>
                        <th class=""><?=lang('payment_method')?></th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php foreach ($payments as $key => $p) { ?>
                      <tr>
                      <?php
                        $currency = Invoice::view_by_id($p->invoice)->currency;
                        $invoice_date = Invoice::view_by_id($p->invoice)->date_saved;
                        $invoice_date = strftime(config_item('date_format'), strtotime($invoice_date));
                        ?>


                        <td style="display:none;"><?=$p->p_id?></td>

                        <td style="border-left: 2px solid <?=($p->refunded != 'Yes') ? '#1AB394':'#e05d6f'; ?>;">
                          <div class="btn-group">
                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i></button>
                            <ul class="dropdown-menu">                      
                            <li>
                            <a href="<?=base_url()?>payments/view/<?=$p->p_id?>"><?=lang('view_payment')?></a>
                            </li>
                            <li><a href="<?=base_url()?>payments/pdf/<?=$p->p_id?>">
                              <?=lang('pdf')?> <?=lang('receipt')?></a>
                            </li>

                            <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'edit_payments')){ ?>
                            <li><a href="<?=base_url()?>payments/edit/<?=$p->p_id?>"><?=lang('edit_payment')?></a></li>
                            <?php if($p->refunded == 'No'){ ?>
                            <li><a href="<?=base_url()?>payments/refund/<?=$p->p_id?>" data-toggle="ajaxModal">
                              <?=lang('refunded')?></a>
                            </li>
                            <?php } ?>
                            <li><a href="<?=base_url()?>payments/delete/<?=$p->p_id?>" data-toggle="ajaxModal"><?=lang('delete_payment')?></a>
                            </li>

                            <?php } ?>
                            </ul>
                          </div>
                        
                        <a class="text-info" href="<?=base_url()?>payments/view/<?=$p->p_id?>">
                        <?php echo Invoice::view_by_id($p->invoice)->reference_no; ?></a>
                        </td>

                        <td>
                        <?php echo Client::view_by_id($p->paid_by)->company_name; ?>
                        </td>
                        <td><?=strftime(config_item('date_format'), strtotime($p->payment_date));?></td>
                        <td><?=$invoice_date?></td>

                        <td class="col-currency <?=($p->refunded == 'Yes') ? 'text-lt text-danger' : '' ; ?>">
                        <strong>
                        <?=Applib::format_currency($currency, $p->amount)?>
                        </strong>
                        </td>

                        <td><?php echo App::get_method_by_id($p->payment_method); ?></td>
                      </tr>
                      <?php }  ?>
                    </tbody>
                  </table>
                </div>
              </section>
              </section>
  
     



    </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->