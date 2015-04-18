<footer id="footWrapper">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="clearfix"></div>

                <!-- contact us footer cell start -->
                <div class="cell-3">
                    <h3 class="block-head">Холбоо барих</h3>
                    <ul>
                        <li class="footer-contact"><i class="fa fa-home"></i><span>{{ $config->address }}</span></li>
                        <li class="footer-contact"><i class="fa fa-globe"></i><span><a href="#">{{ $config->website }}</a></span></li>
                        <li class="footer-contact"><i class="fa fa-phone"></i><span>{{ $config->phone }}</span></li>
                    </ul>
                </div>
                <!-- contact us footer cell end -->

                <!-- Newsletters footer cell start -->
                <div class="cell-3">
                    <div class="foot-logo"></div>
                    <p class="no-margin">Keep up on our always evolving product features and technology. Enter your e-mail and subscribe to our newsletter.</p>
                    <form class="NL">
                        <div class="skew-25 input-box left">
                            <input type="text" class="txt-box skew25" placeholder="Enter Yor Email" required>
                        </div>
                        <div class="left skew-25 NL-btn">
                            <input class="btn skew25" type="submit" value="Send" />
                        </div>
                    </form>
                </div>
                <!-- Newsletters footer cell start -->

                <!-- latest tweets footer cell start -->
                <div class="cell-3">
                    <h3 class="block-head">Latest Tweets</h3>
                    <div class="tweet">
                        <p><span class="fa fa-twitter"></span>Check our portfolio at <a href="#">EXCEPTION</a> to get more information about us.</p>
                        <p><a href="https://twitter.com/">https://twitter.com/</a></p>
                        <p>30 Jan. 2014</p>
                    </div>
                </div>
                <!-- latest tweets footer cell start -->

                <!-- flickr stream footer cell start -->
                <div class="cell-3 flickr-stream-w">
                    <h3 class="block-head">Flickr Stream</h3>
                    <ul>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/1.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/2.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/3.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/4.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/5.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/6.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/7.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                        <li>
                            <a class="flickr" href="http://www.flickr.com/" title="">
                                <img src="static/images/people/8.jpg" alt=""><span class="img-overlay"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- flickr stream footer cell start -->

            </div>
        </div>	
    </div>

    <!-- footer bottom bar start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <!-- footer copyrights left cell -->
                <div class="copyrights cell-5">&copy; {{ date('Y') }}  <b>Онцгой байдлын ерөнхий газар</b>. Бүх эрх хуулиар хамгаалагдсан болно</div>

                <!-- footer social links right cell start -->
                <div class="cell-7">
                    <ul class="social-list right">
                        <li class="skew-25"><a href="{{ $config->website }}" data-title="Цахим хуудас" data-tooltip="true"><span class="fa fa-globe skew25"></span></a></li>
                        <li class="skew-25"><a href="{{ $config->facebook }}" data-title="Facebook хуудас" data-tooltip="true"><span class="fa fa-facebook skew25"></span></a></li>
                        <li class="skew-25"><a href="{{ $config->twitter }}" data-title="Twitter" data-tooltip="true"><span class="fa fa-twitter skew25"></span></a></li>
                    </ul>
                </div>
                <!-- footer social links right cell end -->

            </div>
        </div>
    </div>
    <!-- footer bottom bar end -->

</footer>