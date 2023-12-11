<html>

<head>
    <title>Ajax Example</title>
    <meta name="_token" content="{{ csrf_token() }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
    <div id = 'msg'>This message will be replaced using Ajax.
        Click the button to replace the message.</div>

    {{ Form::button('Replace Message', ['onClick' => 'getMessage()']) }}

    <script>
        function getMessage() {
            var _token = $('meta[name="_token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: '/getmsg',
                data: {
                    _token: _token
                },
                success: function(data) {
                    $("#msg").html(data.msg);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>

</body>

</html>
