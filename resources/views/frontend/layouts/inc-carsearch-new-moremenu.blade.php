<?php
// echo "<pre>";
// print_r(count($history_post));
// echo "</pre>";
?>

<div class="left-boxsearch-item">
    <div class="left-boxsearch-topic2">รถมือสอง ประเภทอื่นๆ</div>
    <div class="row">
        @if (isset($catequery))
        @foreach ($catequery as $rows)
        <div class="col-4 col-lg-6 boxsearch-cartype">
            <a href="{{route('carsearchPage').'/'.$rows->name}}">
                <img src="{{asset($rows->feature)}}" alt="">
            </a>
        </div>
        
        @endforeach
        @endif
    </div>
</div>
@if(isset($history_post) && count($history_post) > 0)
<div class="left-boxsearch-item search-carview">
    <div class="left-boxsearch-topic2">รถที่คุณดูล่าสุด</div>
    <div style="height: fit-content;">
        @foreach($history_post as $keycarshistory => $carshis)
        @php
        $profilecar_imgcarshis = ($carshis->feature)?asset('storage/' . $carshis->feature):asset('public/uploads/default-car.jpg');
        $oldPrice = $carshis->old_price;
        $newPrice = $carshis->price;
        $discountPercentage = $oldPrice > 0 ? floor((($oldPrice - $newPrice) / $oldPrice) * 100) : 0;
        @endphp
        <a href="{{route('cardetailPage', ['slug' => $carshis->slug])}}" class="item-car">
            <figure>
                <div class="cover-car"><img src="{{$profilecar_imgcarshis}}" alt=""></div>
                <figcaption>
                    <div class="car-name">{{$carshis->yearregis??$carshis->modelyear}} {{$carshis->brand->title}} {{$carshis->model->model}}</div>
                    <div class="car-series">{{ ($carshis->generation->generations ?? 'N/A') . ' ' . ($carshis->subModel->sub_models ?? 'N/A') }}</div>
                    <div class="car-province">{{$carshis->province}}</div>
                    <div class="car-price">{{ number_format($newPrice, 0, '.', ',') }}.-</div>
                    @if($oldPrice > 0)
                    <div class="car-price-discount">
                        <span>{{ number_format($oldPrice, 0, '.', ',') }}.-</span> {{ floor($discountPercentage) }}%
                    </div>
                    @endif
                    
                </figcaption>
            </figure>
        </a>
        <!-- <a href="{{route('cardetailPage', ['slug' => $carshis->slug])}}" class="item-car">
            <figure>
                <div class="cover-car"><img src="{{$profilecar_imgcarshis}}" alt=""></div>
                <figcaption>
                    <div class="car-name">{{$carshis->modelyear." ".$carshis->brands_title." ".$carshis->model_name}} </div>
                    <div class="car-series">{{$carshis->generations_name." ".$carshis->sub_models_name}}</div>
                    <div class="car-province">@if(!empty($carshis->customer_proveince)){{$carshis->customer_proveince}}@else{{"-"}}@endif</div>
                    <div class="car-price">{{number_format($carshis->price, 0, '.', ',')}}.-</div>
                </figcaption>
            </figure>
        </a> -->
        @endforeach

    </div>
</div>  
@endif
