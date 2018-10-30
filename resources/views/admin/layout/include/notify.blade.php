                    
                    @if(Auth::user()->hasRole('admin'))
                    <li>
                        <h5>New Seller SignUp <span class="new badge"></span></h5>
                    </li>
                    <li class="divider"></li>
                    @foreach($newseller as $seller)
                    <li>
                        <a href="#!"><i class="mdi-social-group-add"></i> <b>{{ $seller->first_name }}</b> New Seller SignUp</a>
                       
                    </li>
                    @endforeach 
                    @endif


                    <li>
                        <h5>Product In Low Qty <span class="new badge"></span></h5>
                    </li>
                    <li class="divider"></li>
                    @foreach($productsnotify as $product)
                    <li>
                        <a href="#!"><i class="mdi-action-add-shopping-cart"></i><b>{{ $product->name }}</b> Low Qty.</a>
                       
                    </li>
                    @endforeach 
                    
                    