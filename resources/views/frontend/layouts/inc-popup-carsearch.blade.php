<div class="carsearch-popup">
    <div class="carsearch-menu carsearch-lv1">
        <div class="carsearch-top">
            <button class="carsearch-head"> เลือกยี่ห้อรถ</button>
            <button class="carsearch-exit">ยกเลิก</button>
        </div>
        <input type="text" class="car-inputsearch" placeholder="ค้นหา...">
        <ul class="carsearch-ul">
            @foreach ($brand as $rows)
            <li><button rel="{{strtoupper($rows->title)}}" onclick="brand({{$rows->id}}, '{{strtoupper($rows->title)}}')"><img src="{{$rows->feature}}" alt=""> {{strtoupper($rows->title)}}</button></li>
            @endforeach
        </ul>
    </div>
    <div class="carsearch-menu carsearch-lv2">
        <div class="carsearch-top">
            <button class="carsearch-head"><i class="bi bi-arrow-left"></i> เลือกรุ่นรถ</button><button class="carsearch-exit">ยกเลิก</button>
        </div>
        <input type="text" class="car-inputsearch" placeholder="ค้นหา...">
        <ul class="carsearch-ul">
            
        </ul>
        <div class="btn-selectall-car">
            <button rel="BENZ ทุกรุ่น">เลือกรุ่นทั้งหมด.. คลิก <img src="{{asset('frontend/images/chev-circle-white.svg')}}" alt=""></button>
        </div>
    </div>
    <div class="carsearch-menu carsearch-lv3">
        <div class="carsearch-top">
            <button class="carsearch-head"><i class="bi bi-arrow-left"></i> เลือกโฉม</button><button class="carsearch-exit">ยกเลิก</button>
        </div>
        <input type="text" class="car-inputsearch" placeholder="ค้นหา...">
        <ul class="carsearch-ul">
            
            
        </ul>
        <div class="btn-selectall-car">
            <button rel="BENZ C-CLASS ทุกโฉม">เลือกโฉมทั้งหมด.. คลิก <img src="{{asset('frontend/images/chev-circle-white.svg')}}" alt=""></button>
        </div>
    </div>
    <div class="carsearch-menu carsearch-lv4">
        <div class="carsearch-top">
            <button class="carsearch-head"><i class="bi bi-arrow-left"></i> เลือกรุ่นย่อย</button><button class="carsearch-exit">ยกเลิก</button>
        </div>
        <input type="text" class="car-inputsearch" placeholder="ค้นหา...">
        <ul class="carsearch-ul">
            
            
        </ul>
        <div class="btn-selectall-car">
            <button rel="BENZ C-CLASS W202 ปี93-00 ทุกรุ่นย่อย">เลือกรุ่นย่อยทั้งหมด.. คลิก <img src="{{asset('frontend/images/chev-circle-white.svg')}}" alt=""></button>
        </div>
    </div>
</div>



<script type="text/javascript">
    function brand(param, param2) {
        $.get('/popup-carsearch-model/'+param, function(data, status) {
            // console.log(data);
            var html='<li><button rel="'+param2+' ทุกรุ่น" onclick="model(0, \''+param2+' ทุกรุ่น\')">รุ่นทั้งหมด</button></li>';
            $.each(data, function(index, value){
                html+='<li><button rel="'+param2+' '+value.model.toUpperCase()+'" onclick="model('+value.id+', \''+param2+' '+value.model.toUpperCase()+'\')">'+value.model.toUpperCase()+'</button></li>';
            });
            $('.carsearch-lv2 .carsearch-ul').empty().append(html);
        });
    }

    function model(param, param2) {
        $('.box-search-car .carsearch-input input').val(param2);
        $.get('/popup-carsearch-generation/'+param+'?models_id='+param, function(data, status) {
            // console.log(data);
            var html='<li><button rel="'+param2+' ทุกโฉม" onclick="generation(0, \''+param2+' ทุกโฉม\')">โฉมทั้งหมด</button></li>';
            $.each(data, function(index, value){
                html+='<li><button rel="'+param2+' '+value.generations.toUpperCase()+'" onclick="generation('+value.id+', \''+param2+' '+value.generations.toUpperCase()+'\')">'+value.generations.toUpperCase()+'</button></li>';
            });
            $('.carsearch-lv3 .carsearch-ul').empty().append(html);
        });
        // resources\views\frontend\layouts\inc_javascript.blade.php
        if (param == 0){
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
        else {
            $('.box-search-car .carsearch-lv3').fadeIn();
            $('.box-search-car .carsearch-lv2').hide();
        }
    }

    function generation(param, param2) {
        $('.box-search-car .carsearch-input input').val(param2);
        $.get('/popup-carsearch-submodel/'+param+'?generations_id='+param, function(data, status) {
            // console.log(data);
            var html='<li><button rel="'+param2+' ทุกรุ่นย่อย" onclick="submodel(0, \''+param2+' ทุกรุ่นย่อย\')">รุ่นย่อยทั้งหมด</button></li>';
            $.each(data, function(index, value){
                html+='<li><button rel="'+param2+' '+value.sub_models.toUpperCase()+'" onclick="submodel('+value.id+', \''+param2+' '+value.sub_models.toUpperCase()+'\')">'+value.sub_models.toUpperCase()+'</button></li>';
            });
            $('.carsearch-lv4 .carsearch-ul').empty().append(html);
        });
        // resources\views\frontend\layouts\inc_javascript.blade.php
        if (param == 0){
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
        else {
            $('.box-search-car .carsearch-lv4').fadeIn();
            $('.box-search-car .carsearch-lv3').hide();
        }
    }

    function submodel(param, param2) {
        $('.box-search-car .carsearch-input input').val(param2);
        if (param == 0){
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
        else {
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
    }
</script>