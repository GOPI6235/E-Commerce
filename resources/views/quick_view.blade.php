<div class="modal-header">
    <h5 class="modal-title">
        {{ $product->name }}
    </h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-7">
            <img src="{{ asset('assets/upload/products/' . $product->image) }}" class="img-fluid" style="height: 200px"alt="product image">
        </div>
        <div class="col-sm-5">
            {{-- <h5>{{ $product->name }}</h5><hr> --}}
            <span class="float-start mt-4">&#8377 {{ $product->selling_price }}</span>
            <span class="float-end mt-4">&#8377 <s>{{ $product->original_price }}</s></span>

            <button type="button" class="btn btn-outline-warning w-100 mt-5 addToWishlist ">Wishlist<i class="bi bi-heart-fill"></i></button>
            
        </div>
    </div>
    

    <p class="float-end">{{ $product->description }}</p>
</div>


{{-- <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div> --}}

