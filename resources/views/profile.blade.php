@extends('layouts.master')

@section('content')
<!-- Top Header-Profile -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="top-header">
					<div class="top-header-thumb" style="max-height:calc(100vh - 400px);min-height:240px;overflow:hidden;display: flex;justify-content: center;align-items: center;">
						<img src="{{ $profile->cover_image }}" alt="nature" style="flex-shrink: 0;min-width: 100%;min-height: 100%">
					</div>
					<div class="profile-section">
						<div class="row">
							<div class="col col-lg-5 col-md-5 col-sm-12 col-12">
								<ul class="profile-menu">
									<li>
										<a href="02-ProfilePage.html" class="active">Timeline</a>
									</li>
									<li>
										<a href="05-ProfilePage-About.html">About</a>
									</li>
									<li>
										<a href="06-ProfilePage.html">Friends</a>
									</li>
								</ul>
							</div>
							<div class="col col-lg-5 ml-auto col-md-5 col-sm-12 col-12">
								<ul class="profile-menu">
									<li>
										<a href="07-ProfilePage-Photos.html">Photos</a>
									</li>
									<li>
										<a href="09-ProfilePage-Videos.html">Videos</a>
									</li>
									<li>
										<div class="more">
											<svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg>
											<ul class="more-dropdown more-with-triangle">
												<li>
													<a href="#">Report Profile</a>
												</li>
												<li>
													<a href="#">Block Profile</a>
												</li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</div>

						<div class="control-block-button">
							<a href="35-YourAccount-FriendsRequests.html" class="btn btn-control bg-blue">
								<svg class="olymp-happy-face-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-happy-face-icon') }}"></use></svg>
							</a>

							<a href="#" class="btn btn-control bg-purple">
								<svg class="olymp-chat---messages-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-chat---messages-icon') }}"></use></svg>
							</a>

							<div class="btn btn-control bg-primary more">
								<svg class="olymp-settings-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-settings-icon') }}"></use></svg>

								<ul class="more-dropdown more-with-triangle triangle-bottom-right">
									<li>
										<a href="#" data-toggle="modal" data-target="#update-header-photo">Update Profile Photo</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#update-header-photo">Update Header Photo</a>
									</li>
									<li>
										<a href="29-YourAccount-AccountSettings.html">Account Settings</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="top-header-author">
						<a href="02-ProfilePage.html" class="author-thumb">
							<img src="{{ $profile->avatar }}" alt="author">
						</a>
						<div class="author-content">
							<a href="02-ProfilePage.html" class="h4 author-name">{{ $profile->firstname }} {{ $profile->lastname }}</a>
							<div class="country">{{ $profile->location }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block responsive-flex">
				<div class="ui-block-title">
					<div class="h6 title">{{ $profile->firstname }}’s Friends ({{ 10 }})</div>
					<form class="w-search">
						<div class="form-group with-button">
							<input class="form-control" type="text" placeholder="Search Friends...">
							<button>
								<svg class="olymp-magnifying-glass-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon') }}"></use></svg>
							</button>
						</div>
					</form>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg></a>
				</div>
			</div>
		</div>
	</div>
</div>

@php
	$count = 0;
@endphp

<div class="container">
	@foreach ($friends as $friend)

		@if ($count % 4 == 0)
		<div class="row">
		@endif
			<div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
				<div class="ui-block">
				<!-- Friends -->
					<div class="friend-item">
						<div class="friend-header-thumb">
							<img src="{{ asset($friend['cover_image']) }}" alt="friend">
						</div>

						<div class="friend-item-content">

							<div class="more">
								<svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg>
								<ul class="more-dropdown">
									<li>
										<a href="#">Report Profile</a>
									</li>
									<li>
										<a href="#">Block Profile</a>
									</li>
									<li>
										<a href="#">Turn Off Notifications</a>
									</li>
								</ul>
							</div>
							<div class="friend-avatar">
								<div class="author-thumb">
									<img src="{{ asset($friend['avatar']) }}" alt="author">
								</div>
								<div class="author-content">
									<a href="{{ $friend['profile_link'] }}" class="h5 author-name">{{ $friend['name'] }}</a>
									<div class="country">{{ $friend['location'] }}</div>
								</div>
							</div>

							<div class="swiper-container" data-slide="fade">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="friend-count" data-swiper-parallax="-500">
											<a href="#" class="friend-count-item">
												<div class="h6">{{ $friend['friend_count'] }}</div>
												<div class="title">Friends</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">{{ $friend['photo_count'] }}</div>
												<div class="title">Photos</div>
											</a>
											<a href="#" class="friend-count-item">
												<div class="h6">{{ $friend['video_count'] }}</div>
												<div class="title">Videos</div>
											</a>
										</div>
										<div class="control-block-button" data-swiper-parallax="-100">
											<a href="#" class="btn btn-control bg-blue">
												<svg class="olymp-happy-face-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-happy-face-icon') }}"></use></svg>
											</a>

											<a href="#" class="btn btn-control bg-purple">
												<svg class="olymp-chat---messages-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-chat---messages-icon') }}"></use></svg>
											</a>

										</div>
									</div>

									<div class="swiper-slide">
										<p class="friend-about" data-swiper-parallax="-500">{{ $friend['about'] }}</p>

										<div class="friend-since" data-swiper-parallax="-100">
											<span>Friends Since:</span>
											<div class="h6">{{ $friend['friends_since'] }}</div>
										</div>
									</div>
								</div>

								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
					<!-- ... end Friend Item -->

				</div>
			</div>
		@if ($count % 4 == 3)
		</div>
		@endif
		@php
			$count = $count + 1;
		@endphp
	@endforeach
	@if ($count % 4 != 0)
	</div>
	@endif
</div>

<!-- Window-popup Update Header Photo -->

<div class="modal fade" id="update-header-photo" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">
	<div class="modal-dialog window-popup update-header-photo" role="document">
		<div class="modal-content">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-close-icon') }}"></use></svg>
			</a>

			<div class="modal-header">
				<h6 class="title">Update Header Photo</h6>
			</div>

			<div class="modal-body">
				<a href="#" class="upload-photo-item" onclick="chooseFile();" id="upload_photo_choice">
					<svg class="olymp-computer-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-computer-icon') }}"></use></svg>

					<h6>Upload Photo</h6>
					<span>Browse your computer.</span>
				</a>

				<a href="#" class="upload-photo-item" data-toggle="modal" data-target="#choose-from-my-photo">
					<svg class="olymp-photos-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-photos-icon') }}"></use></svg>

					<h6>Choose from My Photos</h6>
					<span>Choose from your uploaded photos</span>
				</a>
			</div>

			<div class="modal-body" style="height:0px;overflow:hidden;">
				{{Form::open(['route' => 'change.cover_image', 'files' => true])}}

				{{Form::label('user_photo', 'User Photo',['class' => 'control-label'])}}
				{{Form::file('user_photo', ['id' => 'user_photo', 'accept' => '.png,.jpg,.jpeg'])}}
				{{Form::submit('Save', ['class' => 'btn btn-success'])}}

				{{Form::close()}}
			</div>
		</div>
	</div>
</div>


<!-- Window-popup Update Header Photo -->

<div class="modal fade" id="update-header-photo" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">
	<div class="modal-dialog window-popup update-header-photo" role="document">
		<div class="modal-content">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-close-icon') }}"></use></svg>
			</a>

			<div class="modal-header">
				<h6 class="title">Update Header Photo</h6>
			</div>

			<div class="modal-body">
				<a href="#" class="upload-photo-item">
				<svg class="olymp-computer-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-computer-icon') }}"></use></svg>

				<h6>Upload Photo</h6>
				<span>Browse your computer.</span>
			</a>

				<a href="#" class="upload-photo-item" data-toggle="modal" data-target="#choose-from-my-photo">

			<svg class="olymp-photos-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-photos-icon') }}"></use></svg>

			<h6>Choose from My Photos</h6>
			<span>Choose from your uploaded photos</span>
		</a>
			</div>
		</div>
	</div>
</div>

<!-- Window-popup Choose from my Photo -->

<div class="modal fade" id="choose-from-my-photo" tabindex="-1" role="dialog" aria-labelledby="choose-from-my-photo" aria-hidden="true">
	<div class="modal-dialog window-popup choose-from-my-photo" role="document">

		<div class="modal-content">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-close-icon') }}"></use></svg>
			</a>
			<div class="modal-header">
				<h6 class="title">Choose from My Photos</h6>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true">
							<svg class="olymp-photos-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-photos-icon') }}"></use></svg>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">
							<svg class="olymp-albums-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-albums-icon') }}"></use></svg>
						</a>
					</li>
				</ul>
			</div>

			<div class="modal-body">
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">

						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo1.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo2.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo3.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>

						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo4.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo5.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo6.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>

						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo7.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo8.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<div class="radio">
								<label class="custom-radio">
									<img src="{{ asset('img/choose-photo9.jpg') }}" alt="photo">
									<input type="radio" name="optionsRadios">
								</label>
							</div>
						</div>


						<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
						<a href="#" class="btn btn-primary btn-lg btn--half-width">Confirm Photo</a>

					</div>
					<div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">

						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="{{ asset('img/choose-photo10.jpg') }}" alt="photo">
								<figcaption>
									<a href="#">South America Vacations</a>
									<span>Last Added: 2 hours ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="{{ asset('img/choose-photo11.jpg') }}" alt="photo">
								<figcaption>
									<a href="#">Photoshoot Summer 2016</a>
									<span>Last Added: 5 weeks ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="{{ asset('img/choose-photo12.jpg') }}" alt="photo">
								<figcaption>
									<a href="#">Amazing Street Food</a>
									<span>Last Added: 6 mins ago</span>
								</figcaption>
							</figure>
						</div>

						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="{{ asset('img/icon-chat13.png') }}" alt="photo">
								<figcaption>
									<a href="#">Graffity & Street Art</a>
									<span>Last Added: 16 hours ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="{{ asset('img/icon-chat14.png') }}" alt="photo">
								<figcaption>
									<a href="#">Amazing Landscapes</a>
									<span>Last Added: 13 mins ago</span>
								</figcaption>
							</figure>
						</div>
						<div class="choose-photo-item" data-mh="choose-item">
							<figure>
								<img src="{{ asset('img/icon-chat15.png') }}" alt="photo">
								<figcaption>
									<a href="#">The Majestic Canyon</a>
									<span>Last Added: 57 mins ago</span>
								</figcaption>
							</figure>
						</div>


						<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
						<a href="#" class="btn btn-primary btn-lg disabled btn--half-width">Confirm Photo</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- ... end Window-popup Choose from my Photo -->

@endsection

@section('scripts')
<script>

var token = '{{ Session::token() }}';

	$(document).ready(function() {
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

		// == SHOWING PHOTO PICKER ==
		$( "#upload_photo_choice" ).click(function(e) {
				e.preventDefault();
				$("#upload_photo_file").css('display', 'block');
		  });
		});

		function chooseFile() {
	      document.getElementById("user_photo").click();
	   }

</script>
@endsection
