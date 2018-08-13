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

						<a href="#" id="add_photo" data-toggle="modal" data-target="#update-header-photo" class="btn btn-md-2 btn-border-think custom-color c-grey">Add Photos</a>
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

					@if($current_album === '')

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

						@foreach($albums as $album)
						<div class="photo-album-item-wrap col-4-width">
							<div class="photo-album-item" data-mh="album-item">
								<div class="photo-item">
									<img src="{{ asset('img/photo-item2.jpg') }}" alt="photo">
									<div class="overlay overlay-dark"></div>
									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg></a>
									<a href="#" class="post-add-icon">
										<svg class="olymp-heart-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-heart-icon') }}"></use></svg>
										<span>324</span>
									</a>
									<a href="#" data-toggle="modal" data-target="#open-photo-popup-v2" class="  full-block"></a>
								</div>

								<div class="content">
									<a href="#" class="title h5">{{ $album->name }}</a>
									<span class="sub-title">Last Added: 2 hours ago</span>

									<div class="swiper-container">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<div class="friend-count" data-swiper-parallax="-500">
													<a href="#" class="friend-count-item">
														<div class="h6">{{ substr_count($album->photos, ',') }}</div>
														<div class="title">Photos</div>
													</a>
													<a href="#" class="friend-count-item">
														<div class="h6">86</div>
														<div class="title">Comments</div>
													</a>
												</div>
											</div>
										</div>

										<!-- If we need pagination -->
										<div class="swiper-pagination"></div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>

					@else

					<div class="photo-album-wrapper">
						@foreach(str_split($album->photos, ',') as $photo)
						<div class="photo-album-item-wrap col-4-width">
							<div class="photo-album-item" data-mh="album-item">
								<div class="photo-item">
									<img src="{{ asset('img/photo-item2.jpg') }}" alt="photo">
									<div class="overlay overlay-dark"></div>
									<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg></a>
									<a href="#" class="post-add-icon">
										<svg class="olymp-heart-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-heart-icon') }}"></use></svg>
										<span>324</span>
									</a>
									<a href="#" data-toggle="modal" data-target="#open-photo-popup-v2" class="  full-block"></a>
								</div>

								<div class="content">
									<a href="#" class="title h5">{{ $album->name }}</a>
									<span class="sub-title">Last Added: 2 hours ago</span>

									<div class="swiper-container">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<div class="friend-count" data-swiper-parallax="-500">
													<a href="#" class="friend-count-item">
														<div class="h6">{{ substr_count($album->photos, ',') }}</div>
														<div class="title">Photos</div>
													</a>
													<a href="#" class="friend-count-item">
														<div class="h6">86</div>
														<div class="title">Comments</div>
													</a>
												</div>
											</div>
										</div>

										<!-- If we need pagination -->
										<div class="swiper-pagination"></div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>

					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-body" style="height:0px;overflow:hidden;">
	{{Form::open(['route' => 'photos.upload', 'files' => true, 'id' => 'photo_form'])}}

	{{Form::label('photo', 'User Photo',['class' => 'control-label'])}}
	{{Form::text('album', 'User Album', ['id' => 'album_input'])}}
	{{Form::text('description', 'User Description', ['id' => 'description_input'])}}
	{{Form::file('user_photo', ['id' => 'photo_input', 'accept' => '.png,.jpg,.jpeg'])}}
	{{Form::submit('Save', ['class' => 'btn btn-success'])}}

	{{Form::close()}}
</div>

@endsection


@section('scripts')

<script>

function doSomething() {
	document.getElementById("photo_input").click();
}

$( "#add_photo" ).click(function(e) {
	e.preventDefault();
	photoSubmit({!! $albums !!});
});

async function photoSubmit(albums) {
		var options = {};

		for(var a in albums) {
			options[albums[a]['id']] = albums[a]['name'];
		}

		var description = '';

		// TODO: Can't get image to center, need to add album to form that way we know what album we are using in controller
		const {value: album} = await swal({
		  title: 'Upload a new photo!',
		  input: 'select',
		  inputOptions: options,
		  inputPlaceholder: 'Select album',
			html: '\
			<div class="container">\
				<div class="row" style="padding-bottom: 0.5em;">\
					<div class="span6" style="float: none; margin: 0 auto;"> \
						<a onmouseover="" style="cursor: pointer;" onclick="doSomething();">\
							<img id="selectedImage" style="max-height:30em;" src="{{ asset('img/icons8-image-file-128.png') }}"></img>\
						</a>\
					</div>\
				</div> \
				<div class="row">\
					<textarea class="form-control" maxlength="255" id="selectedItem.description" placeholder="Description"></textarea>\
				</div> \
			</div>',
		  showCancelButton: true,
		  inputValidator: (value) => {

				description = document.getElementById('selectedItem.description').value;

		    return new Promise((resolve) => {
		      if (value === '') {
		        resolve('You need to select an album.');
					} else if($('#photo_input').val() == '') {
						resolve('You need to select a photo.')
		      } else {
		        resolve();
		      }
		    })
		  }
		});


		if(album !== undefined) {
			$('#album_input').val(album);
			$('#description_input').val(description);
			document.getElementById("photo_form").submit();
		}

		$('#album_input').val('');
		$('#description_input').val('');
		$('#photo_input').val('');
		$('#selectedImage').attr('src', "{{ asset('img/icons8-image-file-128.png') }}");
 }

document.getElementById("photo_form").onchange = function() {
	var selectedFile = document.getElementById('photo_input').files[0];
	var reader = new FileReader();

	reader.onload = function (e) {
    $('#selectedImage').attr('src', e.target.result);
  }

	reader.readAsDataURL(selectedFile);
}


	$( "#create-photo-album" ).click(function(e) {
		e.preventDefault();


		swal({
		  title: 'Create New Album',
		  input: 'text',
		  inputAttributes: {
		    autocapitalize: 'on'
		  },
		  showCancelButton: true,
		  confirmButtonText: 'Create!',
		  showLoaderOnConfirm: true
		}).then((result) => {
		  if (result.value) {
				$.ajax({
					method: 'POST',
					url: '{{ route('photos.create_album') }}',
					data: {
						name: result.value,
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
		  }
		});
	});
</script>

@endsection
