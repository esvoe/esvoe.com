@if(Setting::get('timeline_right_ad') != NULL)
	{!! htmlspecialchars_decode(Setting::get('timeline_right_ad')) !!}
@endif
@if(Config::get('app.env') == 'demo' || Config::get('app.env') == 'local')
	<img src="http://placehold.it/165x200?text=Ad+Block"><br><br>
	<img src="http://placehold.it/165x200?text=Ad+Block">
@endif