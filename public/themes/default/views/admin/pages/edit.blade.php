<div class="panel panel-default">
	<div class="panel-body">
	@include('flash::message')
		<div class="panel-heading no-bg panel-settings">
			<h3 class="panel-title">
				{{ trans('admin.edit_page') }} ({{ $timeline->name }})
			</h3>
		</div>
		<form class="socialite-form"  method="POST" action="{{ url('admin/pages/'.$username.'/edit') }}">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-6">
					<fieldset class="form-group">
						<label for="verified">{{ trans('admin.verified') }}</label>	
						{{ Form::select('verified', array('1' => 'Yes','0' => 'No'),$page->verified, ['class' => 'form-control', 'placeholder' => trans('admin.please_select') ]) }}
						<small class="text-muted">{{ trans('admin.verified_page_text') }}</small>				
					</fieldset>
				</div>

				<div class="col-md-6">	
					<fieldset class="form-group">
						<label for="active">{{ trans('admin.active') }}</label>	
						{{ Form::select('active', array('1' => 'Yes','0' => 'No'),$page->active, ['class' => 'form-control', 'placeholder' => trans('admin.please_select') ]) }}
						<small class="text-muted">{{ trans('messages.page_active') }}</small>				
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">{{ trans('auth.name') }}</label>
						<input type="text" class="form-control" name="name" value="{{ $timeline->name }}" placeholder="{{ trans('auth.name') }}">
						<small class="text-muted">{{ trans('admin.page_name_placeholder') }}</small>
						@if ($errors->has('name'))
						<span class="help-block">
							{{ $errors->first('name') }}
						</span>
						@endif
					</fieldset>
				</div>

				<div class="col-md-6">	
					<fieldset class="form-group">
						<label for="username">{{ trans('common.username') }}</label>
						<input type="text" name="username" class="form-control content-form" value="{{ $timeline->username }}" placeholder="{{ trans('common.username') }}" readonly>
						<small class="text-muted">{{ trans('admin.page_username_text') }}</small>
					</fieldset>	
				</div>
			</div>
			
			<fieldset class="form-group required {{ $errors->has('category_id') ? ' has-error' : '' }}">
				<label for="category_id">{{ trans('common.category') }}</label>
				{{ Form::select('category_id', array('' => trans('admin.please_select'))+ $category_options, $page->category_id , array('class' => 'form-control')) }}
				<small class="text-muted">{{ trans('admin.page_category_text') }}</small>
				@if ($errors->has('category_id'))
				<span class="help-block">
					{{ $errors->first('category_id') }}
				</span>
				@endif
			</fieldset>
				
			
			<fieldset class="form-group">
				<label for="about">{{ trans('common.about') }}</label>				
				{{ Form::textarea('about', $timeline->about, ['class' => 'form-control', 'placeholder' => trans('messages.create_page_placeholder')])}}
				<small class="text-muted">{{ trans('admin.page_about_text') }}</small>
			</fieldset>

			<fieldset class="form-group">
				<label for="thisissometext">{{ trans('common.address') }}</label>
				<input type="text" class="form-control" name="address" value="{{ $page->address }}" placeholder="{{ trans('common.address') }}">
				<small class="text-muted">{{ trans('admin.page_address_text') }}</small>
			</fieldset>

			<div class="row">			
				<div class="col-md-6">	
					<fieldset class="form-group">
						<label for="thisissometext">{{ trans('common.phone') }}</label>
						<input type="text" name="phone" class="form-control content-form" value="{{ $page->phone }}" placeholder="{{ trans('common.phone') }}">
						<small class="text-muted">{{ trans('admin.page_phone_text') }}</small>
					</fieldset>		
				</div>
				<div class="col-md-6">
					<fieldset class="form-group">
						<label for="thisissometext">{{ trans('common.website') }}</label>
						<input type="text" name="website" class="form-control content-form" value="{{ $page->website }}" placeholder="{{ trans('common.website') }}">
						<small class="text-muted">{{ trans('admin.page_website_text') }}</small>
					</fieldset>
				</div>
			</div>
			

			<h3>
				{{ trans('common.privacy_settings') }}
			</h3>
			<hr>
			<div class="row">
				<div class="col-md-6">	
					<fieldset class="form-group">
						<label for="thisissometext">{{ trans('admin.timeline_post_privacy') }}</label>
						{{ Form::select('timeline_post_privacy', array('everyone' => trans('common.everyone'), 'only_admins' => trans('admin.only_admins'), 'none' => trans('common.no_one')), $page->timeline_post_privacy, ['class' => 'form-control'])}}	
						<small class="text-muted">{{ trans('admin.timeline_post_privacy_page_text') }}</small>				
					</fieldset>
				</div>

				<div class="col-md-6">
					<fieldset class="form-group">
						<label for="thisissometext">{{ trans('admin.add_privacy') }}</label>
						{{ Form::select('member_privacy', array('members' => 'Members','only_admins' => 'Only admins') , $page->member_privacy , ['class' => 'form-control']) }}
						<small class="text-muted">{{ trans('admin.add_privacy_text') }}</small>				
					</fieldset>
				</div>
			</div>

			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-sm">{{ trans('common.save_changes') }}</button>
			</div>
		</form>
	</div>
</div>
