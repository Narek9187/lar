@auth
<div class="d-flex mt-5 flex-wrap align-items-end justify-content-between container">
	@foreach($items as $item)
		<div class="card mt-2" style="width:21%;">
			<div class="card-body pt-2">
				<img class="card-img-top p-1" src="{{asset('/images/'.$item->prod->photo[0]->img)}}" data-zoom-image="{{asset('/images/'.$item->prod->photo[0]->img)}}">
				<a data-id="{{$item->id}}" class="fas fa-heart text-danger like" title="remove from cart"></a>
				<div class="card-title name font-weight-bold">{{$item->prod->name}}</div>
				<span class="card-text mb-1">{{$item->prod->price}}</span><span>&#1423;</span><br>
				<span class="card-text mb-1">{{$item->prod->description}}</span>
				<div class="card-title font-weight-bold text-dark mb-0 mt-3" id="user_name">By (<span class="far fa-user">{{$item->prod->seller->name}}</span>)</div>
				<div data-id="{{$item->id}}" class="fas fa-shopping-basket text-warning move_cart" title="move to cart"></div>
			</div>
		</div>
	@endforeach
</div>
@endauth