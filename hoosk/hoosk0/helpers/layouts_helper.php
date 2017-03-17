<?php
if(!function_exists('sliderWithSearch')){
    function sliderWithSearch($data, $ImagePath = null, $Items = null, $action = null){

$dynamicID  = rand(2000,8000);
$dynamicID  = $dynamicID.'_owl-carousel';

    $html = '<div class="slider-container" data-type="'.$Items[0].'">';
        $html .= '<div class="slider-inner">';
            $html .= '<div class="slider-search-box">';
                $html .= '<form action="'.$action.'" method="post">';
                    $html .= '<!--span class="icon" id="slider-search-icon">';
                        $html .= '<i class="fa fa-search"></i>';
                    $html .= '</span-->';
                    $html .= '<input type="text" class=""  id="keyword" name="keyword" placeholder="Search Now">';
                    $html .= '<input type="submit" id="slider-search-submit-icon" value="&#xf002;" class="form-control submit-icon">';
                $html .= '</form>';
            $html .= '</div>';
        $html .= '<div id="'.$dynamicID.'" class="owl-carousel">';

        $i=1;
        foreach ($data as $images) {

            if(!empty($images[Image])){

                if($ImagePath) {
                    $images[Image] = $ImagePath . $images[Image];
                }
                if($i == 1){
                    $item_class = 'item active';
                }else{
                    $item_class = 'item';
                }
                if( is_file(FCPATH.'/'.$images[Image])){
                    $filename = $images[Image];
                    $img = base_url().$filename;
                    //$img = Get_Small_imgs($filename);
                    $html .= '<div class="'.$item_class.' item">';
                        $html .= '<a href="#" class="owl-item-a">';
                            $html .= '<span class="owl-item-span">';
                                $html .= '<img class="owl-item-img img-responsive" src="'.$img.'">';
                            $html .= '</span>';
                        $html .= '</a>';
                    $html .= '</div>';
                    $i++;
                }
            }
        }
        
        $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';

$html .=  Owl_Carousel_init($dynamicID,$Items);

        return $html;
    }
}



if(!function_exists('sliderWithOutSearch')){
    function sliderWithOutSearch($data, $ImagePath = null, $Items = null, $action = null){

$dynamicID  = rand(2000,8000);
$dynamicID  = $dynamicID.'_owl-carousel';

    $html = '<div class="slider-container">';
        $html .= '<div class="slider-inner">';
        $html .= '<div id="'.$dynamicID.'" class="owl-carousel">';

        $i=1;
        foreach ($data as $images) {

            if(!empty($images[Image])){

                if($ImagePath) {
                    $images[Image] = $ImagePath . $images[Image];
                }
                if($i == 1){
                    $item_class = 'item active';
                }else{
                    $item_class = 'item';
                }
                if( is_file(FCPATH.'/'.$images[Image])){
                    $filename = $images[Image];
                    $img = base_url().$filename;
                   
                    $html .= '<div class="'.$item_class.' item">';
                        $html .= '<a href="#" class="owl-item-a">';
                            $html .= '<span class="owl-item-span">';
                                $html .= '<img class="owl-item-img img-responsive" src="'.$img.'">';
                            $html .= '</span>';
                        $html .= '</a>';
                    $html .= '</div>';
                    $i++;
                }
            }
        }
        
        $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';

    $html .=  Owl_Carousel_init($dynamicID,$Items);

        return $html;
    }
}



if(!function_exists('Owl_Carousel_init')) {
    function Owl_Carousel_init($dynamicID,$Items)
    {


$rightClass = "fa fa-arrow-right";
$leftClass  = "fa fa-arrow-left";

        $html .= '<script>
        jQuery(document).ready(function () {

            var owl = $("#'.$dynamicID.'");

            owl.owlCarousel({
                loop:true,
                rewind: true,
                autoplay: true,
                autoplayTimeout: 3000,
                margin:10,
                nav: true,
                navText: ["<i class=\''.$rightClass.'\'></i>","<i class=\''.$leftClass.'\'></i>"],';
                $html .= Owl_Responsive_Settings($Items);
        $html .= '});

            $("#'.$dynamicID.' .play'.'").on("click", function() {
                owl.trigger("play.owl.autoplay", [1000])
            });
            $("#'.$dynamicID.' .stop'.'").on("click", function() {
                owl.trigger("stop.owl.autoplay")
            });
        });
        </script>
        ';
        return $html;
    }
}
if(!function_exists('Owl_Responsive_Settings')) {
    function Owl_Responsive_Settings($Items)
    {
      $html = 'responsiveClass:true,';
      $html .= 'responsive:{';
           if( !empty($Items)){
                if( !empty($Items['mobile'])){
                    $html .= '
                            0:{
                                items:'.$Items['mobile'].',
                                nav:false
                            },';
                }else{
                    $html .= '
                             0:{
                                items:1,
                                nav:false
                            },';
                }
                if( !empty($Items['tablet'])){
                    $html .= '
                            600:{
                                items:'.$Items['tablet'].'
                            },';
                }else{
                    $html .= '
                             600:{
                                items:3
                            },';
                }
                if( !empty($Items['desktop'])){
                    $html .= '
                            1000:{
                                items:'.$Items['desktop'].'
                            },';
                }else{
                    $html .= '
                             1000:{
                                items:6
                            },';
                }
            }else{
                $html .= '
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:6
                    }';
            }
        $html .= '}';
        return $html;
    }
}
if(!function_exists('Get_Small_imgs')) {
    function Get_Small_imgs($filename)
    {
    //For Showing Small Images
        $ext = Get_file_extensions($filename);
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $img2 = $withoutExt.'_icon_258.'.$ext;
        if(is_file(FCPATH.'/'.$img2)){
            $img = base_url().$img2;
        }else{
            $filename = base_url().$images[Image];
            $ext = Get_file_extensions($filename);
            $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
            $img = $withoutExt.'_thumbnail_258.'.$ext;
        }
    }
}
if(!function_exists('Get_file_extensions')) {
    function Get_file_extensions($filename)
    {
        $filename = strtolower($filename);
        $exts = explode(".", $filename);
        $n = count($exts) - 1;
        $exts = $exts[$n];
    return $exts;
    }
}





if(!function_exists('sliderWithSearchOld')){
    function sliderWithSearchOld($data, $ImagePath = null, $Items = null, $action = null){
/*        echo '<pre>';
        var_dump($data);
        echo '</pre>';*/

         $html = '<div class="container">
    <div class="col-md-12">
         <h1>Bootstrap 3 Thumbnail Slider</h1>

        <div class="well">
            <div id="myCarousel" class="carousel slide">
                
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                            <div class="col-sm-3"><a href="#x"><img src="http://placehold.it/500x500" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x"><img src="http://placehold.it/500x500" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x"><img src="http://placehold.it/500x500" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x"><img src="http://placehold.it/500x500" alt="Image" class="img-responsive"></a>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/item-->
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/item-->
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                            <div class="col-sm-3"><a href="#x" class="thumbnail"><img src="http://placehold.it/250x250" alt="Image" class="img-responsive"></a>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/item-->
                </div>
                <!--/carousel-inner-->
                 <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>

                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
            </div>
            <!--/myCarousel-->
        </div>
        <!--/well-->
    </div>
</div>';
        return $html;

    }
}
if(!function_exists('sliderWithOutSearchOld')){
    function sliderWithOutSearchOld($data, $ImagePath = null, $Items = null, $action = null){



$html = '<div class="filter form" style="max-width:400px">';
$html .= '<div class="filter3" id="filter">';
    $html .= '<div class="search searchbox">';
        $html .= '<span class="icon" id="filter_search">';
            $html .= '<i class="fa fa-search"></i>';
        $html .= '</span>';
        $html .= '<input type="text" autocomplete="off" class="locationSuggest ac_input" id="location_search" name="location_value" placeholder="Search Now">';
    $html .= '</div>';
    $html .= '<div class="carousel multi-item-carousel slide" id="theCarousel" data-interval="3000" data-ride="carousel" data-type="multi">';
            $html .= '<div class="carousel-inner">';

$i=1 ;
        foreach ($data as $images) {

            if(!empty($images[Image])){

                    if($ImagePath) {
                        $images[Image] = $ImagePath . $images[Image];
                    }
                    if($i == 1){
                        $item_class = 'item active';
                    }else{
                        $item_class = 'item';
                    }
                if( is_file(FCPATH.'/'.$images[Image])){
                    $filename = $images[Image];
                    $img = base_url().$filename;
                   //$img = Get_Small_imgs($filename);
                    $html .= '<div class="'.$item_class.' col-md-4 col-sm-4 col-xs-4 esic-list-logo">';
                        $html .= '<div class="">';
                            $html .= '<a href="#">';
                                $html .= '<span>';
                                    $html .= '<img class="img-responsive" src="'.$img.'">';
                                $html .= '</span>';
                             $html .= '</a>';
                        $html .= '</div>';
                    $html .= '</div>';
            $i++;
                }
            }
        }

        $html .= '<a class="left carousel-control" href="#theCarousel" data-slide="prev">‹</a>';
        $html .= '<a class="right carousel-control" href="#theCarousel" data-slide="next">›</a>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>'; 
        return $html;
    }
}



?>

