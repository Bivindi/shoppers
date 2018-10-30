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
             .file-class{
    width:90px;
    color:transparent;
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

                                @if(isset($newproduct))
                                    <input type="hidden" name="isNewProduct" value="yes">
                                @endif
                                <div class="row">
                                    
                                     <div class="input-field col s12">
                                        <select name="subcategory2_id" id="subcategory2_id" class="browser-default">
                                            <option value="" disabled="" selected="">Select SubCategory</option>
                                            @foreach($subcategory2 as $category)
                                                @if(isset($product))
                                                    {{ $selected = ($product->sub_category_id == $category->id) ? 'selected' : '' }}
                                                @endif

                                                 @if(isset($newproduct))
                                                    {{ $selected = ($newproduct->sub_category_id == $category->id) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $category->id }}" @if(isset($product)) {{ $selected }} @endif  
                                                    @if(isset($newproduct)) {{ $selected }} @endif
                                                    >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error">{{ $errors->first('subcategory2_id') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="name" name="name"
                                               value="@if(isset($product)){{$product->name}}@elseif(isset($newproduct)){{$newproduct->name}}@else{{old('name')}}@endif"
                                               type="text" onkeyup="search_func(this.value);" autocomplete="off">
                                        <label for="name">Name</label>
                                        <span class="error name">{{ $errors->first('name') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <textarea id="summernote" name="desc" rows="10"
                                                  cols="10">{!! (isset($product)) ? $product->desc : old('desc') !!}  {!! (isset($newproduct)) ? $newproduct->desc : old('desc') !!}</textarea>
                                        <span class="error">{{ $errors->first('desc') }}</span>
                                    </div>
                                    
                                    <div class="input-field col s12">
                                        <input id="metaTitle" name="m_title"
                                               value="@if(isset($product)){{$product->m_title}}@elseif(isset($newproduct)){{$newproduct->m_title}}@else {{old('m_title')}}@endif"
                                               type="text">
                                        <label for="metaTitle">Meta Title</label>
                                        <span class="error">{{ $errors->first('m_title') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="metaKeywords" name="m_keywords"
                                               value="@if(isset($product)){{$product->m_keywords}}@elseif(isset($newproduct)){{$newproduct->m_keywords}}@else {{old('m_keywords')}}@endif"
                                               type="text">
                                        <label for="metaKeywords">Meta Keywords</label>
                                        <span class="error">{{ $errors->first('m_keywords') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="mTags" name="m_tag"
                                               value="@if(isset($product)){{$product->m_tag}} @elseif(isset($newproduct)){{$newproduct->m_tag}}@else{{old('m_tag')}}@endif"
                                               type="text">
                                        <label for="mTags">Meta Tags</label>
                                        <span class="error">{{ $errors->first('m_tag') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="mDesc"
                                                  class="materialize-textarea"
                                                  name="m_desc">@if(isset($product)){{$product->m_desc}} @elseif(isset($newproduct)){{$newproduct->m_desc}}@else {{old('m_desc')}}@endif</textarea>
                                        <label for="mDesc">Meta Description</label>
                                        <span class="error">{{ $errors->first('m_desc') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="Model" name="model"
                                               value="@if(isset($product)){{$product->model}} @elseif(isset($newproduct)){{$newproduct->model}}@else{{old('model')}}@endif"
                                               type="text">
                                        <label for="Model">Model</label>
                                        <span class="error">{{ $errors->first('model') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="SKU" name="sku"
                                               value="@if(isset($product)){{$product->sku}}@elseif(isset($newproduct)){{$newproduct->sku}}
                                               @else {{old('sku')}}@endif" type="text">
                                        <label for="SKU">SKU</label>
                                        <span class="error">{{ $errors->first('sku') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="HSN" name="hsn"
                                               value="@if(isset($product)){{$product->hsn}} @elseif(isset($newproduct)){{$newproduct->hsn}}
                                               @else{{old('hsn') }}@endif" type="text">
                                        <label for="HSN">HSN</label>
                                        <span class="error">{{ $errors->first('hsn') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="ISBN" name="isbn"
                                               value="@if(isset($product)){{$product->isbn}} @elseif(isset($newproduct)){{$newproduct->isbn}}@else{{old('isbn')}}@endif"
                                               type="text">
                                        <label for="ISBN">ISBN</label>
                                        <span class="error">{{ $errors->first('isbn') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="Price" name="price"
                                               value="@if(isset($product)){{$product->price}}@elseif(isset($newproduct)){{$newproduct->price}}@else{{old('price')}}@endif"
                                               type="number">
                                        <label for="Price">Price</label>
                                        <span class="error">{{ $errors->first('price') }}</span>
                                    </div>

                                    <div class="input-field col s6">
                                        <input id="shipping_charge" name="shipping_charge"
                                               value="@if(isset($product)){{$product->shipping_charge}}@elseif(isset($newproduct)){{$newproduct->shipping_charge}}@else{{old('shipping_charge')}}@endif"
                                               type="number">
                                        <label for="shipping_charge">Shipping Charge</label>
                                        <span class="error">{{ $errors->first('shipping_charge') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <select name="tax_class" id="taxClass">
                                            <option value="">Select Tax Class</option>
                                            @foreach($taxClasses as $taxClass)
                                                @if(isset($product))
                                                    {{ $selected = ($product->tax_class_id == $taxClass->id) ? 'selected' : '' }}
                                                @elseif(isset($newproduct))
                                                    {{ $selected = ($newproduct->tax_class_id == $taxClass->id) ? 'selected' : '' }}
                                                @else {{ $selected = ''}}
                                                @endif
                                                <option value="{{ $taxClass->id }}" @if(isset($product)) {{ $selected }} @endif @if(isset($newproduct)) {{ $selected }} @endif>{{ $taxClass->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="taxClass">Select Tax Class</label>
                                        <span class="error">{{ $errors->first('tax_class') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="Quantity" name="quantity"
                                               value="@if(isset($product)){{$product->quantity}}@elseif(isset($newproduct)){{$newproduct->quantity}}@else{{old('quantity')}}@endif"
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
                                                @elseif(isset($newproduct))
                                                    {{ $selected = ($newproduct->brand_id == $brand->id) ? 'selected' : '' }}
                                                @else {{ $selected = ''}}
                                                @endif
                                                <option value="{{ $brand->id }}" @if(isset($product)) {{ $selected }} @endif @if(isset($newproduct)) {{ $selected }} @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="brand">Select Brand</label>
                                        <span class="error">{{ $errors->first('brand') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="rewardPoints" name="reward_points"
                                               value="@if(isset($product)){{$product->reward_points}}@elseif(isset($newproduct)){{$newproduct->reward_points}}@else{{old('reward_points')}}@endif"
                                               type="number">
                                        <label for="rewardPoints">Reward Points</label>
                                        <span class="error">{{ $errors->first('reward_points') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="videoUrl" name="url"
                                               value="@if(isset($product)){{$product->url}}@elseif(isset($newproduct)){{$newproduct->url}}@else{{old('url')}}@endif"
                                               type="text">
                                        <label for="videoUrl">Youtube Url</label>
                                        <span class="error">{{ $errors->first('url') }}</span>
                                    </div>
                                    @if(Auth::user()->hasRole('admin'))
                                        <div class="input-field col s12">
                                            <p>Status</p>
                                            <input name="status" value="1"
                                                   @if(isset($product)) {{ ($product->status == 1) ? 'checked' : ''}} @endif @if(isset($newproduct)) {{ ($newproduct->status == 1) ? 'checked' : ''}} @endif type="radio"
                                                   id="test1"/>
                                            <label for="test1">Enable</label>
                                            <input name="status" value="0"
                                                   @if(isset($product)) {{ ($product->status == 0) ? 'checked' : ''}} @endif type="radio"
                                                   id="test2"/>
                                            <label for="test2">Disable</label>
                                            <span class="error">{{ $errors->first('status') }}</span>
                                        </div>
                                    @endif

                                    <!-- Not Dispaly in Books -->
                                    @if($subcategory->category_id != 22 && $subcategory->category_id != 24)
                                    <div class="input-field col s12">
                                        <p>Color</p>
                                        <input name="is_color" value="1" 
                                        @if(isset($product)){{(count($productColors)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColors)>0) ? 'checked' : ''}} @endif 
                                               class="isColor"
                                               type="radio" id="color1"/>
                                        <label for="color1">Enable</label>
                                        <input name="is_color" value="0"
                                               @if(isset($product)) {{ (count($productColors) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColors) <= 0) ? 'checked' : ''}} @endif
                                               class="isColor"
                                               type="radio" id="color2"/>
                                        <label for="color2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productColor">
                                        @if(isset($product) && count($productColors) > 0)
                                            @foreach($productColors as $productColor)
                                                <div class="prodcolor">

                                                <div class="row">

                                                       <!--  <div class="input-field col s8">
                                                          <div class="input-field col s3">
                                                            <input type="text" id="saturation-demo" class="demo"
                                                                   name="product_color[]" data-control="saturation"
                                                                   value="{{ $productColor->desc }}">
                                                                 </div>

                                                                <div class="input-field col s3">
                                                                   <input type="number" id="priceid" class=""
                                                                   name="product_price[]" 
                                                                   value="{{ $productColor->product_price }}">
                                                                </div>

                                                                <div class="input-field col s3">
                                                                   <img src="{{ asset('850ProductImg/'.$productColor->screenshots) }}"
                                                                     class="img-responsive" height="100" width="100"
                                                                     alt="">
                                                                </div>

                                                                <input type="hidden" name="color_images[]" value="{{ $productColor->image_id}}">
                                                        </div>
                                                        <div class="input-field col s4">
                                                            <button type="button"
                                                                    data-toggle="tooltip" title="Remove"
                                                                    class="btn btn-danger colorRemove" imageid="{{ $productColor->image_id }}"><i
                                                                        class="fa fa-minus-circle"></i></button>
                                                        </div> -->

                                                        <div class="input-field col s2">
                                                            <input type="text" id="saturation-demo" class="demo oldcolorchange"
                                                                   name="product_color_old[]" data-control="saturation"
                                                                   value="{{ $productColor->desc }}" attribute_id="{{ $productColor->id }}">
                                                        </div>

                                                        <div class="input-field col s2">
                                                            <input type="number" id="saturation-demo" class=" oldpricechange"
                                                                   name="product_price_old[]"  value="{{ $productColor->product_price }}" attribute_id="{{ $productColor->id }}">
                                                        </div>

                                                        <div class="input-field col s4">
                                                            <button type="button" attribute_id="{{ $productColor->id }}"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                class="fa fa-minus-circle"></i></button>
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        
                                                        @if(!empty($product->getColorsImages( $productColor->id )->image1))
                                                         <div class="input-field col s2" align="center">
                                                            <img src="{{ asset('100ProductImg/'.$product->getColorsImages( $productColor->id )->image1) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                         
                                                            <button  type="button" imageid="{{ $product->getColorsImages( $productColor->id )->id }}" imagename="image1"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorImageRemove"><i
                                                                class="fa fa-minus-circle"></i></button>
                                                         </div>
                                                         @else
                                                            <div class="input-field col s2" align="center"></div>
                            
                                                         @endif

                                                        @if(!empty($product->getColorsImages( $productColor->id )->image2))
                                                        <div class="input-field col s2" align="center">
                                                            <img src="{{ asset('100ProductImg/'.$product->getColorsImages( $productColor->id )->image2) }}"
                                                            class="img-responsive" height="100" width="100" alt="">

                                                            <button  type="button" imageid="{{ $product->getColorsImages( $productColor->id )->id }}" imagename="image2"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorImageRemove"><i
                                                                class="fa fa-minus-circle"></i></button>

                                                        </div>
                                                         @else
                                                            <div class="input-field col s2" align="center"></div>
                                                        @endif

                                                        @if(!empty($product->getColorsImages( $productColor->id )->image3))
                                                        <div class="input-field col s2" align="center">
                                                            <img src="{{ asset('100ProductImg/'.$product->getColorsImages( $productColor->id )->image3) }}"
                                                            class="img-responsive" height="100" width="100" alt="">

                                                            <button  type="button" imageid="{{ $product->getColorsImages( $productColor->id )->id }}" imagename="image3"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorImageRemove"><i
                                                                class="fa fa-minus-circle"></i></button>

                                                        </div>
                                                         @else
                                                            <div class="input-field col s2" align="center"></div>
                                                        @endif

                                                        @if(!empty($product->getColorsImages( $productColor->id )->image4))
                                                        <div class="input-field col s2" align="center">
                                                            <img src="{{ asset('100ProductImg/'.$product->getColorsImages( $productColor->id )->image4) }}"
                                                            class="img-responsive" height="100" width="100" alt="">

                                                            <button  type="button" imageid="{{ $product->getColorsImages( $productColor->id )->id }}"  imagename="image4"
                                                                data-toggle="tooltip" title="Remove" imageid="{{ asset('100ProductImg/'.$product->getColorsImages( $productColor->id )->id) }}"
                                                                class="btn btn-danger colorImageRemove"><i
                                                                class="fa fa-minus-circle"></i></button>

                                                        </div>
                                                         @else
                                                            <div class="input-field col s2" align="center"></div>
                                                         @endif

                                                        @if(!empty($product->getColorsImages( $productColor->id )->image5))
                                                        <div class="input-field col s2" align="center">
                                                            <img src="{{ asset('100ProductImg/'.$product->getColorsImages( $productColor->id )->image5) }}"
                                                            class="img-responsive" height="100" width="100" alt="">

                                                            <button  type="button" imageid="{{ $product->getColorsImages( $productColor->id )->id }}"  imagename="image5"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorImageRemove"><i
                                                                class="fa fa-minus-circle"></i></button>
                                                         </div>
                                                          @else
                                                            <div class="input-field col s2" align="center"></div>
                                                        @endif

                                                    </div>

                                                    <div class="row">
                                                        @if(!empty($productColor->id))
                                                        <div class="input-field col s2" align="center">
                                                            <input type="file" class="newimage1 newImageUpload file-class" name="image1" attribute_id="{{ $product->getColorsImages( $productColor->id )->id }}">
                                                        </div>


                                                        <div class="input-field col s2" align="center">
                                                            <input type="file" class="newimage2 newImageUpload file-class" name="image2" attribute_id="{{ $product->getColorsImages( $productColor->id )->id }}">
                                                        </div>

                                                        <div class="input-field col s2" align="center">
                                                            <input type="file" class="newimage3 newImageUpload file-class" name="image3" attribute_id="{{ $product->getColorsImages( $productColor->id )->id }}">
                                                        </div>

                                                        <div class="input-field col s2" align="center">
                                                            <input type="file" class="newimage4 newImageUpload file-class" name="image4" attribute_id="{{ $product->getColorsImages( $productColor->id )->id }}">
                                                        </div>

                                                        <div class="input-field col s2" align="center">
                                                            <input type="file" class="newimage5 newImageUpload file-class" name="image5" attribute_id="{{ $product->getColorsImages( $productColor->id )->id }}">
                                                        </div>
                                                        @endif
                                                    </div>
                                                        <br><br><br>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="colors"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Color</td>
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
                                    @endif

                                    <!-- Not Display in Books -->
                                    @if($subcategory->category_id != 22)
                                    <div class="input-field col s12">
                                        <p>Size</p>
                                        <input name="is_size" value="1"
                                               @if(isset($product)) {{ (count($productSize)>0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productSize)>0) ? 'checked' : ''}} @endif
                                                class="isSize"
                                               type="radio" id="size1"/>
                                        <label for="size1">Enable</label>
                                        <input name="is_size" value="0"
                                               @if(isset($product)) {{ (count($productSize) <= 0) ? 'checked' : ''}} @endif class="isSize"
                                               type="radio" id="size2"/>
                                        <label for="size2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productSize">
                                        @if(isset($product) && count($productSize) > 0)
                                            @foreach($productSize as $size)
                                                <div class="prodSize">
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
                                                        <td class="text-left">Size</td>
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
                                    @endif

                                    @if($subcategory->category_id != 39 && $subcategory->category_id != 22 && $subcategory->category_id != 21 && $subcategory->category_id != 24 && $subcategory->category_id != 18)
                                    <!-- size-color -->
                                    <div class="input-field col s12">
                                        <p>Size Color</p>
                                        <input name="size_color" value="1" 
                                        @if(isset($product)){{(count($productSizeColors)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColors)>0) ? 'checked' : ''}} @endif 
                                               class="isSizeColor"
                                               type="radio" id="size_color1"/>
                                        <label for="size_color1">Enable</label>
                                        <input name="size_color" value="0"
                                               @if(isset($product)) {{ (count($productSizeColors) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColors) <= 0) ? 'checked' : ''}} @endif
                                               class="isSizeColor"
                                               type="radio" id="size_color2"/>
                                        <label for="size_color2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productSizeColor">
                                        @if(isset($product) && count($productSizeColors) > 0)
                                            @foreach($productSizeColors as $sizecolor)
                                                <div class="prodSizeColor col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="product_size_color_old[]"
                                                               value="{{ $sizecolor->desc }}" class="demo oldcolorchange" attribute_id="{{ $sizecolor->id }}" >
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="size_color_size_old[]"
                                                               value="{{ $sizecolor->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="size_color_price_old[]"
                                                               value="{{ $sizecolor->product_price }}" class="oldpricechange" attribute_id="{{ $sizecolor->id }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$sizecolor->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button" data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove" attribute_id="{{ $sizecolor->id }}"><i class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="sizecolor_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Size Color</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addSizeColor();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Size Color"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- size-color -->
                                    @endif




                                    @if($subcategory->category_id == 16 || $subcategory->category_id == 23 )
                                    <!-- Scent -->
                                    <div class="input-field col s12">
                                        <p>Scent</p>
                                        <input name="scent" value="1" 
                                        @if(isset($product)){{(count($productScent)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productScent)>0) ? 'checked' : ''}} @endif 
                                               class="isScent"
                                               type="radio" id="scent1"/>
                                        <label for="scent1">Enable</label>
                                        <input name="scent" value="0"
                                               @if(isset($product)) {{ (count($productScent) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productScent) <= 0) ? 'checked' : ''}} @endif
                                               class="isScent"
                                               type="radio" id="scent2"/>
                                        <label for="scent2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 scent">
                                        @if(isset($product) && count($productScent) > 0)
                                            @foreach($productScent as $scent)
                                                <div class="prodScent col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="scent_name[]" 
                                                                   value="{{ $scent->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="number" name="scent_price[]"
                                                               value="{{ $scent->product_price }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                               <img src="{{ asset('850ProductImg/'.$scent->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                            </div>

                                                    <div class="input-field col s3">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="scent_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Scent</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addScent();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Scent"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Scent -->

                                    <!-- Size-Scent -->
                                    <div class="input-field col s12">
                                        <p>Size Scent</p>
                                        <input name="size_scent" value="1" 
                                        @if(isset($product)){{(count($productScentSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productScentSize)>0) ? 'checked' : ''}} @endif 
                                               class="isSizeScent"
                                               type="radio" id="size_scent1"/>
                                        <label for="size_scent1">Enable</label>
                                        <input name="size_scent" value="0"
                                               @if(isset($product)) {{ (count($productScentSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productScentSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isSizeScent"
                                               type="radio" id="size_scent2"/>
                                        <label for="size_scent2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 size_scent">
                                        @if(isset($product) && count($productScentSize) > 0)
                                            @foreach($productScentSize as $scentsize)
                                                <div class="prodSizeScent col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="size_scent_name[]"
                                                               value="{{ $scentsize->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="size_scent_size[]"
                                                               value="{{ $scentsize->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="size_scent_price[]"
                                                               value="{{ $scentsize->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$scentsize->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="sizescent_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Scent Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addSizeScent();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Size Scent"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Size-Scent -->
                                    @endif
                                    
                                    @if($subcategory->category_id == 22)
                                    <!-- ONLY FOR BOOKS -->
                                    <!-- Paperback -->
                                    <div class="input-field col s12">
                                        <p>Paperback</p>
                                        <input name="paperback" value="1" 
                                        @if(isset($product)){{(count($productPaperback)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productPaperback)>0) ? 'checked' : ''}} @endif 
                                               class="isPaperback"
                                               type="radio" id="paperback1"/>
                                        <label for="paperback1">Enable</label>
                                        <input name="paperback" value="0"
                                               @if(isset($product)) {{ (count($productPaperback) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productPaperback) <= 0) ? 'checked' : ''}} @endif
                                               class="isPaperback"
                                               type="radio" id="paperback2"/>
                                        <label for="paperback2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 paperback">
                                        @if(isset($product) && count($productPaperback) > 0)
                                            @foreach($productPaperback as $paperback)
                                                <div class="prodPaperback col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="paperback_name[]"
                                                               value="{{ $paperback->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="paperback_price[]"
                                                               value="{{ $paperback->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$paperback->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="paperback_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Paperback</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addPaperback();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Paperback"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Paperback -->

                                    <!-- Hardcover -->
                                    <div class="input-field col s12">
                                        <p>Hardcover</p>
                                        <input name="hardcover" value="1" 
                                        @if(isset($product)){{(count($productHardcover)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productHardcover)>0) ? 'checked' : ''}} @endif 
                                               class="isHardcover"
                                               type="radio" id="hardcover1"/>
                                        <label for="hardcover1">Enable</label>
                                        <input name="hardcover" value="0"
                                               @if(isset($product)) {{ (count($productHardcover) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productHardcover) <= 0) ? 'checked' : ''}} @endif
                                               class="isHardcover"
                                               type="radio" id="hardcover2"/>
                                        <label for="hardcover2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 hardcover">
                                        @if(isset($product) && count($productHardcover) > 0)
                                            @foreach($productHardcover as $hardcover)
                                                <div class="prodHardcover col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="hardcover_name[]"
                                                               value="{{ $hardcover->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="number" name="hardcover_price[]"
                                                               value="{{ $hardcover->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$hardcover->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="hardcover_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Hardcover</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addHardcover();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Hardcover"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Hardcover -->

                                    <!-- AudioCD -->
                                    <div class="input-field col s12">
                                        <p>Audio CD</p>
                                        <input name="audiocd" value="1" 
                                        @if(isset($product)){{(count($productAudioCD)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productAudioCD)>0) ? 'checked' : ''}} @endif 
                                               class="isAudioCD"
                                               type="radio" id="audiocd1"/>
                                        <label for="audiocd1">Enable</label>
                                        <input name="audiocd" value="0"
                                               @if(isset($product)) {{ (count($productAudioCD) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productAudioCD) <= 0) ? 'checked' : ''}} @endif
                                               class="isHardcover"
                                               type="radio" id="audiocd2"/>
                                        <label for="audiocd2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 audiocd">
                                        @if(isset($product) && count($productAudioCD) > 0)
                                            @foreach($productAudioCD as $audiocd)
                                                <div class="prodAudioCD col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="audiocd_name[]"
                                                               value="{{ $audiocd->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="number" name="audiocd_price[]"
                                                               value="{{ $audiocd->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$audiocd->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="audiocd_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Audio CD</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addAudioCD();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Audio CD"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- AudioCD -->
                                    @endif

                                    @if($subcategory->category_id == 20)
                                    <!-- Pattern -->
                                    <div class="input-field col s12">
                                        <p>Pattern</p>
                                        <input name="pattern" value="1" 
                                        @if(isset($product)){{(count($productPattern)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productPattern)>0) ? 'checked' : ''}} @endif 
                                               class="isPattern"
                                               type="radio" id="pattern1"/>
                                        <label for="pattern1">Enable</label>
                                        <input name="pattern" value="0"
                                               @if(isset($product)) {{ (count($productPattern) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productPattern) <= 0) ? 'checked' : ''}} @endif
                                               class="isPattern"
                                               type="radio" id="pattern2"/>
                                        <label for="pattern2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 pattern">
                                        @if(isset($product) && count($productPattern) > 0)
                                            @foreach($productPattern as $pattern)
                                                <div class="prodPattern col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="pattern_name[]"
                                                               value="{{ $pattern->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="pattern_price[]"
                                                               value="{{ $pattern->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$pattern->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="pattern_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Pattern</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addPattern();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Pattern"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Pattern -->
                                    <!-- Cup Size -->
                                    <div class="input-field col s12">
                                        <p>Cup Size</p>
                                        <input name="cupsize" value="1" 
                                        @if(isset($product)){{(count($productCupSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productCupSize)>0) ? 'checked' : ''}} @endif 
                                               class="isCupSize"
                                               type="radio" id="cupsize1"/>
                                        <label for="cupsize1">Enable</label>
                                        <input name="cupsize" value="0"
                                               @if(isset($product)) {{ (count($productCupSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productCupSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isCupSize"
                                               type="radio" id="cupsize2"/>
                                        <label for="cupsize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 cupsize">
                                        @if(isset($product) && count($productCupSize) > 0)
                                            @foreach($productCupSize as $cupsize)
                                                <div class="prodCupSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="cup_size[]"
                                                               value="{{ $cupsize->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="cup_size_price[]"
                                                               value="{{ $cupsize->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$cupsize->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="cupsize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Cup Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addCupSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add CupSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Cup Size -->

                                    <!-- Cup Size Color -->
                                    <div class="input-field col s12">
                                        <p>Cup Size Color</p>
                                        <input name="cupsizecolor" value="1" 
                                        @if(isset($product)){{(count($productCupSizeColor)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productCupSizeColor)>0) ? 'checked' : ''}} @endif 
                                               class="isCupSizeColor"
                                               type="radio" id="cupsizecolor1"/>
                                        <label for="cupsizecolor1">Enable</label>
                                        <input name="cupsizecolor" value="0"
                                               @if(isset($product)) {{ (count($productCupSizeColor) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productCupSizeColor) <= 0) ? 'checked' : ''}} @endif
                                               class="isCupSizeColor"
                                               type="radio" id="cupsizecolor2"/>
                                        <label for="cupsizecolor2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 cupsizecolor">
                                        @if(isset($product) && count($productCupSizeColor) > 0)
                                            @foreach($productCupSizeColor as $cupsizecolor)
                                                <div class="prodCupSizeColor">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="cup_size_color_size[]"
                                                               value="{{ $cupsizecolor->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="cup_size_color[]"
                                                               value="{{ $cupsizecolor->desc2 }}" class="demo">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="cup_size_color_price[]"
                                                               value="{{ $cupsizecolor->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$cupsizecolor->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="cupsizecolor_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Cup Size Color</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addCupSizeColor();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add CupSizeColor"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Cup Size Color -->
                                   

                                    <!-- Color Lens Width -->
                                    <div class="input-field col s12">
                                        <p>Color Lens Width</p>
                                        <input name="colorlenswidth" value="1" 
                                        @if(isset($product)){{(count($productColorLensWidth)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColorLensWidth)>0) ? 'checked' : ''}} @endif 
                                               class="isColorLensWidth"
                                               type="radio" id="colorlenswidth1"/>
                                        <label for="colorlenswidth1">Enable</label>
                                        <input name="colorlenswidth" value="0"
                                               @if(isset($product)) {{ (count($productColorLensWidth) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColorLensWidth) <= 0) ? 'checked' : ''}} @endif
                                               class="isColorLensWidth"
                                               type="radio" id="colorlenswidth2"/>
                                        <label for="colorlenswidth2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 colorlenswidth">
                                        @if(isset($product) && count($productColorLensWidth) > 0)
                                            @foreach($productColorLensWidth as $colorlenswidth)
                                                <div class="prodColorLensWidth col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_lens[]"
                                                               value="{{ $colorlenswidth->desc }}" class="demo">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_lens_width[]"
                                                               value="{{ $colorlenswidth->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="color_lens_price[]"
                                                               value="{{ $colorlenswidth->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$colorlenswidth->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="colorlenswidth_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Color Lens Width</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addColorLensWidth();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ColorLensWidth"><i
                                                                    class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Color Lens Width -->
                                   
                                   <!-- Color Magnification Strength -->
                                    <div class="input-field col s12">
                                        <p>Color Magnification Strength</p>
                                        <input name="colormagnificationstrength" value="1" 
                                        @if(isset($product)){{(count($productColorMagnificationStrength)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColorMagnificationStrength)>0) ? 'checked' : ''}} @endif 
                                               class="isColorMagni"
                                               type="radio" id="colormagnificationstrength1"/>
                                        <label for="colormagnificationstrength1">Enable</label>
                                        <input name="colormagnificationstrength" value="0"
                                               @if(isset($product)) {{ (count($productColorMagnificationStrength) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColorMagnificationStrength) <= 0) ? 'checked' : ''}} @endif
                                               class="isColorMagni"
                                               type="radio" id="colormagnificationstrength2"/>
                                        <label for="colormagnificationstrength2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 colormagnificationstrength">
                                        @if(isset($product) && count($productColorMagnificationStrength) > 0)
                                            @foreach($productColorMagnificationStrength as $colormag)
                                                <div class="prodcolor">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_magnification_strength[]"
                                                               value="{{ $colormag->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="colormagnificationstrength_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Color Magnification Strength</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addColorMagnificationStrength();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ColorMagnificationStrength"><i
                                                                    class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Color Magnification Strength -->

                                    <!-- Lens Color -->
                                    <div class="input-field col s12">
                                        <p>Lens Color</p>
                                        <input name="lenscolor" value="1" 
                                        @if(isset($product)){{(count($productLensColor)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productLensColor)>0) ? 'checked' : ''}} @endif 
                                               class="isLensColor"
                                               type="radio" id="lenscolor1"/>
                                        <label for="lenscolor1">Enable</label>
                                        <input name="lenscolor" value="0"
                                               @if(isset($product)) {{ (count($productLensColor) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productLensColor) <= 0) ? 'checked' : ''}} @endif
                                               class="isLensColor"
                                               type="radio" id="lenscolor2"/>
                                        <label for="lenscolor2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 lenscolor">
                                        @if(isset($product) && count($productLensColor) > 0)
                                            @foreach($productLensColor as $lenscolor)
                                                <div class="prodLensColor col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="lens_color[]"
                                                               value="{{ $lenscolor->desc }}" class="demo">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="lens_color_price[]"
                                                               value="{{ $lenscolor->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$lenscolor->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="lenscolor_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Lens Color</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addLensColor();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add LensColor"><i
                                                                    class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Lens Color -->

                                    @endif
                                    <!-- Over from clothing id -->


                                    <!-- Garden & Outdoor Start -->
                                    @if($subcategory->category_id == 49)
                                    <!-- Color Material -->
                                    <div class="input-field col s12">
                                        <p>Color Material</p>
                                        <input name="colormaterial" value="1" 
                                        @if(isset($product)){{(count($productColorMaterial)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColorMaterial)>0) ? 'checked' : ''}} @endif 
                                               class="isColorMaterial"
                                               type="radio" id="colormaterial1"/>
                                        <label for="colormaterial1">Enable</label>
                                        <input name="colormaterial" value="0"
                                               @if(isset($product)) {{ (count($productColorMaterial) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColorMaterial) <= 0) ? 'checked' : ''}} @endif
                                               class="isColorMaterial"
                                               type="radio" id="colormaterial2"/>
                                        <label for="colormaterial2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 colormaterial">
                                        @if(isset($product) && count($productColorMaterial) > 0)
                                            @foreach($productColorMaterial as $colormaterial)
                                                <div class="prodColorMaterial col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_material_color[]"
                                                               value="{{ $colormaterial->desc }}" class='demo'>
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_material[]"
                                                               value="{{ $colormaterial->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="color_material_price[]"
                                                               value="{{ $colormaterial->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$colormaterial->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="colormaterial_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Color Material</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addColorMaterial();"
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
                                    <!-- Color Material -->
                                    @endif
                                    <!-- Garden & Outdoor Over -->

                                    <!-- Grocery-Food & Beverages Start  -->
                                    @if($subcategory->category_id == 24 || $subcategory->category_id == 43)

                                    <!-- Product Flavor -->
                                    <div class="input-field col s12">
                                        <p>Flavor</p>
                                        <input name="productFlavor" value="1" 
                                        @if(isset($product)){{(count($productFlavor)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productFlavor)>0) ? 'checked' : ''}} @endif 
                                               class="isFlavor"
                                               type="radio" id="productFlavor1"/>
                                        <label for="productFlavor1">Enable</label>
                                        <input name="productFlavor" value="0"
                                               @if(isset($product)) {{ (count($productFlavor) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productFlavor) <= 0) ? 'checked' : ''}} @endif
                                               class="isFlavor"
                                               type="radio" id="productFlavor2"/>
                                        <label for="productFlavor2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productFlavor">
                                        @if(isset($product) && count($productFlavor) > 0)
                                            @foreach($productFlavor as $flavor)
                                                <div class="prodFlavor col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="product_flavor[]"
                                                               value="{{ $flavor->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="number" name="product_flavor_price[]"
                                                               value="{{ $flavor->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$flavor->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="flavor_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Product Flavor</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addProductFlavor();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ProductFlavor"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Product Flavor -->

                                    <!-- Product Flavor-Size -->
                                    <div class="input-field col s12">
                                        <p>Flavor Size</p>
                                        <input name="flavorsize" value="1" 
                                        @if(isset($product)){{(count($productFlavorSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productFlavorSize)>0) ? 'checked' : ''}} @endif 
                                               class="isFlavorSize"
                                               type="radio" id="flavorsize1"/>
                                        <label for="flavorsize1">Enable</label>
                                        <input name="flavorsize" value="0"
                                               @if(isset($product)) {{ (count($productFlavorSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productFlavorSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isFlavorSize"
                                               type="radio" id="flavorsize2"/>
                                        <label for="flavorsize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 flavorsize">
                                        @if(isset($product) && count($productFlavorSize) > 0)
                                            @foreach($productFlavorSize as $flavorsize)
                                                <div class="prodFlavorSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="flavor_size_flavor[]"
                                                               value="{{ $flavorsize->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="flavor_size[]"
                                                               value="{{ $flavorsize->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="flavor_size_price[]"
                                                               value="{{ $flavorsize->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$flavorsize->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="flavorsize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Flavor Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addFlavorSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add FlavorSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Product Flavor-Size -->

                                    @endif

                                    @if($subcategory->category_id == 24)

                                    <!-- Product Weight -->
                                    <div class="input-field col s12">
                                        <p>Weight</p>
                                        <input name="productWeight" value="1" 
                                        @if(isset($product)){{(count($productWeight)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productWeight)>0) ? 'checked' : ''}} @endif 
                                               class="isWeight"
                                               type="radio" id="productWeight1"/>
                                        <label for="productWeight1">Enable</label>
                                        <input name="productWeight" value="0"
                                               @if(isset($product)) {{ (count($productWeight) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productWeight) <= 0) ? 'checked' : ''}} @endif
                                               class="isWeight"
                                               type="radio" id="productWeight2"/>
                                        <label for="productWeight2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productWeight">
                                        @if(isset($product) && count($productWeight) > 0)
                                            @foreach($productWeight as $weight)
                                                <div class="prodWeight col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="product_weight[]"
                                                               value="{{ $weight->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="product_weight_price[]"
                                                               value="{{ $weight->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$weight->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="weight_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Product Weight</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addProductWeight();"
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
                                    <!-- Product Weight -->

                                    <!-- Product Flavor-Weight -->
                                    <div class="input-field col s12">
                                        <p>Flavor Weight</p>
                                        <input name="flavorweight" value="1" 
                                        @if(isset($product)){{(count($productFlavorWeight)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productFlavorWeight)>0) ? 'checked' : ''}} @endif 
                                               class="isFlavorWeight"
                                               type="radio" id="flavorweight1"/>
                                        <label for="flavorweight1">Enable</label>
                                        <input name="flavorweight" value="0"
                                               @if(isset($product)) {{ (count($productFlavorWeight) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productFlavorWeight) <= 0) ? 'checked' : ''}} @endif
                                               class="isFlavorWeight"
                                               type="radio" id="flavorweight2"/>
                                        <label for="flavorweight2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 flavorweight">
                                        @if(isset($product) && count($productFlavorWeight) > 0)
                                            @foreach($productFlavorWeight as $flavorweight)
                                                <div class="prodFlavorWeight col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="flavor_weight_flavor[]"
                                                               value="{{ $flavorweight->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="flavor_weight[]"
                                                               value="{{ $flavorweight->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="flavor_weight_price[]"
                                                               value="{{ $flavorweight->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$flavorweight->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="flavorweight_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Flavor Weight</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addFlavorWeight();"
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
                                    <!-- Product Flavor-Weight -->
                                    @endif 
                                    <!-- Grocery-Food & Beverages over  -->


                                    <!-- Home & Lightings Start OR Jwellery OR Office OR SPORT -->
                                    @if($subcategory->category_id == 40 || $subcategory->category_id == 39 || $subcategory->category_id == 42 || $subcategory->category_id == 44  || $subcategory->category_id == 17)
                                    <!-- Product Material -->
                                    <div class="input-field col s12">
                                        <p>Material</p>
                                        <input name="productmaterial" value="1" 
                                        @if(isset($product)){{(count($productMaterial)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColors)>0) ? 'checked' : ''}} @endif 
                                               class="isProductMaterial"
                                               type="radio" id="productmaterial1"/>
                                        <label for="productmaterial1">Enable</label>
                                        <input name="productmaterial" value="0"
                                               @if(isset($product)) {{ (count($productMaterial) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productMaterial) <= 0) ? 'checked' : ''}} @endif
                                               class="isProductMaterial"
                                               type="radio" id="productmaterial2"/>
                                        <label for="productmaterial2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 productmaterial">
                                        @if(isset($product) && count($productMaterial) > 0)
                                            @foreach($productMaterial as $material)
                                                <div class="prodMaterial col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="product_material[]"
                                                            value="{{ $material->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="product_material_price[]"
                                                            value="{{ $material->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$material->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="productmaterial_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Product Material</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addProductMaterial();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Product Material"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Product Material -->
                                    @endif

                                    @if($subcategory->category_id == 40 || $subcategory->category_id == 44)
                                    <!-- Material Size --> 
                                    <div class="input-field col s12">
                                        <p>Material Size</p>
                                        <input name="materialsize" value="1" 
                                        @if(isset($product)){{(count($productMaterialSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productMaterialSize)>0) ? 'checked' : ''}} @endif 
                                               class="isMaterialSize"
                                               type="radio" id="materialsize1"/>
                                        <label for="materialsize1">Enable</label>
                                        <input name="materialsize" value="0"
                                               @if(isset($product)) {{ (count($productMaterialSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productMaterialSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isMaterialSize"
                                               type="radio" id="materialsize2"/>
                                        <label for="materialsize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 materialsize">
                                        @if(isset($product) && count($productMaterialSize) > 0)
                                            @foreach($productMaterialSize as $materialsize)
                                                <div class="prodMaterialSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="material_size_material[]"
                                                               value="{{ $materialsize->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="material_size[]"
                                                               value="{{ $materialsize->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="material_size_price[]"
                                                               value="{{ $materialsize->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$materialsize->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="materialsize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Material Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addMaterialSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Material Size"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- Product Material -->
                                    @endif
                                    <!-- Home & Lightings -->

                                    @if($subcategory->category_id == 39)
                                    <!-- Jwellery Main -->
                                    <!-- Metal Type -->
                                    <div class="input-field col s12">
                                        <p>Metal Type</p>
                                        <input name="metaltype" value="1" 
                                        @if(isset($product)){{(count($productMetalType)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productMetalType)>0) ? 'checked' : ''}} @endif 
                                               class="isMetalType"
                                               type="radio" id="metaltype1"/>
                                        <label for="metaltype1">Enable</label>
                                        <input name="metaltype" value="0"
                                               @if(isset($product)) {{ (count($productMetalType) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productMetalType) <= 0) ? 'checked' : ''}} @endif
                                               class="isMetalType"
                                               type="radio" id="metaltype2"/>
                                        <label for="metaltype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 metaltype">
                                        @if(isset($product) && count($productMetalType) > 0)
                                            @foreach($productMetalType as $metaltype)
                                                <div class="prodMetalType col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="metal_type[]"
                                                               value="{{ $metaltype->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="metal_type_price[]"
                                                               value="{{ $metaltype->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$metaltype->screenshots) }}"
                                                            class="img-responsive" height="100" width="100"
                                                            alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="metaltype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Metal Type</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addMetalType();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Metal Type"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Metal Type -->

                                    <!-- SizePerPearl -->
                                    <div class="input-field col s12">
                                        <p>Size Per Pearl</p>
                                        <input name="sizeperpearl" value="1" 
                                        @if(isset($product)){{(count($productSizePerPearl)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productSizePerPearl)>0) ? 'checked' : ''}} @endif 
                                               class="isSizePerPearl"
                                               type="radio" id="sizeperpearl1"/>
                                        <label for="sizeperpearl1">Enable</label>
                                        <input name="sizeperpearl" value="0"
                                               @if(isset($product)) {{ (count($productSizePerPearl) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productSizePerPearl) <= 0) ? 'checked' : ''}} @endif
                                               class="isSizePerPearl"
                                               type="radio" id="sizeperpearl2"/>
                                        <label for="sizeperpearl2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 sizeperpearl">
                                        @if(isset($product) && count($productSizePerPearl) > 0)
                                            @foreach($productSizePerPearl as $sizeperpearl)
                                                <div class="prodcolor">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="size_per_pearl[]"
                                                               value="{{ $sizeperpearl->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="size_per_pearl_price[]"
                                                               value="{{ $sizeperpearl->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$sizeperpearl->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="sizeperpearl_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Size Per Pearl</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addSizePerPearl();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add SizePerPearl"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- SizePerPearl-->

                                    <!-- Color-MetalType -->
                                    <div class="input-field col s12">
                                        <p>Color MetalType</p>
                                        <input name="colormetaltype" value="1" 
                                        @if(isset($product)){{(count($productColorMetalType)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColorMetalType)>0) ? 'checked' : ''}} @endif 
                                               class="isColorMetalType"
                                               type="radio" id="colormetaltype1"/>
                                        <label for="colormetaltype1">Enable</label>
                                        <input name="colormetaltype" value="0"
                                               @if(isset($product)) {{ (count($productColorMetalType) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColorMetalType) <= 0) ? 'checked' : ''}} @endif
                                               class="isColorMetalType"
                                               type="radio" id="colormetaltype2"/>
                                        <label for="colormetaltype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 colormetaltype">
                                        @if(isset($product) && count($productColorMetalType) > 0)
                                            @foreach($productColorMetalType as $colormetaltype)
                                                <div class="prodColorMetalType col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_metaltype_color[]"
                                                               value="{{ $colormetaltype->desc }}" class="demo">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_metaltype[]"
                                                               value="{{ $colormetaltype->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="color_metaltype_price[]"
                                                               value="{{ $colormetaltype->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$colormetaltype->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="colormetaltype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Color MetalType</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addColorMetalType();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ColorMetalType"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Color-MetalType-->

                                    <!-- Color-ItemLength -->
                                    <div class="input-field col s12">
                                        <p>Color-ItemLength</p>
                                        <input name="coloritemlength" value="1" 
                                        @if(isset($product)){{(count($productColorItemLength)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColorItemLength)>0) ? 'checked' : ''}} @endif 
                                               class="isColorItemLength"
                                               type="radio" id="coloritemlength1"/>
                                        <label for="coloritemlength1">Enable</label>
                                        <input name="coloritemlength" value="0"
                                               @if(isset($product)) {{ (count($productColorItemLength) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColorItemLength) <= 0) ? 'checked' : ''}} @endif
                                               class="isColorItemLength"
                                               type="radio" id="coloritemlength2"/>
                                        <label for="coloritemlength2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 coloritemlength">
                                        @if(isset($product) && count($productColorItemLength) > 0)
                                            @foreach($productColorItemLength as $coloritemlength)
                                                <div class="prodcolor">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_itemlength_color[]"
                                                               value="{{ $coloritemlength->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_itemlength[]"
                                                               value="{{ $coloritemlength->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="color_itemlength_price[]"
                                                               value="{{ $coloritemlength->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$coloritemlength->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="coloritemlength_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Color ItemLength</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addColorItemLength();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ColorItemLength"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Color-ItemLength-->

                                    <!-- GemType -->
                                    <div class="input-field col s12">
                                        <p>GemType</p>
                                        <input name="gemtype" value="1" 
                                        @if(isset($product)){{(count($productGemType)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productGemType)>0) ? 'checked' : ''}} @endif 
                                               class="isGemType"
                                               type="radio" id="gemtype1"/>
                                        <label for="gemtype1">Enable</label>
                                        <input name="gemtype" value="0"
                                               @if(isset($product)) {{ (count($productGemType) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productGemType) <= 0) ? 'checked' : ''}} @endif
                                               class="isGemType"
                                               type="radio" id="gemtype2"/>
                                        <label for="gemtype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 gemtype">
                                        @if(isset($product) && count($productGemType) > 0)
                                            @foreach($productGemType as $gemtype)
                                                <div class="prodGemType col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="gem_type[]"
                                                               value="{{ $gemtype->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="gem_type_price[]"
                                                               value="{{ $gemtype->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$gemtype->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="gemtype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Gem Type</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addGemType();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add GemType"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- GemType -->

                                    <!-- Metaltype-GemType -->
                                    <div class="input-field col s12">
                                        <p>Metaltype-GemType</p>
                                        <input name="metalgemtype" value="1" 
                                        @if(isset($product)){{(count($productMetalTypeGemType)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productMetalTypeGemType)>0) ? 'checked' : ''}} @endif 
                                               class="isMetalGemType"
                                               type="radio" id="metalgemtype1"/>
                                        <label for="metalgemtype1">Enable</label>
                                        <input name="metalgemtype" value="0"
                                               @if(isset($product)) {{ (count($productMetalTypeGemType) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productMetalTypeGemType) <= 0) ? 'checked' : ''}} @endif
                                               class="isMetalGemType"
                                               type="radio" id="metalgemtype2"/>
                                        <label for="metalgemtype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 metalgemtype">
                                        @if(isset($product) && count($productMetalTypeGemType) > 0)
                                            @foreach($productMetalTypeGemType as $metgemtype)
                                                <div class="prodMetalTypeGemType col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="metalgemtype_metaltype[]"
                                                            value="{{ $metgemtype->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="metalgemtype_gemtype[]"
                                                            value="{{ $metgemtype->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="metalgemtype_price[]"
                                                               value="{{ $metgemtype->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$metgemtype->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="metalgemtype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">MetalType GemType</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addMetalGemType();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add MetalTypeGemType"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Metaltype-GemType -->

                                    <!-- TotalGemWeight -->
                                    <div class="input-field col s12">
                                        <p>Total Gem Weight</p>
                                        <input name="totalgemweight" value="1" 
                                        @if(isset($product)){{(count($productTotalGemWeight)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productTotalGemWeight)>0) ? 'checked' : ''}} @endif 
                                               class="isTotalGemWeight"
                                               type="radio" id="totalgemweight1"/>
                                        <label for="totalgemweight1">Enable</label>
                                        <input name="totalgemweight" value="0"
                                               @if(isset($product)) {{ (count($productTotalGemWeight) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productTotalGemWeight) <= 0) ? 'checked' : ''}} @endif
                                               class="isTotalGemWeight"
                                               type="radio" id="totalgemweight2"/>
                                        <label for="totalgemweight2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 totalgemweight">
                                        @if(isset($product) && count($productTotalGemWeight) > 0)
                                            @foreach($productTotalGemWeight as $totalgemweight)
                                                <div class="prodTotalGemWeight col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="total_gemweight[]"
                                                            value="{{ $totalgemweight->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="total_gemweight_price[]"
                                                            value="{{ $totalgemweight->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$totalgemweight->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="totalgemweight_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Total Gem Weight</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addTotalGemWeight();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add TotalGemWeight"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- TotalGemWeight -->

                                    <!-- TotalDiamondWeight -->
                                    <div class="input-field col s12">
                                        <p>Total Diamond Weight</p>
                                        <input name="totaldiamondweight" value="1" 
                                        @if(isset($product)){{(count($productTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                               class="isTotalDiamondWeight"
                                               type="radio" id="totaldiamondweight1"/>
                                        <label for="totaldiamondweight1">Enable</label>
                                        <input name="totaldiamondweight" value="0"
                                               @if(isset($product)) {{ (count($productTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               class="isTotalDiamondWeight"
                                               type="radio" id="totaldiamondweight2"/>
                                        <label for="totaldiamondweight2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 totaldiamondweight">
                                        @if(isset($product) && count($productTotalDiamondWeight) > 0)
                                            @foreach($productTotalDiamondWeight as $totaldiaweight)
                                                <div class="prodTotalDiamondWeight col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="total_diamondweight[]"
                                                            value="{{ $totaldiaweight->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="total_diamondweight_price[]"
                                                            value="{{ $totaldiaweight->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$totaldiaweight->screenshots) }}"
                                                            class="img-responsive" height="100" width="100"  alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="totaldiamondweight_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Total Diamond Weight</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addTotalDiamondWeight();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add TotalDiamondWeight"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- TotalDiamondWeight -->

                                    <!-- MetalType-TotalDiamondWeight -->
                                    <div class="input-field col s12">
                                        <p>MetalType-TotalDiamondWeight</p>
                                        <input name="metaltypetotaldiamondweight" value="1" 
                                        @if(isset($product)){{(count($productMetalTypeTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productMetalTypeTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                               class="isMetalTypeTotalDiamondWeight"
                                               type="radio" id="metaltypetotaldiamondweight1"/>
                                        <label for="metaltypetotaldiamondweight1">Enable</label>
                                        <input name="metaltypetotaldiamondweight" value="0"
                                               @if(isset($product)) {{ (count($productMetalTypeTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productMetalTypeTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               class="isMetalTypeTotalDiamondWeight"
                                               type="radio" id="metaltypetotaldiamondweight2"/>
                                        <label for="metaltypetotaldiamondweight2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 metaltypetotaldiamondweight">
                                        @if(isset($product) && count($productMetalTypeTotalDiamondWeight) > 0)
                                            @foreach($productMetalTypeTotalDiamondWeight as $value)
                                                <div class="prodMetalTypeTotalDiamondWeight col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="metaltype_totaldiamondweight_metaltype[]"
                                                            value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="metaltype_totaldiamondweight_diamondweight[]"
                                                            value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="metaltype_totaldiamondweight_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="metaltypetotaldiamondweight_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">MetalType-TotalDiamondWeight</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addMetalTypeTotalDiamondWeight();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add MetalTypeTotalDiamondWeight"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- MetalType-TotalDiamondWeight -->

                                     <!-- ItemLength-Gemtype -->
                                    <div class="input-field col s12">
                                        <p>ItemLength-Gemtype</p>
                                        <input name="itemlengthgemtype" value="1" 
                                        @if(isset($product)){{(count($productItemLengthGemType)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productItemLengthGemType)>0) ? 'checked' : ''}} @endif 
                                               class="isItemLengthGemtype"
                                               type="radio" id="itemlengthgemtype1"/>
                                        <label for="itemlengthgemtype1">Enable</label>
                                        <input name="itemlengthgemtype" value="0"
                                               @if(isset($product)) {{ (count($productItemLengthGemType) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productItemLengthGemType) <= 0) ? 'checked' : ''}} @endif
                                               class="isItemLengthGemtype"
                                               type="radio" id="itemlengthgemtype2"/>
                                        <label for="itemlengthgemtype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 itemlengthgemtype">
                                        @if(isset($product) && count($productItemLengthGemType) > 0)
                                            @foreach($productItemLengthGemType as $value)
                                                <div class="prodItemLengthGemType col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_gemtype_itemlength[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_gemtype[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="itemlength_gemtype_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="itemlengthgemtype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">ItemLength-Gemtype</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addItemLengthGemtype();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ItemLengthGemtype"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- ItemLength-Gemtype -->

                                    <!-- ItemLength-Material -->
                                    <div class="input-field col s12">
                                        <p>ItemLength-Material</p>
                                        <input name="itemlengthmaterial" value="1" 
                                        @if(isset($product)){{(count($productItemLengthMaterial)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productItemLengthMaterial)>0) ? 'checked' : ''}} @endif 
                                               class="isItemLengthMaterial"
                                               type="radio" id="itemlengthmaterial1"/>
                                        <label for="itemlengthmaterial1">Enable</label>
                                        <input name="itemlengthmaterial" value="0"
                                               @if(isset($product)) {{ (count($productItemLengthMaterial) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productItemLengthMaterial) <= 0) ? 'checked' : ''}} @endif
                                               class="isItemLengthMaterial"
                                               type="radio" id="itemlengthmaterial2"/>
                                        <label for="itemlengthmaterial2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 itemlengthmaterial">
                                        @if(isset($product) && count($productItemLengthMaterial) > 0)
                                            @foreach($productItemLengthMaterial as $value)
                                                <div class="prodItemLengthMaterial col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_material_itemlength[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_material[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="itemlength_material_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="itemlengthmaterial_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">ItemLength-Material</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addItemLengthMaterial();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ItemLengthMaterial"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- ItemLength-Material -->

                                    <!-- ItemLength-SizePerPearl -->
                                    <div class="input-field col s12">
                                        <p>ItemLength-SizePerPearl</p>
                                        <input name="itemlengthsizeperpearl" value="1" 
                                        @if(isset($product)){{(count($productItemLengthSizePerPearl)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productItemLengthSizePerPearl)>0) ? 'checked' : ''}} @endif 
                                               class="isItemLengthSizePerPearl"
                                               type="radio" id="itemlengthsizeperpearl1"/>
                                        <label for="itemlengthsizeperpearl1">Enable</label>
                                        <input name="itemlengthsizeperpearl" value="0"
                                               @if(isset($product)) {{ (count($productItemLengthSizePerPearl) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productItemLengthSizePerPearl) <= 0) ? 'checked' : ''}} @endif
                                               class="isItemLengthSizePerPearl"
                                               type="radio" id="itemlengthsizeperpearl2"/>
                                        <label for="itemlengthsizeperpearl2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 itemlengthsizeperpearl">
                                        @if(isset($product) && count($productItemLengthSizePerPearl) > 0)
                                            @foreach($productItemLengthSizePerPearl as $value)
                                                <div class="prodItemLengthSizePerPearl col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_sizeperpearl_itemlength[]"
                                                            value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_sizeperpearl[]"
                                                            value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="itemlength_sizeperpearl_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="itemlengthsizeperpearl_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">ItemLength-SizePerPearl</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addItemLengthSizePerPearl();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ItemLengthSizePerPearl"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- ItemLength-SizePerPearl -->

                                    <!-- ItemLength-MetalType -->
                                    <div class="input-field col s12">
                                        <p>ItemLength-MetalType</p>
                                        <input name="itemlengthmetaltype" value="1" 
                                        @if(isset($product)){{(count($productItemLengthMetalType)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productItemLengthMetalType)>0) ? 'checked' : ''}} @endif 
                                               class="isItemLengthMetalType"
                                               type="radio" id="itemlengthmetaltype1"/>
                                        <label for="itemlengthmetaltype1">Enable</label>
                                        <input name="itemlengthmetaltype" value="0"
                                               @if(isset($product)) {{ (count($productItemLengthMetalType) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productItemLengthMetalType) <= 0) ? 'checked' : ''}} @endif
                                               class="isItemLengthMetalType"
                                               type="radio" id="itemlengthmetaltype2"/>
                                        <label for="itemlengthmetaltype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 itemlengthmetaltype">
                                        @if(isset($product) && count($productItemLengthMetalType) > 0)
                                            @foreach($productItemLengthMetalType as $value)
                                                <div class="prodItemLengthMetalType col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_metaltype_itemlength[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_metaltype[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="itemlength_metaltype_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="itemlengthmetaltype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">ItemLength-MetalType</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addItemLengthMetalType();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ItemLengthMetalType"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- ItemLength-MetalType -->

                                    <!-- ItemLength-TotalDiamondWeight -->
                                    <div class="input-field col s12">
                                        <p>ItemLength-TotalDiamondWeight</p>
                                        <input name="itemlengthtotaldiamondweight" value="1" 
                                        @if(isset($product)){{(count($productItemLengthTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productItemLengthTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                               class="isItemLengthTotalDiamondWeight"
                                               type="radio" id="itemlengthtotaldiamondweight1"/>
                                        <label for="itemlengthtotaldiamondweight1">Enable</label>
                                        <input name="itemlengthtotaldiamondweight" value="0"
                                               @if(isset($product)) {{ (count($productItemLengthTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productItemLengthTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               class="isItemLengthTotalDiamondWeight"
                                               type="radio" id="itemlengthtotaldiamondweight2"/>
                                        <label for="itemlengthtotaldiamondweight2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 itemlengthtotaldiamondweight">
                                        @if(isset($product) && count($productItemLengthTotalDiamondWeight) > 0)
                                            @foreach($productItemLengthTotalDiamondWeight as $value)
                                                <div class="prodItemLengthTotalDiamondWeight col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_totaldiamondweight_itemlength[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="itemlength_totaldiamondweight[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="itemlength_totaldiamondweight_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="itemlengthtotaldiamondweight_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">ItemLength-TotalDiamondWeight</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addItemLengthTotalDiamondWeight();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ItemLengthTotalDiamondWeight"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- ItemLength-TotalDiamondWeight -->

                                    <!-- ItemLength -->
                                    <div class="input-field col s12">
                                        <p>ItemLength</p>
                                        <input name="itemlength" value="1" 
                                        @if(isset($product)){{(count($productItemLength)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productItemLength)>0) ? 'checked' : ''}} @endif 
                                               class="isItemLength"
                                               type="radio" id="itemlength1"/>
                                        <label for="itemlength1">Enable</label>
                                        <input name="itemlength" value="0"
                                               @if(isset($product)) {{ (count($productItemLength) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productItemLength) <= 0) ? 'checked' : ''}} @endif
                                               class="isItemLength"
                                               type="radio" id="itemlength2"/>
                                        <label for="itemlength2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 itemlength">
                                        @if(isset($product) && count($productItemLength) > 0)
                                            @foreach($productItemLength as $value)
                                                <div class="prodItemLength col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="item_length[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="item_length[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="itemlength_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">ItemLength</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addItemLength();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ItemLength"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- ItemLength-->
                                    <!-- RingSize -->
                                    <div class="input-field col s12">
                                        <p>RingSize</p>
                                        <input name="ringsize" value="1" 
                                        @if(isset($product)){{(count($productRingSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productRingSize)>0) ? 'checked' : ''}} @endif 
                                               class="isRingSize"
                                               type="radio" id="ringsize1"/>
                                        <label for="ringsize1">Enable</label>
                                        <input name="ringsize" value="0"
                                               @if(isset($product)) {{ (count($productRingSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productRingSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isRingSize"
                                               type="radio" id="ringsize2"/>
                                        <label for="ringsize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 ringsize">
                                        @if(isset($product) && count($productRingSize) > 0)
                                            @foreach($productRingSize as $value)
                                                <div class="prodRingSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="ring_size[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="ring_size_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="ringsize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">RingSize</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addRingSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add RingSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- RingSize-->
                                
                                    <!-- MetalType-RingSize -->
                                    <div class="input-field col s12">
                                        <p>MetalType-RingSize</p>
                                        <input name="metaltyperingsize" value="1" 
                                        @if(isset($product)){{(count($productMetalTypeRingSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productMetalTypeRingSize)>0) ? 'checked' : ''}} @endif 
                                               class="isMetalTypeRingSize"
                                               type="radio" id="metaltyperingsize1"/>
                                        <label for="metaltyperingsize1">Enable</label>
                                        <input name="metaltyperingsize" value="0"
                                               @if(isset($product)) {{ (count($productMetalTypeRingSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productMetalTypeRingSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isMetalTypeRingSize"
                                               type="radio" id="metaltyperingsize2"/>
                                        <label for="metaltyperingsize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 metaltyperingsize">
                                        @if(isset($product) && count($productMetalTypeRingSize) > 0)
                                            @foreach($productMetalTypeRingSize as $value)
                                                <div class="prodtMetalTypeRingSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="metaltype_ringsize_metaltype[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="metaltype_ringsize[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="metaltype_ringsize_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="metaltyperingsize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">MetalType-RingSize</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addMetalTypeRingSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add MetalTypeRingSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- MetalType-RingSize-->

                                    <!-- Color-RingSize -->
                                    <div class="input-field col s12">
                                        <p>Color-RingSize</p>
                                        <input name="colorringsize" value="1" 
                                        @if(isset($product)){{(count($productColorRingSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColorRingSize)>0) ? 'checked' : ''}} @endif 
                                               class="isColorRingSize"
                                               type="radio" id="colorringsize1"/>
                                        <label for="colorringsize1">Enable</label>
                                        <input name="metaltyperingsize" value="0"
                                               @if(isset($product)) {{ (count($productColorRingSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productColorRingSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isColorRingSize"
                                               type="radio" id="colorringsize2"/>
                                        <label for="colorringsize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 colorringsize">
                                        @if(isset($product) && count($productColorRingSize) > 0)
                                            @foreach($productColorRingSize as $value)
                                                <div class="prodColorRingSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_ringsize_color[]"
                                                               value="{{ $value->desc }}" class="demo">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="color_ringsize[]"
                                                            value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="color_ringsize_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="colorringsize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Color-RingSize</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addColorRingSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ColorRingSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Color-RingSize-->

                                    <!-- RingSize-GemType -->
                                    <div class="input-field col s12">
                                        <p>RingSize-GemType</p>
                                        <input name="ringsizegemtype" value="1" 
                                        @if(isset($product)){{(count($productRingSizeGemType)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productRingSizeGemType)>0) ? 'checked' : ''}} @endif 
                                               class="isRingSizeGemType"
                                               type="radio" id="ringsizegemtype1"/>
                                        <label for="ringsizegemtype1">Enable</label>
                                        <input name="ringsizegemtype" value="0"
                                               @if(isset($product)) {{ (count($productRingSizeGemType) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productRingSizeGemType) <= 0) ? 'checked' : ''}} @endif
                                               class="isRingSizeGemType"
                                               type="radio" id="ringsizegemtype2"/>
                                        <label for="ringsizegemtype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 ringsizegemtype">
                                        @if(isset($product) && count($productRingSizeGemType) > 0)
                                            @foreach($productRingSizeGemType as $value)
                                                <div class="prodRingSizeGemType col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="ringsize_gemtype_ringsize[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="ringsize_gemtype[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="ringsize_gemtype_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="ringsizegemtype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">RingSize-GemType</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addRingSizeGemType();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add RingSizeGemType"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- RingSize-GemType -->

                                    <!-- RingSize-TotalDiamondWeight -->
                                    <div class="input-field col s12">
                                        <p>RingSize-TotalDiamondWeight</p>
                                        <input name="ringsizetotaldiamondweight" value="1" 
                                        @if(isset($product)){{(count($productRingSizeTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productRingSizeTotalDiamondWeight)>0) ? 'checked' : ''}} @endif 
                                               class="isRingSizeTotalDiamondWeight"
                                               type="radio" id="ringsizetotaldiamondweight1"/>
                                        <label for="ringsizetotaldiamondweight1">Enable</label>
                                        <input name="ringsizetotaldiamondweight" value="0"
                                               @if(isset($product)) {{ (count($productRingSizeTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productRingSizeTotalDiamondWeight) <= 0) ? 'checked' : ''}} @endif
                                               class="isRingSizeTotalDiamondWeight"
                                               type="radio" id="ringsizetotaldiamondweight2"/>
                                        <label for="ringsizetotaldiamondweight2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 ringsizetotaldiamondweight">
                                        @if(isset($product) && count($productRingSizeTotalDiamondWeight) > 0)
                                            @foreach($productRingSizeTotalDiamondWeight as $value)
                                                <div class="prodRingSizeTotalDiamondWeight col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="ringsize_totaldiamondweight_ringsize[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="ringsize_totaldiamondweight[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="ringsize_totaldiamondweight_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="ringsizetotaldiamondweight_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">RingSize-TotalDiamondWeight</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addRingSizeTotalDiamondWeight();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add RingSizeTotalDiamondWeight"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- RingSize-TotalDiamondWeight -->
                                    <!-- Jwellery over -->
                                    @endif

                                    @if($subcategory->category_id == 42)
                                    <!-- Office Supplies Start -->
                                    <!-- NumberOfItems -->
                                    <div class="input-field col s12">
                                        <p>Number Of Items</p>
                                        <input name="numberofitems" value="1" 
                                        @if(isset($product)){{(count($productNumberOfItems)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productNumberOfItems)>0) ? 'checked' : ''}} @endif 
                                               class="isNumberOfItems"
                                               type="radio" id="numberofitems1"/>
                                        <label for="numberofitems1">Enable</label>
                                        <input name="numberofitems" value="0"
                                               @if(isset($product)) {{ (count($productNumberOfItems) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productNumberOfItems) <= 0) ? 'checked' : ''}} @endif
                                               class="isNumberOfItems"
                                               type="radio" id="numberofitems2"/>
                                        <label for="numberofitems2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 numberofitems">
                                        @if(isset($product) && count($productNumberOfItems) > 0)
                                            @foreach($productNumberOfItems as $value)
                                                <div class="prodNumberOfItems col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="number_of_items[]"
                                                            value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="number_of_items_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="numberofitems_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Number Of Items</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addNumberOfItems();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add NumberOfItems"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- NumberOfItems -->

                                    <!-- PaperSize -->
                                    <div class="input-field col s12">
                                        <p>Paper Size</p>
                                        <input name="papersize" value="1" 
                                        @if(isset($product)){{(count($productPapersize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productPapersize)>0) ? 'checked' : ''}} @endif 
                                               class="isPaperSize"
                                               type="radio" id="papersize1"/>
                                        <label for="papersize1">Enable</label>
                                        <input name="papersize" value="0"
                                               @if(isset($product)) {{ (count($productPapersize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productPapersize) <= 0) ? 'checked' : ''}} @endif
                                               class="isPaperSize"
                                               type="radio" id="papersize2"/>
                                        <label for="papersize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 papersize">
                                        @if(isset($product) && count($productPapersize) > 0)
                                            @foreach($productPapersize as $value)
                                                <div class="prodPapersize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="paper_size[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="paper_size_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="papersize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Paper Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addPaperSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add PaperSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- PaperSize -->

                                     <!-- MaximumExpandableSize -->
                                    <div class="input-field col s12">
                                        <p>Maximum Expandable Size</p>
                                        <input name="maximumexpandablesize" value="1" 
                                        @if(isset($product)){{(count($productMaximumExpandableSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productMaximumExpandableSize)>0) ? 'checked' : ''}} @endif 
                                               class="isMaximumExpandableSize"
                                               type="radio" id="maximumexpandablesize1"/>
                                        <label for="maximumexpandablesize1">Enable</label>
                                        <input name="papersize" value="0"
                                               @if(isset($product)) {{ (count($productMaximumExpandableSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productMaximumExpandableSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isMaximumExpandableSize"
                                               type="radio" id="maximumexpandablesize2"/>
                                        <label for="maximumexpandablesize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 maximumexpandablesize">
                                        @if(isset($product) && count($productMaximumExpandableSize) > 0)
                                            @foreach($productMaximumExpandableSize as $value)
                                                <div class="prodMaximumExpandableSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="maximum_expandable_size[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="maximum_expandable_size_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button" data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="maximumexpandablesize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Maximum Expandable Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addMaximumExpandableSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add MaximumExpandableSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- MaximumExpandableSize -->

                                    <!-- LineSize -->
                                    <div class="input-field col s12">
                                        <p>Line Size</p>
                                        <input name="linesize" value="1" 
                                        @if(isset($product)){{(count($productLinesize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productLinesize)>0) ? 'checked' : ''}} @endif 
                                               class="isLineSize"
                                               type="radio" id="linesize1"/>
                                        <label for="linesize1">Enable</label>
                                        <input name="papersize" value="0"
                                               @if(isset($product)) {{ (count($productLinesize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productLinesize) <= 0) ? 'checked' : ''}} @endif
                                               class="isLineSize"
                                               type="radio" id="linesize2"/>
                                        <label for="linesize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 linesize">
                                        @if(isset($product) && count($productLinesize) > 0)
                                            @foreach($productLinesize as $value)
                                                <div class="prodLinesize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="line_size[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="line_size_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="linesize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Line Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addLineSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add LineSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- LineSize -->
                                    @endif
                                    <!-- Office -->

                                    <!-- Shoes & Handbags -->
                                    @if($subcategory->category_id == 44)
                                    <!-- Style Size --> 
                                    <div class="input-field col s12">
                                        <p>Style Size</p>
                                        <input name="stylesize" value="1" 
                                        @if(isset($product)){{(count($productStyleSize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productStyleSize)>0) ? 'checked' : ''}} @endif 
                                               class="isStyleSize"
                                               type="radio" id="stylesize1"/>
                                        <label for="stylesize1">Enable</label>
                                        <input name="stylesize" value="0"
                                               @if(isset($product)) {{ (count($productStyleSize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productStyleSize) <= 0) ? 'checked' : ''}} @endif
                                               class="isStyleSize"
                                               type="radio" id="stylesize2"/>
                                        <label for="stylesize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 stylesize">
                                        @if(isset($product) && count($productStyleSize) > 0)
                                            @foreach($productStyleSize as $value)
                                                <div class="prodStyleSize col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="style_size_style[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s3">
                                                        <input type="text" name="style_size[]"
                                                               value="{{ $value->desc2 }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="style_size_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="stylesize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Style Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addStyleSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add StyleSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        @endif
                                    </div>
                                    <!-- StyleSize -->

                                    <!-- Shoes Style --> 
                                    <div class="input-field col s12">
                                        <p>Style</p>
                                        <input name="shoesstyle" value="1" 
                                        @if(isset($product)){{(count($productShoesStyle)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productShoesStyle)>0) ? 'checked' : ''}} @endif 
                                               class="isShoesStyle"
                                               type="radio" id="shoesstyle1"/>
                                        <label for="shoesstyle1">Enable</label>
                                        <input name="stylesize" value="0"
                                               @if(isset($product)) {{ (count($productShoesStyle) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productShoesStyle) <= 0) ? 'checked' : ''}} @endif
                                               class="isShoesStyle"
                                               type="radio" id="shoesstyle2"/>
                                        <label for="shoesstyle2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 shoesstyle">
                                        @if(isset($product) && count($productShoesStyle) > 0)
                                            @foreach($productShoesStyle as $value)
                                                <div class="productShoesStyle col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="shoes_style[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="shoes_style_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="shoesstyle_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Style</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addShoesStyle();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ShoesStyle"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Shoes Style -->
                                    @endif
                                    <!-- Shoes & Handbags -->

                                    <!-- Watches -->
                                    @if($subcategory->category_id == 47)
                                    <!-- bandcolor -->
                                    <div class="input-field col s12">
                                        <p>Band Color</p>
                                        <input name="bandcolor" value="1" 
                                        @if(isset($product)){{(count($productBandcolor)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productBandcolor)>0) ? 'checked' : ''}} @endif 
                                               class="isBandColor"
                                               type="radio" id="bandcolor1"/>
                                        <label for="bandcolor1">Enable</label>
                                        <input name="size_color" value="0"
                                               @if(isset($product)) {{ (count($productBandcolor) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productBandcolor) <= 0) ? 'checked' : ''}} @endif
                                               class="isBandColor"
                                               type="radio" id="bandcolor2"/>
                                        <label for="bandcolor2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 bandcolor">
                                        @if(isset($product) && count($productBandcolor) > 0)
                                            @foreach($productBandcolor as $value)
                                                <div class="prodBandcolor col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="band_color[]"
                                                               value="{{ $value->desc }}" class="demo">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="band_color_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="bandcolor_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Band Color</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addBandColor();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add BandColor"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- bandcolor -->
                                    @endif
                                    <!-- Watches -->


                                    @if($subcategory->category_id == 17)
                                    <!-- Sports -->
                                    <div class="input-field col s12">
                                        <p>Golf Loft</p>
                                        <input name="golfloft" value="1" 
                                        @if(isset($product)){{(count($productGolfloft)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productGolfloft)>0) ? 'checked' : ''}} @endif 
                                               class="isGolfLoft"
                                               type="radio" id="golfloft1"/>
                                        <label for="golfloft1">Enable</label>
                                        <input name="golfloft" value="0"
                                               @if(isset($product)) {{ (count($productGolfloft) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productGolfloft) <= 0) ? 'checked' : ''}} @endif
                                               class="isGolfLoft"
                                               type="radio" id="golfloft2"/>
                                        <label for="golfloft2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 golfloft">
                                        @if(isset($product) && count($productGolfloft) > 0)
                                            @foreach($productGolfloft as $value)
                                                <div class="prodGolfloft col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="golf_loft[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="golf_loft_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$size->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="golfloft_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Golf Loft</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addGolfLoft();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add GolfLoft"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Golf Flex Material</p>
                                        <input name="golfflexmaterial" value="1" 
                                        @if(isset($product)){{(count($productGolfFlexMaterial)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productGolfFlexMaterial)>0) ? 'checked' : ''}} @endif 
                                               class="isGolfFlexMaterial"
                                               type="radio" id="golfflexmaterial1"/>
                                        <label for="golfflexmaterial1">Enable</label>
                                        <input name="golfflexmaterial" value="0"
                                               @if(isset($product)) {{ (count($productGolfFlexMaterial) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productGolfFlexMaterial) <= 0) ? 'checked' : ''}} @endif
                                               class="isGolfFlexMaterial"
                                               type="radio" id="golfflexmaterial1"/>
                                        <label for="golfflexmaterial1">Disable</label>
                                    </div>

                                    <div class="input-field col s12 golfflexmaterial">
                                        @if(isset($product) && count($productGolfFlexMaterial) > 0)
                                            @foreach($productGolfFlexMaterial as $value)
                                                <div class="prodGolfFlexMaterial col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="golf_flexmaterial[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="golf_flexmaterial_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="golfflexmaterial_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Golf Flex Material</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addGolfFlexMaterial();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add GolfFlexMaterial"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Golf Flex Shaft Material</p>
                                        <input name="golfflexshaftmaterial" value="1" 
                                        @if(isset($product)){{(count($productGolfflexShaftMaterial)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productGolfflexShaftMaterial)>0) ? 'checked' : ''}} @endif 
                                               class="isGolfFlexShaftMaterial"
                                               type="radio" id="golfflexshaftmaterial1"/>
                                        <label for="golfflexshaftmaterial1">Enable</label>
                                        <input name="golfflexshaftmaterial" value="0"
                                               @if(isset($product)) {{ (count($productGolfflexShaftMaterial) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productGolfflexShaftMaterial) <= 0) ? 'checked' : ''}} @endif
                                               class="isGolfFlexShaftMaterial"
                                               type="radio" id="golfflexshaftmaterial2"/>
                                        <label for="golfflexshaftmaterial2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 golfflexshaftmaterial">
                                        @if(isset($product) && count($productGolfflexShaftMaterial) > 0)
                                            @foreach($productGolfflexShaftMaterial as $value)
                                                <div class="prodGolfflexShaftMaterial col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="golf_flexshaft_material[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="golf_flexshaft_material_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="golfflexshaftmaterial_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Golf Flex Shaft Material</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addGolfFlexShaftMaterial();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add GolfFlexShaftMaterial"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Golf Shaft Material</p>
                                        <input name="golfshaftmaterial" value="1" 
                                        @if(isset($product)){{(count($productGolfShaftMaterial)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productGolfShaftMaterial)>0) ? 'checked' : ''}} @endif 
                                               class="isGolfShaftMaterial"
                                               type="radio" id="golfshaftmaterial1"/>
                                        <label for="golfshaftmaterial1">Enable</label>
                                        <input name="golfglexmaterial" value="0"
                                               @if(isset($product)) {{ (count($productGolfShaftMaterial) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productGolfShaftMaterial) <= 0) ? 'checked' : ''}} @endif
                                               class="isGolfShaftMaterial"
                                               type="radio" id="golfshaftmaterial2"/>
                                        <label for="golfshaftmaterial2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 golfshaftmaterial">
                                        @if(isset($product) && count($productGolfShaftMaterial) > 0)
                                            @foreach($productGolfShaftMaterial as $value)
                                                <div class="prodGolfShaftMaterial col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="golf_shaft_material[]"
                                                            value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="golf_shaft_material_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                            data-toggle="tooltip" title="Remove"
                                                            class="btn btn-danger colorRemove"><i
                                                            class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="golfshaftmaterial_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Golf Shaft Material</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addGolfShaftMaterial();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add GolfShaftMaterial"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Grip Size</p>
                                        <input name="gripsize" value="1" 
                                        @if(isset($product)){{(count($productGripsize)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productGripsize)>0) ? 'checked' : ''}} @endif 
                                               class="isGripSize"
                                               type="radio" id="gripsize1"/>
                                        <label for="gripsize1">Enable</label>
                                        <input name="gripsize" value="0"
                                               @if(isset($product)) {{ (count($productGripsize) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productGripsize) <= 0) ? 'checked' : ''}} @endif
                                               class="isGripSize"
                                               type="radio" id="gripsize2"/>
                                        <label for="gripsize2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 gripsize">
                                        @if(isset($product) && count($productGripsize) > 0)
                                            @foreach($productGripsize as $value)
                                                <div class="prodcolor">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="grip_size[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="grip_size_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="gripsize_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Grip Size</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addGripSize();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add GripSize"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Grip Type</p>
                                        <input name="griptype" value="1" 
                                        @if(isset($product)){{(count($productGriptype)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productGriptype)>0) ? 'checked' : ''}} @endif 
                                               class="isGripType"
                                               type="radio" id="griptype1"/>
                                        <label for="griptype1">Enable</label>
                                        <input name="griptype" value="0"
                                               @if(isset($product)) {{ (count($productGriptype) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productGriptype) <= 0) ? 'checked' : ''}} @endif
                                               class="isGripType"
                                               type="radio" id="griptype2"/>
                                        <label for="griptype2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 griptype">
                                        @if(isset($product) && count($productGriptype) > 0)
                                            @foreach($productGriptype as $value)
                                                <div class="prodcolor">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="grip_type[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="grip_type_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="griptype_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Grip Type</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addGripType();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add GripType"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Hand</p>
                                        <input name="hand" value="1" 
                                        @if(isset($product)){{(count($productSportHand)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productSportHand)>0) ? 'checked' : ''}} @endif 
                                               class="isHand"
                                               type="radio" id="hand1"/>
                                        <label for="hand1">Enable</label>
                                        <input name="hand" value="0"
                                               @if(isset($product)) {{ (count($productSportHand) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productSportHand) <= 0) ? 'checked' : ''}} @endif
                                               class="isHand"
                                               type="radio" id="hand2"/>
                                        <label for="hand2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 hand">
                                        @if(isset($product) && count($productSportHand) > 0)
                                            @foreach($productSportHand as $value)
                                                <div class="prodSportHand col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="sport_hand[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="sport_hand_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="hand_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Hand</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addHand();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add Hand"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Hand Shaft Length</p>
                                        <input name="handshaftlength" value="1" 
                                        @if(isset($product)){{(count($productHandShaftLength)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productColors)>0) ? 'checked' : ''}} @endif 
                                               class="isHandShaftLength"
                                               type="radio" id="handshaftlength1"/>
                                        <label for="handshaftlength1">Enable</label>
                                        <input name="handshaftlength" value="0"
                                               @if(isset($product)) {{ (count($productHandShaftLength) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productHandShaftLength) <= 0) ? 'checked' : ''}} @endif
                                               class="isHandShaftLength"
                                               type="radio" id="handshaftlength2"/>
                                        <label for="handshaftlength2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 handshaftlength">
                                        @if(isset($product) && count($productHandShaftLength) > 0)
                                            @foreach($productHandShaftLength as $value)
                                                <div class="prodHandShaftLength col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="hand_shaftlength[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="hand_shaftlength_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                        class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="handshaftlength_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Hand Shaft Length</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addHandShaftLength();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add HandShaftLength"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Shaft Material Golf Flex</p>
                                        <input name="shaftmaterialgolfflex" value="1" 
                                        @if(isset($product)){{(count($productShaftmaterialGolfflex)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productShaftmaterialGolfflex)>0) ? 'checked' : ''}} @endif 
                                               class="isShaftMaterialGolfFlex"
                                               type="radio" id="shaftmaterialgolfflex1"/>
                                        <label for="shaftmaterialgolfflex1">Enable</label>
                                        <input name="shaftmaterialgolfflex" value="0"
                                               @if(isset($product)) {{ (count($productShaftmaterialGolfflex) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productShaftmaterialGolfflex) <= 0) ? 'checked' : ''}} @endif
                                               class="isShaftMaterialGolfFlex"
                                               type="radio" id="shaftmaterialgolfflex2"/>
                                        <label for="shaftmaterialgolfflex2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 shaftmaterialgolfflex">
                                        @if(isset($product) && count($productShaftmaterialGolfflex) > 0)
                                            @foreach($productShaftmaterialGolfflex as $value)
                                                <div class="prodShaftmaterialGolfflex col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="shaftmaterial_golfflex[]"
                                                            value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="shaftmaterial_golfflex_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100"
                                                            alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="shaftmaterialgolfflex_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Shaft Material Golf Flex</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addShaftMaterialGolfFlex();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ShaftMaterialGolfFlex"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Shaft Material GolfFlex GolfLoft</p>
                                        <input name="shaftmaterialgolfflexgolfloft" value="1" 
                                        @if(isset($product)){{(count($productShaftmaterialGolfflexGolfloft)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productShaftmaterialGolfflexGolfloft)>0) ? 'checked' : ''}} @endif 
                                               class="isShaftMaterialGolfFlexGolfLoft"
                                               type="radio" id="shaftmaterialgolfflexgolfloft1"/>
                                        <label for="shaftmaterialgolfflexgolfloft1">Enable</label>
                                        <input name="shaftmaterialgolfflexgolfloft" value="0"
                                               @if(isset($product)) {{ (count($productShaftmaterialGolfflexGolfloft) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productShaftmaterialGolfflexGolfloft) <= 0) ? 'checked' : ''}} @endif
                                               class="isShaftMaterialGolfFlexGolfLoft"
                                               type="radio" id="shaftmaterialgolfflexgolfloft2"/>
                                        <label for="shaftmaterialgolfflexgolfloft2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 shaftmaterialgolfflexgolfloft">
                                        @if(isset($product) && count($productShaftmaterialGolfflexGolfloft) > 0)
                                            @foreach($productShaftmaterialGolfflexGolfloft as $value)
                                                <div class="prodShaftmaterialGolfflexGolfloft col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="shaftmaterial_golfflex_golfloft[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="shaftmaterial_golfflex_golfloft_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                             </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="shaftmaterialgolfflexgolfloft_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Shaft Material GolfFlex GolfLoft</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addShaftMaterialGolfFlexGolfLoft();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ShaftMaterialGolfFlexGolfLoft"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Tension Level</p>
                                        <input name="tensionlevel" value="1" 
                                        @if(isset($product)){{(count($productTensionlevel)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productTensionlevel)>0) ? 'checked' : ''}} @endif 
                                               class="isTenssionLevel"
                                               type="radio" id="tensionlevel1"/>
                                        <label for="tensionlevel1">Enable</label>
                                        <input name="tensionlevel" value="0"
                                               @if(isset($product)) {{ (count($productTensionlevel) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productTensionlevel) <= 0) ? 'checked' : ''}} @endif
                                               class="isTenssionLevel"
                                               type="radio" id="tensionlevel2"/>
                                        <label for="tensionlevel2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 tensionlevel">
                                        @if(isset($product) && count($productTensionlevel) > 0)
                                            @foreach($productTensionlevel as $value)
                                                <div class="prodTensionlevel col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="tension_level[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="tension_level_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                        class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="tensionlevel_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Tension Level</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addTensionLevel();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add TensionLevel"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="input-field col s12">
                                        <p>Shaft Material</p>
                                        <input name="shaftmaterial" value="1" 
                                        @if(isset($product)){{(count($productShaftMaterial)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productShaftMaterial)>0) ? 'checked' : ''}} @endif 
                                               class="isShaftMaterial"
                                               type="radio" id="shaftmaterial1"/>
                                        <label for="shaftmaterial1">Enable</label>
                                        <input name="shaftmaterial" value="0"
                                               @if(isset($product)) {{ (count($productShaftMaterial) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productShaftMaterial) <= 0) ? 'checked' : ''}} @endif
                                               class="isShaftMaterial"
                                               type="radio" id="shaftmaterial2"/>
                                        <label for="shaftmaterial2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 shaftmaterial">
                                        @if(isset($product) && count($productShaftMaterial) > 0)
                                            @foreach($productShaftMaterial as $value)
                                                <div class="prodShaftMaterial col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="shaft_material[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="shaft_material_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                        class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="shaftmaterial_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Shaft Material</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addShaftMaterial();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ShaftMaterial"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    

                                    <div class="input-field col s12">
                                        <p>Item Shape</p>
                                        <input name="itemshape" value="1" 
                                        @if(isset($product)){{(count($productItemshape)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productItemshape)>0) ? 'checked' : ''}} @endif 
                                               class="isItemShape"
                                               type="radio" id="itemshape1"/>
                                        <label for="itemshape1">Enable</label>
                                        <input name="itemshape" value="0"
                                               @if(isset($product)) {{ (count($productItemshape) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productItemshape) <= 0) ? 'checked' : ''}} @endif
                                               class="isItemShape"
                                               type="radio" id="itemshape2"/>
                                        <label for="itemshape2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 itemshape">
                                        @if(isset($product) && count($productItemshape) > 0)
                                            @foreach($productItemshape as $value)
                                                <div class="prodItemshape col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="item_shape[]"
                                                            value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="item_shape_price[]"
                                                            value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100"alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="itemshape_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Item Shape</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addItemShape();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add ItemShape"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="input-field col s12">
                                        <p>Size Weight Supported</p>
                                        <input name="sizeweightsupported" value="1" 
                                        @if(isset($product)){{(count($productSizeWeightSupported)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productSizeWeightSupported)>0) ? 'checked' : ''}} @endif 
                                               class="isSizeWeightSupported"
                                               type="radio" id="sizeweightsupported1"/>
                                        <label for="sizeweightsupported1">Enable</label>
                                        <input name="sizeweightsupported" value="0"
                                               @if(isset($product)) {{ (count($productSizeWeightSupported) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productSizeWeightSupported) <= 0) ? 'checked' : ''}} @endif
                                               class="isSizeWeightSupported"
                                               type="radio" id="sizeweightsupported2"/>
                                        <label for="sizeweightsupported2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 sizeweightsupported">
                                        @if(isset($product) && count($productSizeWeightSupported) > 0)
                                            @foreach($productSizeWeightSupported as $value)
                                                <div class="prodSizeWeightSupported col s12">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="size_weight_supported[]"
                                                        value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="text" name="size_weight_supported_price[]"
                                                        value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                            class="img-responsive" height="100" width="100" alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="sizeweightsupported_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Size Weight Supported</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addSizeWeightSupported();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add SizeWeightSupported"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="input-field col s12">
                                        <p>Style Name</p>
                                        <input name="stylename" value="1" 
                                        @if(isset($product)){{(count($productStylename)>0) ? 'checked' : ''}} @endif 
                                              @if(isset($newproduct)) {{ (count($productStylename)>0) ? 'checked' : ''}} @endif 
                                               class="isStyleName"
                                               type="radio" id="stylename1"/>
                                        <label for="stylename1">Enable</label>
                                        <input name="stylename" value="0"
                                               @if(isset($product)) {{ (count($productStylename) <= 0) ? 'checked' : ''}} @endif
                                               @if(isset($newproduct)) {{ (count($productStylename) <= 0) ? 'checked' : ''}} @endif
                                               class="isStyleName"
                                               type="radio" id="stylename2"/>
                                        <label for="stylename2">Disable</label>
                                    </div>

                                    <div class="input-field col s12 stylename">
                                        @if(isset($product) && count($productStylename) > 0)
                                            @foreach($productStylename as $value)
                                                <div class="prodcolor">
                                                    <div class="input-field col s3">
                                                        <input type="text" name="style_name[]"
                                                               value="{{ $value->desc }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <input type="number" name="style_name_price[]"
                                                               value="{{ $value->product_price }}">
                                                    </div>

                                                    <div class="input-field col s2">
                                                               <img src="{{ asset('850ProductImg/'.$value->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                    </div>

                                                    <div class="input-field col s2">
                                                        <button type="button"
                                                                data-toggle="tooltip" title="Remove"
                                                                class="btn btn-danger colorRemove"><i
                                                                    class="fa fa-minus-circle"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="table-responsive">
                                                <table id="stylename_disp"
                                                       class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">Style Name</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addStyleName();"
                                                                    data-toggle="tooltip"
                                                                    title="" class="btn btn-primary"
                                                                    data-original-title="Add StyleName"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                    <!-- Sports Over -->

                                    <!-- ISHWAR -->
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

                                                       
                                                        @if($product->isProductColorImage($screenshots->id)) 
                                                        <div class="input-field col s12">
                                                            <img src="{{ asset('100ProductImg/'.$screenshots->screenshots) }}"
                                                                 class="img-responsive" height="100" width="100"
                                                                 alt="">
                                                            <button type="button"
                                                                    class="btn btn-danger removeScreenshots"
                                                                    screenId="{{ $screenshots->id }}">Remove
                                                            </button>
                                                        </div>
                                                        @endif
                                                       
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

                                                
                                                @if(isset($product) && count($productsAttributes) > 0)
                                                    <input type="hidden" name="attrib_size123" value="{{ count($productsAttributes) }}" id="att_size">
                                                    @foreach($productsAttributes as $key => $attribute)
                                                        <tr id="attribute-row">
                                                            <td class="text-left" style="width: 20%;">
                                                                <input type="text"
                                                                       name="product_attribute[{{ $key }}][name]"
                                                                       value="{{ $attribute->name }}"
                                                                       placeholder="Attribute" class="form-control"/>
                                                            </td>
                                                            <td class="text-left">
                                                                <div class="input-group"><textarea name="product_attribute[{{ $key }}][description]"
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


                                                @if(isset($newproduct) && count($newproduct->ProductAttributes()->where('name', '!=', 'color')->where('name', '!=', 'size')->get())>0)
                                                    @foreach($newproduct->ProductAttributes()->where('name', '!=', 'color')->where('name', '!=', 'size')->get() as $key=>$attribute)
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
    <script src="{{ asset('js/jquery.minicolors.min.js') }}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: "#summernote",
            height : "250",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });</script>
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $(document).on('click', '.discountRmv', function () {
            $(this).parent().parent().remove();
        });

        // $(document).on('click', '.colorRemove', function () {
        //     $(this).parent().parent().remove();

        //     var val = $(this).attr('imageid');
        //     $.ajax({
        //             type: 'get',
        //             url: '{{ route('get:delete_products_screenshots') }}',
        //             data: {screenId: val},
        //             success: function (result) {
        //                 if (result.success == true) {
                                   
        //                     } 
        //                 }
        //         });
        // });

        function colorPicker() {
            var colpick = $('.demo').each(function () {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: 'lowercase',
                    opacity: false,
                    change: function (hex, opacity) {
                        if (!hex) return;
                        if (opacity) hex += ', ' + opacity;
                        $(this).select();
                    },
                    theme: 'bootstrap'
                });
            });
        }

        var image_row = 0;

        function addImage() {
            html = '<tr id="image-row' + image_row + '">';
            html += '  <td class="text-left"><input type="file" id="addition_image" name="addition_image[]" class="dropify" data-default-file=""/></td>';
            html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#images tbody').append(html);
            dropify();

            image_row++;
        }

        function dropify() {
            $('.dropify').dropify();
        }

        var color_row = 0;

        function addColor() {
            html = '<tr id="color-row' + color_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="product_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="color_price" placeholder="Product Price" class="" name="product_price[]" value="">\n' +
                '</div>' +
                '</td> <br><br>';

            html += '<td class="text-left">' +
                '<div class="input-field col s6">\n' +
                '<input type="file" id="product_color_image1" name="product_color_image1[]" value="" ><br><br>' +
                '<input type="file" id="product_color_image2" name="product_color_image2[]" value="" ><br><br>' +
                '<input type="file" id="product_color_image3" name="product_color_image3[]" value="" ><br><br>' +
                '<input type="file" id="product_color_image4" name="product_color_image4[]" value="" ><br><br>' +
                '<input type="file" id="product_color_image5" name="product_color_image5[]" value="" ><br><br>' +
                '</div>' +
                '</td>';

            // html += '  <td class="text-left">' +
            //     '<div class="input-field col s12">\n' +
            //     '<input type="file" id="color_image" class="" name="color_images[]" value="">\n' +
            //     '</div>' +
            //     '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#color-row' + color_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#colors tbody').append(html);
            colorPicker();
            color_row++;
        }

        var size_row = 0;

        function addSize() {
            html = '<tr id="color-row' + color_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" placeholder="Size" name="product_size[]">\n' +
                '</div>' +
                '</td>';
            html += '  <td class="text-left"><button type="button" onclick="$(\'#color-row' + size_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#size tbody').append(html);
            color_row++;
        }

        var size_color_row = 0;
       function addSizeColor() {

            html = '<tr id="color-size-row' + size_color_row + '">';
            html += '  <td class="text-left col s12">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="product_size_color" class="demo" name="product_size_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '<td class="text-left col s6">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="size_color_size" placeholder="Size" class="" name="size_color_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left col s6">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="size_color_price" placeholder="Price" class="" name="size_color_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left col s10">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="size_color_image1" class="file-class col s2" name="size_color_image1[]" value="">\n' +
                '<input type="file" id="size_color_image2" class="file-class col s2" name="size_color_image2[]" value="">\n' +
                '<input type="file" id="size_color_image3" class="file-class col s2" name="size_color_image3[]" value="">\n' +
                '<input type="file" id="size_color_image4" class="file-class col s2" name="size_color_image4[]" value="">\n' +
                '<input type="file" id="size_color_image5" class="file-class col s2" name="size_color_image5[]" value="">\n' +
                '</div>' +
                '</td>';


            // html += '  <td class="text-left col s12">' +
            //     '<div class="input-field col s12">\n' +
            //     '<input type="file" id="size_color_image" class="file-class" name="size_color_image[]" value="">\n' +
            //     '</div>' +
            //     '</td>';

            html += '<br><br>  <td class="text-left col s2"><button type="button" onclick="$(\'#color-size-row' + size_color_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#sizecolor_disp tbody').append(html);
            colorPicker();
            size_color_row++;
        }

        var scent_row = 0;
        function addScent() {

            html = '<tr id="scent_row' + scent_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="scent_name"  placeholder="Scent" name="scent_name[]">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="scent_price" placeholder="Price" class="" name="scent_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="scent_image" name="scent_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#scent_row' + scent_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#scent_disp tbody').append(html);
            colorPicker();
            scent_row++;
        }

        var scent_size_row = 0;
        function addSizeScent() {
            html = '<tr id="scent_size_row' + scent_size_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="size_scent_name"  placeholder="Scent" name="size_scent_name[]">\n' +
                '</div>' +
                '</td>';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="size_scent_size" placeholder="Size" class="" name="size_scent_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="size_scent_price" placeholder="Price" class="" name="size_scent_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="size_scent_image" name="size_scent_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#size_color_row' + size_color_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#sizescent_disp tbody').append(html);
            colorPicker();
            scent_size_row++;
        }


        var paperback_row = 0;
        function addPaperback() {
            html = '<tr id="paperback_row' + paperback_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="paperback_name"  placeholder="Paperback" name="paperback_name[]">\n' +
                '</div>' +
                '</td>';
          
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="paperback_price" placeholder="Price" class="" name="paperback_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="paperback_image" name="paperback_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#paperback_row' + paperback_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#paperback_disp tbody').append(html);
            colorPicker();
            paperback_row++;
        }

        var hardcover_row = 0;
        function addHardcover() {
            html = '<tr id="hardcover_row' + hardcover_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="hardcover_name"  placeholder="Hardcover" name="hardcover_name[]">\n' +
                '</div>' +
                '</td>';
          
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="hardcover_price" placeholder="Price" class="" name="hardcover_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="hardcover_image" name="hardcover_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#hardcover_row' + hardcover_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#hardcover_disp tbody').append(html);
            colorPicker();
            hardcover_row++;
        }

        var audio_cd_row = 0;
        function addAudioCD() {
            html = '<tr id="audio_cd_row' + audio_cd_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="audiocd_name"  placeholder="Audio CD" name="audiocd_name[]">\n' +
                '</div>' +
                '</td>';
          
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="audiocd_price" placeholder="Price" class="" name="audiocd_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="audiocd_image" name="audiocd_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#audio_cd_row' + audio_cd_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#audiocd_disp tbody').append(html);
            colorPicker();
            audio_cd_row++;
        }



        var pattern_row = 0;
        function addPattern() {
            html = '<tr id="pattern_row' + pattern_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="pattern_name"  placeholder="Pattern" name="pattern_name[]">\n' +
                '</div>' +
                '</td>';
          
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="pattern_price" placeholder="Price" class="" name="pattern_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="pattern_image" name="pattern_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#pattern_row' + pattern_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#pattern_disp tbody').append(html);
            colorPicker();
            pattern_row++;
        }

        var cupsize_row = 0;
        function addCupSize() {
            html = '<tr id="cupsize_row' + cupsize_row + '">';
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="cup_size"  placeholder="Cup Size" name="cup_size[]">\n' +
                '</div>' +
                '</td>';
          
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="cup_size_price" placeholder="Price" class="" name="cup_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="cup_size_image" name="cup_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#cupsize_row' + cupsize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#cupsize_disp tbody').append(html);
            colorPicker();
            cupsize_row++;
        }

        var cupsizecolor_row = 0;
        function addCupSizeColor() {
            html = '<tr id="cupsizecolor_row' + cupsizecolor_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="cup_size_color_size"  placeholder="Cup Size" name="cup_size_color_size[]">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="cup_size_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';
          
            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="cup_size_color_price" placeholder="Price" class="" name="cup_size_color_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="cup_size_color_image" name="cup_size_color_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#cupsizecolor_row' + cupsizecolor_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#cupsizecolor_disp tbody').append(html);
            colorPicker();
            cupsizecolor_row++;
        }



        var colorlenswidth_row = 0;
        function addColorLensWidth() {
            html = '<tr id="colorlenswidth_row' + colorlenswidth_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="color_lens[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="color_lens_width"  placeholder="Width" name="color_lens_width[]">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="color_lens_price" placeholder="Price" class="" name="color_lens_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="color_lens_image" name="color_lens_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#colorlenswidth_row' + colorlenswidth_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#colorlenswidth_disp tbody').append(html);
            colorPicker();
            colorlenswidth_row++;
        }


        var colormaginification_row = 0;
        function addColorMagnificationStrength() {
            html = '<tr id="colormaginification_row' + colormaginification_row + '">';

            // html += '  <td class="text-left">' +
            //     '<div class="input-field col s12">\n' +
            //     '<input type="text" id="saturation-demo" class="demo" name="color_ms[]" data-control="saturation" value="#0088cc">\n' +
            //     '</div>' +
            //     '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="color_magnification_strength"  placeholder="Strength" name="color_magnification_strength[]">\n' +
                '</div>' +
                '</td>';
                
            // html += '  <td class="text-left">' +
            //     '<div class="input-field col s12">\n' +
            //     '<input type="number" id="color_lens_price" placeholder="Price" class="" name="color_magnification_strength[]" value="">\n' +
            //     '</div>' +
            //     '</td>';

            // html += '  <td class="text-left">' +
            //     '<div class="input-field col s12">\n' +
            //     '<input type="file" id="color_lens_image" name="color_lens_image[]" value="">\n' +
            //     '</div>' +
            //     '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#colormaginification_row' + colormaginification_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#colormagnificationstrength_disp tbody').append(html);
            colorPicker();
            colormaginification_row++;
        }

        var lenscolor_row = 0;
        function addLensColor() {
            html = '<tr id="lenscolor_row' + lenscolor_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="lens_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="lens_color_price" placeholder="Price" class="" name="lens_color_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="lens_color_image" name="lens_color_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#lenscolor_row' + lenscolor_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#lenscolor_disp tbody').append(html);
            colorPicker();
            lenscolor_row++;
        }

        var colormaterial_row = 0;
        function addColorMaterial() {
            html = '<tr id="colormaterial_row' + colormaterial_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="color_material_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="color_material" placeholder="Material" class="" name="color_material[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="color_material_price" placeholder="Price" class="" name="color_material_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="color_material_image" name="color_material_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#colormaterial_row' + colormaterial_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#colormaterial_disp tbody').append(html);
            colorPicker();
            colormaterial_row++;
        }


        var productflavor_row = 0;
        function addProductFlavor() {
            html = '<tr id="productflavor_row' + productflavor_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="product_flavor" placeholder="Flavor" class="" name="product_flavor[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="product_flavor_price" placeholder="Price" class="" name="product_flavor_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="product_flavor_image" name="product_flavor_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#productflavor_row' + productflavor_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#flavor_disp tbody').append(html);
            colorPicker();
            productflavor_row++;
        }

        var productweight_row = 0;
        function addProductWeight() {
            html = '<tr id="productweight_row' + productweight_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="product_weight" placeholder="Weight" class="" name="product_weight[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="product_weight_price" placeholder="Price" class="" name="product_weight_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="product_weight_image" name="product_weight_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#productweight_row' + productweight_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#weight_disp tbody').append(html);
            colorPicker();
            productweight_row++;
        }

        var flavorsize_row = 0;
        function addFlavorSize() {
            html = '<tr id="flavorsize_row' + flavorsize_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="flavor_size_flavor" placeholder="Flavor" class="" name="flavor_size_flavor[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="flavor_size" placeholder="Size" class="" name="flavor_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="flavor_size_price" placeholder="Price" class="" name="flavor_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="flavor_size_image" name="flavor_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#flavorsize_row' + flavorsize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#flavorsize_disp tbody').append(html);
            colorPicker();
            flavorsize_row++;
        }

        var flavorweight_row = 0;
        function addFlavorWeight() {
            html = '<tr id="flavorweight_row' + flavorweight_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="flavor_weight_flavor" placeholder="Flavor" class="" name="flavor_weight_flavor[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="flavor_weight" placeholder="Weight" class="" name="flavor_weight[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="flavor_weight_price" placeholder="Price" class="" name="flavor_weight_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="flavor_weight_image" name="flavor_weight_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#flavorweight_row' + flavorweight_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#flavorweight_disp tbody').append(html);
            colorPicker();
            flavorweight_row++;
        }


        var productmaterial_row = 0;
        function addProductMaterial() {
            html = '<tr id="productmaterial_row' + productmaterial_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="product_material" placeholder="Material" class="" name="product_material[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="product_material_price" placeholder="Price" class="" name="product_material_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="product_material_image" name="product_material_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#productmaterial_row' + productmaterial_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#productmaterial_disp tbody').append(html);
            colorPicker();
            productmaterial_row++;
        }

        var materialsize_row = 0;
        function addMaterialSize() {
            html = '<tr id="materialsize_row' + materialsize_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="material_size_material" placeholder="Material" class="" name="material_size_material[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="material_size" placeholder="Size" class="" name="material_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="material_size_price" placeholder="Price" class="" name="material_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="material_size_image" name="material_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#materialsize_row' + materialsize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#materialsize_disp tbody').append(html);
            colorPicker();
            materialsize_row++;
        }

        // Jwellery 

        var metaltype_row = 0;
        function addMetalType() {
            html = '<tr id="metaltype_row' + metaltype_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="metal_type" placeholder="Metal Type" class="" name="metal_type[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="metal_type_price" placeholder="Price" class="" name="metal_type_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="metal_type_image" name="metal_type_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#metaltype_row' + metaltype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#metaltype_disp tbody').append(html);
            colorPicker();
            metaltype_row++;
        }


        var sizeperpearl_row = 0;
        function addSizePerPearl() {
            html = '<tr id="sizeperpearl_row' + sizeperpearl_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="size_per_pearl" placeholder="Size Per Pearl" class="" name="size_per_pearl[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="size_per_pearl_price" placeholder="Price" class="" name="size_per_pearl_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="size_per_pearl_image" name="size_per_pearl_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#sizeperpearl_row' + sizeperpearl_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#sizeperpearl_disp tbody').append(html);
            colorPicker();
            sizeperpearl_row++;
        }

        var colormetaltype_row = 0;
        function addColorMetalType() {
            html = '<tr id="colormetaltype_row' + colormetaltype_row + '">';


            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="color_metaltype_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="color_metaltype" placeholder="Metal Type" class="" name="color_metaltype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="color_metaltype_price" placeholder="Price" class="" name="color_metaltype_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="color_metaltype_image" name="color_metaltype_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#colormetaltype_row' + colormetaltype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#colormetaltype_disp tbody').append(html);
            colorPicker();
            colormetaltype_row++;
        }

        var coloritemlength_row = 0;
        function addColorItemLength() {
            html = '<tr id="coloritemlength_row' + coloritemlength_row + '">';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="color_itemlength_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="color_itemlength" placeholder="Item Length" class="" name="color_itemlength[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="color_itemlength_price" placeholder="Price" class="" name="color_itemlength_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="color_itemlength_image" name="color_item_lengthimage[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#coloritemlength_row' + coloritemlength_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#coloritemlength_disp tbody').append(html);
            colorPicker();
            coloritemlength_row++;
        }

        var gemtype_row = 0;
        function addGemType() {
            html = '<tr id="gemtype_row' + gemtype_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="gem_type" placeholder="Gem Type" class="" name="gem_type[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="gem_type_price" placeholder="Price" class="" name="gem_type_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="gem_type_image" name="gem_type_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#gemtype_row' + gemtype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#gemtype_disp tbody').append(html);
            colorPicker();
            gemtype_row++;
        }

        var metalgemtype_row = 0;
        function addMetalGemType() {
            html = '<tr id="metalgemtype_row' + metalgemtype_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="metalgemtype_metaltype" placeholder="Metal Type" class="" name="metalgemtype_metaltype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="metalgemtype_gemtype" placeholder="Gem Type" class="" name="metalgemtype_gemtype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="metalgemtype_price" placeholder="Price" class="" name="metalgemtype_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="metalgemtype_image" name="metalgemtype_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#metalgemtype_row' + metalgemtype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#metalgemtype_disp tbody').append(html);
            colorPicker();
            metalgemtype_row++;
        }


        var totalgemweight_row = 0;
        function addTotalGemWeight() {
            html = '<tr id="totalgemweight_row' + totalgemweight_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="total_gemweight" placeholder="Total Gem Weight" class="" name="total_gemweight[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="total_gemweight_price" placeholder="Price" class="" name="total_gemweight_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="total_gemweight_image" name="total_gem_weightimage[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#totalgemweight_row' + totalgemweight_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#totalgemweight_disp tbody').append(html);
            colorPicker();
            totalgemweight_row++;
        }


        var totaldiamondweight_row = 0;
        function addTotalDiamondWeight() {
            html = '<tr id="totaldiamondweight_row' + totaldiamondweight_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="total_diamondweight" placeholder="Total Diamond Weight" class="" name="total_diamondweight[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="total_diamondweight_price" placeholder="Price" class="" name="total_diamondweight_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="total_diamondweight_image" name="total_diamondweight_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#totaldiamondweight_row' + totaldiamondweight_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#totaldiamondweight_disp tbody').append(html);
            colorPicker();
            totaldiamondweight_row++;
        }

        var metaltypetotaldiamondweight_row = 0;
        function addMetalTypeTotalDiamondWeight() {
            html = '<tr id="metaltypetotaldiamondweight_row' + metaltypetotaldiamondweight_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="metaltype_totaldiamondweight_metaltype" placeholder="Metal Type" class="" name="metaltype_totaldiamondweight_metaltype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="metaltype_totaldiamondweight_diamondweight" placeholder="Total Diamond Weight" class="" name="metaltype_totaldiamondweight_diamondweight[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="metaltype_totaldiamondweight_price" placeholder="Price" class="" name="metaltype_totaldiamondweight_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="metaltype_totaldiamondweight_image" name="metaltype_totaldiamondweight_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#metaltypetotaldiamondweight_row' + metaltypetotaldiamondweight_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#metaltypetotaldiamondweight_disp tbody').append(html);
            colorPicker();
            metaltypetotaldiamondweight_row++;
        }


        var itemlengthgemtype_row = 0;
        function addItemLengthGemtype() {
            html = '<tr id="itemlengthgemtype_row' + itemlengthgemtype_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_gemtype_itemlength" placeholder="Item Length" class="" name="itemlength_gemtype_itemlength[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_gemtype" placeholder="Gem Type" class="" name="itemlength_gemtype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="itemlength_gemtype_price" placeholder="Price" class="" name="itemlength_gemtype_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="itemlength_gemtype_image" name="itemlength_gemtype_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#itemlengthgemtype_row' + itemlengthgemtype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#itemlengthgemtype_disp tbody').append(html);
            colorPicker();
            itemlengthgemtype_row++;
        }


        var itemlengthmaterial_row = 0;
        function addItemLengthMaterial() {
            html = '<tr id="itemlengthmaterial_row' + itemlengthmaterial_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_material_itemlength" placeholder="Item Length" class="" name="itemlength_material_itemlength[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_material" placeholder="Material" class="" name="itemlength_material[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="itemlength_material_price" placeholder="Price" class="" name="itemlength_material_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="itemlength_material_image" name="itemlength_material_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#itemlengthmaterial_row' + itemlengthmaterial_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#itemlengthmaterial_disp tbody').append(html);
            colorPicker();
            itemlengthmaterial_row++;
        }

        var itemlengthsizeperpearl_row = 0;
        function addItemLengthSizePerPearl() {
            html = '<tr id="itemlengthsizeperpearl_row' + itemlengthsizeperpearl_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_sizeperpearl_itemlength" placeholder="Item Length" class="" name="itemlength_sizeperpearl_itemlength[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_sizeperpearl" placeholder="Size Per Pearl" class="" name="itemlength_sizeperpearl[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="itemlength_sizeperpearl_price" placeholder="Price" class="" name="itemlength_sizeperpearl_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="itemlength_sizeperpearl_image" name="itemlength_sizeperpearl_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#itemlengthsizeperpearl_row' + itemlengthsizeperpearl_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#itemlengthsizeperpearl_disp tbody').append(html);
            colorPicker();
            itemlengthsizeperpearl_row++;
        }

        var itemlengthmetaltype_row = 0;
        function addItemLengthMetalType() {
            html = '<tr id="itemlengthmetaltype_row' + itemlengthmetaltype_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_metaltype_itemlength" placeholder="Item Length" class="" name="itemlength_metaltype_itemlength[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_metaltype" placeholder="Metal Type" class="" name="itemlength_metaltype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="itemlength_metaltype_price" placeholder="Price" class="" name="itemlength_metaltype_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="itemlength_metaltype_image" name="itemlength_metaltype_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#itemlengthmetaltype_row' + itemlengthmetaltype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#itemlengthmetaltype_disp tbody').append(html);
            colorPicker();
            itemlengthmetaltype_row++;
        }


        var itemlengthtotaldiamondweight_row = 0;
        function addItemLengthTotalDiamondWeight() {
            html = '<tr id="itemlengthtotaldiamondweight_row' + itemlengthtotaldiamondweight_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_totaldiamondweight_itemlength" placeholder="Item Length" class="" name="itemlength_totaldiamondweight_itemlength[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="itemlength_totaldiamondweight" placeholder="Total Diamond Weight" class="" name="itemlength_totaldiamondweight[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="itemlength_totaldiamondweight_price" placeholder="Price" class="" name="itemlength_totaldiamondweight_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="itemlength_totaldiamondweight_image" name="itemlength_totaldiamondweight_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#itemlengthtotaldiamondweight_row' + itemlengthtotaldiamondweight_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#itemlengthtotaldiamondweight_disp tbody').append(html);
            colorPicker();
            itemlengthtotaldiamondweight_row++;
        }

        var itemlength_row = 0;
        function addItemLength() {
            html = '<tr id="itemlength_row' + itemlength_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="item_length" placeholder="Item Length" class="" name="item_length[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="item_length_price" placeholder="Price" class="" name="item_length_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="item_length_image" name="item_length_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#itemlength_row' + itemlength_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#itemlength_disp tbody').append(html);
            colorPicker();
            itemlength_row++;
        }



        var ringsize_row = 0;
        function addRingSize() {
            html = '<tr id="ringsize_row' + ringsize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="ring_size" placeholder="Ring Size" class="" name="ring_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="ring_size_price" placeholder="Price" class="" name="ring_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="ring_size_image" name="ring_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#ringsize_row' + ringsize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#ringsize_disp tbody').append(html);
            colorPicker();
            ringsize_row++;
        }

        var metaltyperingsize_row = 0;
        function addMetalTypeRingSize() {
            html = '<tr id="metaltyperingsize_row' + metaltyperingsize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="metaltype_ringsize_metaltype" placeholder="Metal Type" class="" name="metaltype_ringsize_metaltype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="metaltype_ringsize" placeholder="Ring Size" class="" name="metaltype_ringsize[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="metaltype_ringsize_price" placeholder="Price" class="" name="metaltype_ringsize_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="metaltype_ringsize_image" name="metaltype_ringsize_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#metaltyperingsize_row' + metaltyperingsize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#metaltyperingsize_disp tbody').append(html);
            colorPicker();
            metaltyperingsize_row++;
        }

        var colorringsize_row = 0;
        function addColorRingSize() {
            html = '<tr id="colorringsize_row' + colorringsize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="color_ringsize_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="color_ringsize" placeholder="Ring Size" class="" name="color_ringsize[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="color_ringsize_price" placeholder="Price" class="" name="color_ringsize_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="color_ringsize_image" name="color_ringsize_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#colorringsize_row' + colorringsize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#colorringsize_disp tbody').append(html);
            colorPicker();
            colorringsize_row++;
        }

        var ringsizegemtype_row = 0;
        function addRingSizeGemType() {
            html = '<tr id="ringsizegemtype_row' + ringsizegemtype_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="ringsize_gemtype_ringsize" placeholder="Ring Size" class="" name="ringsize_gemtype_ringsize[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="ringsize_gemtype" placeholder="Gem Type" class="" name="ringsize_gemtype[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="ringsize_gemtype_price" placeholder="Price" class="" name="ringsize_gemtype_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="ringsize_gemtype_image" name="ringsize_gemtype_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#ringsizegemtype_row' + ringsizegemtype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#ringsizegemtype_disp tbody').append(html);
            colorPicker();
            ringsizegemtype_row++;
        }

        var ringsizetotaldiamondweight_row = 0;
        function addRingSizeTotalDiamondWeight() {
            html = '<tr id="ringsizetotaldiamondweight_row' + ringsizetotaldiamondweight_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="ringsize_totaldiamondweight_ringsize" placeholder="Ring Size" class="" name="ringsize_totaldiamondweight_ringsize[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="ringsize_totaldiamondweight" placeholder="Total Diamond Weight" class="" name="ringsize_totaldiamondweight[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="ringsize_totaldiamondweight_price" placeholder="Price" class="" name="ringsize_totaldiamondweight_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="ringsize_totaldiamondweight_image" name="ringsize_totaldiamondweight_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#ringsizetotaldiamondweight_row' + ringsizetotaldiamondweight_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#ringsizetotaldiamondweight_disp tbody').append(html);
            colorPicker();
            ringsizetotaldiamondweight_row++;
        }

        // Office Supplies start
        var numberofitems_row = 0;
        function addNumberOfItems() {
            html = '<tr id="numberofitems_row' + numberofitems_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="number_of_items" placeholder="Number Of Items" class="" name="number_of_items[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="number_of_items_price" placeholder="Price" class="" name="number_of_items_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="number_of_items_image" name="number_of_items_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#numberofitems_row' + numberofitems_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#numberofitems_disp tbody').append(html);
            colorPicker();
            numberofitems_row++;
        }

        var papersize_row = 0;
        function addPaperSize() {
            html = '<tr id="papersize_row' + papersize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="paper_size" placeholder="Paper Size" class="" name="paper_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="paper_size_price" placeholder="Price" class="" name="paper_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="paper_size_image" name="paper_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#papersize_row' + papersize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#papersize_disp tbody').append(html);
            colorPicker();
            papersize_row++;
        }

        var maximumexpandablesize_row = 0;
        function addMaximumExpandableSize() {
            html = '<tr id="maximumexpandablesize_row' + maximumexpandablesize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="maximum_expandable_size" placeholder="Maximum Expandable Size" class="" name="maximum_expandable_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="maximum_expandable_size_price" placeholder="Price" class="" name="maximum_expandable_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="maximum_expandable_size_image" name="maximum_expandable_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#maximumexpandablesize_row' + maximumexpandablesize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#maximumexpandablesize_disp tbody').append(html);
            colorPicker();
            maximumexpandablesize_row++;
        }

        var linesize_row = 0;
        function addLineSize() {
            html = '<tr id="linesize_row' + linesize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="line_size" placeholder="Line Size" class="" name="line_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="line_size_price" placeholder="Price" class="" name="line_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="line_size_image" name="line_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#linesize_row' + linesize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#linesize_disp tbody').append(html);
            colorPicker();
            linesize_row++;
        }
        // Office Supplies

        // Shoes & Handbags

        var stylesize_row = 0;
        function addStyleSize() {
            html = '<tr id="stylesize_row' + stylesize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="style_size_style" placeholder="Style" class="" name="style_size_style[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="style_size" placeholder="Size" class="" name="style_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="style_size_price" placeholder="Price" class="" name="style_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="style_size_image" name="style_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#stylesize_row' + stylesize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#stylesize_disp tbody').append(html);
            colorPicker();
            stylesize_row++;
        }

        var shoesstyle_row = 0;
        function addShoesStyle() {
            html = '<tr id="shoesstyle_row' + shoesstyle_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="shoes_style" placeholder="Style" class="" name="shoes_style[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="shoes_style_price" placeholder="Price" class="" name="shoes_style_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="shoes_style_image" name="shoes_style_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#shoesstyle_row' + shoesstyle_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#shoesstyle_disp tbody').append(html);
            colorPicker();
            shoesstyle_row++;
        }


        var bandcolor_row = 0;
        function addBandColor() {
            html = '<tr id="bandcolor_row' + bandcolor_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="saturation-demo" class="demo" name="band_color[]" data-control="saturation" value="#0088cc">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="band_color_price" placeholder="Price" class="" name="band_color_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="band_color_image" name="band_color_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#bandcolor_row' + bandcolor_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#bandcolor_disp tbody').append(html);
            colorPicker();
            bandcolor_row++;
        }

        // Sports
        var golfloft_row = 0;
        function addGolfLoft() {
            html = '<tr id="golfloft_row' + golfloft_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="golf_loft" placeholder="Golf Loft" class="" name="golf_loft[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="golf_loft_price" placeholder="Price" class="" name="golf_loft_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="golf_loft_image" name="golf_loft_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#golfloft_row' + golfloft_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#golfloft_disp tbody').append(html);
            colorPicker();
            golfloft_row++;
        }

        var golfflexmaterial_row = 0;
        function addGolfFlexMaterial() {
            html = '<tr id="golfflexmaterial_row' + golfflexmaterial_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="golf_flexmaterial" placeholder="Golf Flex Material" class="" name="golf_flexmaterial[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="golf_flexmaterial_price" placeholder="Price" class="" name="golf_flexmaterial_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="golf_flexmaterial_image" name="golf_flexmaterial_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#golfflexmaterial_row' + golfflexmaterial_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#golfflexmaterial_disp tbody').append(html);
            colorPicker();
            golfflexmaterial_row++;
        }

        var golfflexshaftmaterial_row = 0;
        function addGolfFlexShaftMaterial() {
            html = '<tr id="golfflexshaftmaterial_row' + golfflexshaftmaterial_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="golf_flexshaft_material" placeholder="Golf Flex Shaft Material" class="" name="golf_flexshaft_material[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="golf_flexshaft_material_price" placeholder="Price" class="" name="golf_flexshaft_material_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="golf_flexshaft_material_image" name="golf_flexshaft_material_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#golfflexshaftmaterial_row' + golfflexshaftmaterial_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#golfflexshaftmaterial_disp tbody').append(html);
            colorPicker();
            golfflexshaftmaterial_row++;
        }

        var golfshaftmaterial_row = 0;
        function addGolfShaftMaterial() {
            html = '<tr id="golfshaftmaterial_row' + golfshaftmaterial_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="golf_shaft_material" placeholder="Golf Shaft Material" class="" name="golf_shaft_material[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="golf_shaft_material_price" placeholder="Price" class="" name="golf_shaft_material_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="golf_shaft_material_image" name="golf_shaft_material_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#golfshaftmaterial_row' + golfshaftmaterial_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#golfshaftmaterial_disp tbody').append(html);
            colorPicker();
            golfshaftmaterial_row++;
        }

        var gripsize_row = 0;
        function addGripSize() {
            html = '<tr id="gripsize_row' + gripsize_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="grip_size" placeholder="Grip Size" class="" name="grip_size[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="grip_size_price" placeholder="Price" class="" name="grip_size_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="grip_size_image" name="grip_size_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#gripsize_row' + gripsize_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#gripsize_disp tbody').append(html);
            colorPicker();
            gripsize_row++;
        }

        var griptype_row = 0;
        function addGripType() {
            html = '<tr id="griptype_row' + griptype_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="grip_type" placeholder="Grip Type" class="" name="grip_type[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="grip_type_price" placeholder="Price" class="" name="grip_type_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="grip_type_image" name="grip_type_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#griptype_row' + griptype_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#griptype_disp tbody').append(html);
            colorPicker();
            griptype_row++;
        }

        var hand_row = 0;
        function addHand() {
            html = '<tr id="hand_row' + hand_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="sport_hand" placeholder="Hand" class="" name="sport_hand[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="sport_hand_price" placeholder="Price" class="" name="sport_hand_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="sport_hand_image" name="sport_hand_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#hand_row' + hand_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#hand_disp tbody').append(html);
            hand_row++;
        }

        var handshaftlength_row = 0;
        function addHandShaftLength() {
            html = '<tr id="handshaftlength_row' + handshaftlength_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="hand_shaftlength" placeholder="Hand Shaft Length" class="" name="hand_shaftlength[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="hand_shaftlength_price" placeholder="Price" class="" name="hand_shaftlength_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="hand_shaftlength_image" name="hand_shaftlength_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#handshaftlength_row' + handshaftlength_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#handshaftlength_disp tbody').append(html);
            handshaftlength_row++;
        }

        
        var shaftmaterialgolfflex_row = 0;
        function addShaftMaterialGolfFlex() {
            html = '<tr id="shaftmaterialgolfflex_row' + shaftmaterialgolfflex_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="shaftmaterial_golfflex" placeholder="Shaft Material Golf Flex" class="" name="shaftmaterial_golfflex[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="shaftmaterial_golfflex_price" placeholder="Price" class="" name="shaftmaterial_golfflex_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="shaftmaterial_golfflex_image" name="shaftmaterial_golfflex_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#shaftmaterialgolfflex_row' + shaftmaterialgolfflex_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#shaftmaterialgolfflex_disp tbody').append(html);
            shaftmaterialgolfflex_row++;
        }

        var shaftmaterialgolfflexgolfloft_row = 0;
        function addShaftMaterialGolfFlexGolfLoft() {
            html = '<tr id="shaftmaterialgolfflexgolfloft_row' + shaftmaterialgolfflexgolfloft_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="shaftmaterial_golfflex_golfloft" placeholder="Shaft Material GolfFlex GolfLoft" class="" name="shaftmaterial_golfflex_golfloft[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="shaftmaterial_golfflex_golfloft_price" placeholder="Price" class="" name="shaftmaterial_golfflex_golfloft_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="shaftmaterial_golfflex_golfloft_image" name="shaftmaterial_golfflex_golfloft_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#shaftmaterialgolfflexgolfloft_row' + shaftmaterialgolfflexgolfloft_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#shaftmaterialgolfflexgolfloft_disp tbody').append(html);
            shaftmaterialgolfflexgolfloft_row++;
        }

        var tensionlevel_row = 0;
        function addTensionLevel() {
            html = '<tr id="tensionlevel_row' + tensionlevel_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="tension_level" placeholder="Tension Level" class="" name="tension_level[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="tension_level_price" placeholder="Price" class="" name="tension_level_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="tension_level_image" name="tension_level_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#tensionlevel_row' + tensionlevel_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#tensionlevel_disp tbody').append(html);
            tensionlevel_row++;
        }

        var shaftmaterial_row = 0;
        function addShaftMaterial() {
            html = '<tr id="shaftmaterial_row' + shaftmaterial_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="shaft_material" placeholder="Shaft Material" class="" name="shaft_material[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="shaft_material_price" placeholder="Price" class="" name="shaft_material_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="shaft_material_image" name="shaft_material_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#shaftmaterial_row' + shaftmaterial_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#shaftmaterial_disp tbody').append(html);
            shaftmaterial_row++;
        }

        var itemshape_row = 0;
        function addItemShape() {
            html = '<tr id="itemshape_row' + itemshape_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="item_shape" placeholder="Item Shape" class="" name="item_shape[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="item_shape_price" placeholder="Price" class="" name="item_shape_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="item_shape_image" name="item_shape_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#itemshape_row' + itemshape_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#itemshape_disp tbody').append(html);
            itemshape_row++;
        }

        var sizeweightsupported_row = 0;
        function addSizeWeightSupported() {
            html = '<tr id="sizeweightsupported_row' + sizeweightsupported_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="size_weight_supported" placeholder="Size Weight Supported" class="" name="size_weight_supported[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="size_weight_supported_price" placeholder="Price" class="" name="size_weight_supported_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="size_weight_supported_image" name="size_weight_supported_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#sizeweightsupported_row' + sizeweightsupported_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#sizeweightsupported_disp tbody').append(html);
            sizeweightsupported_row++;
        }

        var stylename_row = 0;
        function addStyleName() {
            html = '<tr id="stylename_row' + stylename_row + '">'; 

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="text" id="style_name" placeholder="Style Name" class="" name="style_name[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="number" id="style_name_price" placeholder="Price" class="" name="style_name_price[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left">' +
                '<div class="input-field col s12">\n' +
                '<input type="file" id="style_name_image" name="style_name_image[]" value="">\n' +
                '</div>' +
                '</td>';

            html += '  <td class="text-left"><button type="button" onclick="$(\'#stylename_row' + stylename_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

            html += '</tr>';

            $('#stylename_disp tbody').append(html);
            stylename_row++;
        }

    </script>


    <script type="text/javascript"><!--
        var discount_row = 0;

        function addDiscount() {
            html = '<tr id="discount-row' + discount_row + '">';
            html += '  <td class="text-right"><input type="number" name="product_discount[' + discount_row + '][price]" value="" placeholder="Price" class="form-control" /></td>';
            html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control datepicker" /><span class="input-group-btn"></span></div></td>';
            html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control datepicker" /><span class="input-group-btn"></span></div></td>';
            html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#discount tbody').append(html);

            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15 // Creates a dropdown of 15 years to control year
            });

            discount_row++;
        }

        if(parseInt($('#att_size').val())+1 > 0)
        {
            var att_size = parseInt($('#att_size').val())+1;
        }
        else
        {
            var att_size = 0;
        }
        var attribute_row = att_size;

        function addAttribute() {
            html = '<tr id="attribute-row' + attribute_row + '">';
            html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" placeholder="Attribute" class="form-control" /></td>';
            html += '  <td class="text-left">';
            html += '<div class="input-group"><textarea name="product_attribute[' + attribute_row + '][description]" rows="5" placeholder="Text" class="materialize-textarea"></textarea></div>';
            html += '  </td>';
            html += '  <td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#attribute tbody').append(html);
            attribute_row++;
        }

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
            colorPicker();
            // Used events
            var drEvent = $('.dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function (event, element) {
                var file = element.filename;
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'get',
                                url: '{{ route('get:delete_products_screenshots') }}',
                                data: {file: file},
                                success: function (result) {
                                    if (result.success == true) {
                                        location.reload();
                                        swal("Deleted!", "Your subcategory has been deleted.", "success");
                                    } else {
                                        $.notify(result.message, "error");
                                    }
                                }
                            });
                        } else {
                            swal("Cancelled", "Your employee is safe :)", "error");
                        }
                    });
            });
        });

        $(document).on('click', '.removeScreenshots', function () {
            var screenId = $(this).attr('screenId');
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'get',
                            url: '{{ route('get:delete_products_screenshots') }}',
                            data: {screenId: screenId},
                            success: function (result) {
                                if (result.success == true) {
                                    location.reload();
                                    swal("Deleted!", "Your additional image has been deleted.", "success");
                                } else {
                                    $.notify(result.message, "error");
                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "Your employee is safe :)", "error");
                    }
                });
        });


        @if(isset($product))
        $("#formValidate").validate({
            rules: {
                name: 'required',
                desc: 'required',
                price: 'required',
                subcategory:'required',
                m_keywords: 'required',
                model: 'required',
                brand: 'required',
                status: 'required',
                quantity: {
                    required: true,
                    number: true
                }
            },
            //For custom messages
            messages: {
                name: "Please enter your product name..!",
                subcategory:'Please select subcategory',
                desc: "Please enter your product desc..!",
                price: "Please enter your product price..!",
                m_keywords: "Please enter your product meta keywords..!",
                model: "Please enter your product model..!",
                brand: "Enter your product brand..!",
                status: "Enter your product status..!",
                product_img: "Enter your product image..!",
                extension: "Enter valid product image like gif|jpg|jpeg|tiff|png..!",
                quantity: "Enter your mobile product quantity..!",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
        @else
        $("#formValidate").validate({
            rules: {
                name: 'required',
                subcategory:'required',
                desc: 'required',
                price: 'required',
                m_keywords: 'required',
                model: 'required',
                brand: 'required',
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                status: 'required',
                @endif
                product_img: {
                    required: true,
                    extension: "gif|jpg|jpeg|tiff|png"
                },
                quantity: {
                    required: true,
                    number: true
                }
            },
            //For custom messages
            messages: {
                name: "Please enter your product name..!",
                subcategory:'Please select subcategory',
                desc: "Please enter your product desc..!",
                price: "Please enter your product price..!",
                m_keywords: "Please enter your product meta keywords..!",
                model: "Please enter your product model..!",
                brand: "Enter your product brand..!",
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                status: "Enter your product status..!",
                @endif
                product_img: "Enter your product image..!",
                extension: "Enter valid product image like gif|jpg|jpeg|tiff|png..!",
                quantity: "Enter your mobile product quantity..!",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
        @endif

        $('.isColor').on('change', function () {
            if ($(this).val() == 1) {
                getProductColor();
            } else {
                $('.productColor').html('');
            }
        });

        $('.isSize').on('change', function () {
            if ($(this).val() == 1) {
                getProductSize();
            } else {
                $('.productSize').html('');
            }
        });

        $('.isSizeColor').on('change', function () {
            if ($(this).val() == 1) {
                getProductSizeColor();
            } else {
                $('.productSizeColor').html('');
            }
        });

         $('.isScent').on('change', function () {
            if ($(this).val() == 1) {
                getProductScent();
            } else {
                $('.scent').html('');
            }
        });

        $('.isSizeScent').on('change', function () {

            if ($(this).val() == 1) {
                getProductSizeScent();
            } else {
                $('.size_scent').html('');
            }
        });


        $('.isPaperback').on('change', function () {

            if ($(this).val() == 1) {
                getProductPaperback();
            } else {
                $('.paperback').html('');
            }
        });

        $('.isHardcover').on('change', function () {

            if ($(this).val() == 1) {
                getProductHardcover();
            } else {
                $('.hardcover').html('');
            }
        });

        $('.isAudioCD').on('change', function () {

            if ($(this).val() == 1) {
                getProductAudioCD();
            } else {
                $('.audiocd').html('');
            }
        });


        $('.isPattern').on('change', function () {

            if ($(this).val() == 1) {
                getProductPattern();
            } else {
                $('.pattern').html('');
            }
        });

        $('.isCupSize').on('change', function () {

            if ($(this).val() == 1) {
                getProductCupSize();
            } else {
                $('.cupsize').html('');
            }
        });

        $('.isCupSizeColor').on('change', function () {

            if ($(this).val() == 1) {
                getProductCupSizeColor();
            } else {
                $('.cupsizecolor').html('');
            }
        });

        $('.isColorLensWidth').on('change', function () {

            if ($(this).val() == 1) {
                getProductColorLensWidth();
            } else {
                $('.colorlenswidth').html('');
            }
        });

        $('.isColorMagni').on('change', function () {

            if ($(this).val() == 1) {
                getProductColorMagnificationStrength();
            } else {
                $('.colormagnificationstrength').html('');
            }
        });

        $('.isLensColor').on('change', function () {

            if ($(this).val() == 1) {
                getProductLensColor();
            } else {
                $('.lenscolor').html('');
            }
        });


        $('.isColorMaterial').on('change', function () {

            if ($(this).val() == 1) {
                getProductColorMaterial();
            } else {
                $('.colormaterial').html('');
            }
        });


         $('.isFlavor').on('change', function () {

            if ($(this).val() == 1) {
                getProductFlavor();
            } else {
                $('.productFlavor').html('');
            }
        });


        $('.isWeight').on('change', function () {

            if ($(this).val() == 1) {
                getProductWeight();
            } else {
                $('.productWeight').html('');
            }
        });

        $('.isFlavorWeight').on('change', function () {
            if ($(this).val() == 1) {
                getFlavorWeight();
            } else {
                $('.flavorweight').html('');
            }
        });

        $('.isFlavorSize').on('change', function () {
            if ($(this).val() == 1) {
                getFlavorSize();
            } else {
                $('.flavorsize').html('');
            }
        });

        $('.isProductMaterial').on('change', function () {
            if ($(this).val() == 1) {
                getProductMaterial();
            } else {
                $('.productmaterial').html('');
            }
        });

        $('.isMaterialSize').on('change', function () {
            if ($(this).val() == 1) {
                getMaterialSize();
            } else {
                $('.materialsize').html('');
            }
        });

        // Jwellery

        $('.isMetalType').on('change', function () {
            if ($(this).val() == 1) {
                getMetalType();
            } else {
                $('.metaltype').html('');
            }
        });

        $('.isSizePerPearl').on('change', function () {
            if ($(this).val() == 1) {
                getSizePerPearl();
            } else {
                $('.sizeperpearl').html('');
            }
        });

        $('.isColorMetalType').on('change', function () {
            if ($(this).val() == 1) {
                getColorMetalType();
            } else {
                $('.colormetaltype').html('');
            }
        });

        $('.isColorItemLength').on('change', function () {
            if ($(this).val() == 1) {
                getColorItemLength();
            } else {
                $('.coloritemlength').html('');
            }
        });

        $('.isGemType').on('change', function () {
            if ($(this).val() == 1) {
                getGemType();
            } else {
                $('.gemtype').html('');
            }
        });

        $('.isMetalGemType').on('change', function () {
            if ($(this).val() == 1) {
                getMetalGemType();
            } else {
                $('.metalgemtype').html('');
            }
        });


        $('.isTotalGemWeight').on('change', function () {
            if ($(this).val() == 1) {
                getTotalGemWeight();
            } else {
                $('.totalgemweight').html('');
            }
        });

        $('.isTotalDiamondWeight').on('change', function () {
            if ($(this).val() == 1) {
                getTotalDiamondWeight();
            } else {
                $('.totaldiamondweight').html('');
            }
        });

        $('.isMetalTypeTotalDiamondWeight').on('change', function () {
            if ($(this).val() == 1) {
                getMetalTypeTotalDiamondWeight();
            } else {
                $('.metaltypetotaldiamondweight').html('');
            }
        });

        $('.isItemLengthGemtype').on('change', function () {
            if ($(this).val() == 1) {
                getItemLengthGemtype();
            } else {
                $('.itemlengthgemtype').html('');
            }
        });

        $('.isItemLengthMaterial').on('change', function () {
            if ($(this).val() == 1) {
                getItemLengthMaterial();
            } else {
                $('.itemlengthmaterial').html('');
            }
        });

        $('.isItemLengthSizePerPearl').on('change', function () {
            if ($(this).val() == 1) {
                getItemLengthSizePerPearl();
            } else {
                $('.itemlengthsizeperpearl').html('');
            }
        });

        $('.isItemLengthMetalType').on('change', function () {
            if ($(this).val() == 1) {
                getItemLengthMetalType();
            } else {
                $('.itemlengthmetaltype').html('');
            }
        });
        
        $('.isItemLengthTotalDiamondWeight').on('change', function () {
            if ($(this).val() == 1) {
                getItemLengthTotalDiamondWeight();
            } else {
                $('.itemlengthtotaldiamondweight').html('');
            }
        });

        $('.isItemLength').on('change', function () {
            if ($(this).val() == 1) {
                getItemLength();
            } else {
                $('.itemlength').html('');
            }
        });
        
        $('.isRingSize').on('change', function () {
            if ($(this).val() == 1) {
                getRingSize();
            } else {
                $('.ringsize').html('');
            }
        });

        $('.isMetalTypeRingSize').on('change', function () {
            if ($(this).val() == 1) {
                getMetalTypeRingSize();
            } else {
                $('.metaltyperingsize').html('');
            }
        });

        $('.isColorRingSize').on('change', function () {
            if ($(this).val() == 1) {
                getColorRingSize();
            } else {
                $('.colorringsize').html('');
            }
        });

        $('.isRingSizeGemType').on('change', function () {
            if ($(this).val() == 1) {
                getRingSizeGemType();
            } else {
                $('.ringsizegemtype').html('');
            }
        });
        
        $('.isRingSizeTotalDiamondWeight').on('change', function () {
            if ($(this).val() == 1) {
                getRingSizeTotalDiamondWeight();
            } else {
                $('.ringsizetotaldiamondweight').html('');
            }
        });
        // Jwellery Over

        // Office start
        $('.isNumberOfItems').on('change', function () {
            if ($(this).val() == 1) {
                getNumberOfItems();
            } else {
                $('.numberofitems').html('');
            }
        });

        $('.isPaperSize').on('change', function () {
            if ($(this).val() == 1) {
                getPaperSize();
            } else {
                $('.papersize').html('');
            }
        });

        $('.isMaximumExpandableSize').on('change', function () {
            if ($(this).val() == 1) {
                getMaximumExpandableSize();
            } else {
                $('.maximumexpandablesize').html('');
            }
        });

        $('.isLineSize').on('change', function () {
            if ($(this).val() == 1) {
                getLineSize();
            } else {
                $('.linesize').html('');
            }
        });
        // Office Over

        // Shoes & Handbags
        $('.isStyleSize').on('change', function () {
            if ($(this).val() == 1) {
                getStyleSize();
            } else {
                $('.stylesize').html('');
            }
        });

        $('.isShoesStyle').on('change', function () {
            if ($(this).val() == 1) {
                getShoesStyle();
            } else {
                $('.shoesstyle').html('');
            }
        });
        // Shoes & Handbags

        // Watches
        $('.isBandColor').on('change', function () {
            if ($(this).val() == 1) {
                getBandColor();
            } else {
                $('.bandcolor').html('');
            }
        });

        // Sport
        $('.isGolfLoft').on('change', function () {
            if ($(this).val() == 1) {
                getGolfLoft();
            } else {
                $('.golfloft').html('');
            }
        });

        $('.isGolfFlexMaterial').on('change', function () {
            if ($(this).val() == 1) {
                getGolfFlexMaterial();
            } else {
                $('.golfflexmaterial').html('');
            }
        });

        $('.isGolfFlexShaftMaterial').on('change', function () {
            if ($(this).val() == 1) {
                getGolfFlexShaftMaterial();
            } else {
                $('.golfflexshaftmaterial').html('');
            }
        });

        $('.isGolfShaftMaterial').on('change', function () {
            if ($(this).val() == 1) {
                getGolfShaftMaterial();
            } else {
                $('.golfshaftmaterial').html('');
            }
        });

        $('.isGripSize').on('change', function () {
            if ($(this).val() == 1) {
                getGripSize();
            } else {
                $('.gripsize').html('');
            }
        });

        $('.isGripType').on('change', function () {
            if ($(this).val() == 1) {
                getGripType();
            } else {
                $('.griptype').html('');
            }
        });

        $('.isHand').on('change', function () {
            if ($(this).val() == 1) {
                getHand();
            } else {
                $('.hand').html('');
            }
        });

        $('.isHandShaftLength').on('change', function () {
            if ($(this).val() == 1) {
                getHandShaftLength();
            } else {
                $('.handshaftlength').html('');
            }
        });

        $('.isShaftMaterialGolfFlex').on('change', function () {
            if ($(this).val() == 1) {
                getShaftMaterialGolfFlex();
            } else {
                $('.shaftmaterialgolfflex').html('');
            }
        });

        $('.isShaftMaterialGolfFlexGolfLoft').on('change', function () {
            if ($(this).val() == 1) {
                getShaftMaterialGolfFlexGolfLoft();
            } else {
                $('.shaftmaterialgolfflexgolfloft').html('');
            }
        });

        $('.isTenssionLevel').on('change', function () {
            if ($(this).val() == 1) {
                getTensionLevel();
            } else {
                $('.tensionlevel').html('');
            }
        });

        $('.isShaftMaterial').on('change', function () {
            if ($(this).val() == 1) {
                getShaftMaterial();
            } else {
                $('.shaftmaterial').html('');
            }
        });

        $('.isItemShape').on('change', function () {
            if ($(this).val() == 1) {
                getItemShape();
            } else {
                $('.itemshape').html('');
            }
        });

        $('.isSizeWeightSupported').on('change', function () {
            if ($(this).val() == 1) {
                getSizeWeightSupported();
            } else {
                $('.sizeweightsupported').html('');
            }
        });

        $('.isStyleName').on('change', function () {
            if ($(this).val() == 1) {
                getStyleName();
            } else {
                $('.stylename').html('');
            }
        });


        function getProductColor() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_color') }}",
                success: function (result) {
                    $('.productColor').html(result);
                }
            });
        }

        function getProductSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_size') }}",
                success: function (result) {
                    $('.productSize').html(result);
                }
            });
        }

        function getProductSizeColor() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_size_color') }}",
                success: function (result) {
                    $('.productSizeColor').html(result);
                }
            });
        }

        function getProductScent() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_scent') }}",
                success: function (result) {
                    
                    $('.scent').html(result);
                }
            });
        }

        function getProductSizeScent() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_size_scent') }}",
                success: function (result) {
                    $('.size_scent').html(result);
                }
            });
        }

        function getProductPaperback() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_paperback') }}",
                success: function (result) {
                    $('.paperback').html(result);
                }
            });
        }

        function getProductHardcover() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_hardcover') }}",
                success: function (result) {
                    $('.hardcover').html(result);
                }
            });
        }

        function getProductAudioCD() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_audiocd') }}",
                success: function (result) {
                    $('.audiocd').html(result);
                }
            });
        }

        function getProductPattern() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_pattern') }}",
                success: function (result) {
                    $('.pattern').html(result);
                }
            });
        }

        function getProductCupSize() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_cup_size') }}",
                success: function (result) {
                    $('.cupsize').html(result);
                }
            });
        }

        function getProductCupSizeColor() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_cup_size_color') }}",
                success: function (result) {
                    $('.cupsizecolor').html(result);
                }
            });
        }

        function getProductColorLensWidth() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_color_lens_width') }}",
                success: function (result) {
                    $('.colorlenswidth').html(result);
                }
            });
        }


        function getProductColorMagnificationStrength() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_color_magnification_strength') }}",
                success: function (result) {
                    $('.colormagnificationstrength').html(result);
                }
            });
        }

        function getProductLensColor() {

            $.ajax({
                type: 'get',
                url: "{{ route('get:product_lens_color') }}",
                success: function (result) {
                    $('.lenscolor').html(result);
                }
            });
        }

        function getProductColorMaterial() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_color_material') }}",
                success: function (result) {
                    $('.colormaterial').html(result);
                }
            });
        }

        function getProductFlavor() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_flavor') }}",
                success: function (result) {
                    $('.productFlavor').html(result);
                }
            });
        }

        function getProductWeight() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_weight') }}",
                success: function (result) {
                    $('.productWeight').html(result);
                }
            });
        }

        function getFlavorSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_flavor_size') }}",
                success: function (result) {
                    $('.flavorsize').html(result);
                }
            });
        }

        function getFlavorWeight() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_flavor_weight') }}",
                success: function (result) {
                    $('.flavorweight').html(result);
                }
            });
        }

        function getProductMaterial() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_material') }}",
                success: function (result) {
                    $('.productmaterial').html(result);
                }
            });
        }

        function getMaterialSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_material_size') }}",
                success: function (result) {
                    $('.materialsize').html(result);
                }
            });
        }

        // Jwellery
        function getMetalType() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_metaltype') }}",
                success: function (result) {
                    $('.metaltype').html(result);
                }
            });
        }

        function getSizePerPearl() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_sizeperpearl') }}",
                success: function (result) {
                    $('.sizeperpearl').html(result);
                }
            });
        }

        function getColorMetalType() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_color_metaltype') }}",
                success: function (result) {
                    $('.colormetaltype').html(result);
                }
            });
        }

        function getColorItemLength() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_color_itemlength') }}",
                success: function (result) {
                    $('.coloritemlength').html(result);
                }
            });
        }

        function getGemType() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_gemtype') }}",
                success: function (result) {
                    $('.gemtype').html(result);
                }
            });
        }

        function getMetalGemType() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_metalgemtype') }}",
                success: function (result) {
                    $('.metalgemtype').html(result);
                }
            });
        }

        function getTotalGemWeight() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_total_gemweight') }}",
                success: function (result) {
                    $('.totalgemweight').html(result);
                }
            });
        }

        function getTotalDiamondWeight() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_total_diamondweight') }}",
                success: function (result) {
                    $('.totaldiamondweight').html(result);
                }
            });
        }

        // Start from here... 14-08-2018

        function getMetalTypeTotalDiamondWeight() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_metaltype_totaldiamondweight') }}",
                success: function (result) {
                    $('.metaltypetotaldiamondweight').html(result);
                }
            });
        }

        function getItemLengthGemtype() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_itemlength_gemtype') }}",
                success: function (result) {
                    $('.itemlengthgemtype').html(result);
                }
            });
        }

        function getItemLengthMaterial() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_itemlength_material') }}",
                success: function (result) {
                    $('.itemlengthmaterial').html(result);
                }
            });
        }

        function getItemLengthSizePerPearl() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_itemlength_sizeperpearl') }}",
                success: function (result) {
                    $('.itemlengthsizeperpearl').html(result);
                }
            });
        }
       
        function getItemLengthMetalType() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_itemlength_metaltype') }}",
                success: function (result) {
                    $('.itemlengthmetaltype').html(result);
                }
            });
        }
       
        function getItemLengthTotalDiamondWeight() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_itemlength_totaldiamondweight') }}",
                success: function (result) {
                    $('.itemlengthtotaldiamondweight').html(result);
                }
            });
        }

        function getItemLength() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_itemlength') }}",
                success: function (result) {
                    $('.itemlength').html(result);
                }
            });
        }
       
        function getRingSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_ringsize') }}",
                success: function (result) {
                    $('.ringsize').html(result);
                }
            });
        }
       
        function getMetalTypeRingSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_metaltype_ringsize') }}",
                success: function (result) {
                    $('.metaltyperingsize').html(result);
                }
            });
        }

        function getColorRingSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_color_ringsize') }}",
                success: function (result) {
                    $('.colorringsize').html(result);
                }
            });
        }

        function getRingSizeGemType() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_ringsize_gemtype') }}",
                success: function (result) {
                    $('.ringsizegemtype').html(result);
                }
            });
        }

        function getRingSizeTotalDiamondWeight() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_ringsize_totaldiamondweight') }}",
                success: function (result) {
                    $('.ringsizetotaldiamondweight').html(result);
                }
            });
        }
        // Jwellery

        //Office
        function getNumberOfItems() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_numberofitems') }}",
                success: function (result) {
                    $('.numberofitems').html(result);
                }
            });
        }

        function getPaperSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_papersize') }}",
                success: function (result) {
                    $('.papersize').html(result);
                }
            });
        }

        function getMaximumExpandableSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_maximum_expandablesize') }}",
                success: function (result) {
                    $('.maximumexpandablesize').html(result);
                }
            });
        }

        function getLineSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_linesize') }}",
                success: function (result) {
                    $('.linesize').html(result);
                }
            });
        }
        // Office

        // Shoes & Handbag
        function getStyleSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_stylesize') }}",
                success: function (result) {
                    $('.stylesize').html(result);
                }
            });
        }

        function getShoesStyle() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_shoesstyle') }}",
                success: function (result) {
                    $('.shoesstyle').html(result);
                }
            });
        }
        
        // Watches
        function getBandColor() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_bandcolor') }}",
                success: function (result) {
                    $('.bandcolor').html(result);
                }
            });
        } 

        // Sports
        function getGolfLoft() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_golfloft') }}",
                success: function (result) {
                    $('.golfloft').html(result);
                }
            });
        } 

        function getGolfFlexMaterial() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_golf_flex_material') }}",
                success: function (result) {
                    $('.golfflexmaterial').html(result);
                }
            });
        } 

         function getGolfFlexShaftMaterial() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_golf_flex_shaft_material') }}",
                success: function (result) {
                    $('.golfflexshaftmaterial').html(result);
                }
            });
        } 

        function getGolfShaftMaterial() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_golf_shaft_material') }}",
                success: function (result) {
                    $('.golfshaftmaterial').html(result);
                }
            });
        } 


        function getGripSize() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_gripsize') }}",
                success: function (result) {
                    $('.gripsize').html(result);
                }
            });
        } 

        function getGripType() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_griptype') }}",
                success: function (result) {
                    $('.griptype').html(result);
                }
            });
        } 

        function getHand() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_hand') }}",
                success: function (result) {
                    $('.hand').html(result);
                }
            });
        } 

        function getHandShaftLength() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_hand_shaft_length') }}",
                success: function (result) {
                    $('.handshaftlength').html(result);
                }
            });
        } 

        function getShaftMaterialGolfFlex() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_shaftmaterial_golfflex') }}",
                success: function (result) {
                    $('.shaftmaterialgolfflex').html(result);
                }
            });
        }
            
        function getShaftMaterialGolfFlexGolfLoft() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_shaftmaterial_golfflex_golfloft') }}",
                success: function (result) {
                    $('.shaftmaterialgolfflexgolfloft').html(result);
                }
            });
        }

        function getTensionLevel() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_tensionlevel') }}",
                success: function (result) {
                    $('.tensionlevel').html(result);
                }
            });
        }

        function getShaftMaterial() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_shaft_material') }}",
                success: function (result) {
                    $('.shaftmaterial').html(result);
                }
            });
        }

        function getItemShape() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_itemshape') }}",
                success: function (result) {
                    $('.itemshape').html(result);
                }
            });
        }

         function getSizeWeightSupported() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_size_weight_supported') }}",
                success: function (result) {
                    $('.sizeweightsupported').html(result);
                }
            });
        }


         function getStyleName() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:product_stylename') }}",
                success: function (result) {
                    $('.stylename').html(result);
                }
            });
        }


    </script>


<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<!-- get products autocomplete -->
<script language="javascript">
function search_func(value)
{ 
    var selected;  
    var val = $.trim(value);

    $.ajax({
       type: "GET",
       url: "{{ route('get:get_products') }}",
       data: {'productname' : val},
       dataType: "json",
       success: function(data){
            var products = [];
            $.each( data, function( key, value ) {
                products.push(value.name);
            });
            $("#name").autocomplete({
                source: products,
                select: function( event, ui ) {  selected = true;  },
                close: function() { if(selected==true){ getFormData();} }
            });   
        }
    });
}


function getFormData()
{
   var pname = $("#name").val();

   $.ajax({
       type: "GET",
       url: "{{ route('get:get_products_formdata') }}",
       data: {'productname' : pname},
       dataType: "json",
       success: function(data){
            console.log(data);

            var id = data.slug;

            var url ="{{ route('get:get_products_filldata','id') }}";
            url = url.replace('id',id);
            window.location=url;
           
        }
    });
}



// ISHWAR
$(document).on('click', '.colorRemove', function () {
            $(this).parent().parent().remove();

            var id = $(this).attr('attribute_id');
            if(id){
                $.ajax({
                    type: 'post',
                    url: '{{ route('post:remove_product_color') }}',
                    data: {"attribute_id" : id,"_token":"{{ csrf_token() }}"},
                    success: function (result) {
                        $.notify(result.message, "success");
                        location.reload();
                    }
                })
            }

        });

        
        $(document).on('change', '.newImageUpload', function () {

            var id = $(this).attr('attribute_id');
            var name = $(this).attr('name');

            var file_data = $(this).prop("files")[0];   
            var form_data = new FormData();                  
            form_data.append("file", file_data);            
            form_data.append("id", id);
            form_data.append("name", name);
            form_data.append("_token", "{{ csrf_token() }}");

            if(id){
                $.ajax({
                   dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,

                    type: 'post',
                    url: '{{ route('post:add_color_image') }}',
                    data: form_data,
                    success: function (result) {
                        $.notify(result.message, "success");
                        location.reload();
                    }
                })
            }


        });

        // Remove color image
        $(document).on('click', '.colorImageRemove', function () {
            var imageid = $(this).attr('imageid');
            var imagename = $(this).attr('imagename');

            if(imagename){
                $.ajax({
                    type: 'post',
                    url: '{{ route('post:remove_color_image') }}',
                    data: {"imageid" : imageid, "imagename" : imagename ,"_token":"{{ csrf_token() }}"},
                    success: function (result) {
                        $.notify(result.message, "success");
                        location.reload();
                    }
                })
            }
        });

        $(document).on('focusout', '.oldcolorchange', function () {
            var id = $(this).attr('attribute_id');
            var color = $(this).val();
            
            if(id){
                $.ajax({
                    type: 'post',
                    url: '{{ route('post:update_product_color') }}',
                    data: {"color" : color, "id" : id ,"_token":"{{ csrf_token() }}"},
                    success: function (result) {
                        $.notify(result.message, "success");
                        location.reload();
                    }
                })
            }
        });

        $(document).on('change', '.oldpricechange', function () {
            var id = $(this).attr('attribute_id');
            var price = $(this).val();
            
            if(id){
                $.ajax({
                    type: 'post',
                    url: '{{ route('post:update_product_price') }}',
                    data: {"price" : price, "id" : id ,"_token":"{{ csrf_token() }}"},
                    success: function (result) {
                        $.notify(result.message, "success");
                        // location.reload();
                    }
                })
            }
        });


        // $('#color1').click(function() {
        //     $('#size_color1').not('#color1').removeAttr('checked');
        // });


        // $(document).on('click', '.is_color', function (e) {
            
        //     if ($('input[name=size_color]').is(':checked') == false ) {
        //             $.notify("Select product size..!!", "error");
        //             return false;
        //     }

        // });

//         $('input.example').on('change', function() {
//     $('input.example').not(this).prop('checked', false);  
// });

</script>




@endsection
