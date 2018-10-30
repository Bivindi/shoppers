@extends('emails.include.index')
@section('header')
    Failed Wallet Amount
@endsection
@section('header_image')
    <img editable="true" mc:edit="image003"
         src="<?php echo $message->embed(public_path() . "/email/images/circle-icon-help.png"); ?>"
         style="display:block; line-height:0; font-size:0; border:0;" border="0" alt=""/>
@endsection
@section('body')
    <tr>
        <td>
            <table class="table1 editable-bg-color bg_color_ffffff" bgcolor="#ffffff" width="600" align="center"
                   border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                <tr>
                    <td height="60"></td>
                </tr>
                <tr>
                    <td>
                        <table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0"
                               style="margin: 0 auto;">
                            <tr>
                                <td mc:edit="text003" align="left" class="center_content text_color_282828"
                                    style="color: #282828; font-size: 18px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                    <div class="editable-text">
										<span class="text_container">
											<multiline>
												Hi {{ $username }}
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
                                <td mc:edit="text004" align="left" class="center_content text_color_282828"
                                    style="color: #282828; font-size: 14px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                    <div class="editable-text" style="line-height: 2;">
										<span class="text_container">
											<multiline>
												Your Wallet amount <strong>{{ $wallet }}</strong> is failed please try again.
                                                <br>
                                                Your total wallet amount is <strong>{{ $total }}</strong>
											</multiline>
										</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td height="50"></td>
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
