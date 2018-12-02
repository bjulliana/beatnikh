@extends('layouts.app')
@section('content')

	<div class="container py-2 py-md-4">
		<div class="row">
			<div class="col-12">
				<div class="alert">
					@include('alerts')
					<h1 class="h2 text-center">My Account</h1>
				</div>
			</div>
		</div>
		<div class="row border justify-content-center align-content-center py-4 mx-1 mx-md-0">
			<div class="col-6 col-md-4 col-lg-3 text-center mb-3 mb-md-0">
				<div class="profile-header-img">
					<img class="rounded" src="/uploads/users/{{ $user->photo }}" />
				</div>
			</div>
			<div class="col-10 text-center text-md-left col-md-7 col-lg-6 offset-md-1 offset-lg-2 align-self-center">
				<div class="row py-2">
					<div class="col-md-4"><strong>{{ __('Name') }}</strong></div>
					<div class="col-md-6">{{ $user->name }}</div>
				</div>
				<div class="row py-2">
					<div class="col-md-4"><strong>{{ __('Username') }}</strong></div>
					<div class="col-md-6">{{ $user->username }}</div>
				</div>
				<div class="row py-2">
					<div class="col-md-4"><strong>{{ __('E-Mail Address') }}</strong></div>
					<div class="col-md-6">{{ $user->email }}</div>
				</div>
				<div class="row py-2">
					<div class="col-md-4"><strong>{{ __('Photo') }}</strong></div>
					<div class="col-md-6">{{ $user->photo }}</div>
				</div>
				<div class="row my-3">
					<div class="col-md-6 offset-md-4">
						<a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">
							{{ __('Edit Profile') }}
						</a>
					</div>
				</div>
			</div>
		</div>
		{{--<div class="row justify-content-center">--}}
			{{--<div class="col-8 col-sm-5 col-lg-3 profile-header-container">--}}
				{{--<div class="profile-header-img">--}}
					{{--<img class="rounded-circle" src="/uploads/users/{{ $user->photo }}" />--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}
		<div class="row justify-content-center text-center text-sm-left">
			<div class="col-12 col-sm-5 card-body">
				{{--<div class="row py-2">--}}
					{{--<div class="col-md-4 text-md-right"><strong>{{ __('Name') }}</strong></div>--}}
					{{--<div class="col-md-6">{{ $user->name }}</div>--}}
				{{--</div>--}}
				{{--<div class="row py-2">--}}
					{{--<div class="col-md-4 text-md-right"><strong>{{ __('Username') }}</strong></div>--}}
					{{--<div class="col-md-6">{{ $user->username }}</div>--}}
				{{--</div>--}}
				{{--<div class="row py-2">--}}
					{{--<div class="col-md-4 text-md-right"><strong>{{ __('E-Mail Address') }}</strong></div>--}}
					{{--<div class="col-md-6">{{ $user->email }}</div>--}}
				{{--</div>--}}
				{{--<div class="row py-2">--}}
					{{--<div class="col-md-4 text-md-right"><strong>{{ __('Photo') }}</strong></div>--}}
					{{--<div class="col-md-6">{{ $user->photo }}</div>--}}
				{{--</div>--}}

			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-6 text-center text-sm-left mb-4">
				<h2 id="products">My Products</h2>
			</div>
			<div class="col-12 col-sm-6 text-center text-sm-right mb-4">
				<a class="btn btn-primary" href="{{ route('products.new') }}">New Ad</a>
			</div>
		</div>
		@if ($products->count() > 1)
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Image</th>
						<th scope="col">Name</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($products as $product)
						<tr>
							<th>{{ $loop->iteration }}</th>
							<td><img class="product-thumb" src="/uploads/products/{{ $product->images->first()->file_name }}"></td>
							<td><a href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a></td>
							<td>
								<a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary mr-3">Edit</a><a href="{{ route('products.drop', $product->id) }}" class="btn btn-danger" onclick='return confirm("Are you sure?")'>Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>You don't have any products yet. Start Selling now!</p>
			<p><a class="btn btn-primary" href="{{ route('products.new') }}">Add your first product</a></p>
		@endif
	</div>
@endsection