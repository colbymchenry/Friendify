@extends('layouts.master')

@section('content')
<!-- Top Header-Profile -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">

			</div>
		</div>
	</div>
</div>

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

	   
		});

</script>
@endsection
