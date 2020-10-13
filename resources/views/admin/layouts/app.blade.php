@include("layouts.common.header")
 @section('topbar')
	@include("admin.layouts.topbar")
@show

@yield('content')

@section('footer')
	@include("layouts.common.footer")
@show
