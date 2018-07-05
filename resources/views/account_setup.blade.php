@php

use \App\User;
use \App\Profile;

@endphp

@extends('layouts.master')

@section('head')
<style>
	.disabled {
	   pointer-events: none;
	   cursor: default;
	}
</style>
@endsection

@section('content')
<!-- Top Header-Profile -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-left: 50px;padding-right: 50px;">

			<div class="ui-block">
				<!-- Login-Registration Form  -->
				<div class="registration-login-form">
					<!-- Nav tabs -->
					<!-- Used to gaurantee correct size of the tab items. -->
					<style>
						.custom {
							width: 33.333333333% !important;
							height: 33.333333333% !important;
						}
					</style>
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item custom">
							<a class="nav-link active" data-toggle="tab" href="#home" role="tab">
								<svg><use xlink:href="octicons/svg/home.svg#default"></use></svg>
							<!-- <img style="fill:#ff5e3a" src="octicons/svg/home.svg"></object> -->
							</a>
						</li>
						<li class="nav-item custom">
							<a class="nav-link" data-toggle="tab" href="#profile" role="tab">
								<svg class="olymp-register-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-register-icon"></use></svg>
							</a>
						</li>
						<li class="nav-item custom">
							<a class="nav-link" data-toggle="tab" href="#interests" role="tab">
								<svg class="olymp-register-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-register-icon"></use></svg>
							</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">

						<!-- LOCATION SETUP -->
						<div class="tab-pane active" id="home" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Where do you live?</div>
							<form class="content">
								<div class="row">
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Enter your address" type="text" onFocus="geolocate()" id="autocomplete"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Address" type="text" readonly="readonly" value="{{ User::where('uuid', \Session::get('uuid'))->first()->street_number }}" id="street_number"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Street" type="text" readonly="readonly" value="{{ User::where('uuid', \Session::get('uuid'))->first()->route }}" id="route"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="City" type="email" readonly="readonly" value="{{ User::where('uuid', \Session::get('uuid'))->first()->city }}" id="locality"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="State" type="text" readonly="readonly" value="{{ User::where('uuid', \Session::get('uuid'))->first()->state }}" id="administrative_area_level_1"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Zip Code" type="text" readonly="readonly" value="{{ User::where('uuid', \Session::get('uuid'))->first()->zip_code }}" id="postal_code"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Country" type="text" readonly="readonly" value="{{ User::where('uuid', \Session::get('uuid'))->first()->country }}" id="country"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<a href="#" id="location-next" class="btn btn-purple btn-lg full-width disabled">Next!</a>
									</div>
								</div>
							</form>
						</div>
						<!-- LOCATION SETUP END -->

						<!-- ABOUT SETUP -->
						<div class="tab-pane" id="profile" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Tell us about yourself...</div>
							<form class="content">

								<div class="row">
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<h5 style="padding-left: 10px;">Name</h5>
									</div>
									<div class="col col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12">
										<div class="form-group label-floating">
											<input class="form-control" id="firstname" placeholder="First Name" value="{{ User::where('uuid', Session::get('uuid'))->first()->firstname }}"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12">
										<div class="form-group label-floating">
											<input class="form-control" id="middlename" placeholder="Middle Name" value="{{ User::where('uuid', Session::get('uuid'))->first()->middlename }}"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-4 col-lg-4 col-md-4 col-sm-12">
										<div class="form-group label-floating">
											<input class="form-control" id="lastname" placeholder="Last Name" value="{{ User::where('uuid', Session::get('uuid'))->first()->lastname }}"></input>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<h5 style="padding-left: 10px;">Contact Information</h5>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group label-floating">
											<input class="form-control" id="email" placeholder="Email" value="{{ User::where('uuid', Session::get('uuid'))->first()->email }}"></input>
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group label-floating">
											<input class="form-control" id="phonenumber" placeholder="Phone Number" value="{{ User::where('uuid', Session::get('uuid'))->first()->phonenumber }}" maxlength="16"></input>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group label-floating">
											<h5 style="padding-left: 10px;">About</h5>
											<textarea class="form-control" maxlength="255" id="about-you" placeholder="About You...">{{ Profile::where('uuid', Session::get('uuid'))->first()->about }}</textarea>
											<p style="text-align: right;"><b id="about-you-length">0/255</b></p>
										</div>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<a href="#" id="about-next" class="btn btn-purple btn-lg full-width">Next!</a>
									</div>
								</div>
							</form>
						</div>
						<!-- ABOUT SETUP END -->

						<!-- <ol>
						@foreach($interests as $block)
							{!! $block !!}
						@endforeach
						</ol> -->

						<!-- INTERESTS SETUP -->
						<div class="tab-pane" id="interests" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Let's find out what you like...</div>
							<form class="content">
								<div class="row">
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

										<div class="ui-block-title">
											<div class="h6 title">Number with Slider</div>
											<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
										</div>

										<div class="ui-block-content">
											<div class="swiper-container" data-slide="fade">
												<div class="swiper-wrapper">
													<div class="swiper-slide">
														<div class="statistics-slide">

														</div>
													</div>
													<div class="swiper-slide">
														<div class="statistics-slide">
															<div class="count-stat" data-swiper-parallax="-500">358</div>
															<div class="title" data-swiper-parallax="-100"><span class="c-primary">Olympus</span> Posts Rank</div>
															<div class="sub-title" data-swiper-parallax="-100">The Olympus Rank measures the quantity of comments, likes and posts.</div>
														</div>
													</div>
													<div class="swiper-slide">
														<div class="statistics-slide">
															<div class="count-stat" data-swiper-parallax="-500">711</div>
															<div class="title" data-swiper-parallax="-100"><span class="c-primary">Olympus</span> Posts Rank</div>
															<div class="sub-title" data-swiper-parallax="-100">The Olympus Rank measures the quantity of comments, likes and posts.</div>
														</div>
													</div>
												</div>

												<!-- If we need pagination -->
												<div class="swiper-pagination pagination-blue"></div>
											</div>
										</div>

										<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
											<a href="#" id="interests-next" class="btn btn-purple btn-lg full-width">Next!</a>
										</div>

									</div>

								</div>
							</form>
						</div>
						<!-- INTERESTS SETUP END -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>

	var placeSearch, autocomplete;
	var componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'long_name',
		postal_code: 'short_name'
	};

	function initAutocomplete() {
		// Create the autocomplete object, restricting the search to geographical
		// location types.
		autocomplete = new google.maps.places.Autocomplete(
				/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
				{types: ['geocode']});

		// When the user selects an address from the dropdown, populate the address
		// fields in the form.
		autocomplete.addListener('place_changed', fillInAddress);
	}

	function fillInAddress() {
		// Get the place details from the autocomplete object.
		var place = autocomplete.getPlace();

		for (var component in componentForm) {
			document.getElementById(component).value = '';
			document.getElementById(component).disabled = false;
		}

		// Get each component of the address from the place details
		// and fill the corresponding field on the form.
		for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
				var val = place.address_components[i][componentForm[addressType]];
				document.getElementById(addressType).value = val;
			}
		}

		updateLocationNextBtn();
	}

	$( "#autocomplete" ).change(function() {
		updateLocationNextBtn();
	});

	// Bias the autocomplete object to the user's geographical location,
	// as supplied by the browser's 'navigator.geolocation' object.
	function geolocate() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var circle = new google.maps.Circle({
					center: geolocation,
					radius: position.coords.accuracy
				});
				autocomplete.setBounds(circle.getBounds());
			});
		}

		updateLocationNextBtn();
	}

	function updateLocationNextBtn()
	{
		if($('#route').val().length === 0)
		{
			$('#location-next').addClass('disabled');
		} else
		{
			$('#location-next').removeClass('disabled');
		}
	}

	$( "#location-next" ).click(function(e) {
		e.preventDefault();
		$.ajax({
			method: 'POST',
			url: '{{ route('account_setup.location') }}',
			data: {
				street_number: $('#street_number').val(),
				route: $('#route').val(),
				city: $('#locality').val(),
				state: $('#administrative_area_level_1').val(),
				country: $('#country').val(),
				zip_code: $('#postal_code').val(),
				_token: token
			 }
		})
		.done(function (msg) {
			if(msg.hasOwnProperty('success')) {
				 swal("Success!", msg['success'], "success");
			} else if(msg.hasOwnProperty('failure')) {
				swal("Uh-Oh!", msg['failure'], "error");
			} else {
				swal("Uh-Oh!", "Something went wrong on our end.", "error");
			}
		});
	});

	$('#about-you').bind('input propertychange', function() {
		var aboutYouLength = $('#about-you').val().length;
    $('#about-you-length').text(aboutYouLength + '/255');
	});

	$("#about-next").click(function(e) {
		e.preventDefault();
		$.ajax({
			method: 'POST',
			url: '{{ route('account_setup.information') }}',
			data: {
				firstname: $('#firstname').val(),
				middlename: $('#middlename').val(),
				lastname: $('#lastname').val(),
				email: $('#email').val(),
				phonenumber: $('#phonenumber').val(),
				about: $('#about-you').val(),
				_token: token
			 }
		})
		.done(function (msg) {
			if(msg.hasOwnProperty('success')) {
				 swal("Success!", msg['success'], "success");
			} else if(msg.hasOwnProperty('failure')) {
				swal("Uh-Oh!", msg['failure'], "error");
			} else {
				swal("Uh-Oh!", "Something went wrong on our end.", "error");
			}
		});
	});

	const isNumericInput = (event) => {
    const key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
    	(key >= 96 && key <= 105) // Allow number pad
    );
	};

	const isModifierKey = (event) => {
    const key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
    	(key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
    	(key > 36 && key < 41) || // Allow left, up, right, down
    	(
      	// Allow Ctrl/Command + A,C,V,X,Z
        (event.ctrlKey === true || event.metaKey === true) &&
    		(key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
      )
	};

	const enforceFormat = (event) => {
		// alert('A');
    // Input must be of a valid number format or a modifier key, and not longer than ten digits
    if(!isNumericInput(event) && !isModifierKey(event)){
      event.preventDefault();
    }
	};

	const formatToPhone = (event) => {
    if(isModifierKey(event)) {return;}

    // I am lazy and don't like to type things more than once
    const target = event.target;
    const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
    const zip = input.substring(0,3);
    const middle = input.substring(3,6);
    const last = input.substring(6,10);

    if(input.length > 6){target.value = `(${zip}) ${middle} - ${last}`;}
    else if(input.length > 3){target.value = `(${zip}) ${middle}`;}
    else if(input.length > 0){target.value = `(${zip}`;}
	};

// const inputElement = document.getElementById('phoneNumber');
$('#phonenumber').on('keydown', enforceFormat);
$('#phonenumber').on('keyup', formatToPhone);

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUI1i_osQOGSch2wy1xYI0Fya8b01ZGp4&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
