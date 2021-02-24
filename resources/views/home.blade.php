@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('send.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script>


    var firebaseConfig = {
        apiKey: "AIzaSyDS0gPXEGJ3QE_7nsTFgZV3tYzTUJ1SzY4",
        authDomain: "lakum-e233e.firebaseapp.com",
        projectId: "lakum-e233e",
        storageBucket: "lakum-e233e.appspot.com",
        messagingSenderId: "87566572142",
        appId: "1:87566572142:web:83691b1988656f73c5247f"
    };
    // measurementId: G-R1KQTR3JBN
      // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    // function initFirebaseMessagingRegistration() {
    //         messaging
    //         .requestPermission()
    //         .then(function () {
    //             return messaging.getToken()
    //         })
    //         .then(function(token) {
    //             console.log(token);

    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });

    //             $.ajax({
    //                 url: '{{ route("save-token") }}',
    //                 type: 'POST',
    //                 data: {
    //                     token: token
    //                 },
    //                 dataType: 'JSON',
    //                 success: function (response) {
    //                     alert('Token saved successfully.');
    //                 },
    //                 error: function (err) {
    //                     console.log('User Chat Token Error'+ err);
    //                 },
    //             });

    //         }).catch(function (err) {
    //             toastr.error('User Chat Token Error'+ err, null, {timeOut: 3000, positionClass: "toast-bottom-right"});
    //         });
    //  }  
    

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });

</script>
@endsection
