<!-- Section-10 -->
<table class="table_full editable-bg-color bg_color_e6e6e6 editable-bg-image" bgcolor="#e6e6e6" width="100%" align="center"  mc:repeatable="castellab" mc:variant="Header" cellspacing="0" cellpadding="0" border="0">
    <!-- header -->
    <tr>
        <td>
            <!-- container -->
            <table class="table1 editable-bg-color bg_color_303f9f" bgcolor="#303f9f" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                <!-- padding-top -->
                <tr><td height="25"></td></tr>
                <tr>
                    <td>
                        <!-- Inner container -->
                        <table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                            <tr>
                                <td>
                                    <!-- logo -->
                                    <table width="50%" align="left" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="left">
                                                <a href="#" class="editable-img">
                                                    <h1><a href="https://lozypay.com/" style="color: #ffffff;">LozyPay</a></h1>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr><td height="22"></td></tr>
                                    </table><!-- END logo -->
                                </td>
                            </tr>

                            <!-- horizontal gap -->
                            <tr><td height="60"></td></tr>

                            <tr>
                                <td align="center">
                                    <div class="editable-img">
                                        <img editable="true" mc:edit="image003" src="<?php echo $message->embed(public_path() . "/email/images/circle-icon-message.png"); ?>"  style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
                                    </div>
                                </td>
                            </tr>

                            <!-- horizontal gap -->
                            <tr><td height="40"></td></tr>

                            <tr>
                                <td mc:edit="text001" align="center" class="text_color_ffffff" style="color: #ffffff; font-size: 30px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                    <div class="editable-text">
										<span class="text_container">
											<multiline>Contact Us</multiline>
										</span>
                                    </div>
                                </td>
                            </tr>
                        </table><!-- END inner container -->
                    </td>
                </tr>
                <!-- padding-bottom -->
                <tr><td height="60"></td></tr>
            </table><!-- END container -->
        </td>
    </tr>

    <!-- body -->
    <tr>
        <td>
            <!-- container -->
            <table class="table1 editable-bg-color bg_color_ffffff" bgcolor="#ffffff" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                <!-- padding-top -->
                <tr><td height="60"></td></tr>

                <tr>
                    <td>
                        <!-- inner container -->
                        <table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">

                            <tr>
                                <td mc:edit="text003" align="left" class="center_content text_color_282828" style="color: #282828; font-size: 18px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                    <div class="editable-text">
										<span class="text_container">
											<multiline>Hi admin you have some Message  from {{ $email }} for {{ $subject }},</multiline>
										</span>
                                    </div>
                                </td>
                            </tr>

                            <!-- horizontal gap -->
                            <tr><td height="10"></td></tr>

                            <tr>
                                <td mc:edit="text004" align="left" class="center_content text_color_282828" style="color: #282828; font-size: 16px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                                    <div class="editable-text" style="line-height: 2;">
										<span class="text_container">
											<multiline>
												{{ $msg }}
											</multiline>
										</span>
                                    </div>
                                </td>
                            </tr>
                        </table><!-- END inner container -->
                    </td>
                </tr>
                <!-- padding-bottom -->
                <tr><td height="60"></td></tr>
            </table><!-- END container -->
        </td>
    </tr>

    <!-- footer -->
    <tr>
        <td>
            <!-- container -->
            <table class="table1" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                <!-- padding-top -->
                <tr><td height="40"></td></tr>

                <tr>
                    <td>
                        <!-- column-2  -->
                        <table class="table1-2" width="120" align="right" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="120" align="center" style="margin: 0 auto;">
                                        <tr>
                                            <!-- facebook -->
                                            <td align="center" width="30">
                                                <a href="#" style="border-style: none !important; display: inline-block;; border: 0 !important;" class="editable-img">
                                                    <img editable="true" mc:edit="image005" src="<?php echo $message->embed(public_path() . "/email/images/icon-fb.png"); ?>" width="30" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
                                                </a>
                                            </td>

                                            <!-- vertical gap -->
                                            <td width="15"></td>

                                            <!-- twitter -->
                                            <td align="center" width="30">
                                                <a href="#" style="border-style: none !important; display: inline-block; border: 0 !important;" class="editable-img">
                                                    <img editable="true" mc:edit="image006" src="<?php echo $message->embed(public_path() . "/email/images/icon-twitter.png"); ?>" width="30" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
                                                </a>
                                            </td>

                                            <!-- vertical gap -->
                                            <td width="15"></td>

                                            <!-- google+ -->
                                            <td align="center" width="30">
                                                <a href="#" style="border-style: none !important; display: inline-block;; border: 0 !important;" class="editable-img">
                                                    <img editable="true" mc:edit="image007" src="<?php echo $message->embed(public_path() . "/email/images/icon-gp.png"); ?>" width="30" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- margin-bottom -->
                            <tr><td height="30"></td></tr>
                        </table><!-- END column-2 -->
                    </td>
                </tr>

                <!-- padding-bottom -->
                <tr><td height="70"></td></tr>
            </table><!-- END container -->
        </td>
    </tr>
</table><!-- END wrapper -->