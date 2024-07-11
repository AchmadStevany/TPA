<!doctype html>
<html lang="en">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
</head>

@section('body')

    <body class="authentication-bg">
    @show
    @yield('content')
    @include('layouts.vendor-scripts')
</body>

</html>
