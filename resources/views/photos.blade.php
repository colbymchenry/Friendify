@extends('layouts.master')

@section('content')

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="top-header">
					<div class="top-header-thumb" style="max-height:calc(100vh - 300px);min-height:240px;overflow:hidden;display: flex;justify-content: center;align-items: center;">
						@if($profile->cover_image !== '')
							<img src="{{ $profile->cover_image }}" alt="nature" style="flex-shrink: 0;min-width: 100%;min-height: 100%">
						@else
							<img src="https://i.imgur.com/A6J7EpN.png" alt="nature" style="flex-shrink: 0;min-width: 100%;min-height: 100%">
						@endif
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
										<a href="{!! route('photos_view', ['uuid'=>$profile->uuid]) !!}">Photos</a>
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

								<a class="btn btn-control bg-yellow hidden" id="pending_button">
									<svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg>
								</a>
								<a class="btn btn-control bg-green hidden" id="friend_button">
									<svg class="olymp-happy-face-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-happy-face-icon') }}"></use></svg>
								</a>
								<a class="btn btn-control bg-blue hidden" id="request_button">
									<svg class="olymp-plus-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-plus-icon') }}"></use></svg>
								</a>

								<a class="btn btn-control bg-purple hidden" id="messages_button">
									<svg class="olymp-chat---messages-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-chat---messages-icon') }}"></use></svg>
								</a>
								<div class="btn btn-control bg-primary more hidden" id="options_button">
									<svg class="olymp-settings-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-settings-icon') }}"></use></svg>

									<ul class="more-dropdown more-with-triangle triangle-bottom-right">
										<li>
											<a href="#" data-toggle="modal" data-target="#update-avatar-photo">Update Profile Photo</a>
										</li>
										<li>
											<a href="#" data-toggle="modal" data-target="#update-header-photo">Update Header Photo</a>
										</li>
										<li>
											<a href="{{ route('account_setup') }}">Account Settings</a>
										</li>
									</ul>
								</div>
						</div>
					</div>
					<div class="top-header-author">
							<div class="top-header-thumb author-thumb" style="min-height:100px;overflow:hidden;display: flex;justify-content: center;align-items: center;">
								@if($profile->avatar !== '')
									<img src="{{ $profile->avatar }}" alt="nature" style="flex-shrink: 0;min-width: 100%;min-height: 100%;">
								@else
									<img src="https://i.imgur.com/3gokj8j.png" alt="nature" style="flex-shrink: 0;min-width: 100%;min-height: 100%;">
								@endif
							</div>
						<div class="author-content">
							<a href="02-ProfilePage.html" class="h4 author-name">{{ $profile->firstname }} {{ $profile->lastname }}</a>
							<div class="country">{{ $profile->city . ($profile->city !== '' && $profile->state !== '' ? ', ' : '' ) . $profile->state }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- TOP CONTROLS -->
<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block responsive-flex">
				<div class="ui-block-title">
					<div class="h6 title">{{ $profile->firstname }}’s Photo Gallery</div>

					<div class="block-btn align-right">
						<a href="#" data-toggle="modal" data-target="#create-photo-album" class="btn btn-primary btn-md-2">Create Album  +</a>

						<a href="#" onclick="photoSubmit();" data-toggle="modal" data-target="#update-header-photo" class="btn btn-md-2 btn-border-think custom-color c-grey">Add Photos</a>
					</div>

					<ul class="nav nav-tabs photo-gallery" role="tablist">
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#photo-page" role="tab">
								<svg class="olymp-photos-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-photos-icon') }}"></use></svg>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#album-page" role="tab">
								<svg class="olymp-albums-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-albums-icon') }}"></use></svg>
							</a>
						</li>

					</ul>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [END] TOP CONTROLS -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<!-- Tab panes -->
			<div class="tab-content">

				<div class="tab-pane active" id="album-page" role="tabpanel">

					<div class="photo-album-wrapper">

            <!-- CREATE AN ALBUM BUTTON -->
						<div class="photo-album-item-wrap col-4-width" >
							<div class="photo-album-item create-album" style="height: 36em;" data-mh="album-item">
								<a href="#" data-toggle="modal" class="full-block"></a>
								<div class="content">
									<a id="create-photo-album" href="#" class="btn btn-control bg-primary" data-toggle="modal">
										<svg class="olymp-plus-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-plus-icon') }}"></use></svg>
									</a>
									<a href="#" class="title h5" data-toggle="modal">Create an Album</a>
									<span class="sub-title">It only takes a few minutes!</span>
								</div>
							</div>
			      </div>
            <!-- [END] CREATE AN ALBUM BUTTON -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-body" style="height:0px;overflow:hidden;">
	{{Form::open(['route' => 'photos.upload', 'files' => true, 'id' => 'photo_form'])}}

	{{Form::label('photo', 'User Photo',['class' => 'control-label'])}}
	{{Form::file('user_photo', ['id' => 'photo_input', 'accept' => '.png,.jpg,.jpeg'])}}
	{{Form::submit('Save', ['class' => 'btn btn-success'])}}

	{{Form::close()}}
</div>

@endsection


@section('scripts')

<script>

function photoSubmit() {
		document.getElementById("photo_input").click();
 }

 document.getElementById("photo_form").onchange = function() {
	document.getElementById("photo_form").submit();
};


	$( "#create-photo-album" ).click(function(e) {
		e.preventDefault();
		swal({
			title: "What's the name of the album?",
		  type: "input",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  animation: "slide-from-top",
		  inputPlaceholder: "Write something..."
		}, function(inputValue) {
			if (inputValue === false) return false;

	   	if (inputValue === "") {
		     swal.showInputError("You need to write something!");
		     return false;
	   	}

			$.ajax({
				method: 'POST',
				url: '{{ route('photos.create_album') }}',
				data: {
					name: inputValue,
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
	});
</script>

@endsection
