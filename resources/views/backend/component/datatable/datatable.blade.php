<!-- Datatable -->
<div id="<?php echo $dt->id; ?>" class="datatable table-responsive">
    {!! Form::open(['url' => $dt->callback, 'id' => 'datatable_action', 'method' => 'post']) !!}
        <input type="hidden" id="datatable_params" name="datatable_params" value="<?php echo $dt->params(); ?>">
    {!! Form::close() !!}
    <?php if(is_array($dt->data['column']) && count($dt->data['column']) > 0): ?>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="datatable-paging">
                <?php
                    $colspan = count($dt->data['column']) + 2;
                    if(!$dt->config['bulk']) $colspan--;
                    if(!$dt->config['action_column']) $colspan--;
                ?>
                <th colspan="<?php echo $colspan; ?>">
                    <?php if($dt->config['paging']): ?>
                    <div class="datatable-action-container">
                        <label>{{ ucwords(trans('backend/component/datatable.page')) }}</label>
                        <div class="input-group">
                            <span class="input-group-btn">	
                                <button class="btn btn-default btn-icon datatable-btn-page datatable-btn-page-prev disabled" data-page="prev" type="button"><i class="icon-arrow-left22"></i></button>
                            </span>
                            <input id="datatable_page" type="text" class="paging form-control number-only" value="1">
                            <span class="input-group-btn">
                                <?php $disable = ( $dt->config['total_rows'] > $dt->config['view_per_page_list'][0]) ? '' : 'disabled'; ?>	
                                <button class="btn btn-default btn-icon datatable-btn-page datatable-btn-page-next <?php echo $disable; ?>" data-page="next" type="button"><i class="icon-arrow-right22"></i></button>
                            </span>
                        </div>
                        <label>{{ trans('backend/component/datatable.of') }} <span id="datatable_total_page"><?php echo $dt->config['total_pages']; ?></span> {{ trans('backend/component/datatable.pages') }}</label>
                    </div>
                    <?php endif; ?>
                    <?php if($dt->config['view_per_page']): ?>
                    <div class="datatable-action-container">
                        <label>{{ ucwords(trans('backend/component/datatable.view')) }}</label>
                        <div class="form-group">
                            <select class="datatable-per-page bootstrap-select bs-select-hidden" data-width="100%">
                                <?php foreach($dt->config['view_per_page_list'] as $v): ?>
                                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label>{{ trans('backend/component/datatable.per_page') }}</label>
                    </div>
                    <label class="total-records">{{ ucwords(trans('backend/component/datatable.total')) }} <span id="datatable_total_rows"><?php echo $dt->config['total_rows']; ?></span> {{ trans('backend/component/datatable.records') }} {{ trans('backend/component/datatable.found') }}</label>            
                    <?php endif; ?>
                    <?php if($dt->config['export']): ?>
                    <div class="datatable-export-container">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary"><i class="icon-file-text2 position-left"></i> {{ ucwords(trans('backend/component/datatable.export')) }}</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="#"><i class="icon-file-stats"></i> CSV</a></li>
                                <li><a href="#"><i class="icon-file-excel"></i> Excel XML</a></li>
                                <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                </th>
            </tr>
            <?php if($dt->config['bulk']): ?>
            <tr class="datatable-selection">
                <th colspan="<?php echo ($colspan - 1); ?>">
                    <a class="datatable-select-all">{{ ucwords(trans('backend/component/datatable.select_all')) }}</a>
                    <a class="datatable-unselect-all">{{ ucwords(trans('backend/component/datatable.unselect_all')) }}</a>
                    <a class="datatable-select-visible">{{ ucwords(trans('backend/component/datatable.select_visible')) }}</a>
                    <a class="datatable-unselect-visible">{{ ucwords(trans('backend/component/datatable.unselect_visible')) }}</a>
                    <span><span id="selected_items">0</span> {{ trans('backend/component/datatable.items_selected') }}</span>
                </th>
                <?php if($dt->config['bulk']): ?>
                <th class="action">
                    <div class="datatable-action-container">
                        <div class="form-group">
                            {!! Form::open(['class' => 'form-bulk-action', 'method' => 'post']) !!}
                                <input type="hidden" id="datatable_bulk_data" name="datatable_bulk_data">
                            {!! Form::close() !!}
                            <select class="datatable-bulk-action bootstrap-select bs-select-hidden" data-width="100%">
                                <option value="">Bulk actions</option>
                                <?php foreach($dt->action_bulk as $ab): ?>
                                    <?php if($ab['icon'] != ''): ?>
                                    <option data-message="<?php echo $ab['alert_message']; ?>" data-callback="<?php echo $ab['callback']; ?>" value="<?php echo $ab['label'] ?>" data-icon="<?php echo $ab['icon']; ?>"><?php echo ucfirst($ab['label']); ?></option>
                                    <?php else: ?>
                                    <option data-message="<?php echo $ab['alert_message']; ?>" data-callback="<?php echo $ab['callback']; ?>" value="<?php echo $ab['label'] ?>"><?php echo ucfirst($ab['label']); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </th>
                <?php endif; ?>
            </tr>
            <?php endif; ?>
            <tr class="datatable-column-name">
                <?php if($dt->config['bulk']): ?>
                <th style="width:5%"></th>
                <?php endif; ?>
                <?php foreach($dt->data['column'] as $d): ?>
                <th style="width:<?php echo $d['width']; ?>; text-align:<?php echo $d['data_align']; ?>">
                    <?php if($dt->config['sorting']): ?>
                    <a class="datatable-sort-action" data-sort="<?php echo $d['field']; ?>">
                        <?php echo $d['name']; ?>
                        <i class="datatable-column-sort sort-asc <?php echo ($d['sorted'] == 'asc') ? 'enable' : '' ?> icon-arrow-up5"></i>
                        <i class="datatable-column-sort sort-desc <?php echo ($d['sorted'] == 'desc') ? 'enable' : '' ?> icon-arrow-down5"></i>
                    </a>
                    <?php else: ?>
                    <?php echo $d['name']; ?>
                    <?php endif; ?>
                </th>
                <?php endforeach; ?>
                <?php if($dt->config['action_column']): ?>
                <th style="width:10%; text-align:center;">{{ ucwords(trans('backend/component/datatable.action')) }}</th>
                <?php endif; ?>
            </tr>
            <?php if($dt->config['filter']): ?>
            <tr class="datatable-filter">
                <?php if($dt->config['bulk']): ?>
                <th></th>
                <?php endif; ?>
                <?php foreach($dt->data['column'] as $d): ?>
                <th>
                <?php if($d['filter'] == 'text'): ?>
                    <input type="text" class="datatable-search-field form-control" data-search-type="single" data-search="<?php echo $d['field']; ?>">
                <?php elseif($d['filter'] == 'number'): ?>
                    <input type="text" class="datatable-search-field form-control number-only" data-search-type="single" data-search="<?php echo $d['field']; ?>">
                <?php elseif($d['filter'] == 'number_range'): ?>
                    <input type="text" placeholder="From" class="datatable-search-field form-control number-only" data-search-type="range" data-search-base="0" data-search="<?php echo $d['field']; ?>">
                    <input type="text" placeholder="To" class="datatable-search-field form-control number-only" data-search-type="range" data-search-base="1" data-search="<?php echo $d['field']; ?>">
                <?php elseif($d['filter'] == 'date'): ?>
                    <div class="input-group datatable-datepicker">
                        <input type="text" class="datatable-datepicker-input datatable-search-field form-control" data-search-type="single" data-search="<?php echo $d['field']; ?>" value="">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                    </div>
                <?php elseif($d['filter'] == 'date_range'): ?>
                    <div class="input-group datatable-datepicker">
                        <input type="text" placeholder="From" class="datatable-datepicker-input datatable-search-field form-control" data-search-type="range" data-search-base="0" data-search="<?php echo $d['field']; ?>" value="">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                    </div>
                    <div class="input-group datatable-datepicker">
                        <input type="text" placeholder="To" class="datatable-datepicker-input datatable-search-field form-control" data-search-type="range" data-search-base="1" data-search="<?php echo $d['field']; ?>" value="">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                    </div>
                <?php elseif($d['filter'] == 'select'): ?>
                    <select class="datatable-search-field form-control" data-search-type="single" data-search="<?php echo $d['field']; ?>">
                        <option value=""></option>
                        <?php foreach($d['filter_select'] as $k=>$v): ?>
                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                </th>
                <?php endforeach; ?>
                <?php if($dt->config['action_column']): ?>
                <th style="text-align:center;">
                    <button type="button" class="btn btn-default btn-xs datatable-btn-search"><i class="icon-search4 position-left"></i> {{ ucwords(trans('backend/component/datatable.search')) }}</button>
                    <button type="button" class="btn btn-warning btn-xs datatable-btn-reset"><i class="icon-eraser2 position-left"></i> {{ ucwords(trans('backend/component/datatable.reset')) }} &nbsp;</button>
                </th>
                <?php endif; ?>
            </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php if(is_array($dt->data['row']) && count($dt->data['row']) > 0): ?>
            <?php foreach($dt->data['row'] as $d): ?>
            <tr>
                <?php if($dt->config['bulk']): ?>
                <td><input class="datatable-item-checkbox" type="checkbox" value="<?php echo $d['id']; ?>"></td>
                <?php endif; ?>
                <?php foreach($dt->data['column'] as $c): ?>
                    <?php if($c['data_align'] == 'left'): ?><td class="data-align-left"><?php echo $d[$c['field']]; ?></td><?php endif; ?>
                    <?php if($c['data_align'] == 'center'): ?><td class="data-align-center"><?php echo $d[$c['field']]; ?></td><?php endif; ?>
                    <?php if($c['data_align'] == 'right'): ?><td class="data-align-right"><?php echo $d[$c['field']]; ?></td><?php endif; ?>
                <?php endforeach; ?>
                <?php if($dt->config['action_column']): ?>
                        <td class="datatable-action-single" style="text-align:center;">
                            <div class="btn-group">
                                <a href="<?php echo $dt->action_single[0]['callback'].$d['id']; ?>" type="button" class="btn btn-default action-single-main-button"><i class="<?php echo $dt->action_single[0]['icon']; ?>"></i> <?php echo ucwords($dt->action_single[0]['label']); ?></a>
                                <?php if(count($dt->action_single) > 1): ?>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <?php for($i=1; $i<count($dt->action_single); $i++): ?>
                                    <li <?php echo ($dt->action_single[$i]['spacer']) ? 'style="border-top: 1px solid #DDD;"' : ''; ?>>
                                        <a <?php if($dt->action_single[$i]['actionpage'] == 'newpage') echo 'target="_blank"'; ?> <?php echo ($dt->action_single[$i]['alert']) ? 'class="action-single-button" data-message="'.$dt->action_single[$i]['alert_message'].'"' : ''; ?> href="<?php echo $dt->action_single[$i]['callback'].$d['id']; ?>">
                                            <i class="<?php echo $dt->action_single[$i]['icon']; ?>"></i> <?php echo ucwords($dt->action_single[$i]['label']); ?>
                                        </a>
                                    </li>
                                    <?php endfor; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr><td id="no_data" class="data-align-center" colspan="<?php echo $colspan; ?>">{{ ucfirst(trans('backend/component/datatable.data_not_found')) }}</td></tr>     
            <?php endif; ?>
        </tbody>
    </table>
    <?php else: ?>
    <center>{{ trans('backend/component/datatable.specify_column_first') }}</center>
    <?php endif; ?>

    <!-- Datatable notification -->
    
    <!--
    <div id="datatable_modal_notification" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords(trans('backend/component/datatable.notification')) }}</h5>
                    <hr>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info alert-styled-left text-blue-800 content-group datatable-notification-message">
                        {{ trans('backend/component/datatable.select_one_data') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">{{ ucwords(trans('backend/component/datatable.ok')) }}</button>
                </div>
            </div>
        </div>
    </div>
    -->
    
    <div id="datatable_modal_confirm" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords(trans('backend/component/datatable.confirm')) }}</h5>
                    <hr>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="bulk_action_method" value="enable">
                    <input type="hidden" id="bulk_action_message_success" value="Success!">
                    <div class="datatable-notification-message"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">{{ ucwords(trans('backend/component/datatable.cancel')) }}</button>
                    <button class="btn btn-primary" data-dismiss="modal" id="bulk_action_confirm" >{{ ucwords(trans('backend/component/datatable.ok')) }}</button>
                </div>
            </div>
        </div>
    </div>
    <div id="datatable_modal_confirm_action_single" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords(trans('backend/component/datatable.confirm')) }}</h5>
                    <hr>
                </div>
                <div class="modal-body">
                    <div class="datatable-notification-message"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">{{ ucwords(trans('backend/component/datatable.cancel')) }}</button>
                    <button class="btn btn-primary" data-dismiss="modal" id="single_action_confirm" >{{ ucwords(trans('backend/component/datatable.ok')) }}</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <div id="datatable_modal_notification" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords(trans('backend/component/datatable.notification')) }}</h5>
                    <hr>
                </div>
                <div class="modal-body">
                    <div class="datatable-notification-message">{{ trans('backend/component/datatable.select_one_data') }}</div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">{{ ucwords(trans('backend/component/datatable.ok')) }}</button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- /Datatable notification -->

</div>
<!-- End Datatable -->


