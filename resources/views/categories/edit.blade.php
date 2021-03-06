@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="alert mt-4">
			@include('alerts')
		</div>
		<div class="row justify-content-center">
			<div class="col-6 col-md-3">
				<div class="category-img">
					<img src="/uploads/categories/{{ $category->image }}" />
				</div>
			</div>
		</div>
		<div class="row justify-content-center py-5">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Edit Category') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
							@csrf

							<div class="form-group row">
								<label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

								<div class="col-md-6">
									<input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $category->title }}" required autofocus>

									@if ($errors->has('title'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('title') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Category Image') }}</label>

								<div class="col-md-6">
									<input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" value="{{ $category->image }}" autofocus>

									@if ($errors->has('image'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('image') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row mb-0 justify-content-center">
								<div class="col-md-3">
									<button type="submit" class="btn btn-primary btn-block">
										{{ __('Update') }}
									</button>
								</div>
								<div class="col-md-3">
									<a href="{{ route('categories.show') }}" class="btn btn-danger btn-block">
										{{ __('Cancel') }}
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
