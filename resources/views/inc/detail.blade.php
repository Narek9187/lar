@auth

{{-- show detail --}}
<div class="d-flex flex-wrap align-items-end">
	@foreach($data->photo as $item)
		<div class="card ml-2" style="width:19%; height: fit-content;">
			<div class="card-body">
				<img class="card-img-top p-1" src="{{asset('/images/'.$item->img)}}" data-zoom-image="{{asset('/images/'.$item->img)}}">
			</div>
		</div>
	@endforeach
</div>

@endauth