<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookTour;
use App\Models\Tour;
use App\Models\User;
use Mail;

class BookTourController extends Controller
{
    public function __construct(BookTour $bookTour,Tour $tour)
    {
        view()->share([
            'book_tour_active' => 'active',
            'status' => $bookTour::STATUS,
            'classStatus' => $bookTour::CLASS_STATUS,
            'tours' => $tour::get(),
        ]);
        $this->bookTour = $bookTour;
    }
    //
    public function index(Request $request)
    {
        $bookTours = BookTour::with(['tour', 'user']);
      

        if ($request->name_tour) {
            $nameTour = $request->name_tour;
            $bookTours->whereIn('b_tour_id', function ($q) use ($nameTour) {
                $q->from('tours')
                    ->select('id')
                    ->where('t_title', 'like', '%'.$nameTour.'%');
            });
        }
        
        if ($request->b_tour_id) {
            $bookTours->where('b_tour_id', $request->b_tour_id);
          
        }
        if ($request->b_name) {
            $bookTours->where('b_name', 'like', '%'.$request->b_name.'%');
        }
        if ($request->b_email) {
            $bookTours->where('b_email', $request->b_email);
        }

        if ($request->b_phone) {
            $bookTours->where('b_phone', $request->b_phone);
        }

        $bookTours = $bookTours->orderByDesc('id')->paginate(NUMBER_PAGINATION_PAGE);
        return view('admin.book_tour.index', compact('bookTours'));
    }

    public function prinft_order($id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_converst($id));
        return $pdf->stream();
    }

    public function print_order_converst($id){
        $tour = BookTour::find($id);

        $totalPrice = ($tour->b_number_adults*$tour->b_price_adults)+($tour->b_number_children*$tour->b_price_children)+($tour->b_number_child6*$tour->b_price_child6)+($tour->b_number_child2*$tour->b_price_child2)+($tour->number_singer_room*500000+$tour->fee_singer_room)+($tour->number_two_room*500000+$tour->fee_two_room)+($tour->number_three_room*500000+$tour->fee_three_room);

        $output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>PDF</title>
        </head>
        <style>
        body{
            font-family: Dejavu Sans;
        }
        </style>
        <body>
       
            <h1 style = "color:red;"><center>Hóa đơn</center></h1>
            <h1><center>Hóa đơn</center></h1>
            <i>Mã đơn hàng: </i><b>'.$tour->id.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <i>Ngày tạo: </i><b>'.$tour->created_at.'</b><br>
            <i>Tên khách hàng: </i><b>'.$tour->b_name.'</b>
            <i>Email khách hàng: </i><b>'.$tour->b_email.'</b>
            <i>SĐT khách hàng: </i><b>'.$tour->b_phone.'</b>
        

            <p style = "color:red;">Thông tin hóa đơn: </p>
           
                <table border="1" cellspacing="0">
                <tr>
                <th>Tên tour - Mã tour</th>
                    <th>Dữ liệu tour</th>
                </tr>
                ';
               
                    $output .= '<tr>
                    <td style="vertical-align: middle; width: 15%" class="title-content">'
                    .$tour->id.'<p>'.$tour->tour->t_title.'</p>
                </td>

                <td style="vertical-align: middle; width: 35%" class="title-content">                                            
                    <p><b>Số người lớn</b>:'.$tour->b_number_adults.' <b>Thành tiền</b>:'.number_format($tour->b_number_adults*$tour->b_price_adults, 0,',','.').'vnd</p>
                    <p><b>Số trẻ em</b>:'.$tour->b_number_children.' - <b>Thành tiền</b>:'. number_format($tour->b_number_children*$tour->b_price_children, 0,',','.').'vnd</p>
                    <p><b>Số trẻ em (2-6 tuổi) :</b>'. $tour->b_number_child6 .' - <b>Thành tiền</b>:'. number_format($tour->b_number_child6*$tour->b_price_child6, 0,',','.').' vnd</p>
                <p><b>Số trẻ em (dưới 2 tuổi) :</b>'. $tour->b_number_child2 .' - <b>Thành tiền</b>: '.number_format($tour->b_number_child2*$tour->b_price_child2, 0,',','.') .'vnd</p>
                <p><b>Số phòng đơn:</b>'.$tour->number_singer_room.' - <b>Thành tiền</b>: '. number_format($tour->number_singer_room*500000+$tour->fee_singer_room, 0,',','.') .' vnd</p>
                <p><b>Số phòng đôi  :</b>'. $tour->number_two_room.'- <b>Thành tiền</b>: '. number_format($tour->number_two_room*800000+$tour->fee_two_room, 0,',','.') .'vnd</p>
                <p><b>Số phòng ba :</b> '.$tour->number_three_room .' - <b>Thành tiền</b>: '. number_format($tour->number_three_room*1000000+$tour->fee_three_room, 0,',','.')  .' vnd</p>
                    <p><b>Tổng tiền </b>:'.number_format($totalPrice, 0,',','.') .' vnd</p>
                    <p><b>Mã booking</b>: '.$tour->id .'</p>
                    <p><b>Điểm đón</b>: '.$tour->b_address .'</p>
                    <p><b>Ghi chú</b>: '.$tour->b_note .'</p>
                </td> ';

                foreach(json_decode($tour->otherPeople,true) as $index=> $ai)
                {

                    $output.='
                    
                    <p><b>Tên người đi kèm'. $index .'</b>:'.$ai['name'] .'</p>
                <p><b>Ngày sinh'. $index .'</b>:'. $ai['dob'] .'</p>
                <p><b>Giới tính'. $index .'</b>:'. $ai['gender'] .'</p>
                    
                    ';
                }
                                  
               $output.= '
               </table>
        </body>
        </html>';
                
        return $output;
    }

    public function delete($id)
    {
        $bookTour = BookTour::find($id);
        if (!$bookTour) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $bookTour->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function updateStatus(Request $request, $status, $id)
    {
        $bookTour = BookTour::find($id);
        $numberUser = $bookTour->b_number_adults + $bookTour->b_number_children+ $bookTour->b_number_child6+ $bookTour->b_number_child2;
        if (!$bookTour) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
    $temp= $bookTour->b_status;
        \DB::beginTransaction();
        if($status != $bookTour->b_status && $status > $bookTour->b_status ){
        try {
            $bookTour->b_status = $status;
            
            if ($bookTour->save()) {
                if($status == 4 && $temp !=3){
                    return redirect()->back()->with('error', 'thao tác lỗi');
                }
                if ($status == 5 ) {
                    if($temp ==4 ) {
                        return redirect()->back()->with('error', 'Thao tác sai');
                    }
                    if($temp==1){
                        $tour = Tour::find($bookTour->b_tour_id);
                    $tour->t_follow= $tour->t_follow - $numberUser;                   
                    $tour->save();
                    $user = User::find($bookTour->b_user_id);
                    $mailuser =$user->email;
                    Mail::send('emailhuy',compact('user','bookTour','tour'),function($email) use($mailuser){
                        $email->subject('Xác nhận HUỶ BOOKING');
                        $email->to($mailuser);
                    });
                    }else {
                        $tour = Tour::find($bookTour->b_tour_id);
                    $tour->t_number_registered = $tour->t_number_registered - $numberUser;                   
                    $tour->save();
                    $user = User::find($bookTour->b_user_id);
                    $mailuser =$user->email;
                    Mail::send('emailhuy',compact('user','bookTour','tour'),function($email) use($mailuser){
                        $email->subject('Xác nhận HUỶ BOOKING');
                        $email->to($mailuser);
                    });
                    }
                    
                } 
                if($status==3){
                   
                    if($temp == 2) {
                        $tour = Tour::find($bookTour->b_tour_id);
                        $user = User::find($bookTour->b_user_id);
                        $mailuser =$user->email;
                        Mail::send('emailtt',compact('user','bookTour','tour'),function($email) use($mailuser){
                            $email->subject('Xác nhận thanh toán');
                            $email->to($mailuser);
                        });
                    }
                    if($temp == 1) {

                        $tour = Tour::find($bookTour->b_tour_id);
                        $tour->t_number_registered = $tour->t_number_registered + $numberUser;
                        $tour->t_follow = $tour->t_follow - $numberUser;
                        $tour->save();
                        $user = User::find($bookTour->b_user_id);
                        $mailuser =$user->email;
                        Mail::send('emailtt',compact('user','bookTour','tour'),function($email) use($mailuser){
                            $email->subject('Xác nhận thanh toán');
                            $email->to($mailuser);
                        });
                    }
                    
                }
                if($status==2  ){
                   
                    $tour = Tour::find($bookTour->b_tour_id);
                    $tour->t_number_registered = $tour->t_number_registered + $numberUser;
                    $tour->t_follow = $tour->t_follow - $numberUser;
                    $tour->save();
                    $user = User::find($bookTour->b_user_id);
                    $mailuser =$user->email;
                    Mail::send('email',compact('user','bookTour','tour'),function($email) use($mailuser){
                        $email->subject('Xác nhận booking');
                        $email->to($mailuser);
                    });
                }
            }
           
            \DB::commit();
            return redirect()->route('book.tour.index')->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }else {
        return redirect()->back()->with('error', 'Lỗi thao tác');
    }
    }
}
