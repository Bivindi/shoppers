<form class="form-inline" action="{{ route('get:product_search') }}" id="searchForm" method="get">
    <div class="form-group form-category">
        <select class="select-category" name="category">
            <option value="">All Categories1</option>
            @foreach($categories as $category)
                <option value="{{ $category->slug }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group input-serach">
        <input type="text" name="search" id="autocomplete" placeholder="Keyword here...">
    </div>
    <button type="submit" class="pull-right btn-search"></button>
</form>