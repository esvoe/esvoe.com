<div class="container">
	<div class="row">
		<div class="visible-lg col-lg-2">
			<br>
			{!! Theme::partial('home-leftbar',compact('trending_tags')) !!}
		</div>
        <div class="col-md-10">
			<div class="panel panel-default">
                <div class="panel-heading no-bg user-pages no-paddingbottom navbars">
                    <div class="page-heading pull-left">{{ trans('common.wallet_bilance') }}</div>
                    <div class="page-heading pull-right">{{ trans('common.wallet') }}<span>{{ $balance->token }} єТ</span></div>
                    <div class="clearfix"></div>
                </div>
            </div>
            @if ($query->count() > 0)
                    <div class="block">
                        <div class="block-title">
                            <h2>{{ trans('common.wallet_transactions_button') }}</h2>
                        </div>
                        <div class="table-responsive">
                            {{ Form::open() }}
                                {{ Form::token() }}
                                @include('wallet.parts_transaction',compact('timeline', 'trending_tags', 'transactionQuery', 'balance', 'query'))
                            {{ Form::close() }}    
                        </div>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        {{ trans('common.not_transactions') }}
                    </div>
                @endif
        </div>
    </div>
</div><!-- /container -->
