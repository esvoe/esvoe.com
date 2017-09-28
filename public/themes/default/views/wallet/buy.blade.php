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
		</div><!-- /col-md-10 -->
		<form method="POST" action="{{ url('admin') }}">

			{{ csrf_field() }}
			<div class="privacy-question">

				<h3>{{ trans('common.buy_etoken') }}</h3><hr>

				<div class="row">
					<div class="col-md-6">
						<h4>{{ trans('common.method_of_replenishment') }}</h4>
						<fieldset class="form-group">
							{{ Form::radio('method', 'Visa') }}
							{{ Form::label('Visa') }}
							{{ Form::radio('method', 'MasterCard') }}
							{{ Form::label('MasterCard') }}
							{{ Form::radio('method', 'PayPal') }}
							{{ Form::label('PayPal') }}
							{{ Form::radio('method', 'WebMoney') }}
							{{ Form::label('WebMoney') }}
							{{ Form::radio('method', 'InternetCash') }}
							{{ Form::label('InternetCash') }}
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							{{--{{ Form::label('buy_etoken', trans('admin.custom_option1')) }}--}}
							{{ Form::label('buy_etoken', 'Купить токены') }}
							{{ Form::text('buy_etoken', Setting::get('custom_option1'), array('class' => 'form-control','placeholder' => 'Введите количество')) }}
						</fieldset>
					</div>
				</div>


				<div class="pull-right">
					{{ Form::submit('Купить', ['class' => 'btn btn-success']) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
</div><!-- /container -->

