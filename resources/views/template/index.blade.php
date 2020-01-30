<!DOCTYPE html>
<html>
    @section('head')
        @include('template.head')
  	<body>
		@section('sidebar')
		    @include('template.sidebar')
		    <div class="main-content" id="panel">
			@section('header')
			    @include('template.header')
				<div class="container-fluid mt--6">
				@show
					@yield('content')

				@section('footer')
				    @include('template.footer')
				</div>
		</div>
	</body>
	@section('mainjs')
	    @include('template.mainjs')
</html>