<select name="state" id="state">
    <option value="">Select State..</option>
    @foreach ($state as $list)
        <option value="{{ $list->state_id }}">{{ $list->state_name }}</option>
    @endforeach
</select>
<select name="city" id="city">
    <option value="">Select City..</option>
</select>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('#state').change(function() {
            let sid = jQuery(this).val();
            jQuery.ajax({
                url: '/city',
                type: 'post',
                data: 'sid=' + sid + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#city').html(result)
                }
            });
        });
    });
</script>
