@auth

{{-- add items Form --}}
<form action="{{url('/prod')}}" method="post" class="form form-group container" enctype="multipart/form-data">
	@csrf
	<input name="name" placeholder="name" class="form-control d-inline" required>
	<input name="count" placeholder="count" class="form-control d-inline" required>
	<input name="price" placeholder="price" class="form-control d-inline" required>
	<input name="description" placeholder="description" class="form-control d-inline" required>
	<input type="file" class="d-none" id="filei" name="img[]" multiple placeholder="description" required>
	<label for="filei" class="btn btn-light mt-1 text-warning">upload</label>
	<button class="btn btn-warning mb-1 text-light">ավելացնել</button>
</form>

{{-- Errors --}}
@if(count($errors))
	<div class="alert alert-danger mt-2">Սխալ մուտքագրված դաշտ</div>
@endif


{{-- show items --}}
<div class="d-flex mt-5 flex-wrap align-items-end justify-content-between container">
	@foreach($items as $item)
		<div class="card" style="width:22%;">
			<div class="card-body pt-1 pb-3">
				<img class="card-img-top ml-5" src="{{asset('/images/'.$item->photo[0]->img)}}" data-zoom-image="{{asset('/images/'.$item->photo[0]->img)}}">
				<div class="card-title font-weight-bold" id="name">{{$item->name}}</div>
				<span class="card-text mb-1" id="price">{{$item->price}}</span><span class="i">&#1423;</span><br>
				<span class="card-text mb-1" id="count">{{$item->count}}</span><span class="i">հատ</span><br>
				<div class="card-text" id="description">{{$item->description}}</div>
				<div class="card-title mt-3 mb-1 font-weight-bold text-secondary" id="user_name">By (<span class="far fa-user i">{{$item->seller->name}}</span>)</div>
				<button data-id="{{$item->id}}" class="save fas fa-check btn btn-success d-none"></button>
				<button class="edit fas fa-edit btn btn-danger pr-2"></button>
				<a href="{{route('delete', $item->id)}}" class="close del btn text-danger">&times;</a>
				<a href="{{route('detail', $item->id)}}" class="btn text-danger more">more...</a>
			</div>
		</div>
	@endforeach
</div>


@endauth {{-- Auth::check()-ի նոր տարբերակ --}}


