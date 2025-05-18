<div style="position: relative; width: 1587px; height: 2240px; overflow: hidden;">
    <!-- template image!!! -->
    <img src="{{ asset('images/templates/template-5.png') }}" alt="Poster Template"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; pointer-events: none; user-select: none;">

     @if ($petImage)
    <img src="{{ asset('storage/' . $petImage) }}"
         style="
         overflow: scroll;
         position: relative;
         top: 550px;
         left: 160px;
         width: 1270px;
         height: 800px;
         object-fit: cover;
         z-index: 5;">
    @else
        <!-- Placeholder or default image if no image is available -->
        <img src="{{ asset('images/default-placeholder.jpg') }}"
            style="
            overflow: scroll;
            position: relative;
            top: 550px;
            left: 160px;
            width: 1270px;
            height: 800px;
            object-fit: cover;
            z-index: 5;">
    @endif

    <!-- pet name -->
    <div style="
        position: absolute;
        top: 1370px;
        left: 244px;
        width: 1096px;
        height: 142px;
        font-size: 120px;
        color: #222222;
        font-family: 'Chunk Five', sans-serif;
        font-weight: bold;
        text-align: center;
        /* text-transform: uppercase; */
        line-height: 1.5;
        overflow: hidden;
        z-index: 20;
    ">
        <!-- {{ $petName ?? 'Pet Name' }} -->
        • {{ Illuminate\Support\Str::limit( $petName ?? 'Pet name', 12) }} •
    </div>

    <!-- pet description -->
    <div style="
        /* border: 1px solid #C50565; */
        position: absolute;
        padding: 10px;
        top: 1530px;
        left: 143px;
        width: 1300px;
        height: 300px;
        font-size: 45px;
        color: #222222;
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
        top: 1990px;
        left: 140px;
        width: 1300px;
        height: 100px;
        font-size: 65px;
        font-weight: 700;
        color: #222222;
        font-family: 'Chunk Five', sans-serif;
        text-align: center;
        line-height: 55px;
        overflow: hidden;
        z-index: 20;
        /* text-transform: uppercase; */
    ">
        {{ Illuminate\Support\Str::limit( $contactPerson ?? 'Jane Doe', 15) }} • {{ Illuminate\Support\Str::limit( $contactNumber ?? '+63 900 000 0000', 11) }}
    </div>
</div>
