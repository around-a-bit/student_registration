<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DCG Registration">
    <title>{{$title}}</title>
    <!-- ----------------------------------------------------------------------------------------------- -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/googleapisFont.css') }}">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/togglePassword.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sweetAlert.js') }}"></script>



<script>
let errorMessage = "{{ request('error') ?? '' }}";
if("{{isset($error)}}"){
    let errorMessage = "{{ isset($error) ? $success : null }}";  
}
let successMessage = "{{ request('success') ?? '' }}";
if("{{isset($success)}}"){
    let successMessage = "{{ isset($success) ? $success : null }}";  
}
let deleteMessage = "{{ request('delete_message') ?? '' }}";
if("{{isset($delete_message)}}"){
    let successMessage = "{{ isset($delete_message) ? $success : null }}";  
}
</script>
</head>