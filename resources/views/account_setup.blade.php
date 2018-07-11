@php

use \App\User;
use \App\Profile;
use \App\Friends;

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

						<!-- INTERESTS SETUP -->
						<div class="tab-pane" id="interests" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Tell us about yourself...</div>
							<form class="content">
								<div class="row">
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<ul id="interest_list">

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
<script src="{{ asset('js/interests.js') }}"></script>

<script>

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

var interestsJSON = JSON.parse('{!! json_encode($json) !!}');
var interestObjects = jsonToArray(interestsJSON);
var user_interests = {!! json_encode($user_interests->toArray()) !!};
setupInterestsHTML();

function setInterest(event) {
  var id = parseInt(event.target.name);
	var value = (event.target.value == 'on' ? 1 : 0);
	$.ajax({
		method: 'POST',
		url: '{{ route('account_setup.interest') }}',
		data: {
			id: id,
			value: parseInt(value),
			_token: '{{ Session::token() }}'
		 }
	})
	.done(function (msg) {
		if(msg.hasOwnProperty('success')) {
		} else if(msg.hasOwnProperty('failure')) {
			swal("Uh-Oh!", msg['failure'], "error");
		} else {
			swal("Uh-Oh!", "Something went wrong on our end.", "error");
		}
	});
}

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
