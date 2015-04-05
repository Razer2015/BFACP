@extends('layout.main')

@section('content')

<section ng-controller="PlayerController">
    <div class="row">

        <!-- Player Basic -->
        <div class="col-xs-12 col-lg-6">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">{{ Lang::get('player.profile.details.title') }}</div>
                </div>

                <div class="box-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.id') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">{{{ $player->PlayerID }}}</p>
                                {{ Form::hidden('player_id', $player->PlayerID) }}
                                {{ Form::hidden('player_name', $player->SoldierName) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.game') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">{{{ $player->game->Name }}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.eaguid') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    @if( ! empty($player->EAGUID) )
                                    {{ link_to_route('player.listing', $player->EAGUID, [
                                        'player' => $player->EAGUID
                                    ], [
                                        'target' => '_blank'
                                    ]) }}
                                    @else
                                    <span class="text-red">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.pbguid') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    @if( ! empty($player->PBGUID) )
                                    {{ link_to_route('player.listing', $player->PBGUID, [
                                        'player' => $player->PBGUID
                                    ], [
                                        'target' => '_blank'
                                    ]) }}
                                    @else
                                    <span class="text-red">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.ip') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    @if( ! empty($player->IP_Address) )
                                    {{ link_to_route('player.listing', $player->IP_Address, [
                                        'player' => $player->IP_Address
                                    ], [
                                        'target' => '_blank'
                                    ]) }}
                                    @else
                                    <span class="text-red">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.country') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    {{ HTML::image($player->country_flag, $player->country_name) }}
                                    {{{ $player->country_name }}}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.reputation') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    <span class="{{ $player->reputation->color }}">
                                        @if($player->reputation->total_rep_co > 0)
                                        <i class="fa fa-caret-up"></i>
                                        @elseif($player->reputation->total_rep_co < 0)
                                        <i class="fa fa-caret-down"></i>
                                        @elseif($player->reputation->total_rep_co == 0)
                                        <i class="fa fa-caret-left"></i>
                                        @endif

                                        {{ round($player->reputation->total_rep_co, 2) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ Lang::get('player.profile.details.items.rank') }}</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    {{ HTML::image($player->rank_image, sprintf('Rank %u', $player->GlobalRank), ['width' => '128px']) }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- END Player Basic -->

        <div class="col-xs-12 col-lg-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="javascript://" data-target="#infractions" data-toggle="tab">{{ Lang::get('player.profile.infractions.title') }}</a></li>
                    <li><a href="javascript://" data-target="#ban-current" data-toggle="tab">{{ Lang::get('player.profile.bans.current.title') }}</a></li>
                    <li><a href="javascript://" data-target="#ban-previous" data-toggle="tab">{{ Lang::get('player.profile.bans.previous.title') }}</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="infractions">
                        @if( ! is_null($player->infractions_global) && ! is_null($player->infractions_server))
                        <table class="table table-striped table-condensed">
                            <thead>
                                <th>{{ Lang::get('player.profile.infractions.table.col1') }}</th>
                                <th>{{ Lang::get('player.profile.infractions.table.col2') }}</th>
                                <th>{{ Lang::get('player.profile.infractions.table.col3') }}</th>
                                <th>{{ Lang::get('player.profile.infractions.table.col4') }}</th>
                            </thead>

                            <tbody>
                                @foreach($player->infractions_server as $infraction)
                                <tr>
                                    <td>
                                        @if($infraction->server->is_active)
                                        <a href="servers/live#id-{{ $infraction->server->ServerID }}" target="_blank" tooltip="{{ $infraction->server->ServerName }}">
                                            {{ $infraction->server->server_name_short or str_limit($infraction->server->ServerName, 30) }}
                                        </a>
                                        @else
                                        <span tooltip="{{ $infraction->server->ServerName }}">{{ $infraction->server->server_name_short or str_limit($infraction->server->ServerName, 30) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $infraction->punish_points }}</td>
                                    <td>{{ $infraction->forgive_points }}</td>
                                    <td>{{ $infraction->total_points }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td><span class="pull-right">{{ Lang::get('player.profile.infractions.overall.title') }}</span></td>
                                    <td>{{ $player->infractions_global->punish_points }}</td>
                                    <td>{{ $player->infractions_global->forgive_points }}</td>
                                    <td>{{ $player->infractions_global->total_points }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i> {{ Lang::get('player.profile.infractions.none') }}
                        </div>
                        @endif
                    </div>

                    <div class="tab-pane" id="ban-current">
                        @if( ! is_null($player->ban) && $player->ban->is_active )
                        <table class="table table-condensed">
                            <thead>
                                <th>{{ Lang::get('player.profile.bans.current.table.col1') }}</th>
                                <th>{{ Lang::get('player.profile.bans.current.table.col2') }}</th>
                                <th>{{ Lang::get('player.profile.bans.current.table.col3') }}</th>
                                <th>{{ Lang::get('player.profile.bans.current.table.col4') }}</th>
                                <th>{{ Lang::get('player.profile.bans.current.table.col5') }}</th>
                                <th width="25%">{{ Lang::get('player.profile.bans.current.table.col6') }}</th>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <span ng-bind="moment('{{ $player->ban->ban_issued }}').fromNow()" tooltip="{{ HTML::moment($player->ban->ban_issued) }}"></span>
                                    </td>
                                    <td>
                                        <span ng-bind="moment('{{ $player->ban->ban_expires }}').fromNow()" tooltip="{{ HTML::moment($player->ban->ban_expires) }}"></span>
                                    </td>
                                    <td>
                                        @if($player->ban->record->server->is_active)
                                        <a href="servers/live#id-{{ $player->ban->record->server->ServerID }}" target="_blank" tooltip="{{ $player->ban->record->server->ServerName }}">
                                            {{ $player->ban->record->server->server_name_short or str_limit($player->ban->record->server->ServerName, 30) }}
                                        </a>
                                        @else
                                        <span tooltip="{{ $player->ban->record->server->ServerName }}">{{ $player->ban->record->server->server_name_short or str_limit($player->ban->record->server->ServerName, 30) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($player->ban->is_perm)
                                        <label class="label label-danger">{{ Lang::get('player.profile.bans.type.permanent.short') }}</label>
                                        @else
                                        <label class="label label-warning">{{ Lang::get('player.profile.bans.type.temporary.short') }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($player->ban->is_active)
                                        <label class="label label-danger">{{ Lang::get('player.profile.bans.status.enabled') }}</label>
                                        @elseif($player->ban->is_expired)
                                        <label class="label label-success">{{ Lang::get('player.profile.bans.status.expired') }}</label>
                                        @elseif( ! $player->ban->is_active && ! $player->ban->is_expired)
                                        <label class="label label-primary">{{ Lang::get('player.profile.bans.status.disabled') }}</label>
                                        @endif
                                    </td>
                                    <td>{{ $player->ban->record->record_message }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @elseif( ! is_null($player->ban) && (!$player->ban->is_active || $player->ban->is_expired))
                        <alert type="info">
                            <i class="fa fa-info-circle"></i>&nbsp;{{ Lang::get('player.profile.bans.current.inactive', ['status' => $player->ban->ban_status]) }}
                        </alert>
                        @else
                        <alert type="success">
                            <i class="fa fa-check"></i> {{ Lang::get('player.profile.bans.current.none') }}
                        </alert>
                        @endif
                    </div>

                    <div class="tab-pane" id="ban-previous">
                        @if( ! is_null($player->ban) && ! is_null($player->ban->previous) && count($player->ban->previous) > 1 )
                        <table class="table table-striped table-condensed">
                            <thead>
                                <th>{{ Lang::get('player.profile.bans.previous.table.col1') }}</th>
                                <th>{{ Lang::get('player.profile.bans.previous.table.col2') }}</th>
                                <th>{{ Lang::get('player.profile.bans.previous.table.col3') }}</th>
                                <th>{{ Lang::get('player.profile.bans.previous.table.col4') }}</th>
                                <th width="25%">{{ Lang::get('player.profile.bans.previous.table.col5') }}</th>
                            </thead>

                            <tbody>
                                @foreach($player->ban->previous as $ban)
                                <?php if($player->ban->latest_record_id == $ban->record_id) continue; ?>
                                <tr>
                                    <td>
                                        <span ng-bind="moment('{{ $ban->stamp }}').fromNow()" tooltip="{{ HTML::moment($ban->stamp) }}"></span>
                                    </td>
                                    <td>
                                        <span ng-bind="momentDuration({{ $ban->command_numeric }}, 'minutes')"></span>
                                    </td>
                                    <td>
                                        @if($ban->server->is_active)
                                        <a href="servers/live#id-{{ $ban->server->ServerID }}" target="_blank" tooltip="{{ $ban->server->ServerName }}">
                                            {{ $ban->server->server_name_short or str_limit($ban->server->ServerName, 30) }}
                                        </a>
                                        @else
                                        <span tooltip="{{ $ban->server->ServerName }}">{{ $ban->server->server_name_short or str_limit($ban->server->ServerName, 30) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(in_array($ban->command_action, [8, 73]))
                                        <label class="label label-danger">{{ Lang::get('player.profile.bans.type.permanent.short') }}</label>
                                        @else
                                        <label class="label label-warning">{{ Lang::get('player.profile.bans.type.temporary.short') }}</label>
                                        @endif
                                    </td>
                                    <td>{{ $ban->record_message }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i> {{ Lang::get('player.profile.bans.previous.none') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="javascript://" data-target="#server-stats-active" data-toggle="tab">{{ Lang::get('player.profile.stats.server.title') }} &ndash; <span class="badge bg-green">Active</span></a></li>
                    <li><a href="javascript://" data-target="#server-stats-inactive" data-toggle="tab">{{ Lang::get('player.profile.stats.server.title') }} &ndash; <span class="badge bg-gray">Inactive</span></a></li>
                    <li><a href="javascript://" data-target="#sessions" data-toggle="tab"><span ng-if="refresh.sessions"><i class="fa fa-refresh fa-spin"></i>&nbsp;</span>{{ Lang::get('player.profile.stats.sessions.title') }}</a></li>
                    <li><a href="javascript://" data-target="#acs" data-toggle="tab"><span ng-if="refresh.acs">
                        <i class="fa fa-refresh fa-spin"></i>&nbsp;</span>
                        <span class="badge" ng-class="{'bg-green': weapons.acs.length === 0, 'bg-red': weapons.acs.length > 0}" ng-bind="weapons.acs.length"></span>
                        {{ Lang::get('player.profile.acs.title') }}
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="server-stats-active">
                        @include('partials.player.profile._serverstats', ['stats' => $player->stats, 'unless' => TRUE])
                    </div>

                    <div class="tab-pane" id="server-stats-inactive">
                        @include('partials.player.profile._serverstats', ['stats' => $player->stats, 'unless' => FALSE])
                    </div>

                    <div class="tab-pane" id="sessions">
                        @include('partials.player.profile._sessions')
                    </div>

                    <div class="tab-pane" id="acs">
                        @include('partials.player.profile._acs')

                        <alert type="info" class="hidden-xs hidden-sm">
                            <i class="fa fa-info-circle"></i>&nbsp;
                            {{ Lang::get('player.profile.acs.help') }}
                        </alert>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ Lang::get('player.profile.records.title') }}</h3>

                    <div class="box-tools pull-right">
                        <pagination class="pagination-sm inline" total-items="records.total" ng-change="fetchRecords()" ng-model="records.current_page" max-size="5" boundary-links="true" items-per-page="records.per_page"></pagination>
                    </div>
                </div>

                <div class="box-body">
                    @include('partials.player.profile._records')
                </div>

                <div class="box-footer">
                    {{ Lang::get('player.profile.records.viewing.p1') }} <span ng-bind="records.from | number"></span> {{ Lang::get('player.profile.records.viewing.p2') }} <span ng-bind="records.to | number"></span> {{ Lang::get('player.profile.records.viewing.p3') }} <span ng-bind="records.total | number"></span>.
                </div>

                <div class="overlay" ng-if="refresh.records">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
