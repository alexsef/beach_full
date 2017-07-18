<div class="swiper-container gallery-top swiper-container-horizontal">
    <div class="swiper-wrapper" id="images">
        @foreach($slider as $slide)
            <div class="swiper-slide" style="width: 1140px; margin-right: 10px;">
                <img src="{{ $slide->img }}" alt="{{ $slide->alt }}" width="100%">
            </div>
        @endforeach
    </div>
    <div class="swiper-button-prev swiper-button-disabled"></div>
    <div class="swiper-button-next"></div>
</div>
<div class="swiper-container gallery-thumbs swiper-container-horizontal">
    <div class="swiper-wrapper" style="transform: translate3d(427.5px, 0px, 0px); transition-duration: 0ms;">
        @foreach($slider as $slide)
            <div class="swiper-slide" style="margin-right: 10px;">
                <img src="{{ $slide->img }}" alt="{{ $slide->alt }}" width="100%">
            </div>
        @endforeach
    </div>
</div>