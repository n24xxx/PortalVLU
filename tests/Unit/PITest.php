<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use Admin;
use Illuminate\Support\Facades\Session;
use App\PI;

class PITest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_add_PI_correct_data()
    {
        $actual = [
           'employee_code' => 'T153772',
           'full_name' =>'Le Thanh Son',
           'nation' =>'Kinh',
           'gender'=> 1,
           'date_of_birth' =>'1997-04-10',
           'place_of_birth' =>'TPHCM',
           'permanent_address' =>'An Giang',
           'contact_address' =>'An Giang',
           'phone_number' =>'0123456789',
           'email_address' =>'lethanhson2910@gmail.com',
           'position' =>'Quan ly',
           'date_of_recruitment' =>'2018-04-10',
           'professional_title' =>'Lao cong',
           'identity_card' =>'321368999',
           'date_of_issue' =>'2015-04-10',
           'place_of_issue' =>'TPHCM',

         ];
        $addPI = $this->post('/admin/pi-add', $actual);
        $pi = PI::where('employee_code', $actual['employee_code'])->first();//
        $this->assertEquals($pi->employee_code, $actual['employee_code']);
        $this->assertEquals($pi->identity_card, $actual['identity_card']);
        $this->assertEquals($pi->email_address, $actual['email_address']);
    }
    public function test_add_PI_with_empty_employee_code()
    {
        $actual = [
            'employee_code' => '',
            'full_name' =>'Le Thanh Son',
            'nation' =>'Kinh',
            'gender' =>1,
            'date_of_birth' =>'1997-04-10',
            'place_of_birth' =>'TPHCM',
            'permanent_address' =>'An Giang',
            'contact_address' =>'An Giang',
            'phone_number' =>'0123456789',
            'email_address' =>'lethanhson2910@gmail.com',
            'position' =>'Quan ly',
            'date_of_recruitment' =>'2018-04-10',
            'professional_title' =>'Lao cong',
            'identity_card' =>'321368999',
            'date_of_issue' =>'2015-04-10',
            'place_of_issue' =>'TPHCM',

          ];
        $addPI = $this->post('/admin/pi-add', $actual);

        $addPI->assertSessionHasErrors([
            'employee_code'=> 'Mã giảng viên không được bỏ trống',
          ]);
        // $pi = PI::where('employee_code',$actual['employee_code'])->first();
          // $this->assertEquals($pi->employee_code, $actual['employee_code']);
    }

    public function test_add_PI_with_duplicate_employee_code()
    {
        $actual = [
             'employee_code' => 'T153772',
             'full_name' =>'Le Thanh Son',
             'nation' =>'Kinh',
             'gender' =>1,
             'date_of_birth' =>'1997-04-10',
             'place_of_birth' =>'TPHCM',
             'permanent_address' =>'An Giang',
             'contact_address' =>'An Giang',
             'phone_number' =>'0123456789',
             'email_address' =>'lethanhson2910@gmail.com',
             'position' =>'Quan ly',
             'date_of_recruitment' =>'2018-04-10',
             'professional_title' =>'Lao cong',
             'identity_card' =>'321368999',
             'date_of_issue' =>'2015-04-10',
             'place_of_issue' =>'TPHCM',

           ];
        $addPI = $this->post('/admin/pi-add', $actual);
        $duplicate_pi = $this->post('/admin/pi-add', $actual);
        $duplicate_pi->assertSessionHasErrors([
             'employee_code'=> 'Mã giảng viên đã tồn tại'
           ]);
    }
    public function test_add_PI_with_incorrect_format_email()
    {
        $actual = [
             'employee_code' => 'T153772',
             'full_name' =>'Le Thanh Son',
             'nation' =>'Kinh',
             'gender' =>1,
             'date_of_birth' =>'1997-04-10',
             'place_of_birth' =>'TPHCM',
             'permanent_address' =>'An Giang',
             'contact_address' =>'An Giang',
             'phone_number' =>'0123456789',
             'email_address' =>'lethanhson2910@',
             'position' =>'Quan ly',
             'date_of_recruitment' =>'2018-04-10',
             'professional_title' =>'Lao cong',
             'identity_card' =>'321368999',
             'date_of_issue' =>'2015-04-10',
             'place_of_issue' =>'TPHCM',

           ];
        $format_email = $this->post('/admin/pi-add', $actual);
        $format_email->assertSessionHasErrors([
             'email_address'=> 'Email sai định dạng'
           ]);
    }
    public function test_add_PI_with_incorrect_format_date()
    {
        $actual = [
             'employee_code' => 'T153772',
             'full_name' =>'Le Thanh Son',
             'nation' =>'Kinh',
             'gender' =>1,
             'date_of_birth' =>123,
             'place_of_birth' =>'TPHCM',
             'permanent_address' =>'An Giang',
             'contact_address' =>'An Giang',
             'phone_number' =>'0123456789',
             'email_address' =>'lethanhson2910@',
             'position' =>'Quan ly',
             'date_of_recruitment' =>'2018-04-10',
             'professional_title' =>'Lao cong',
             'identity_card' =>'321368999',
             'date_of_issue' =>'2015-04-10',
             'place_of_issue' =>'TPHCM',

           ];
        $format_email = $this->post('/admin/pi-add', $actual);
        $format_email->assertSessionHasErrors([
             'date_of_birth'=> 'Ngày sinh sai định dạng'
           ]);
    }
    public function test_add_PI_with_incorrect_length_place_of_birth()
    {
        $actual = [
             'employee_code' => 'T153772',
             'full_name' =>'Le Thanh Son',
             'nation' =>'Kinh',
             'gender' =>1,
             'date_of_birth' =>123,
             'place_of_birth' =>'TPCM',
             'permanent_address' =>'An Giang',
             'contact_address' =>'An Giang',
             'phone_number' =>'0123456789',
             'email_address' =>'lethanhson2910@gmail.com',
             'position' =>'Quan ly',
             'date_of_recruitment' =>'2018-04-10',
             'professional_title' =>'Lao cong',
             'identity_card' =>'321368999',
             'date_of_issue' =>'2015-04-10',
             'place_of_issue' =>'TPHCM',

           ];
        $format_email = $this->post('/admin/pi-add', $actual);
        $format_email->assertSessionHasErrors([
             'place_of_birth'=> 'Nơi sinh phải lớn hơn 5 kí tự'
           ]);
    }
}
