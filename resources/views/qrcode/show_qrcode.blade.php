<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js'])

</head>

<body class="font-sans antialiased">

    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <span
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Verify Code') }}</span>
        </label>
        <br><br>
        <p class="font-semibold text-x2 text-gray-800 dark:text-gray-200 leading-tight">You need to scan this code with
            your authentication app</p>
        <br>
    </div>

    <script>
        var channel = Echo.private('qr-scanned')
            .listen('scan', function(data) {
                console.log("PUTAAAAAAAAAAAAAAA", data)
                alert(JSON.stringify(data));
            });

        // // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        // var pusher = new Pusher('50febbf270e0acf49e54', {
        //   cluster: 'us3'
        // });

        // var channel = pusher.subscribe('qr-scanned');
        // // pusher.user.bind('qr-scanned', function(data){
        // // })

        // channel.bind('qr-scanned', function(data) {
        //     console.log("PUTAAAAAAAAAAAAAAA", data)
        //   alert(JSON.stringify(data.channel));
        // });
    </script>

    <div class="block mt-5" style="display: flex; justify-content: center;">
        <label for="remember_me" class="inline-flex items-center">
            <span class="font-semibold  text-gray-800 dark:text-gray-200 leading-tight"
                style="font-size: 50px;">{{ $qr_code }}</span>
        </label>
    </div>
    <br>
    <a href="{{ $url }}">{{ $url }}</a>
    <br>
</body>

</html>
