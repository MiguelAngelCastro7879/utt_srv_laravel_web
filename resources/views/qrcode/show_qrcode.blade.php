<x-guest-layout>
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
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('50febbf270e0acf49e54', {
            cluster: 'us3'
        });
        var channel = pusher.subscribe('qr-scanned');
        channel.bind('scan', function(data) {
            if(data.user.email == {!! json_encode($user) !!}){
                alert(JSON.stringify(data.user.email));
                window.location.href = "{{ route('qr_verified')}}";
            }
        });
    </script>
    <div class="block mt-5" style="display: flex; justify-content: center;">
        <label for="remember_me" class="inline-flex items-center">
            <span class="font-semibold  text-gray-800 dark:text-gray-200 leading-tight"
                style="font-size: 50px;">{{ $qr_code }}</span>
        </label>
    </div>
    <br>
    <br>
</x-guest-layout>
