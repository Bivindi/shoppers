@extends('emails.include.index')
@section('header')
    Return of your Order
@endsection
@section('header_image')
    <img editable="true" mc:edit="image003"
         src="<?php echo $message->embed(public_path() . "/email/images/circle-icon-basket.png"); ?>"
         style="display:block; line-height:0; font-size:0; border:0;" border="0" alt=""/>
@endsection
@section('body')
    <tr>
        <td>
            <!-- container -->
            <table class="table1 editable-bg-color bg_color_ffffff" bgcolor="#ffffff" width="600" align="center"
                   border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                <!-- padding-top -->
                <tr>
                    <td height="60"></td>
                </tr>

                <tr>
                    <td>
                        <!-- inner container -->
                        <table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0"
                               style="margin: 0 auto;">

                            <tr>
                                <td mc:edit="text003" align="left" class="center_content text_color_282828"
                                    style="color: #282828; font-size: 18px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                    <div class="editable-text">
										<span class="text_container">
											<multiline>Hello {{ $username }},</multiline>
										</span>
                                    </div>
                                </td>
                            </tr>

                            <!-- horizontal gap -->
                            <tr>
                                <td height="10"></td>
                            </tr>

                            <tr>
                                <td mc:edit="text004" align="left" class="center_content text_color_282828"
                                    style="color: #282828; font-size: 14px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                    <div class="editable-text" style="line-height: 2;">
										<span class="text_container">
											<multiline>
												We would like to inform you that we have processed your return request for the following item in the order {{ $transaction_id }}</multiline>
										</span>
                                    </div>
                                </td>
                            </tr>

                            <!-- horizontal gap -->
                            <tr>
                                <td height="50"></td>
                            </tr>
                            <!-- product-1 -->
                            <tr>
                                <td>
                                    <!-- column-1  -->
                                    <table class="table1-2" width="125" align="left" border="0" cellspacing="0"
                                           cellpadding="0">
                                        <tr>
                                            <td align="center">
                                                <a href="#"
                                                   style="border-style: none !important; display: block; border: 0 !important;"
                                                   class="editable-img">
                                                    <img editable="true" mc:edit="image004"
                                                         src="<?php echo $message->embed(public_path() . "/100ProductImg/$product_img"); ?>"
                                                         style="display:block; line-height:0; font-size:0; border:0;"
                                                         border="0" alt=""/>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- margin-bottom -->
                                        <tr>
                                            <td height="30"></td>
                                        </tr>
                                    </table><!-- END column-1 -->

                                    <!-- vertical gap -->
                                    <table class="tablet_hide" width="40" align="left" border="0" cellspacing="0"
                                           cellpadding="0">
                                        <tr>
                                            <td height="1"></td>
                                        </tr>
                                    </table>

                                    <!-- column-2  -->
                                    <table class="table1-2" width="355" align="left" border="0" cellspacing="0"
                                           cellpadding="0">
                                        <tr>
                                            <td mc:edit="text005" align="left" class="center_content text_color_282828"
                                                style="color: #282828; font-size: 14px; font-weight: 600; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                                <div class="editable-text">
													<span class="text_container">
														<multiline>
															{{ $name }}
														</multiline>
													</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- horizontal gap -->
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <!-- sub-column-1  -->
                                                <table class="table1-2" align="left" border="0" cellspacing="0"
                                                       cellpadding="0">
                                                    <tr>
                                                        <td mc:edit="text007" align="left"
                                                            class="center_content text_color_282828"
                                                            style="color: #282828; font-size: 12px; font-weight: 600; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                                            <div class="editable-text">
																<span class="text_container">
																	<multiline>PRICE</multiline>
																</span>
                                                            </div>
                                                        </td>

                                                        <td width="10"></td>

                                                        <td mc:edit="text008" align="left"
                                                            class="center_content text_color_282828"
                                                            style="color: #282828; font-size: 12px; font-weight: 600; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                                            <div class="editable-text">
																<span class="text_container">
																	<multiline>QTY</multiline>
																</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td mc:edit="text010" align="left"
                                                            class="center_content text_color_303f9f"
                                                            style="color: #303f9f; font-size: 12px; font-weight: 400; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                                            <div class="editable-text">
																<span class="text_container">
																	<multiline>Rs.{{ $price }}</multiline>
																</span>
                                                            </div>
                                                        </td>

                                                        <td width="10"></td>

                                                        <td mc:edit="text011" align="left"
                                                            class="center_content text_color_303f9f"
                                                            style="color: #303f9f; font-size: 12px; font-weight: 400; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                                            <div class="editable-text">
																<span class="text_container">
																	<multiline>{{ $quantity }}</multiline>
																</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20"></td>
                                                    </tr>
                                                </table>
                                                <table class="tablet_hide" width="40" align="left" border="0"
                                                       cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="1"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="30"></td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
