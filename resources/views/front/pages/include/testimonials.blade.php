<div class="block left-module">
    <p class="title_block">Testimonials </p>
    <div class="block_content">
        <ul class="testimonials owl-carousel" data-loop="false" data-nav="false" data-margin="30"
            data-autoplayTimeout="1000" data-autoplay="true" data-autoplayHoverPause="true"
            data-items="1">
            @foreach($testimonials as $testimonial)
                <li>
                    <div class="client-mane">{{ $testimonial->title }}</div>
                    <div class="client-avarta">
                        <img src="{{ asset('otherpages/'.$testimonial->image) }}"/>
                    </div>
                    <div class="testimonial">
                        {!! $testimonial->desc !!}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>