<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 2/26/2018
 * Time: 12:46 PM
 */

namespace App\Classes;
use App\Model\ColorsImages;
use App\Model\HomepageSlider;
use App\Model\Order;
use App\Model\Products;
use App\Model\ProductsAttributes;
use App\Model\ProductsDiscount;
use App\Model\ProductsScreenshots;
use App\Model\ProductsSliders;
use App\Model\SubcategorySlider;
use App\Model\TaxClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdminManageService
{
    public function SaveTaxClassDetails($taxClass, $request)
    {
        if (isset($taxClass->name)) {
            if ($taxClass->name != $request->get('name')) {
                $taxClass->slug = $taxClass->getSlugForCustom($taxClass->name);
            }
        } else {
            $taxClass->slug = $taxClass->getSlugForCustom($request->get('name'));
        }
        $taxClass->name = $request->get('name');
        $taxClass->tax_rate = $request->get('tax_rate');
        if ($request->get('type') == TaxClass::FLAT) {
            $taxClass->type = TaxClass::FLAT;
        }
        if ($request->get('type') == TaxClass::PERCENTAGE) {
            $taxClass->type = TaxClass::PERCENTAGE;
        }
        $taxClass->save();
        return $taxClass;
    }

    public function saveCurrenciesDetails($currency, $request)
    {
        if (isset($currency->name)) {
            if ($currency->name != $request->get('name')) {
                $currency->slug = $currency->getSlugForCustom($currency->name);
            }
        } else {
            $currency->slug = $currency->getSlugForCustom($request->get('name'));
        }
        $currency->name = $request->get('name');
        $currency->code = $request->get('code');
        $currency->value = $request->get('value');
        $currency->status = $request->get('status');
        $currency->save();
        return $currency;
    }

    public function saveBulkProductDetails($product, $value)
    {
        $product->user_id = Auth::user()->id;
        $product->name = $value->name;
        $product->desc = $value->desc;
        $product->m_title = $value->m_title;
        $product->m_desc = $value->m_desc;
        $product->m_keywords = $value->m_keywords;
        $product->m_tag = $value->m_tag;
        $product->model = $value->model;
        $product->sku = $value->sku;
        $product->hsn = $value->hsn;
        $product->isbn = $value->isbn;
        $product->price = $value->price;
        $product->quantity = $value->quantity;
        $product->reward_points = $value->reward_points;
        $product->video_thumb = $value->video_thumb;
        $product->video_id = $value->video_id;
        $product->url = $value->url;
        $product->tax_class_id = $value->tax_class_id;
        $product->brand_id = $value->brand_id;
        $product->sub_category_id = $value->sub_category_id;
        $product->status = 0;
        $product->size_chart = $value->size_chart;
        $product->order = $value->order;
        $product->recommend = $value->recommend;
        $product->special = $value->special;
        $product->new_arrival = $value->new_arrival;
        return $product;
    }

    public function saveProductDetails($product, $request)
    {
        $product->name = $request->get('name');
        $product->desc = $request->get('desc');
        $product->price = $request->get('price');
        $product->sub_category_id = $request->get('subcategory2_id'); //ishwar
        $product->shipping_charge = $request->get('shipping_charge'); //ishwar
        // $product->sub_category_id = $request->get('subcategory');
        $product->m_title = $request->get('m_title');
        $product->m_keywords = $request->get('m_keywords');
        $product->m_tag = $request->get('m_tag');
        $product->m_desc = $request->get('m_desc');
        $product->model = $request->get('model');
        $product->sku = $request->get('sku');
        $product->hsn = $request->get('hsn');
        $product->isbn = $request->get('isbn');
        $product->tax_class_id = $request->get('tax_class');
        $product->quantity = $request->get('quantity');
        $product->brand_id = $request->get('brand');
        $product->reward_points = $request->get('reward_points');
        if ($request->get('status')) {
            $product->status = $request->get('status');
        }
        if ($request->get('url')) {
            $product->url = $request->get('url');
            $videoid = $product->getVideoId();
            $product->video_id = $videoid;
            $thumbUrl = 'http://img.youtube.com/vi/' . $videoid . '/hqdefault.jpg';
            $thumbName = time() . '.jpg';
            $destination = public_path('/videothumb/');
            $fileName = $destination . $thumbName;

            file_put_contents($fileName, $this->getFile($thumbUrl));
            if ($request->get('oldVideoImg')) {
                \File::delete(public_path('videothumb/' . $request->get('oldVideoImg')));
            }
            $product->video_thumb = $thumbName;
        }
        return $product;
    }

    public function getFile($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $raw = curl_exec($ch);
        curl_close($ch);
        if ($raw != false) {
            return $raw;
        }
    }

    public function saveProductImages($request, $product)
    {
        if ($request->file('product_img')) {
            $file = $request->file('product_img');
            $destinationPath = public_path('/productimg/');
            $productImg = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $productImg);
            $product->product_img = $productImg;
            if (\File::exists(public_path() . '/productimg/' . $request->get('oldProductImg'))) {
                \File::delete(public_path() . '/productimg/' . $request->get('oldProductImg'));
            } elseif (\File::exists(public_path() . '/100ProductImg/' . $request->get('oldProductImg'))) {
                \File::delete(public_path() . '/100ProductImg/' . $request->get('oldProductImg'));
            } elseif (\File::exists(public_path() . '/268ProductImg/' . $request->get('oldProductImg'))) {
                \File::delete(public_path() . '/268ProductImg/' . $request->get('oldProductImg'));
            } elseif (\File::exists(public_path() . '/300ProdctImg/' . $request->get('oldProductImg'))) {
                \File::delete(public_path() . '/300ProdctImg/' . $request->get('oldProductImg'));
            } elseif (\File::exists(public_path() . '/420ProductImg/' . $request->get('oldProductImg'))) {
                \File::delete(public_path() . '/420ProductImg/' . $request->get('oldProductImg'));
            } elseif (\File::exists(public_path() . '/850ProductImg/' . $request->get('oldProductImg'))) {
                \File::delete(public_path() . '/850ProductImg/' . $request->get('oldProductImg'));
            }

            $thumb_img = Image::make(public_path('/productimg/' . $productImg))->resize(null, 327,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(268, 327);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('268ProductImg/') . $productImg);

            $thumb_img1 = Image::make(public_path('/productimg/' . $productImg))->resize(null, 366,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas2 = Image::canvas(300, 366);
            $canvas2->insert($thumb_img1, 'center');
            $canvas2->save(public_path('300ProdctImg/') . $productImg);

            $thumb_img2 = Image::make(public_path('/productimg/' . $productImg))->resize(null, 512,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas3 = Image::canvas(420, 512);
            $canvas3->insert($thumb_img2, 'center');
            $canvas3->save(public_path('420ProductImg/') . $productImg);

            $thumb_img3 = Image::make(public_path('/productimg/' . $productImg))->resize(null, 1036,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas4 = Image::canvas(850, 1036);
            $canvas4->insert($thumb_img3, 'center');
            $canvas4->save(public_path('850ProductImg/') . $productImg);

            $thumb_img4 = Image::make(public_path('/productimg/' . $productImg))->resize(null, 122,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas5 = Image::canvas(100, 122);
            $canvas5->insert($thumb_img4, 'center');
            $canvas5->save(public_path('100ProductImg/') . $productImg);
        } else {
            $product->product_img = $request->get('oldProductImg');
        }

        return $product;
    }

    public function saveProductSizeChart($sizeChart, $product, $oldSizeChartImg = null)
    {
        if ($sizeChart) {
            $destinationPath = public_path('/sizechart/');
            $sizeChartImg = time() . '.' . $sizeChart->getClientOriginalExtension();
            $sizeChart->move($destinationPath, $sizeChartImg);
            $product->size_chart = $sizeChartImg;
            $thumb_img = Image::make(public_path('/sizechart/' . $sizeChartImg))->resize(null, 860,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(971, 860);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('sizechart/') . $sizeChartImg);
            if (\File::exists(public_path() . '/sizechart/' . $oldSizeChartImg)) {
                \File::delete(public_path() . '/sizechart/' . $oldSizeChartImg);
            }
        }
        return $product;
    }

    public function saveAdditionalImage($product, $addition_image)
    {
        foreach ($addition_image as $key => $item) {
            $additionImages = new ProductsScreenshots();
            $additionImages->product_id = $product->id;
            if ($item) {
                $screenshots = $product->slug . '_' . rand(1111, 9999) . '.' . $item->getClientOriginalExtension();
                $item->move(public_path('productScreenshots/'), $screenshots);

                $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots))->resize(null, 122,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                $canvas1 = Image::canvas(100, 122);
                $canvas1->insert($thumb_screen, 'center');
                $canvas1->save(public_path('100ProductImg/') . $screenshots);


                $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                $canvas2 = Image::canvas(420, 512);
                $canvas2->insert($thumb_screen1, 'center');
                $canvas2->save(public_path('420ProductImg/') . $screenshots);

                $thumb_screen2 = Image::make(public_path('productScreenshots/' . $screenshots))->resize(null, 1036,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                $canvas3 = Image::canvas(850, 1036);
                $canvas3->insert($thumb_screen2, 'center');
                $canvas3->save(public_path('850ProductImg/') . $screenshots);

                $additionImages->screenshots = $screenshots;
                $additionImages->save();
            }
        }
        return $additionImages;
    }

    public function saveProductDiscount($product, $product_discounts)
    {
        foreach ($product_discounts as $item) {
            $productDiscount = new ProductsDiscount();
            $productDiscount->product_id = $product->id;
            $productDiscount->price = $item['price'];
            $productDiscount->start_date = Carbon::parse($item['date_start'])->format('Y-m-d');
            $productDiscount->end_date = Carbon::parse($item['date_end'])->format('Y-m-d');
            $productDiscount->save();
        }
        return $productDiscount;
    }

    public function saveproductAttributes($product, $product_attributes)
    {

        // dd($product_attributes);
        foreach ($product_attributes as $item) {
            $productAttr = new ProductsAttributes();
            $productAttr->product_id = $product->id;
            if (isset($productAttr->name)) {
                if ($productAttr->name != $item['name']) {
                    $productAttr->slug = $productAttr->getSlugForCustom($item['name']);
                }
            } else {
                $productAttr->slug = $productAttr->getSlugForCustom($item['name']);
            }
            $productAttr->name = $item['name'];
            $productAttr->desc = $item['description'];
            $productAttr->save();
        }
        return $productAttr;
    }

    public function saveProductAttr($product, $productSizes, $attr , $prices = null, $desc2 = null, $image = null, $isold = null, $request = null)
    {
        foreach ($productSizes as $key => $size) {

            $colorImages = new ProductsScreenshots();
            $colorImages->product_id = $product->id;

            // print_r($image);
            // dd($image);
            if($attr != 'color' || $attr != 'size_color')
            {
                if(isset($image[$key]))
                {   
                    if(is_file($image[$key]))
                    {
                            $screenshots = $product->slug . '_' . rand(1111, 9999) . '.' . $image[$key]->getClientOriginalName();
                            $image[$key]->move(public_path('productScreenshots/'), $screenshots);

                            $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots))->resize(null, 122,
                                function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            $canvas1 = Image::canvas(100, 122);
                            $canvas1->insert($thumb_screen, 'center');
                            $canvas1->save(public_path('100ProductImg/') . $screenshots);


                            $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots))->resize(null, 512,
                                function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            $canvas2 = Image::canvas(420, 512);
                            $canvas2->insert($thumb_screen1, 'center');
                            $canvas2->save(public_path('420ProductImg/') . $screenshots);

                            $thumb_screen2 = Image::make(public_path('productScreenshots/' . $screenshots))->resize(null, 1036,
                                function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            $canvas3 = Image::canvas(850, 1036);
                            $canvas3->insert($thumb_screen2, 'center');
                            $canvas3->save(public_path('850ProductImg/') . $screenshots);

                            $colorImages->screenshots = $screenshots;
                            $colorImages->save();
                    }
                    else
                    {
                       $image = $image[$key];
                    }
                }
            }

            $productSize = new ProductsAttributes();
            $productSize->product_id = $product->id;
            $productSize->name = $attr;
            $productSize->desc = $size;
            $productSize->desc2 = $desc2[$key];
            $productSize->slug = $attr;
            $productSize->product_price = $prices[$key];
            $productSize->image_id = isset( $colorImages->id) ? $colorImages->id : NULL;
            $productSize->save();

            // echo $productSize->name;
            // exit;
            if($productSize->name == 'color')
            {
                $colorImages = new ColorsImages();
                //images 1
                if(isset($request->file('product_color_image1')[$key]))
                {
                    $colorimage1 = $request->file('product_color_image1')[$key];
                    $screenshots1 = 'color1_' . time() . '.' . $colorimage1->getClientOriginalExtension();
                    $colorimage1->move(public_path('productScreenshots/'), $screenshots1);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas1 = Image::canvas(100, 122);
                    $canvas1->insert($thumb_screen, 'center');
                    $canvas1->save(public_path('100ProductImg/') . $screenshots1);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots1);


                }
                else
                {
                    $screenshots1 = '';
                }

                if(isset($request->file('product_color_image2')[$key]))
                {
                    //image 2
                    $colorimage2 = $request->file('product_color_image2')[$key];
                    $screenshots2 =  'color2_' . time() . '.' . $colorimage2->getClientOriginalExtension();
                    $colorimage2->move(public_path('productScreenshots/'), $screenshots2);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots2))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas2 = Image::canvas(100, 122);
                    $canvas2->insert($thumb_screen, 'center');
                    $canvas2->save(public_path('100ProductImg/') . $screenshots2);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots2))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots2);
                }
                else
                {
                    $screenshots2 = '';
                }

                if(isset($request->file('product_color_image3')[$key]))
                {
                    //image 3
                    $colorimage3 = $request->file('product_color_image3')[$key];
                    $screenshots3 = 'color3_' . time() . '.' . $colorimage3->getClientOriginalExtension();
                    $colorimage3->move(public_path('productScreenshots/'), $screenshots3);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots3))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas3 = Image::canvas(100, 122);
                    $canvas3->insert($thumb_screen, 'center');
                    $canvas3->save(public_path('100ProductImg/') . $screenshots3);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots3))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots3);
                }
                else
                {
                    $screenshots3 = '';
                }

                if(isset($request->file('product_color_image4')[$key]))
                {
                    //image 4
                    $colorimage4 = $request->file('product_color_image4')[$key];
                    $screenshots4 = 'color4_' . time() . '.' . $colorimage4->getClientOriginalExtension();
                    $colorimage4->move(public_path('productScreenshots/'), $screenshots4);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots4))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas4 = Image::canvas(100, 122);
                    $canvas4->insert($thumb_screen, 'center');
                    $canvas4->save(public_path('100ProductImg/') . $screenshots4);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots4))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots4);
                }
                else
                {
                    $screenshots4 = '';
                }

                if(isset($request->file('product_color_image5')[$key]))
                {
                    //image 5
                    $colorimage5 = $request->file('product_color_image5')[$key];
                    $screenshots5 = 'color5_' . time() . '.' . $colorimage5->getClientOriginalExtension();
                    $colorimage5->move(public_path('productScreenshots/'), $screenshots5);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots5))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas5 = Image::canvas(100, 122);
                    $canvas5->insert($thumb_screen, 'center');
                    $canvas5->save(public_path('100ProductImg/') . $screenshots5);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots5))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots5);
                }
                else
                {
                    $screenshots5 = '';
                }

                $colorImages->attribute_id = $productSize->id;
                $colorImages->product_id = $product->id;
                $colorImages->image1 = $screenshots1;
                $colorImages->image2 = $screenshots2;
                $colorImages->image3 = $screenshots3;
                $colorImages->image4 = $screenshots4;
                $colorImages->image5 = $screenshots5;

                $colorImages->save();
            }

            if($productSize->name == 'size_color')
            {
                $colorImages = new ColorsImages();
                //images 1
                if(isset($request->file('size_color_image1')[$key]))
                {
                    $colorimage1 = $request->file('size_color_image1')[$key];
                    $screenshots1 = 'color1_' . time() . '.' . $colorimage1->getClientOriginalExtension();
                    $colorimage1->move(public_path('productScreenshots/'), $screenshots1);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas1 = Image::canvas(100, 122);
                    $canvas1->insert($thumb_screen, 'center');
                    $canvas1->save(public_path('100ProductImg/') . $screenshots1);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots1);


                }
                else
                {
                    $screenshots1 = '';
                }

                if(isset($request->file('size_color_image2')[$key]))
                {
                    //image 2
                    $colorimage2 = $request->file('size_color_image2')[$key];
                    $screenshots2 =  'color2_' . time() . '.' . $colorimage2->getClientOriginalExtension();
                    $colorimage2->move(public_path('productScreenshots/'), $screenshots2);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots2))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas2 = Image::canvas(100, 122);
                    $canvas2->insert($thumb_screen, 'center');
                    $canvas2->save(public_path('100ProductImg/') . $screenshots2);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots2))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots2);
                }
                else
                {
                    $screenshots2 = '';
                }

                if(isset($request->file('size_color_image3')[$key]))
                {
                    //image 3
                    $colorimage3 = $request->file('size_color_image3')[$key];
                    $screenshots3 = 'color3_' . time() . '.' . $colorimage3->getClientOriginalExtension();
                    $colorimage3->move(public_path('productScreenshots/'), $screenshots3);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots3))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas3 = Image::canvas(100, 122);
                    $canvas3->insert($thumb_screen, 'center');
                    $canvas3->save(public_path('100ProductImg/') . $screenshots3);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots3))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots3);
                }
                else
                {
                    $screenshots3 = '';
                }

                if(isset($request->file('size_color_image4')[$key]))
                {
                    //image 4
                    $colorimage4 = $request->file('size_color_image4')[$key];
                    $screenshots4 = 'color4_' . time() . '.' . $colorimage4->getClientOriginalExtension();
                    $colorimage4->move(public_path('productScreenshots/'), $screenshots4);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots4))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas4 = Image::canvas(100, 122);
                    $canvas4->insert($thumb_screen, 'center');
                    $canvas4->save(public_path('100ProductImg/') . $screenshots4);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots4))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots4);
                }
                else
                {
                    $screenshots4 = '';
                }

                if(isset($request->file('size_color_image5')[$key]))
                {
                    //image 5
                    $colorimage5 = $request->file('size_color_image5')[$key];
                    $screenshots5 = 'color5_' . time() . '.' . $colorimage5->getClientOriginalExtension();
                    $colorimage5->move(public_path('productScreenshots/'), $screenshots5);

                    $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots5))->resize(null, 122,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    $canvas5 = Image::canvas(100, 122);
                    $canvas5->insert($thumb_screen, 'center');
                    $canvas5->save(public_path('100ProductImg/') . $screenshots5);

                    $thumb_screen1 = Image::make(public_path('productScreenshots/' . $screenshots5))->resize(null, 512,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas = Image::canvas(420, 512);
                    $canvas->insert($thumb_screen1, 'center');
                    $canvas->save(public_path('420ProductImg/') . $screenshots5);
                }
                else
                {
                    $screenshots5 = '';
                }

                $colorImages->attribute_id = $productSize->id;
                $colorImages->product_id = $product->id;
                $colorImages->image1 = $screenshots1;
                $colorImages->image2 = $screenshots2;
                $colorImages->image3 = $screenshots3;
                $colorImages->image4 = $screenshots4;
                $colorImages->image5 = $screenshots5;

                $colorImages->save();
            }
        }
       
        return $productSize;
    }

    public function saveOrderStatus($order, $request)
    {
        if ($request->get('status') == Order::SUCCESS) {
            $order->status = Order::SUCCESS;
        } elseif ($request->get('status') == Order::FAILED) {
            $order->status = Order::FAILED;
        } elseif ($request->get('status') == Order::CANCELED) {
            $order->status = Order::CANCELED;
        } elseif ($request->get('status') == Order::PROCESS) {
            $order->status = Order::PROCESS;
        } elseif ($request->get('status') == Order::RETURNED) {
            $order->status = Order::RETURNED;
        } else {
            $order->status = Order::PENDING;
        }
        $order->save();
        return $order;
    }

    public function getSlug($name)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));

        $count = Products::where('slug', 'like', $slug . '%')->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }

    public function getSellerCommission()
    {
        $commissions = Order::select('users.id', 'users.username', 'order.created_at', 'order.unique_order_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->distinct()
            ->get();
        return $commissions;
    }

    public function saveMainSlider($main_slider, $url)
    {
        $file = $main_slider;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->main_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();

        $image = Image::make(public_path('/slider/') . $sliderImg);
        $image->resize(890, 470);
        $image->save();
        return $slider;
    }

    public function saveSmallSlider($small_slider, $url)
    {
        $file = $small_slider;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->small_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();

        $image = Image::make(public_path('/slider/') . $sliderImg);
        $image->resize(220, 169);
        $image->save();
        return $slider;
    }

    public function saveMediumSlider($medium_slider, $url)
    {
        $file = $medium_slider;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->medium_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();
        $image = Image::make(public_path('/slider/') . $sliderImg);
        $image->resize(350, 169);
        $image->save();

        return true;
    }

    public function saveNewArrivalSlider($new_arrival_sliders, $url)
    {

        $file = $new_arrival_sliders;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->new_arrival_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();

        $thumb_img = Image::make(public_path('/slider/' . $sliderImg))->resize(null, 348,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas1 = Image::canvas(227, 348);
        $canvas1->insert($thumb_img, 'center');
        $canvas1->save(public_path('/slider/') . $sliderImg);

        return true;
    }

    public function saveTopSellerSlider($topSellerSliders, $url)
    {
        $file = $topSellerSliders;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->top_seller_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();

        $canvas1 = $this->resizeImage($sliderImg, 227, 348);
        $canvas1->save(public_path('/slider/') . $sliderImg);

        return true;
    }

    public function resizeImage($file, $height, $width)
    {
        $thumb_img = Image::make(public_path('/slider/' . $file))->resize(null, $width,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas1 = Image::canvas($height, $width);
        $canvas1->insert($thumb_img, 'center');

        return $canvas1;
    }

    public function saveTopSellerHorizontalSlider($topSellerHorizontalSliders, $url)
    {

        $file = $topSellerHorizontalSliders;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->seller_horizontal_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();

        $image = Image::make(public_path('/slider/') . $sliderImg);
        $image->resize(580, 120);
        $image->save();

        return true;
    }

    public function saveSpecialProductSlider($specialProductSliders, $url)
    {
        $file = $specialProductSliders;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->special_product_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();

        $thumb_img = Image::make(public_path('/slider/' . $sliderImg))->resize(null, 348,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas1 = Image::canvas(227, 348);
        $canvas1->insert($thumb_img, 'center');
        $canvas1->save(public_path('/slider/') . $sliderImg);

        return true;
    }

    public function saveRecommendSlider($recommendSliders, $url)
    {
        $file = $recommendSliders;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->recommend_slider = $sliderImg;
        $slider->url = $url;
        $slider->save();

        $thumb_img = Image::make(public_path('/slider/' . $sliderImg))->resize(null, 348,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas1 = Image::canvas(227, 348);
        $canvas1->insert($thumb_img, 'center');
        $canvas1->save(public_path('/slider/') . $sliderImg);

        return true;
    }

    public function savefooterSlider($footerImage)
    {
        $file = $footerImage;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new HomepageSlider();
        $slider->footer_slider = $sliderImg;
        $slider->save();

        $thumb_img = Image::make(public_path('/slider/' . $sliderImg))->resize(null, 1000,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas1 = Image::canvas(1920, 1000);
        $canvas1->insert($thumb_img, 'center');
        $canvas1->save(public_path('/slider/') . $sliderImg);

        return true;
    }

    public function saveSubcatMainSlider($mainSliders)
    {
        foreach ($mainSliders as $item) {
            $file = $item;
            $destinationPath = public_path('/slider/');
            $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $sliderImg);
            $slider = new SubcategorySlider();
            $slider->main_slider = $sliderImg;
            $slider->save();

            $image = Image::make(public_path('/slider/') . $sliderImg);
            $image->resize(870, 288);
            $image->save();
        }
        return true;
    }

    public function saveProductsSlider($mainSliders, $url)
    {
            $file = $mainSliders;
            $destinationPath = public_path('/slider/');
            $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $sliderImg);
            $slider = new ProductsSliders();
            $slider->main_slider = $sliderImg;
            if($url){
                $slider->url = $url;
            $slider->save();

            $thumb_img = Image::make(public_path('/slider/' . $sliderImg))->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('/slider/') . $sliderImg);
        }
        return true;
    }

    public function saveProductsSlider2($sidebar_slider, $url)
    {
        $file = $sidebar_slider;
        $destinationPath = public_path('/slider/');
        $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $sliderImg);
        $slider = new ProductsSliders();
        $slider->sidebar_slider = $sliderImg;
        if($url){
            $slider->url = $url;
        }
        $slider->save();

        $thumb_img = Image::make(public_path('/slider/' . $sliderImg))->resize(null, 281,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas1 = Image::canvas(270, 281);
        $canvas1->insert($thumb_img, 'center');
        $canvas1->save(public_path('/slider/') . $sliderImg);

        return true;
    }

    public function saveSubcatSidebarSlider($sidebarSliders)
    {
        foreach ($sidebarSliders as $item) {
            $file = $item;
            $destinationPath = public_path('/slider/');
            $sliderImg = str_random(5) . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $sliderImg);
            $slider = new SubcategorySlider();
            $slider->sidebar_slider = $sliderImg;
            $slider->save();

            $thumb_img = Image::make(public_path('/slider/' . $sliderImg))->resize(null, 348,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(227, 348);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('/slider/') . $sliderImg);
        }
        return true;
    }


    // ishwar
    public function saveBrandsImages($request, $brand)
    {
        if ($request->file('brand_logo')) {
            $file = $request->file('brand_logo');
            $destinationPath = public_path('/brandsImg/');
            $brandlogo = 'brand_'.time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $brandlogo);

            $brand->brand_logo = $brandlogo;
            if (\File::exists(public_path('/brandsImg/100brands/'). $request->get('oldBrandLogo'))) {
                \File::delete(public_path('/brandsImg/100brands/'). $request->get('oldBrandLogo'));
            }
             elseif (\File::exists(public_path('/brandsImg/250brands/'). $request->get('oldBrandLogo'))) {
                \File::delete(public_path('/brandsImg/250brands/'). $request->get('oldBrandLogo'));
            } 
            elseif (\File::exists(public_path('/brandsImg/500brands/'). $request->get('oldBrandLogo'))) {
                \File::delete(public_path('/brandsImg/500brands/'). $request->get('oldBrandLogo'));
            } 

            /*---------first--------*/
             $thumb_img1 = Image::make(public_path('/brandsImg/' . $brandlogo))->resize(null, 100,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(100, 100);
            $canvas1->insert($thumb_img1, 'center');
            $canvas1->save(public_path('/brandsImg/100brands/') . $brandlogo);

            // /*---------second--------*/
            $thumb_img2 = Image::make(public_path('/brandsImg/' . $brandlogo))->resize(null, 250,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas2 = Image::canvas(250, 250);
            $canvas2->insert($thumb_img2, 'center');
            $canvas2->save(public_path('/brandsImg/250brands/') . $brandlogo);

            // /*---------third--------*/
            $thumb_img3 = Image::make(public_path('/brandsImg/' . $brandlogo))->resize(null, 500,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas3 = Image::canvas(500, 500);
            $canvas3->insert($thumb_img3, 'center');
            $canvas3->save(public_path('/brandsImg/500brands/') . $brandlogo);

        } else {
            $brand->brand_logo = $request->get('oldBrandLogo');
        }

        // if ($request->file('brand_document')) {
        //     $file = $request->file('brand_document');
        //     $destinationPath = public_path('/brandsImg/documents');
        //     $brandDoc = 'brand_doc'.time() . '.' . $file->getClientOriginalExtension();
        //     $file->move($destinationPath, $brandDoc);

        //     $brand->brand_document = $brandDoc;
        // } else {
        //     $brand->brand_document = $request->get('oldBrandDoc');
        // }
        return $brand;
    }
}