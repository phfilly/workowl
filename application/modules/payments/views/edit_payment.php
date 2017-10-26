
<!-- Start -->


<section id="content">
    <section class="hbox stretch">

        <aside class="aside-md bg-white b-r" id="subNav">

            <header class="dk header b-b">

                <p class="h4"><?=lang('all_payments')?></p>
            </header>

            <section class="vbox">
                <section class="scrollable">
                    <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

                        <ul class="nav">

                            <?php foreach ($payments as $key => $p) { ?>
                                <li class="b-b b-light <?php if($p->p_id == $this->uri->segment(3)){ echo "bg-light dk"; } ?>">
                                    <a href="<?=base_url()?>payments/view/<?=$p->p_id?>" class="small">
                                        <strong>
                                            <?=ucfirst(Client::view_by_id($p->paid_by)->company_name)?>
                                        </strong>
                                        <div class="pull-right">
                                            <strong><?=Applib::format_currency(Invoice::view_by_id($p->invoice)->currency,$p->amount)?></strong>
                                        </div> <br>
                                        <small class="block small text-muted"><?=$p->trans_id?> | <?=strftime(config_item('date_format'), strtotime($p->created_date));?> </small>

                                    </a> </li>
                            <?php } ?>
                        </ul>

                    </div></section>
            </section>
        </aside>

        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">

                            <?php $i = Payment::view_by_id($id); ?>
                            <div class="btn-group">
                                <a href="<?=base_url()?>payments/view/<?=$i->p_id?>" data-original-title="<?=lang('view_details')?>" data-toggle="tooltip" data-placement="top" class="btn btn-<?=config_item('theme_color');?> btn-sm"><i class="fa fa-info-circle"></i> <?=lang('payment_details')?></a>
                            </div>

                        </div>
                        <div class="col-sm-4 m-b-xs">

                        </div>
                    </div> </header>
                <section class="scrollable wrapper">

                    <!-- Start create invoice -->
                    <div class="col-sm-12">
                        <section class="panel panel-default">

                            <header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('payment_details')?> - TRANS <?=$i->trans_id?></header>
                            <div class="panel-body">


                                <?php
                                $attributes = array('class' => 'bs-example form-horizontal');
                                echo form_open(base_url().'payments/edit',$attributes); ?>
                                <input type="hidden" name="p_id" value="<?=$i->p_id?>">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('amount')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" value="<?=$i->amount?>" name="amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('payment_method')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <select name="payment_method" class="form-control">
                                            <?php foreach (App::list_payment_methods() as $key => $p_method) { ?>
                                                <option value="<?=$p_method->method_id?>"<?=($i->payment_method == $p_method->method_id ? ' selected="selected"' : '')?>><?=$p_method->method_name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <?php $currency = App::currencies($i->currency); ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('currency')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <select name="currency" class="form-control">
                                           <?php foreach (App::currencies() as $cur) : ?>
                                <option value="<?=$cur->code?>"<?=($currency->code == $cur->code ? ' selected="selected"' : '')?>><?=$cur->name?></option>
                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                        

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('payment_date')?></label>
                                    <div class="col-lg-4">
                                        <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'), strtotime($i->payment_date));?>" name="payment_date" data-date-format="<?=config_item('date_picker_format');?>" >
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('notes')?> </label>
                                    <div class="col-lg-8">
                                        <textarea name="notes" class="form-control"><?=$i->notes?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-<?=config_item('theme_color');?>"> <?=lang('save_changes')?></button>



                                </form>
                            </div>
                        </section>
                    </div>


                    <!-- End create invoice -->



                </section>




            </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>

<!-- end -->