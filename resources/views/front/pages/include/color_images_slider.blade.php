@if(!empty($image->image1))
<li data-thumb="{{ asset('100ProductImg/'.$image->image1) }}" class="lslide">
	<img  class="figure-img img-fluid data-image" src="{{ asset('100ProductImg/'.$image->image1) }}"
	 alt="product-img" style="width: 100%; height: 450px;" />
</li>
@endif

@if(!empty($image->image2))
<li data-thumb="{{ asset('100ProductImg/'.$image->image2) }}" class="lslide">
	<img  class="figure-img img-fluid data-image" src="{{ asset('100ProductImg/'.$image->image2) }}"
	 alt="product-img" style="width: 100%; height: 450px;" />
</li>
@endif

@if(!empty($image->image3))
<li data-thumb="{{ asset('100ProductImg/'.$image->image3) }}" class="lslide">
	<img  class="figure-img img-fluid data-image" src="{{ asset('100ProductImg/'.$image->image3) }}"
	 alt="product-img" style="width: 100%; height: 450px;" />
</li>
@endif

@if(!empty($image->image4))
<li data-thumb="{{ asset('100ProductImg/'.$image->image4) }}" class="lslide">
	<img  class="figure-img img-fluid data-image" src="{{ asset('100ProductImg/'.$image->image4) }}"
	 alt="product-img" style="width: 100%; height: 450px;" />
</li>
@endif

@if(!empty($image->image5))
<li data-thumb="{{ asset('100ProductImg/'.$image->image5) }}" class="lslide">
	<img  class="figure-img img-fluid data-image" src="{{ asset('100ProductImg/'.$image->image5) }}"
	 alt="product-img" style="width: 100%; height: 450px;" />
</li>
@endif

