<div class="navbar-custom-menu">
    <ul class="nav navbar-nav" id="site-navbar">
	    {{-- Day/Night Toggle, nicked from docs.docker.com --}}
		<li>
			<div class="toggle-mode">
				<div class="icon">
					<i class="fa fa-sun-o" aria-hidden="true"></i>
				</div>
				<div class="toggle-switch">
					<label class="switch">
						<input type="checkbox" id="switch-style" @if (Cookie::get('theme') == 'night') checked @endif>
						<span class="slider round"></span>
					</label>
				</div>
				<div class="icon">
					<i class="fa fa-moon-o" aria-hidden="true"></i>
				</div>
			</div>
        </li>
        {{-- Reports Menu --}}
        @if($bfacp->isLoggedIn && Auth::user()->ability(null, 'admin.adkats.reports.view'))
            <li class="dropdown messages-menu" ng-include="'js/templates/latestreports.html'" ng-controller="ReportsController" onload="latestReports()"></li>
        @endif

        {{-- User Menu --}}
        @if($bfacp->isLoggedIn)
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>

                    <span>{{ $bfacp->user->username }} <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header bg-light-blue">
                        {!! Html::image($bfacp->user->gravatar, null, ['class' => 'img-circle']) !!}
                        <p>
                            {{ $bfacp->user->roles[0]->name }}
                            <small>Member since
                                <span ng-bind="moment('{{ $bfacp->user->created_at->toIso8601String() }}').format('MMMM YYYY')"></span>
                            </small>
                        </p>
                    </li>

                    <li class="user-body">
                        @forelse($bfacp->user->soldiers as $soldier)
                            <div class="col-xs-4">
                                {!! link_to_route('player.show', $soldier->player->game->Name, [
                                    $soldier->player->PlayerID,
                                    $soldier->player->SoldierName
                                ], ['target' => '_self', 'class' => $soldier->player->game->class_css, 'style' => 'color: white !important', 'tooltip' => $soldier->player->SoldierName]) !!}
                            </div>
                        @empty
                            <alert type="info">
                                {!! Macros::faicon('fa-info-circle') !!} No soldiers found.
                                </alert>
                        @endforelse
                    </li>

                    <li class="user-footer">
                        <div class="pull-left">
                            {!! link_to_route('user.account', 'Account', [], ['class' => 'btn btn-default btn-flat', 'target' => '_self']) !!}
                            {!! link_to_route('user.profile', 'Profile', [$bfacp->user->id, strtolower($bfacp->user->username)], ['class' => 'btn btn-default btn-flat', 'target' => '_self']) !!}
                        </div>

                        <div class="pull-right">
                            {!! link_to_route('user.logout', 'Logout', [], ['class' => 'btn btn-default btn-flat', 'target' => '_self']) !!}
                        </div>
                    </li>
                </ul>
            </li>
        @else
            <li>
                <a href="{{ route('user.login') }}" target="_self">
                    {!! Macros::faicon('fa-sign-in') !!}
                    <span>Login</span>
                </a>
            </li>
        @endif
    </ul>
</div>
