<div class="block left-module">
    <p class="title_block">CATEGORIES</p>
    <div class="block_content">
        <div class="layered layered-category">
            <div class="layered-content">
                <ul class="tree-menu">
                    @foreach($categories as $key => $category)
                        <li class="@if($key == 0) active @endif">
                            <span></span>
                            <a href="javascript:void(0);">{{ $category->name }}</a>
                            @if(count($category->subCategories()->get())>0)
                                <ul>
                                    @foreach($category->subCategories()->get() as $subcategory)
                                        <li><span></span><a
                                                    href="{{ route('get:sub_category_products', ['cat' => $category->slug, 'subCatSlug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>