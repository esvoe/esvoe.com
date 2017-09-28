<form name="paySystemForm" method="post" action="{{ $url }}">
    @foreach($params as $key => $value)
        <input name="{{ $key }}" type="hidden" value="{{ $value }}">
    @endforeach
</form>
<script>
    document.forms["paySystemForm"].submit();
</script>