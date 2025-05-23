<div style="position: relative; width: 1587px; height: 2240px; overflow: hidden;">
    <!-- template image!!! -->
    <img src="{{ asset('images/templates/template-3.png') }}" alt="Poster Template"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; pointer-events: none; user-select: none;">

     @if ($petImage)
    <img crossorigin="anonymous" src="{{ asset('storage/' . $petImage) }}"
         style="
         position: absolute;
         top: 210px;
         left: 230px;
         width: 1130px;
         {{-- height: 1020px; --}}
         object-fit: cover;
         z-index: 5;">
    @else
        <!-- placeholder na pic if waray pa pet image -->
        <img crossorigin="anonymous" src="{{ asset('images/default-placeholder.jpg') }}"
            style="
            position: absolute;
            top: 210px;
            left: 230px;
            width: 1140px;
            object-fit: cover;
            z-index: 5;">
    @endif

    <!-- pet name -->
    <div style="
        position: absolute;
        top: 1610px;
        left: 244px;
        width: 1130px;
        {{-- height: 142px; --}}
        font-size: 150px;
        rotate: 358deg;
        color: #feb823;
        {{-- -webkit-text-stroke: 2px #401b0f; --}}
        text-shadow:
                -15px -15px 0 #401b0f,
                15px -15px 0 #401b0f,
                -15px 15px 0 #401b0f,
                15px 15px 0 #401b0f,
                -15px 0px 0 #401b0f,
                15px 0px 0 #401b0f,
                0px -15px 0 #401b0f,
                0px 15px 0 #401b0f;
        font-family: 'One Little Font', sans-serif;
        font-weight: bold;
        text-align: center;
        /* text-transform: uppercase; */
        line-height: 1.5;
        overflow: hidden;
        z-index: 20;
    ">
        {{ Illuminate\Support\Str::limit( $petName ?? 'Pet name', 14) }}
    </div>
</div>
