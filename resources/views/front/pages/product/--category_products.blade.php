<ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
    data-nav="true" data-margin="10"
    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
    @foreach($products as $product)
        @include('front.pages.product.homepage_products')
    @endforeach
</ul>
<script>
    $(".owl-carousel").each(function(index, el) {
        var config = $(this).data();
        config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
        config.smartSpeed="300";
        if($(this).hasClass('owl-style2')){
            config.animateOut="fadeOut";
            config.animateIn="fadeIn";
        }
        $(this).owlCarousel(config);
    });
</script>