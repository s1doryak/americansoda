<div class="wrapper">
    <div class="block-header">
        <h2>
            @lang('pages/home.title')
        </h2>

        <ul class="actions">
            <li>
                <a href="">
                    <i class="zmdi zmdi-trending-up"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="zmdi zmdi-check-all"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="">@lang('pages/home.actions.refresh')</a>
                    </li>
                    <li>
                        <a href="">@lang('pages/home.actions.manage-widgets')</a>
                    </li>
                    <li>
                        <a href="">@lang('pages/home.actions.widgets-settings')</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>

    <div class="card">
        <div class="card-header">
            <h2>@lang('pages/home.curved-line-chart.title')
                <small>@lang('pages/home.curved-line-chart.subtitle')</small></h2>

            <ul class="actions">
                <li>
                    <a href="">
                        <i class="zmdi zmdi-refresh-alt"></i>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="zmdi zmdi-download"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="" data-toggle="dropdown">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="">@lang('pages/home.curved-line-chart.actions.change-date-range')</a>
                        </li>
                        <li>
                            <a href="">@lang('pages/home.curved-line-chart.actions.change-graph-type')</a>
                        </li>
                        <li>
                            <a href="">@lang('pages/home.curved-line-chart.actions.other-settings')</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="chart-edge">
                <div id="curved-line-chart" class="flot-chart"></div>
            </div>
        </div>
    </div>

    <div class="mini-charts">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="mini-charts-item bgm-lightgreen">
                    <div class="clearfix">
                        <div class="chart stats-bar"></div>
                        <div class="count">
                            <small>@lang('pages/home.mini-charts.stats-bar')</small>
                            <h2>987,459</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="mini-charts-item bgm-purple">
                    <div class="clearfix">
                        <div class="chart stats-bar-2"></div>
                        <div class="count">
                            <small>@lang('pages/home.mini-charts.stats-bar-2')</small>
                            <h2>356,785K</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="mini-charts-item bgm-orange">
                    <div class="clearfix">
                        <div class="chart stats-line"></div>
                        <div class="count">
                            <small>@lang('pages/home.mini-charts.stats-line')</small>
                            <h2>$ 458,778</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="mini-charts-item bgm-bluegray">
                    <div class="clearfix">
                        <div class="chart stats-line-2"></div>
                        <div class="count">
                            <small>@lang('pages/home.mini-charts.stats-line-2')</small>
                            <h2>23,856</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-widgets">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div id="site-visits" class="dw-item bgm-teal">
                    <div class="dwi-header">
                        <div class="p-30">
                            <div class="dash-widget-visits"></div>
                        </div>

                        <div class="dwih-title">@lang('pages/home.site-visits.title')</div>
                    </div>

                    <div class="list-group lg-even-white">
                        <div class="list-group-item media sv-item">
                            <div class="pull-right">
                                <div class="stats-bar"></div>
                            </div>
                            <div class="media-body">
                                <small>@lang('pages/home.site-visits.page-views')</small>
                                <h3>47,896,536</h3>
                            </div>
                        </div>

                        <div class="list-group-item media sv-item">
                            <div class="pull-right">
                                <div class="stats-bar-2"></div>
                            </div>
                            <div class="media-body">
                                <small>@lang('pages/home.site-visits.site-visitors')</small>
                                <h3>24,456,799</h3>
                            </div>
                        </div>

                        <div class="list-group-item media sv-item">
                            <div class="pull-right">
                                <div class="stats-line"></div>
                            </div>
                            <div class="media-body">
                                <small>@lang('pages/home.site-visits.total-clicks')</small>
                                <h3>13,965</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div id="pie-charts" class="dw-item bgm-cyan c-white">

                    <div class="dw-item">
                        <div class="dwi-header">
                            <div class="dwih-title">@lang('pages/home.pie-charts.title')</div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="text-center p-20 m-t-25">
                            <div class="easy-pie main-pie" data-percent="75">
                                <div class="percent">45</div>
                                <div class="pie-title">@lang('pages/home.pie-charts.total-emails-sent')</div>
                            </div>
                        </div>

                        <div class="p-t-25 p-b-20 text-center">
                            <div class="easy-pie sub-pie-1" data-percent="56">
                                <div class="percent">56</div>
                                <div class="pie-title">@lang('pages/home.pie-charts.bounce-rate')</div>
                            </div>
                            <div class="easy-pie sub-pie-2" data-percent="84">
                                <div class="percent">84</div>
                                <div class="pie-title">@lang('pages/home.pie-charts.total-opened')</div>
                            </div>
                            <div class="easy-pie sub-pie-2" data-percent="21">
                                <div class="percent">21</div>
                                <div class="pie-title">@lang('pages/home.pie-charts.total-ignored')</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <!-- Todo -->
                <div id="todo" class="card card-light">
                    <div class="card-header ch-alt">
                        <h2>@lang('pages/home.todo.title')</h2>
                    </div>

                    <div class="card-body card-padding">
                        <div class="t-add">
                            <i class="ta-btn zmdi zmdi-plus" data-ma-action="todo-form-open"></i>

                            <div class="ta-block">
                                <textarea placeholder="@lang('pages/home.todo.placeholder')"></textarea>

                                <div class="tab-actions">
                                    <a data-ma-action="todo-form-close" href="" class="c-red"><i
                                            class="zmdi zmdi-close"></i></a>
                                    <a data-ma-action="todo-form-close" href="" class="c-green"><i
                                            class="zmdi zmdi-check"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="list-group">
                            <div class="list-group-item media">
                                <div class="pull-right">
                                    <ul class="actions actions-alt">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="zmdi zmdi-more-vert"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="">@lang('pages/home.todo.actions.delete')</a></li>
                                                <li><a href="">@lang('pages/home.todo.actions.archive')</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="media-body">
                                    <div class="checkbox checkbox-light">
                                        <label>
                                            <input type="checkbox">
                                            <i class="input-helper"></i>
                                            <span>@lang('pages/home.todo.items.0')</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item media">
                                <div class="pull-right">
                                    <ul class="actions actions-alt">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="zmdi zmdi-more-vert"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="">@lang('pages/home.todo.actions.delete')</a></li>
                                                <li><a href="">@lang('pages/home.todo.actions.archive')</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="media-body">
                                    <div class="checkbox checkbox-light">
                                        <label>
                                            <input type="checkbox">
                                            <i class="input-helper"></i>
                                            <span>@lang('pages/home.todo.items.1')</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item media">
                                <div class="pull-right">
                                    <ul class="actions actions-alt">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="zmdi zmdi-more-vert"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="">@lang('pages/home.todo.actions.delete')</a></li>
                                                <li><a href="">@lang('pages/home.todo.actions.archive')</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="media-body">
                                    <div class="checkbox checkbox-light">
                                        <label>
                                            <input type="checkbox">
                                            <i class="input-helper"></i>
                                            <span>@lang('pages/home.todo.items.2')</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item media">
                                <div class="pull-right">
                                    <ul class="actions actions-alt">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="zmdi zmdi-more-vert"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="">@lang('pages/home.todo.actions.delete')</a></li>
                                                <li><a href="">@lang('pages/home.todo.actions.archive')</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="media-body">
                                    <div class="checkbox checkbox-light">
                                        <label>
                                            <input type="checkbox">
                                            <i class="input-helper"></i>
                                            <span>@lang('pages/home.todo.items.3')</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item media">
                                <div class="pull-right">
                                    <ul class="actions actions-alt">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="zmdi zmdi-more-vert"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="">@lang('pages/home.todo.actions.delete')</a></li>
                                                <li><a href="">@lang('pages/home.todo.actions.archive')</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="media-body">
                                    <div class="checkbox checkbox-light">
                                        <label>
                                            <input type="checkbox">
                                            <i class="input-helper"></i>
                                            <span>@lang('pages/home.todo.items.4')</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <!-- Recent Items -->
            <div class="card">
                <div class="card-header">
                    <h2>@lang('pages/home.recent-items.title') <small>@lang('pages/home.recent-items.subtitle')</small>
                    </h2>
                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="">@lang('pages/home.recent-items.actions.change-date-range')</a>
                                </li>
                                <li>
                                    <a href="">@lang('pages/home.recent-items.actions.change-graph-type')</a>
                                </li>
                                <li>
                                    <a href="">@lang('pages/home.recent-items.actions.other-settings')</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="card-body m-t-0">
                    <table class="table table-inner table-vmiddle">
                        <thead>
                        <tr>
                            <th>@lang('pages/home.recent-items.columns.id')</th>
                            <th>@lang('pages/home.recent-items.columns.name')</th>
                            <th style="width: 60px">@lang('pages/home.recent-items.columns.price')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="f-500 c-cyan">2569</td>
                            <td>Samsung Galaxy Mega</td>
                            <td class="f-500 c-cyan">$521</td>
                        </tr>
                        <tr>
                            <td class="f-500 c-cyan">9658</td>
                            <td>Huawei Ascend P6</td>
                            <td class="f-500 c-cyan">$440</td>
                        </tr>
                        <tr>
                            <td class="f-500 c-cyan">1101</td>
                            <td>HTC One M8</td>
                            <td class="f-500 c-cyan">$680</td>
                        </tr>
                        <tr>
                            <td class="f-500 c-cyan">6598</td>
                            <td>Samsung Galaxy Alpha</td>
                            <td class="f-500 c-cyan">$870</td>
                        </tr>
                        <tr>
                            <td class="f-500 c-cyan">4562</td>
                            <td>LG G3</td>
                            <td class="f-500 c-cyan">$690</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="recent-items-chart" class="flot-chart"></div>
            </div>
        </div>

        <div class="col-sm-6">

            <!-- Recent Posts -->
            <div class="card">
                <div class="card-header">
                    <h2>@lang('pages/home.recent-posts.title') <small>@lang('pages/home.recent-posts.subtitle')</small>
                    </h2>
                    <ul class="actions">
                        <li>
                            <a href="">
                                <i class="zmdi zmdi-refresh-alt"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="zmdi zmdi-download"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="">@lang('pages/home.recent-posts.actions.change-date-range')</a>
                                </li>
                                <li>
                                    <a href="">@lang('pages/home.recent-posts.actions.change-graph-type')</a>
                                </li>
                                <li>
                                    <a href="">@lang('pages/home.recent-posts.actions.other-settings')</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="list-group">
                        <a class="list-group-item media" href="">
                            <div class="pull-left">
                                <img class="lgi-img"
                                     src="{{ asset('vendor/material-admin/img/demo/profile-pics/1.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lgi-heading">David Belle</div>
                                <small class="lgi-text">Cum sociis natoque penatibus et magnis dis parturient
                                    montes</small>
                            </div>
                        </a>
                        <a class="list-group-item media" href="">
                            <div class="pull-left">
                                <img class="lgi-img"
                                     src="{{ asset('vendor/material-admin/img/demo/profile-pics/2.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lgi-heading">Jonathan Morris</div>
                                <small class="lgi-text">Nunc quis diam diamurabitur at dolor elementum, dictum turpis
                                    vel</small>
                            </div>
                        </a>
                        <a class="list-group-item media" href="">
                            <div class="pull-left">
                                <img class="lgi-img"
                                     src="{{ asset('vendor/material-admin/img/demo/profile-pics/3.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lgi-heading">Fredric Mitchell Jr.</div>
                                <small class="lgi-text">Phasellus a ante et est ornare accumsan at vel magnauis blandit
                                    turpis at augue ultricies</small>
                            </div>
                        </a>
                        <a class="list-group-item media" href="">
                            <div class="pull-left">
                                <img class="lgi-img"
                                     src="{{ asset('vendor/material-admin/img/demo/profile-pics/4.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lgi-heading">Glenn Jecobs</div>
                                <small class="lgi-text">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius
                                    dignissim, dui est consectetur neque</small>
                            </div>
                        </a>
                        <a class="list-group-item media" href="">
                            <div class="pull-left">
                                <img class="lgi-img"
                                     src="{{ asset('vendor/material-admin/img/demo/profile-pics/4.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lgi-heading">Bill Phillips</div>
                                <small class="lgi-text">Proin laoreet commodo eros id faucibus. Donec ligula quam,
                                    imperdiet vel ante placerat</small>
                            </div>
                        </a>
                        <a class="view-more" href="">@lang('pages/home.recent-posts.buttons.view-more')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
