@extends('admin.layout.default')
@section('title')
    @if(isset($product))
        Edit Products
    @else
        Add Products
    @endif
@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('css/jquery.minicolors.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <!--dropify-->
    <link href="{{ asset('assets/js/plugins/dropify/css/dropify.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection">
    <style>
        .removeScreenshots {
            position: absolute;
            left: 137px;
            top: 30px;
        }
    </style>
@endsection
@section('page-content')
    <section id="content">
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2"
                       placeholder="Explore Materialize">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">@if(isset($product)) Edit Products @else Add Products @endif</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Products</a>
                            </li>
                            <li class="active">@if(isset($product))
                                    Edit Products
                                @else
                                    Add Products
                                @endif</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
            <!--Form Advance-->
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="col-md-12">
                        <h4 class="header2">@if(isset($product))
                                Edit Products
                            @else
                                Add Products
                            @endif</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_products') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if(isset($product))
                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                    <input type="hidden" name="oldProductImg" value="{{ $product->product_img }}">
                                    <input type="hidden" name="oldVideoImg" value="{{ $product->video_thumb }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" name="name"
                                               value="{{ (isset($product)) ? $product->name : old('name') }}"
                                               type="text">
                                        <label for="name">Name</label>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="summernote" name="desc" rows="10"
                                                  cols="10">{!! (isset($product)) ? $product->desc : old('desc') !!}</textarea>
                                        <span class="error">{{ $errors->first('desc') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <select name="subcategory" id="category">
                                            <option value="">Select SubCategory</option>
                                            @foreach($subcategories as $subcategory)
                                                @if(isset($product))
                                                    {{ $selected = ($product->sub_category_id == $subcategory->id) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $subcategory->id }}" @if(isset($product)) {{ $selected }} @endif>{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="category">Select SubCategory</label>
                                        <span class="error">{{ $errors->first('subcategory') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="metaTitle" name="m_title"
                                               value="{{ (isset($product)) ? $product->m_title : old('m_title') }}"
                                               type="text">
                                        <label for="metaTitle">Meta Title</label>
                                        <span class="error">{{ $errors->first('m_title') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="metaKeywords" name="m_keywords"
                                               value="{{ (isset($product)) ? $product->m_keywords : old('m_keywords') }}"
                                               type="text">
                                        <label for="metaKeywords">Meta Keywords</label>
                                        <span class="error">{{ $errors->first('m_keywords') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="mTags" name="m_tag"
                                               value="{{ (isset($product)) ? $product->m_tag : old('m_tag') }}"
                                               type="text">
                                        <label for="mTags">Meta Tags</label>
                                        <span class="error">{{ $errors->first('m_tag') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="mDesc"
                                                  class="materialize-textarea"
                                                  name="m_desc">{{ (isset($product)) ? $product->m_desc : old('m_desc') }}</textarea>
                                        <label for="mDesc">Meta Description</label>
                                        <span class="error">{{ $errors->first('m_desc') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="Model" name="model"
                                               value="{{ (isset($product)) ? $product->model : old('model') }}"
                                               type="text">
                                        <label for="Model">Model</label>
                                        <span class="error">{{ $errors->first('model') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="SKU" name="sku"
                                               value="{{ (isset($product)) ? $product->sku : old('sku') }}" type="text">
                                        <label for="SKU">SKU</label>
                                        <span class="error">{{ $errors->first('sku') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="HSN" name="hsn"
                                               value="{{ (isset($product)) ? $product->hsn : old('hsn') }}" type="text">
                                        <label for="HSN">HSN</label>
                                        <span class="error">{{ $errors->first('hsn') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="ISBN" name="isbn"
                                               value="{{ (isset($product)) ? $product->isbn : old('isbn') }}"
                                               type="text">
                                        <label for="ISBN">ISBN</label>
                                        <span class="error">{{ $errors->first('isbn') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="Price" name="price"
                                               value="{{ (isset($product)) ? $product->price : old('price') }}"
                                               type="number">
                                        <label for="Price">Price</label>
                                        <span class="error">{{ $errors->first('price') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <select name="tax_class" id="taxClass">
                                            <option value="">Select Tax Class</option>
                                            @foreach($taxClasses as $taxClass)
                                                @if(isset($product))
                                                    {{ $selected = ($product->tax_class_id == $taxClass->id) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $taxClass->id }}" @if(isset($product)) {{ $selected }} @endif>{{ $taxClass->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="taxClass">Select Tax Class</label>
                                        <span class="error">{{ $errors->first('tax_class') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="Quantity" name="quantity"
                                               value="{{ (isset($product)) ? $product->quantity : old('quantity') }}"
                                               type="number">
                                        <label for="Quantity">Quantity</label>
                                        <span class="error">{{ $errors->first('quantity') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <select name="brand" id="brand">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                @if(isset($product))
                                                    {{ $selected = ($product->brand_id == $brand->id) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $brand->id }}" @if(isset($product)) {{ $selected }} @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="brand">Select Brand</label>
                                        <span class="error">{{ $errors->first('brand') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="rewardPoints" name="reward_points"
                                               value="{{ (isset($product)) ? $product->reward_points : old('reward_points') }}"
                                               type="number">
                                        <label for="rewardPoints">Reward Points</label>
                                        <span class="error">{{ $errors->first('reward_points') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="videoUrl" name="url"
                                               value="{{ (isset($product)) ? $product->url : old('url') }}"
                                               type="text">
                                        <label for="videoUrl">Youtube Url</label>
                                        <span class="error">{{ $errors->first('url') }}</span>
                                    </div>
                                    @if(Auth::user()->hasRole('admin'))
                                        <div class="input-field col s12">
                                            <p>Status</p>
                                            <input name="status" value="1"
                                                   @if(isset($product)) {{ ($product->status == 1) ? 'checked' : ''}} @endif type="radio"
                                                   id="test1"/>
                                            <label for="test1">Enable</label>
                                            <input name="status" value="0"
                                                   @if(isset($product)) {{ ($product->status == 0) ? 'checked' : ''}} @endif type="radio"
                                                   id="test2"/>
                                            <label for="test2">Disable</label>
                                            <span class="error">{{ $errors->first('status') }}</span>
                                        </div>
                                    @endif
                                    <div class="input-field col s12">
                                        <p>Color</p>
                                        <input name="is_color" value="1"
                                               @if(isset($product)) {{ (count($productColors)>0) ? 'checked' : ''}} @endif class="isColor"
                                               type="radio" id="color1"/>
                                        <label for="color1">Enable</label>
                                        <input name="is_color" value="0"
                                               @if(isset($product)) {{ (count($productColors) <= 0) ? 'checked' : ''}} @endif class="isColor"
                                               type="radio" id="color2"/>
                                        <label for="color2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productColor">
                                        @if(isset($product) && count($productColors) > 0)
                                            @foreach($productColors as $productColor)
                                                <div class="prodcolor">
                                                    <div class="input-field col s8">
                                                        <input type="text" id="saturation-demo" class="demo"
                                                               name="product_color[]" data-control="saturation"
                                                               value="{{ $productColor->desc }}">
                                                    </div>
                                                    <div class="input-field col s4">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="colors"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Product Color</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addColor();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Image"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Size</p>
                                        <input name="is_color" value="1"
                                               @if(isset($product)) {{ (count($productSize)>0) ? 'checked' : ''}} @endif class="isSize"
                                               type="radio" id="size1"/>
                                        <label for="size1">Enable</label>
                                        <input name="is_color" value="0"
                                               @if(isset($product)) {{ (count($productSize) <= 0) ? 'checked' : ''}} @endif class="isSize"
                                               type="radio" id="size2"/>
                                        <label for="size2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productSize">
                                        @if(isset($product) && count($productSize) > 0)
                                            @foreach($productSize as $size)
                                                <div class="prodcolor">
                                                    <div class="input-field col s8">
                                                        <input type="text" name="product_size[]"
                                                               value="{{ $size->desc }}">
                                                    </div>
                                                    <div class="input-field col s4">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="size"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Product Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Size"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>

                                    <div class="col s12">
                                        <p>Size Chart</p>
                                        @if(isset($product))
                                            <input type="file" id="input-file" name="size_chart"
                                                   class="dropify-event"
                                                   data-default-file="{{ asset('sizechart/'.$product->size_chart) }}"/>
                                        @else
                                            <input type="file" id="sizeChart" name="size_chart" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>

                                    <div class="col s12">
                                        <p>Image</p>
                                        @if(isset($product))
                                            <input type="file" id="input-file-events" name="product_img"
                                                   class="dropify-event"
                                                   data-default-file="{{ asset('productimg/'.$product->product_img) }}"/>
                                        @else
                                            <input type="file" id="profile" name="product_img" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="table-responsive">
                                            <table id="images" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <td class="text-left">Additional Images</td>
                                                    <td></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($product) && count($product->productScreenshots()->get())>0)
                                                    @foreach($product->productScreenshots()->get() as $key => $screenshots)
                                                        <div class="input-field col s12">
                                                            <img src="{{ asset('100ProductImg/'.$screenshots->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                            <button type="button"
                                                                    class="btn btn-danger removeScreenshots"
                                                                    screenId="{{ $screenshots->id }}">Remove
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-left">
                                                        <button type="button" onclick="addImage();"
                                                                data-toggle="tooltip"
                                                                title="" class="btn btn-primary"
                                                                data-original-title="Add Image"><i
                                                                    class="fa fa-plus-circle"></i></button>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="table-responsive">
                                            <table id="discount" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <td class="text-right">Price</td>
                                                    <td class="text-left">Date Start</td>
                                                    <td class="text-left">Date End</td>
                                                    <td></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($product) && count($product->ProductDiscount()->get())>0)
                                                    @foreach($product->ProductDiscount()->get() as $key=>$discount)
                                                        <tr id="discount-row">
                                                            <td class="text-right"><input type="text"
                                                                                          name="product_discount[{{ $key }}][price]"
                                                                                          value="{{ $discount->price }}"
                                                                                          placeholder="Price"
                                                                                          class="form-control"/></td>
                                                            <td class="text-left" style="width: 20%;">
                                                                <div class="input-group date"><input type="text"
                                                                                                     name="product_discount[{{$key}}][date_start]"
                                                                                                     value="{{ $discount->start_date }}"
                                                                                                     placeholder="Date Start"
                                                                                                     data-date-format="YYYY-MM-DD"
                                                                                                     class="form-control datepicker"/><span
                                                                            class="input-group-btn"></span></div>
                                                            </td>
                                                            <td class="text-left" style="width: 20%;">
                                                                <div class="input-group date"><input type="text"
                                                                                                     name="product_discount[{{$key}}][date_end]"
                                                                                                     value="{{ $discount->end_date }}"
                                                                                                     placeholder="Date End"
                                                                                                     data-date-format="YYYY-MM-DD"
                                                                                                     class="form-control datepicker"/><span
                                                                            class="input-group-btn"></span></div>
                                                            </td>
                                                            <td class="text-left">
                                                                <button type="button"
                                                                        data-toggle="tooltip" title="Remove"
                                                                        class="btn btn-danger discountRmv"><i
                                                                            class="fa fa-minus-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-left">
                                                        <button type="button" onclick="addDiscount();"
                                                                data-toggle="tooltip"
                                                                title="" class="btn btn-primary"
                                                                data-original-title="Add Discount"><i
                                                                    class="fa fa-plus-circle"></i></button>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="table-responsive">
                                            <table id="attribute"
                                                   class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <td class="text-left">Attribute</td>
                                                    <td class="text-left">Text</td>
                                                    <td></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($product) && count($product->ProductAttributes()->where('name', '!=', 'color')->where('name', '!=', 'size')->get())>0)
                                                    @foreach($product->ProductAttributes()->where('name', '!=', 'color')->where('name', '!=', 'size')->get() as $key=>$attribute)
                                                        <tr id="attribute-row">
                                                            <td class="text-left" style="width: 20%;">
                                                                <input type="text"
                                                                       name="product_attribute[{{ $key }}][name]"
                                                                       value="{{ $attribute->name }}"
                                                                       placeholder="Attribute" class="form-control"/>
                                                            </td>
                                                            <td class="text-left">
                                                                <div class="input-group"><textarea
                                                                            name="product_attribute[{{ $key }}][description]"
                                                                            rows="5" placeholder="Text"
                                                                            class="materialize-textarea">{{ $attribute->desc }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td class="text-left">
                                                                <button type="button"
                                                                        data-toggle="tooltip" title="Remove"
                                                                        class="btn btn-danger discountRmv"><i
                                                                            class="fa fa-minus-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-left">
                                                        <button type="button" onclick="addAttribute();"
                                                                data-toggle="tooltip" title="" class="btn btn-primary"
                                                                data-original-title="Add Attribute"><i
                                                                    class="fa fa-plus-circle"></i></button>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">

    </script>
@endsection
