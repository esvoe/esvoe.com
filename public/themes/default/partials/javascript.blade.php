<script>
    @php
        $settings = Auth::user()->getLeftSidebarSettings()
    @endphp

    @if($settings != null)
        @foreach($settings as $setting)
            if ($('.wrap-sett-menu input[data-sett-side="{{ $setting }}"]'))
                $('.wrap-sett-menu input[data-sett-side="{{ $setting }}"]').prop('checked', true);
        @endforeach
        $('.sidebar > ul > li').show();
        $('.wrap-sett-menu input:not(:checked)').each(function(){
            var valueSett = $(this).data('sett-side');
            $('.sidebar > ul > li[data-li-setting="'+ valueSett +'"]').hide();
        });
    @endif
</script>