<section id="content">
  <section class="hbox stretch">
    <aside>
      <section class="vbox">
        <section class="scrollable wrapper">
          <section class="panel panel-default">
            <header class="panel-heading">
              <div class="btn-group">

              <button class="btn btn-<?=config_item('theme_color');?> btn-sm">
              <?php
              $view = isset($_GET['view']) ? $_GET['view'] : NULL;
              switch ($view) {
                case 'paid':
                  echo lang('paid');
                  break;
                case 'unpaid':
                  echo lang('not_paid');
                  break;
                case 'partially_paid':
                  echo lang('partially_paid');
                  break;
                case 'recurring':
                  echo lang('recurring');
                  break;

                default:
                  echo lang('filter');
                  break;
              }
              ?></button>
              <button class="btn btn-<?=config_item('theme_color');?> btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret"></span>
              </button>
              <ul class="dropdown-menu">

              <li><a href="<?=base_url()?>invoices?view=paid"><?=lang('paid')?></a></li>
              <li><a href="<?=base_url()?>invoices?view=unpaid"><?=lang('not_paid')?></a></li>
              <li><a href="<?=base_url()?>invoices?view=partially_paid"><?=lang('partially_paid')?></a></li>
              <li><a href="<?=base_url()?>invoices?view=recurring"><?=lang('recurring')?></a></li>
              <li><a href="<?=base_url()?>invoices"><?=lang('all_invoices')?></a></li>

              </ul>
              </div>
               <span class="h3"><?=lang('invoices')?></span>

              <?php
              if(User::is_admin() || User::perm_allowed(User::get_id(),'add_invoices')) { ?>
              <a href="<?=base_url()?>invoices/add" class="btn btn-sm btn-<?=config_item('theme_color');?> pull-right"><i class="fa fa-plus"></i><?=lang('create_invoice')?></a>
              <?php } ?>
            </header>
            <div class="table-responsive">
              <table id="table-invoices" class="table table-striped b-t b-light AppendDataTables">
                <thead>
                  <tr>
                  <th style="width:5px; display:none;"></th>
                    <th class=""><?=lang('invoice')?></th>
                    <th class=""><?=lang('client_name')?></th>
                    <th class=""><?=lang('status')?></th>
                    <th class="col-date"><?=lang('due_date')?></th>
                    <th class="col-currency"><?=lang('amount')?></th>
                    <th class="col-currency"><?=lang('due_amount')?></th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($invoices as $key => &$inv) {
                    $status = Invoice::payment_status($inv->inv_id);
                    switch ($status) {
                        case 'fully_paid': $label2 = 'success';  break;
                        case 'partially_paid': $label2 = 'warning'; break;
                        case 'not_paid': $label2 = 'danger'; break;
                    }
                  ?>
                  <tr>
                  <td style="display:none;"><?=$inv->inv_id?></td>

                  <td style="border-left: 2px solid
                <?php echo ($status == 'fully_paid') ? '#1ab394' :'#f0ad4e'; ?>">
                      <div class="btn-group">
                        <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                         <i class="fa fa-ellipsis-h"></i>
                        </button>

                        <ul class="dropdown-menu">
                          <li>
                           <a href="<?=base_url()?>invoices/view/<?=$inv->inv_id?>">
                           <?=lang('preview_invoice')?>
                           </a>
                          </li>

                <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'edit_all_invoices')) { ?>

                          <li>
                          <a href="<?=base_url()?>invoices/edit/<?=$inv->inv_id?>">
                          <?=lang('edit_invoice')?>
                          </a>
                          </li>

                <?php } ?>
                          <li>
                          <a href="<?=base_url()?>invoices/timeline/<?=$inv->inv_id?>">
                          <?=lang('invoice_history')?>
                          </a>
                          </li>

                <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'email_invoices')) { ?>

                          <li>
                          <a href="<?=base_url()?>invoices/send_invoice/<?=$inv->inv_id?>" data-toggle="ajaxModal" title="<?=lang('email_invoice')?>"><?=lang('email_invoice')?>
                          </a>
                          </li>

                <?php } ?>
                <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'send_email_reminders')) { ?>
                          <li>
                          <a href="<?=base_url()?>invoices/remind/<?=$inv->inv_id?>" data-toggle="ajaxModal" title="<?=lang('send_reminder')?>">
                          <?=lang('send_reminder')?>
                          </a>
                          </li>

                <?php } ?>
                <?php if(config_item('pdf_engine') == 'invoicr') : ?>
                          <li>
                          <a href="<?=base_url()?>fopdf/invoice/<?=$inv->inv_id?>"><?=lang('pdf')?></a>
                          </li>

                <?php elseif(config_item('pdf_engine') == 'mpdf') : ?>
                                <li>
                                <a href="<?=base_url()?>invoices/pdf/<?=$inv->inv_id?>"><?=lang('pdf')?></a>
                                </li>
                <?php endif; ?>



                <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'delete_invoices')) { ?>
                          <li>
                          <a href="<?= base_url() ?>invoices/delete/<?= $inv->inv_id ?>" data-toggle="ajaxModal">
                          <?=lang('delete_invoice')?>
                          </a>
                          </li>

                <?php } ?>

                        </ul>
                      </div>

                    <a class="text-info" href="<?=base_url()?>invoices/view/<?=$inv->inv_id?>">
                    <?=$inv->reference_no?>
                    </a>

                    </td>

                    <td>
                    <?php echo Client::view_by_id($inv->client)->company_name; ?>
                    </td>

                    <td class="">
                        <span class="label label-<?=$label2?>"><?=lang($status)?> <?php if($inv->emailed == 'Yes') { ?><i class="fa fa-envelope-o"></i><?php } ?></span>
                      <?php if ($inv->recurring == 'Yes') { ?>
                      <span class="label label-primary"><i class="fa fa-retweet"></i></span>
                      <?php }  ?>

                    </td>

                    <td><?=strftime(config_item('date_format'), strtotime($inv->due_date))?></td>

                    <td class="col-currency">
                    <?=Applib::format_currency($inv->currency, Invoice::get_invoice_subtotal($inv->inv_id))?>
                    </td>

                    <td class="col-currency">
                    <?=Applib::format_currency($inv->currency, Invoice::get_invoice_due_amount($inv->inv_id));?>
                    </td>


                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </section>
        </section>


        </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
        <!-- end -->
