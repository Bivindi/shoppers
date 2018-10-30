<div class="col-md-6 col-lg-6 slider-search-section d-none d-lg-block">
    <form action="{{ route('get:product_search') }}" id="searchForm" method="get">
        <div class="input-group">
            <!-- <div class="input-group-btn">
                <button type="button" class="btn btn-secondary wd-slider-search-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Categories <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu wd-dropdown-menu">
                    <div class="search-category">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="search-category-title">Cameras and photos</h6>
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Camera Electronice</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Camera Appereances</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> DSLR</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Video cameras</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Top Cameras</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="search-category-title">Cameras and photos</h6>
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Camera Electronice</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Camera Appereances</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> DSLR</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Video cameras</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Top Cameras</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <select class="select-category" name="category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="text" name="search" id="autocomplete" class="form-control input-search-box" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-secondary wd-search-btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
        </div>
    </form>
</div>