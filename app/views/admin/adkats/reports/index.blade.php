@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <th>ID</th>
                            <th>Server</th>
                            <th>Type</th>
                            <th>Source</th>
                            <th>Target</th>
                            <th>Time</th>
                            <th>Message</th>
                        </thead>

                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->record_id }}</td>
                                <td>{{ $report->server->server_name_short or $report->server->ServerName }}</td>
                                <td>{{ $report->action->command_name }}</td>
                                <td>{{ link_to_route('player.show', $report->source_name, [$report->source_id, $report->source_name]) }}</td>
                                <td>{{ link_to_route('player.show', $report->target_name, [$report->target_id, $report->target_name]) }}</td>
                                <td><span ng-bind="moment('{{ $report->stamp }}').fromNow()" tooltip="<?php echo '{{';?> moment('<?php echo $report->stamp;?>').format('lll') <?php echo '}}';?>"></span></td>
                                <td>{{ $report->record_message }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box-footer clearfix">
                <div class="pull-left">Total: <span ng-bind="{{ $reports->getTotal() }} | number"></span></div>
                <div class="pull-right">{{ $reports->appends(Input::except('page'))->links() }}</div>
            </div>
        </div>
    </div>
</div>
@stop
