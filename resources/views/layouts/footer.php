@section('footer')
<section class="footer" id="contact">
    <div class="container">
        <div class="row no-margin">
            <div class="col-lg-4 col-sm-6 col-xs-12 no-padding">
                <div class="footer_block_title">CONTACT US</div>
                <ul class="footer_block">
                    <li class="icon_map"> 55 Main St.<br>Toronto, ON<br>M1H 3A5</li>
                    <li class="icon_phone">(416) 555-5252</li>
                    <li class="icon_email">hello@treehouse.com</li>
                </ul>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12 no-padding">
                <div class="footer_block_title">LATEST POSTS</div>
                <ul class="footer_block">
                    <li class="icon_news">Made With Love In Toronto</li>
                    <li class="icon_picture">Startup News & Emerging Tech</li>
                    <li class="icon_news">Bitcoin Will Soon Rule The World</li>
                    <li class="icon_news">Wearable Technology On The Rise</li>
                    <li class="icon_media">Learn Web Design In 30 Days!</li>
                </ul>
            </div>
            <div class="col-lg-4 col-sm-12 col-xs-12 no-padding">
                <!--img class="footer_map img-responsive" src="images/map.png" /-->
                <div id="map" class="footer_map"></div>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaI7el_kgrQQ45LvYGVeFHGFYL5PAdWAs&callback=initMap"></script>
            </div>
        </div>
    </div>
</section>
@endsection