@auth
<div class="d-flex mt-5 flex-wrap align-items-end justify-content-between container">
	@foreach($items as $item)
		<div class="card mt-2" style="width:21%;">
			<div class="card-body pt-2" data-id="{{$item->products_id}}">
				<img class="card-img-top p-1" src="{{asset('/images/'.$item->prod->photo[0]->img)}}" data-zoom-image="{{asset('/images/'.$item->prod->photo[0]->img)}}">
				<a data-id="{{$item->id}}" class="far fa-star text-danger move_wish" title="move to wishlist"></a>
				<div class="card-title name mb-1 font-weight-bold">{{$item->prod->name}}</div>
				<span class="card-text mb-1 price">{{$item->prod->price * $item->count}}</span><span>&#1423;</span><br>
				<input data-id="{{$item->id}}" type="number" max="{{DB::table("products")->where('id', $item->products_id)->first()->count}}" class="card-text mb-1 p-0 border-danger" id="count" value="{{$item->count}}"><span>հատ</span><br>
				<span class="card-text mb-1">{{$item->prod->description}}</span>
				<div class="card-title font-weight-bold text-dark mb-0 mt-3" id="user_name">By (<span class="far fa-user">{{$item->prod->seller->name}}</span>)</div>
				<a data-id="{{$item->id}}" class="close del p-0 btn text-danger" title="remove from cart">&times;</a>
				<a href="{{url('stripe')}}" class="btn btn-sm mt-2 btn-success">Buy</a>
			</div>
		</div>
	@endforeach
</div>
@endauth