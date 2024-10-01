<!DOCTYPE html>

@extends('layouts.app')
<body>
  
    <!-- Include Navbar -->
    @include('template/navbar')

    <div class="content">
        @yield('content')
        <img class="w-100" src="{{asset('img/carousel-1.jpg')}}" alt="Image">
    </div>
<!-- Include Navbar -->
@include('template/footer')

</body>
</html>
