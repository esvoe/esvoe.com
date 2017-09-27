<!-- main-section -->

<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {!! Theme::partial('advertising') !!}
        </div>
        <div class="col-lg-9 col-wallet">
            {!! Theme::partial('wallet', ['balance' => $balance]) !!}
            @if(Request::root() != Request::url())
                <div class="wrap-footer-home other-page-footer panel panel-default">
                    <a @if(Config::get('app.locale')== 'en')class="active-lang-home" @endif href="{{url('setlocale/'.'en')}}">{{Config::get('app.locales')['en']}}</a>
                    <a @if(Config::get('app.locale')== 'ru')class="active-lang-home" @endif href="{{url('setlocale/'.'ru')}}">{{Config::get('app.locales')['ru']}}</a>
                    <a @if(Config::get('app.locale')== 'ua')class="active-lang-home" @endif href="{{url('setlocale/'.'ua')}}">{{Config::get('app.locales')['ua']}}</a>
                    <div class="more-lang-home">
                        <a data-toggle="modal" data-target=".modal-lang" href=""><i class="fa fa-globe fa-lg" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="link-home-footer other-page-footer">
                    @foreach(App\StaticPage::active() as $staticpage)
                        <a href="{{ url('page/'.$staticpage->slug) }}">{{ $staticpage->title }}</a>
                    @endforeach
                    <p>
                        <a class="copy" href="/">{{ Setting::get('site_name') }} </a>
                        <span>&copy; {{ date('Y') }}</span>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

{{--<div class="container">--}}
	{{--<div class="row">--}}
		{{--<div class="visible-lg col-lg-2">--}}
			{{--<br>--}}
			{{--{!! Theme::partial('home-leftbar',compact('trending_tags')) !!}--}}
		{{--</div>--}}

		{{--<div class="col-md-10">--}}
			{{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading no-bg user-pages no-paddingbottom navbars">--}}
                    {{--<div class="page-heading pull-left">{{ trans('common.wallet_bilance') }}</div>--}}
                    {{--<div class="page-heading pull-right">{{ trans('common.wallet') }}<span>{{ $balance->token }} єТ</span></div>--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
		{{--</div><!-- /col-md-10 -->--}}
        {{----}}
        {{--<div class="col-md-10">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading no-bg user-pages no-paddingbottom navbars">--}}
                    {{--@if(Auth::user()->id == $timeline->user->id)--}}
                    {{--<div class="page-heading  pull-left">--}}
                        {{--<span>{{ trans('common.wallet_buy') }}</span></div>--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="{{ url(Auth::user()->username.'/wallet/buy') }}" class="btn btn-success btn-downloadreport">--}}
                                {{--{{ trans('common.wallet_buy_button') }}--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="panel-heading no-bg user-pages no-paddingbottom navbars">--}}
                    {{--@if(Auth::user()->id == $timeline->user->id)--}}
                    {{--<div class="page-heading  pull-left">--}}
                        {{--<span>{{ trans('common.wallet_sell') }}</span></div>--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="{{ url(Auth::user()->username.'/wallet/sell') }}" class="btn btn-success btn-downloadreport">--}}
                                {{--{{ trans('common.wallet_sell_button') }}--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="panel-heading no-bg user-pages no-paddingbottom navbars">--}}
                    {{--@if(Auth::user()->id == $timeline->user->id)--}}
                    {{--<div class="page-heading  pull-left">--}}
                        {{--<span>{{ trans('common.wallet_refill') }}</span></div>--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="{{ url(Auth::user()->username.'/wallet/refill') }}" class="btn btn-success btn-downloadreport">--}}
                                {{--{{ trans('common.wallet_refill_button') }}--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="panel-heading no-bg user-pages no-paddingbottom navbars">--}}
                    {{--@if(Auth::user()->id == $timeline->user->id)--}}
                    {{--<div class="page-heading  pull-left">--}}
                        {{--<span>{{ trans('common.wallet_refill_email') }}</span></div>--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="{{ url(Auth::user()->username.'/wallet/mailing') }}" class="btn btn-success btn-downloadreport">--}}
                                {{--{{ trans('common.wallet_refill_email_button') }}--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="panel-heading no-bg user-pages no-paddingbottom navbars">--}}
                    {{--@if(Auth::user()->id == $timeline->user->id)--}}
                    {{--<div class="page-heading  pull-left">--}}
                        {{--<span>{{ trans('common.wallet_withdraw') }}</span></div>--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="{{ url(Auth::user()->username.'/wallet/withdrawal') }}" class="btn btn-success btn-downloadreport">--}}
                                {{--{{ trans('common.wallet_withdraw_button') }}--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="panel-heading no-bg user-pages no-paddingbottom navbars">--}}
                    {{--@if(Auth::user()->id == $timeline->user->id)--}}
                    {{--<div class="page-heading  pull-left">--}}
                        {{--<span>{{ trans('common.wallet_transactions') }}</span></div>--}}
                        {{--<div class="pull-right">--}}
                            {{--<a href="{{ url(Auth::user()->username.'/wallet/transaction') }}" class="btn btn-success btn-downloadreport">--}}
                                {{--{{ trans('common.wallet_transactions_button') }}--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
            {{--</div>            --}}
        {{--</div>--}}
	{{--</div>--}}
{{--</div><!-- /container -->--}}

<!-- /main-section -->