<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- icon cdn  -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
	<!-- css  -->
	<link rel="stylesheet" href="{{asset('member/css/common.css')}}">
	<link rel="stylesheet" href="{{asset('member/css/crowdafrik.css')}}">
	<!-- bootstrap  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
	<script type="text/javascript" src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <title>@yield('title')</title>
</head>
<body>



	@yield('content')


<script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- swipper slider js end  -->
</body>
</body>
</html>
<script type="text/javascript">
	$('#ab2').hide();

	 
	$(document).ready(function() {
  // Handle tab switching on click
  $('.tab-switch').on('click', function() {
    // Remove active class from all tab switches
    $('.tab-switch').removeClass('active');

    // Add active class to the clicked tab switch
    $(this).addClass('active');
  });
});

</script>