@extends('page.layouts.page')
@section('title', 'Đặt tour')
@section('style')
@stop
@section('seo')
@stop
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/bg_4.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Tours <i class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Đặt Tour</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb contact-section mb-4">
        <div class="container">
            {{-- <div class="row d-flex contact-info">
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-map-marker"></span>
                        </div>
                        <h3 class="mb-2">Địa chỉ</h3>
                        <p>Số 3 Đ. Cầu Giấy, Láng Thượng, Đống Đa, Hà Nội Hà Nội</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-phone"></span>
                        </div>
                        <h3 class="mb-2">Số điện thoại liên hệ</h3>
                        <p><a href="tel://1234567920">0379667895</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-paper-plane"></span>
                        </div>
                        <h3 class="mb-2">Địa chỉ email</h3>
                        <p><a href="mailto:info@yoursite.com">admin@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-globe"></span>
                        </div>
                        <h3 class="mb-2">Website</h3>
                        <p><a href="#">http://youtube.com</a></p>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <section class="ftco-section contact-section ftco-no-pt">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-6 order-md-last">
                    <p></p>
                    <form action="{{ route('post.book.tour', $tour->id) }}" method="POST" class="bg-light p-5 contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Họ và tên <sup class="text-danger">(*)</sup></label>
                            <input type="text" name="b_name" value="{{ old('b_name', isset($user) ? $user->name : '') }}" class="form-control" placeholder="Họ và tên">
                            @if ($errors->first('b_name'))
                                <span class="text-danger">{{ $errors->first('b_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Email <sup class="text-danger">(*)</sup></label>
                            <input type="text" name="b_email" value="{{ old('b_email', isset($user) ? $user->email : '') }}" class="form-control" placeholder="Email">
                            @if ($errors->first('b_email'))
                                <span class="text-danger">{{ $errors->first('b_email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Số điện thoại <sup class="text-danger">(*)</sup></label>
                            <input type="text" name="b_phone" value="{{ old('b_phone', isset($user) ? $user->phone : '') }}" class="form-control" placeholder="Số điện thoại">
                            @if ($errors->first('b_phone'))
                                <span class="text-danger">{{ $errors->first('b_phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Địa chỉ <sup class="text-danger">(*)</sup></label>
                            <input type="text" name="b_address" value="{{ old('b_address', isset($user) ? $user->address : '') }}" class="form-control" placeholder="Địa chỉ">
                            @if ($errors->first('b_address'))
                                <span class="text-danger">{{ $errors->first('b_address') }}</span>
                            @endif
                        </div>
                        <!-- <div class="form-group">
                            <label for="inputEmail3" class="control-label">Ngày khởi hành dự kiến</label>
                            <input type="date" name="b_start_date" value="{{ old('b_address', isset($user) ? $user->address : '') }}" class="form-control">
                            @if ($errors->first('b_start_date'))
                                <span class="text-danger">{{ $errors->first('b_start_date') }}</span>
                            @endif
                        </div> -->
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Người lớn <sup class="text-danger">(*)</sup></label>
                            <input type="number" name="b_number_adults" class="form-control" placeholder="Số người lớn">
                            @if ($errors->first('b_number_adults'))
                                <span class="text-danger">{{ $errors->first('b_number_adults') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Trẻ em (6 - 12 tuổi) <sup class="text-danger">(*)</sup></label>
                            <input type="number"  min="0" value="0" name="b_number_children" class="form-control" placeholder="Số trẻ em">
                            @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Trẻ em (2-6 tuổi) <sup class="text-danger">(*)</sup></label>
                            <input type="number"  min="0" value="0" name="b_number_child6" class="form-control" placeholder="Số trẻ em">
                            @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Trẻ sơ sinh (Nhỏ hơn 2 tuổi) <sup class="text-danger">(*)</sup></label>
                            <input type="number"  min="0" value="0" name="b_number_child2" class="form-control a" placeholder="Số trẻ em">
                            @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Số lượng phòng đơn <sup class="text-danger">(*)</sup></label>
                            <input type="number"  min="0" value="0" name="number_singer_room" class="form-control a" placeholder="Số trẻ em">
                            <!-- @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                            @endif -->
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Phụ thu phòng đơn <sup class="text-danger">(*)</sup></label>
                            <select name="fee_singer_room" id="" class="form-control a">
                                <option value="0">Không</option>
                                <option value="1">Có +500.000 vnđ</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Số lượng phòng đôi <sup class="text-danger">(*)</sup></label>
                            <input type="number"  min="0" value="0" name="number_two_room" class="form-control a" placeholder="Số trẻ em">
                            <!-- @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                            @endif -->
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Phụ thu phòng đôi <sup class="text-danger">(*)</sup></label>
                            <select name="fee_two_room" id="" class="form-control a">
                                <option value="0">Không</option>
                                <option value="1">Có +500.000 vnđ</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Số lượng phòng ba <sup class="text-danger">(*)</sup></label>
                            <input type="number"  min="0" value="0" name="number_three_room" class="form-control a" placeholder="Số trẻ em">
                            <!-- @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                            @endif -->
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Phụ thu phòng ba <sup class="text-danger">(*)</sup></label>
                            <select name="fee_three_room" id="" class="form-control a">
                                <option value="0">Không</option>
                                <option value="1">Có +500.000 vnđ</option>    
                            </select>
                        </div>
                        <div id="form-container" class="border p-3">
                        <div class="form">
                            <h4>Nhập tên khách hàng đi kèm</h4>
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label">Họ và tên </label>
                                <input type="text" name="customer_1" class="form-control a" placeholder="Họ và tên">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label">Ngày sinh </label>
                                <input type="text" name="dob_1" class="form-control a" placeholder="Ngày sinh">
                            </div>
                            <div class="form-group">
                            <label for="inputEmail3" class="control-label">Giới tính</label>
                            <select name="gender_1" id="" class="form-control a">
                                <option value="nam">Nam</option>
                                <option value="nu">Nữ</option>    
                            </select>
                            <div class="delete-form">-</div>
                        </div>
                        </div>
                        </div>

                        <div id="add-form" class="btn btn-primary py-2 px-3 m-3">+</div>
                       
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Ghi chú</label>
                            <textarea name="b_note"  placeholder="Gửi yêu cầu cho chúng to" id="message" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <input type="submit" value="Đặt Tour" class="btn btn-primary py-3 px-5">
                            </div>
                        </div>
                        {{-- -------Them --}}
                        {{-- @if ($tour->location->count() > 0)
                    <div class="bg-light sidebar-box ftco-animate fadeInUp ftco-animated related-tour">
                        <h3>Danh Sách Khách sạn Liên Quan</h3>
                        <?php $itemTour = 'item-related-tour' ?>
                        @foreach($tour->location->tours as $tour->location->tour)
                            @include('page.common.itemTour', compact('tour', 'itemTour'))
                        @endforeach
                    </div>
                @endif --}}
                        
                        
                    </form>

                </div>

                <div class="col-md-6 text-center">
                    <div class="col-md-12">
                        <h2 class="mb-3 title-book">{{ $tour->t_title }}</h2>
                        <h2 class="mb-3">{{ isset($tour->location) ? $tour->location->l_name : '' }}</h2>
                        <p>Hành trình : {{ $tour->t_journeys }}</p>
                        <p>Lịch trình : {{ $tour->t_schedule }}</p>
                        <p>Phương tiện di chuyển : {{ $tour->t_move_method }}</p>
                        <p>Số người tham gia : {{ $tour->t_number_guests }}</p>
                        <p>Đã đăng ký : {{ $tour->t_number_registered }}</p>
                        {{-- <div class="phoneWrap">
                            <div class="hotline">037.96.67895</div>
                            <div class="hotline">01234.56789</div>
                        </div> --}}
                        
                    </div>
                    <div class="col-md-12">
                        <img src="{{ asset('page/images/travel.jpg') }}" alt="" class="image-book">
                    </div>
                    <div>
                        
                    <table style="border-collapse: collapse; width: 100%;margin-top:20px" border="1">
                        
<tbody>
<tr>
<td style="width: 10%;">Bảng gi&aacute;</td>
<td style="width: 20%;">Người lớn(tr&ecirc;n 12 tuổi)</td>
<td style="width: 20%;">Trẻ em(6-12 tuổi)</td>
<td style="width: 20%;">Trẻ em(2-6 tuổi)</td>
<td style="width: 20%;">Sơ sinh( &lt;2 tuổi)</td>
<td style="width: 20%;">Phụ thu phòng</td>
</tr>
<tr>
<td style="width: 10%;">Gi&aacute;&nbsp;</td>
<td style="width: 20%;">{{ number_format($tour->t_price_adults-($tour->t_price_adults*$tour->t_sale/100),0,',','.') }} vnd</td>
<td style="width: 20%;">{{ number_format($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100),0,',','.') }} vnd</td>
<td style="width: 20%;">{{ number_format(($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100))*50/100,0,',','.') }} vnd</td>
<td style="width: 20%;">{{ number_format(($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100))*25/100,0,',','.') }} vnd</td>
<td style="width: 20%;">500.000 vnd</td>
</tr>
</tbody>
</table>
{{-- <div >@if ($tour->location->count() > 0)
    <div class="bg-light sidebar-box ftco-animate fadeInUp ftco-animated related-tour">
        <h3>Danh Sách Khách sạn Liên Quan</h3>
        <?php $itemTour = 'item-related-tour' ?>
        @foreach($tour->location as $tour->location->tour)
            @include('page.common.itemTour', compact('tour', 'itemTour'))
        @endforeach
    </div>
@endif --}}
<div class="col-md-12">
    <img src="{{ asset('page/images/bgbook.jpg') }}" alt="" class="bg-book">
</div>
</div>

                {{-- @if ($tours->count() > 0)
                        <div class="bg-light sidebar-box ftco-animate fadeInUp ftco-animated related-tour">
                            <h3>Danh Sách Tour Liên Quan</h3>
                            <?php $itemTour = 'item-related-tour' ?>
                            @foreach($tours as $tour)
                                @include('page.common.itemTour', compact('tour', 'itemTour'))
                            @endforeach
                        </div>
                    @endif --}}
</div>
                </div>
            </div>
        </div>
        <script>
    $('.a').on('input',function(){
        var $a =$(this).val();
        var $p = $(this).parents('tr');
        var $b=300;
        var $t=$p.find('.t');
        $t.text($b*$a);
    })
</script>
<script>
    var formContainer = document.getElementById("form-container");
var addFormButton = document.getElementById("add-form");

var formNumber = 2;

addFormButton.addEventListener("click", function() {
  var newForm = document.createElement("div");
  newForm.classList.add("form");
  newForm.dataset.formId = formNumber;
  newForm.innerHTML = `
    <h4>Người đi kèm ${formNumber}</h4>
    <div class="form-group">
        <label for="inputEmail3" class="control-label">Họ và tên </label>
        <input type="text" name="customer_${formNumber}" class="form-control a" placeholder="Họ và tên">
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="control-label">Ngày sinh </label>
        <input type="text" name="dob_${formNumber}" class="form-control a" placeholder="Ngày sinh">
    </div>
    <div class="form-group">
    <label for="inputEmail3" class="control-label">Giới tính</label>
    <select name="gender_${formNumber}" id="" class="form-control a">
        <option value="nam">Nam</option>
        <option value="nu">Nữ</option>    
    </select>
    <div class="delete-form">-</div>
  `;
  formContainer.appendChild(newForm);
  formNumber++;
  
  // Add event listener for the new form's delete button
  var deleteFormButton = newForm.querySelector(".delete-form");
  deleteFormButton.addEventListener("click", function() {
    var formId = newForm.dataset.formId;
    var formToDelete = document.querySelector(`.form[data-form-id="${formId}"]`);
    formToDelete.remove();
  });
});

</script>
    </section>
@stop
@section('script')
@stop