<div class="col-12 col-lg-4 col-xl-3 menuprofile-mb">
    <div class="close-menuprofile"><i class="bi bi-x-circle-fill"></i></div>
    <a href="{{route('customercontactPage')}}" class="btn-customer">
        <div><i class="bi bi-person"></i> ลูกค้ารอติดต่อกลับ</div>
        <div class="num-contactcus">{{count($contacts_back)}}</div>
    </a>
    @include('frontend.layouts.inc-menu-deal')


</div>





    