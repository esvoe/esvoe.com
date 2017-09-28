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

				<h3>{{ trans('common.wallet_refill_email') }}</h3><hr>
				<div class="row">
					<div class="col-md-6">
						<fieldset class="form-group">
							{{--{{ Form::label('buy_etoken', trans('admin.custom_option1')) }}--}}
							{{ Form::label('refill_etoken', 'Введите количество токенов') }}
							{{ Form::text('refill_etoken', Setting::get('custom_option1'), array('class' => 'form-control','placeholder' => 'Введите количество')) }}
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							{{--{{ Form::label('buy_etoken', trans('admin.custom_option1')) }}--}}
							{{ Form::label('user_name', 'Введите email для перервода') }}
							{{ Form::text('user_name', Setting::get('custom_option1'), array('class' => 'form-control','placeholder' => 'Введите имя пользевателя')) }}
						</fieldset>
					</div>
				</div>




				<div class="pull-right">
					{{ Form::submit('Переслать', ['class' => 'btn btn-success']) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
</div><!-- /container -->

