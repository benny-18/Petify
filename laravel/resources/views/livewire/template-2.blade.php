<div style="position: relative; width: 1587px; height: 2240px; overflow: hidden;">
    <!-- template image!!! -->
    <img src="{{ asset('images/templates/template-2.png') }}" alt="Poster Template"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; pointer-events: none; user-select: none;">

     @if ($petImage)
    <img src="{{ asset('storage/' . $petImage) }}"
         style="
         position: absolute;
         top: 540px;
         left: 390px;
         /* width: 685px;  */
         height: 820px;
         object-fit: cover;
         z-index: 5;">
    @else
        <!-- Placeholder or default image if no image is available -->
        <img src="{{ asset('images/default-placeholder.jpg') }}"
            style="position: absolute; top: 996px; left: 170px; width: 685px; height: 757px; object-fit: cover; z-index: 5;">
    @endif

    <!-- pet name -->
    <div style="
        position: absolute;
        top: 1400px;
        left: 244px;
        width: 1096px;
        height: 142px;
        font-size: 120px;
        color: #9f582b;
        font-family: 'Chunk Five', sans-serif;
        font-weight: bold;
        text-align: center;
        /* text-transform: uppercase; */
        line-height: 1.5;
        overflow: hidden;
        z-index: 20;
    ">
        <!-- {{ $petName ?? 'Pet Name' }} -->
        {{ Illuminate\Support\Str::limit( $petName ?? 'Pet name', 14) }}
    </div>

    <!-- Age -->
    <!-- <div style="
        position: absolute;
        top: 1573px;
        left: 242px;
        width: 93px;
        height: 48px;
        font-size: 40px;
        color: #9f582b;
        font-family: 'Pridi', sans-serif;
        text-align: center;
        line-height: 48px;
        overflow: hidden;
        z-index: 20;
    ">
        {{ $petAge ?? 'Age' }}
    </div> -->

    <!-- Breed -->
    <!-- <div style="
        position: absolute;
        top: 1570px;
        left: 514px;
        width: 550px;
        height: 52px;
        font-size: 40px;
        color: #9f582b;
        border: 1px solid #C50565;
        font-family: 'Pridi', sans-serif;
        text-align: center;
        line-height: 52px;
        overflow: hidden;
        z-index: 20;
    ">
        {{ $petBreed ?? 'Breed' }}
    </div> -->

    <!-- Sex -->
    <!-- <div style="
        position: absolute;
        top: 1570px;
        left: 1202px;
        width: 242px;
        height: 50px;
        font-size: 40px;
        color: #9f582b;
        font-family: 'Pridi', sans-serif;
        text-align: center;
        line-height: 50px;
        overflow: hidden;
        z-index: 20;
    ">
        {{ $petSex ?? 'Sex' }}
    </div> -->

    <!-- pet description -->
    <div style="
        /* border: 1px solid #C50565; */
        position: absolute;
        padding: 10px;
        top: 1560px;
        left: 143px;
        width: 1300px;
        height: 300px;
        font-size: 45px;
        color: #9f582b;
        font-family: 'Pridi', sans-serif;
        text-align: center;
        line-height: 1.5;
        overflow: hidden;
        overflow-wrap: break-word;
        z-index: 20;
    ">
        {{ $petSex ?? 'Sex' }} • {{ $petAge ?? 'Age' }} year(s) old • {{ $petBreed ?? 'Breed' }}<br>
        {{ Illuminate\Support\Str::limit( $petDescription ?? 'Pet description goes here.', 150) }}
        <!-- {{ $petDescription ?? 'Pet description goes here.' }} -->
    </div>

    <!-- contact person -->
    <div style="
        position: absolute;
        top: 2022px;
        left: 140px;
        width: 592px;
        height: 84px;
        font-size: 50px;
        font-weight: 700;
        color: #9f582b;
        font-family: 'Chunk Five', sans-serif;
        text-align: left;
        line-height: 55px;
        overflow: hidden;
        z-index: 20;
        text-transform: uppercase;
    ">
        {{ $contactPerson ?? 'Jane Doe' }}
    </div>

    <!-- contact number -->
    <div style="
        position: absolute;
        top: 1968px;
        left: 750px;
        width: 697px;
        height: 138px;
        font-size: 90px;
        color: #9f582b;
        font-family: 'Chunk Five', sans-serif;
        text-align: right;
        line-height: 150px;
        overflow: hidden;
        z-index: 20;

    ">
        {{ $contactNumber ?? '+63 900 000 0000' }}
    </div>
</div>
