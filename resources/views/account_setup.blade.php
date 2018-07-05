@php

use \App\Profile;

@endphp

@extends('layouts.master')

@section('head')
<style>
	.disabled {
	   pointer-events: none;
	   cursor: default;
	}

	.hidden {
	  display: none;
	  visibility: hidden;
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
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home" role="tab">
								<svg><use xlink:href="octicons/svg/home.svg#default"></use></svg>
							<!-- <img style="fill:#ff5e3a" src="octicons/svg/home.svg"></object> -->
							</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#profile" role="tab">
								<svg class="olymp-register-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-register-icon"></use></svg>
							</a>
						</li> -->
						<li class="nav-item">
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
											<input class="form-control" placeholder="Enter your address" type="text" onFocus="geolocate()" id="autocomplete">
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Street" type="text" readonly="readonly" id="street_number">
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Address" type="text" readonly="readonly" id="route">
										</div>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="City" type="email" readonly="readonly" id="locality">
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="State" type="text" readonly="readonly" id="administrative_area_level_1">
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Zip Code" type="text" readonly="readonly" id="postal_code">
										</div>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group is-empty">
											<input class="form-control" placeholder="Country" type="text" readonly="readonly" id="country">
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



						<!-- INTERESTS SETUP -->
						<div class="tab-pane" id="interests" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Tell us about yourself...</div>
							<form class="content">
								<div class="row">
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<ul id="interest_list">
										@foreach($interests as $block)
											{!! $block !!}
										@endforeach
										</ul>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<a href="#" id="about-next" class="btn btn-purple btn-lg full-width">Next!</a>
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
					url: '{{ route('account_setup.about') }}',
					data: {
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

			$('ul[id^="ulInterest"]').click(function(e) {
				if(e.target.tagName === 'INPUT') {
					var inputId = e.target.id;
					var level = e.target.name;

					$('#interest_list').find('ul').filter(function() {
							return $(this).find('input')[0].name == level && $(this).attr('id') != inputId.replace('input', 'ulInterest');
					}).map(function(i, e) {
							if($(this).attr('name') !== 'bottom') {
								$(this).addClass("hidden");
							}
					});

					$(this).find('ul').filter(function() {
							return $(this).find('input')[0].name == (parseInt(level) + 1);
					}).map(function(i, e) {
							$(this).removeClass("hidden");
					});
				}
			});

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUI1i_osQOGSch2wy1xYI0Fya8b01ZGp4&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
