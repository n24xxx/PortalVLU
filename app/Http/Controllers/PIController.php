<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PI;
use App\Employee;
use Hash;

class PIController extends Controller
{
    public function index(){
      //check if have any get request named 'search' then assign value to $search
      $search =  \Request::get('search');

      //query if $search have a value
      $pis = PI::where(function($query) use ($search){
            if($search != null){
                $query->where(function($q) use ($search){
                    $q->where('employee_code','like','%'.$search.'%');
                });
            }

        })->orderBy('first_name','decs')->paginate(10)->appends(['search'=>$search]);

      return view('pi.pi-list',compact('pis','search'));
    }
    public function getAdd()
    {
        return view('pi.pi-add');
    }
    public function postAdd(Request $request)
    {
        $request->validate(
          [
          'employee_code'=> 'required|unique:personalinformations,employee_code',
          'full_name'=> 'required|min:4|max:60',
          'nation'=> 'required',
          'date_of_birth'=>'required|date',
          'place_of_birth'=> 'required|min:5|max:100',
          'permanent_address'=> 'required|min:6|max:100',
          'contact_address'=> 'required|min:6|max:100',
          'phone_number'=> 'required',
          'email_address'=> 'required|email|unique:personalinformations,email_address',
          'position'=> 'required',
          'date_of_recruitment' => 'required|date',
          'professional_title'=> 'required',
          'identity_card'=> 'required|unique:personalinformations,identity_card',
          'date_of_issue' => 'required|data',
          'place_of_issue'=> 'required|min:5|max:100'
      ],
          [
              'employee_code.required'=> 'Mã giảng viên không được bỏ trống',
              'employee_code.unique'=> 'Mã giảng viên đã tồn tại',
              'full_name.required' =>'Họ và tên không được bỏ trống',
              'full_name.min' =>'Họ và tên phải lớn hơn 4 kí tự',
              'full_name.max' =>'Họ và tên phải nhỏ hơn 60 kí tự',
              'nation.required' =>'Dân tộc không được bỏ trống',
              'date_of_birth.required' =>'Ngày sinh không được bỏ trống',
              'date_of_birth.date' =>'Ngày sinh sai định dạng',
              'place_of_birth.min' =>'Nơi sinh phải lớn hơn 5 kí tự',
              'place_of_birth.max' =>'Nơi sinh phải nhỏ hơn 100 kí tự',
              'place_of_birth.required' =>'Nơi sinh không được bỏ trống',
              'permanent_address.min' =>'Địa chỉ thường trú phải lớn hơn 6 kí tự',
              'permanent_address.max' =>'Địa chỉ thường trú phải nhỏ hơn 100 kí tự',
              'permanent_address.required' =>'Địa chỉ thường trú không được bỏ trống',
              'contact_address.min' =>'Địa chỉ liên hệ phải lớn hơn 6 kí tự',
              'contact_address.max' =>'Địa chỉ liên hệ phải nhỏ hơn 100 kí tự',
              'contact_address.required' =>'Địa chỉ liên hệ không được bỏ trống',
              'phone_number.required' =>'Số điện thoại không được bỏ trống',
              'email_address.required' =>'Email không được bỏ trống',
              'email_address.email' =>'Email sai định dạng',
              'email_address.unique' =>'Email đã được sử dụng',
              'position.required' =>'Chức vụ không được bỏ trống',
              'date_of_recruitment.required' =>'Ngày tuyển dụng không được bỏ trống',
              'date_of_recruitment.date' =>'Ngày tuyển dụng sai định dạng',
              'professional_title.required' =>'Chức danh chuyên môn không được bỏ trống',
              'identity_card.unique' =>'Chứng minh nhân dân đã được sử dụng',
              'identity_card.required' =>'Chứng minh nhân dân không được bỏ trống',
              'date_of_issue.required' =>'Ngày cấp không được bỏ trống',
              'date_of_issue.date' =>'Ngày cấp sai định dạng',
              'place_of_issue.min' =>'Nơi cấp phải lớn hơn 5 kí tự',
              'place_of_issue.max' =>'Nơi cấp phải nhỏ hơn 100 kí tự',
              'place_of_issue.required' =>'Nơi cấp không được bỏ trống'
          ]
      );

        //add data
        $pi = new PI;
        $pi->id= $request->id;
        $pi->employee_code= $request->employee_code;

        // $full_name = " ".$request->full_name;
        $pi->full_name= $request->full_name;
        $split = explode(" ", $request->full_name);
        $pi->first_name =$split[sizeof($split)-1]; // get name
        $pi->gender= $request->gender;
        $pi->nation= $request->nation;
        $pi->date_of_birth= $request->date_of_birth;
        $pi->place_of_birth= $request->place_of_birth;
        $pi->permanent_address= $request->permanent_address;
        $pi->contact_address= $request->contact_address;
        $pi->phone_number= $request->phone_number;
        $pi->email_address= $request->email_address;
        $pi->position= $request->position;
        $pi->date_of_recruitment= $request->date_of_recruitment;
        $pi->professional_title= $request->professional_title;
        $pi->identity_card= $request->identity_card;
        $pi->date_of_issue= $request->date_of_issue;
        $pi->place_of_issue= $request->place_of_issue;
        $pi->save();
        //create account
        $employee = new Employee;
        $employee->personalinformation_id = $pi->id;
        $employee->username= $pi->employee_code;
        $employee->password = Hash::make($pi->employee_code);

        $employee->save();

        return redirect()->back()->with('message', 'Thêm thành công');
    }
    //get data personal information
    public function getupdate($id)
    {
        $pi = PI::Find($id);
        return view('pi.pi-update', compact('pi'));
    }
    //post date update information
    public function postupdate(Request $request, $id)
    {


        //post data
        $pi = PI::Find($id);
        $request->validate(
            [
              'full_name'=> 'required|min:4|max:60',
              'nation'=> 'required',
              'date_of_birth'=>'required|date',
              'place_of_birth'=> 'required|min:5|max:100',
              'permanent_address'=> 'required|min:6|max:100',
              'contact_address'=> 'required|min:6|max:100',
              'phone_number'=> 'required',
              'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
              'position'=> 'required',
              'date_of_recruitment' => 'required|date',
              'professional_title'=> 'required',
              'identity_card'=> 'required|unique:personalinformations,identity_card,'.$pi->id,
              'date_of_issue' => 'required|data',
              'place_of_issue'=> 'required|min:5|max:100'
          ],
              [
                  'employee_code.required'=> 'Mã giảng viên không được bỏ trống',
                  'employee_code.unique'=> 'Mã giảng viên đã tồn tại',
                  'full_name.required' =>'Họ và tên không được bỏ trống',
                  'full_name.min' =>'Họ và tên phải lớn hơn 4 kí tự',
                  'full_name.max' =>'Họ và tên phải nhỏ hơn 60 kí tự',
                  'nation.required' =>'Dân tộc không được bỏ trống',
                  'date_of_birth.required' =>'Ngày sinh không được bỏ trống',
                  'date_of_birth.date' =>'Ngày sinh sai định dạng',
                  'place_of_birth.min' =>'Nơi sinh phải lớn hơn 5 kí tự',
                  'place_of_birth.max' =>'Nơi sinh phải nhỏ hơn 100 kí tự',
                  'place_of_birth.required' =>'Nơi sinh không được bỏ trống',
                  'permanent_address.min' =>'Địa chỉ thường trú phải lớn hơn 6 kí tự',
                  'permanent_address.max' =>'Địa chỉ thường trú phải nhỏ hơn 100 kí tự',
                  'permanent_address.required' =>'Địa chỉ thường trú không được bỏ trống',
                  'contact_address.min' =>'Địa chỉ liên hệ phải lớn hơn 6 kí tự',
                  'contact_address.max' =>'Địa chỉ liên hệ phải nhỏ hơn 100 kí tự',
                  'contact_address.required' =>'Địa chỉ liên hệ không được bỏ trống',
                  'phone_number.required' =>'Số điện thoại không được bỏ trống',
                  'email_address.required' =>'Email không được bỏ trống',
                  'email_address.email' =>'Email sai định dạng',
                  'email_address.unique' =>'Email đã được sử dụng',
                  'position.required' =>'Chức vụ không được bỏ trống',
                  'date_of_recruitment.required' =>'Ngày tuyển dụng không được bỏ trống',
                  'date_of_recruitment.date' =>'Ngày tuyển dụng sai định dạng',
                  'professional_title.required' =>'Chức danh chuyên môn không được bỏ trống',
                  'identity_card.unique' =>'Chứng minh nhân dân đã được sử dụng',
                  'identity_card.required' =>'Chứng minh nhân dân không được bỏ trống',
                  'date_of_issue.required' =>'Ngày cấp không được bỏ trống',
                  'date_of_issue.date' =>'Ngày cấp sai định dạng',
                  'place_of_issue.min' =>'Nơi cấp phải lớn hơn 5 kí tự',
                  'place_of_issue.max' =>'Nơi cấp phải nhỏ hơn 100 kí tự',
                  'place_of_issue.required' =>'Nơi cấp không được bỏ trống'
              ]
        );
        //post data
        $pi->id= $request->id;
        $pi->full_name= $request->full_name;
        $split = explode(" ", $request->full_name);
        $pi->first_name =$split[sizeof($split)-1]; // get name
        $pi->gender= $request->gender;
        $pi->nation= $request->nation;
        $pi->date_of_birth= $request->date_of_birth;
        $pi->place_of_birth= $request->place_of_birth;
        $pi->permanent_address= $request->permanent_address;
        $pi->contact_address= $request->contact_address;
        $pi->phone_number= $request->phone_number;
        $pi->email_address= $request->email_address;
        $pi->position= $request->position;
        $pi->date_of_recruitment= $request->date_of_recruitment;
        $pi->professional_title= $request->professional_title;
        $pi->identity_card= $request->identity_card;
        $pi->date_of_issue= $request->date_of_issue;
        $pi->place_of_issue= $request->place_of_issue;
        //validate data

        $pi->save();


        return redirect()->back()->with('message', 'Cập Nhật thành công');
    }
}
