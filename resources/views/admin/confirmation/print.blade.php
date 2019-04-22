<html>

<head>

</head>

<body>
     <div class="form-group col-sm-12">
          <div class="col-sm-6 text-center">
               <div class="form-group-header">
                    <strong>BỘ GIÁO DỤC VÀ ĐÀO TẠO</strong>
               </div>
               <div class="form-group-header">
                    <strong>TRƯỜNG ĐẠI HỌC VĂN LANG
                         <hr style="width: 180px">
                         <label
                              style="font-weight:normal">Số:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/GXN-ĐHVL</label>

                    </strong>

               </div>
          </div>
          <div class="col-sm-6 text-center">
               <div class="form-group-header">
                    <strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong>
               </div>
               <div class="form-group-header">
                    <strong style="font-size:1.06rem">Độc lập – Tự do – Hạnh phúc
                         <hr style="width: 200px">
                    </strong>
               </div>
          </div>

     </div>
     <div class="form-group">
          <div class="col-sm-12 text-center">
               <h4 style="font-size:1.06rem">GIẤY XÁC NHẬN</h4>
               <h4 style="margin-top:1rem">TRƯỜNG ĐẠI HỌC VĂN LANG</h4>
          </div>
     </div>
     <div class="form-group">
          <div class="col-sm-1">&nbsp;</div>
          <div class="col-sm-10" style="margin-top:2rem">
                <div class="form-group col-sm-12">
                <label for="">Xác nhận: {{$cr->reason}}</label>

                </div>
                <div class="form-group col-sm-12">
                     <div class="col-sm-6">
                         <label for="">Sinh ngày: {{date('d/m/Y', strtotime($cr->date_of_birth))}}</label>

                     </div>
                     <div class="col-sm-6">
                          <label for="">tại {{$cr->place_of_birth}}</label>

                     </div>

                </div>
                <div class="form-group col-sm-12">
                     <div class="col-sm-6">
                          <label for="">CMND: {{$cr->identity_card}}</label>

                     </div>
                     <div class="col-sm-6">
                          <label for="">Ngày cấp: {{date('d/m/Y', strtotime($cr->date_of_issue))}}</label>

                     </div>
                </div>
                <div class="form-group col-sm-12">
                     <label for="">Địa chỉ: {{$cr->address}}</label>

                </div>
                <div class="form-group col-sm-12">
                    @if($cr->pi->officer->type_id == 4)
                     <label for="">Là <span>{{$cr->pi->teacher->type->note}}</span> <span>{{$cr->pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->date_of_recruitment))}}
                                 đến nay.</label>
                     @elseif($cr->pi->officer->type_id == 3)
                     <label for="">Là <span>{{$cr->pi->officer->position->name}}</span> <span>{{$cr->pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->date_of_recruitment))}}
                         đến nay.</label>

                     @elseif($cr->pi->officer->type_id == 2)
                     <label for="">Là <span>{{$cr->pi->officer->position->note}}</span> <span>{{$cr->pi->unit->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->date_of_recruitment))}}
                         đến nay.</label>

                     @elseif($cr->pi->officer->type_id == 1)
                     <label for="">Là <span>{{$cr->pi->officer->position->name}}</span>, Trường Đại học Văn Lang từ {{date('d/m/Y', strtotime($cr->pi->date_of_recruitment))}}
                         đến nay.</label>
                     @endif

                </div>
                <div class="form-group col-sm-12">
                     <label for="">Nhà trường cấp giấy xác nhận để {{$cr->gender == 1 ? 'bà' : 'ông'}} {{$cr->full_name}} bổ túc hồ sơ cá nhân.</label>

                </div>
                <div class="form-group col-sm-12" style="margin-top:1rem">
                     <div class="col-sm-4">&nbsp;</div>
                     <div class="col-sm-8 text-center">
                          <label style="font-style:italic" for=""> Tp. Hồ Chí Minh,
                             ngày {{Carbon\Carbon::now()->day}} tháng {{Carbon\Carbon::now()->month}} năm
                             {{Carbon\Carbon::now()->year}} </label>

                     </div>

                </div>
                <div class="form-group col-sm-12">
                     <div class="col-sm-4">&nbsp;</div>
                     <div class="col-sm-8 text-center">
                        <h4 for="" class="text-uppercase">{{$cr->first_signer == null ? 'KT. HIỆU TRƯỞNG': $cr->first_signer}}</h4>
                          <h4 for="" class="text-uppercase">{{$cr->second_signer == null ? 'PHÓ HIỆU TRƯỞNG': $cr->second_signer}}</h4>

                     </div>


                </div>
                <div class="form-group col-sm-12" style="margin-top:3rem">
                     <div class="col-sm-4">&nbsp;</div>
                     <div class="col-sm-8 text-center">
                          <h4 for="" class="text-capitalize">{{$cr->name_of_signer == null ? 'Họ Tên Người Ký': $cr->name_of_signer}}</h4>

                     </div>


                </div>
           </div>
          <div class="col-sm-1"></div>

     </div>

</body>


<style>
     body {
          font-family: 'Times New Roman', Times, serif;
     }

     hr {
          display: block;
          height: 1px;
          background: transparent;
          width: 100%;
          border: none;
          border-top: solid 1px #aaa;
     }
     .text-uppercase{
        text-transform:uppercase!important;
     }
     .text-capitalize{

        text-transform:capitalize!important;
     }
     h4 {
          margin-block-start: 0.5rem;
          margin-block-end: 0.5rem;
     }

     .fs-14 {
          font-size: 14px;

     }

     .fs-13 {
          font-size: 13px;

     }

     .mt-10 {
          margin-top: 10px;
     }

     .form-group {
          margin-bottom: 1rem;
     }

     .form-group-header {
          margin-bottom: 0.5rem;
     }

     .text-center {
          text-align: center;
     }

     .col-sm-1,
     .col-sm-2,
     .col-sm-3,
     .col-sm-4,
     .col-sm-5,
     .col-sm-6,
     .col-sm-7,
     .col-sm-8,
     .col-sm-9,
     .col-sm-10,
     .col-sm-11,
     .col-sm-12 {
          float: left;
     }

     .col-sm-12 {
          width: 100%;
     }

     .col-sm-11 {
          width: 91.66666667%;
     }

     .col-sm-10 {
          width: 83.33333333%;
     }

     .col-sm-9 {
          width: 75%;
     }

     .col-sm-8 {
          width: 66.66666667%;
     }

     .col-sm-7 {
          width: 58.33333333%;
     }

     .col-sm-6 {
          width: 50%;
     }

     .col-sm-5 {
          width: 41.66666667%;
     }

     .col-sm-4 {
          width: 33.33333333%;
     }

     .col-sm-3 {
          width: 25%;
     }

     .col-sm-2 {
          width: 16.66666667%;
     }

     .col-sm-1 {
          width: 8.33333333%;
     }

     @media print {

          .col-sm-1,
          .col-sm-2,
          .col-sm-3,
          .col-sm-4,
          .col-sm-5,
          .col-sm-6,
          .col-sm-7,
          .col-sm-8,
          .col-sm-9,
          .col-sm-10,
          .col-sm-11,
          .col-sm-12 {
               float: left;
          }

          .col-sm-12 {
               width: 100%;
          }

          .col-sm-11 {
               width: 91.66666667%;
          }

          .col-sm-10 {
               width: 83.33333333%;
          }

          .col-sm-9 {
               width: 75%;
          }

          .col-sm-8 {
               width: 66.66666667%;
          }

          .col-sm-7 {
               width: 58.33333333%;
          }

          .col-sm-6 {
               width: 50%;
          }

          .col-sm-5 {
               width: 41.66666667%;
          }

          .col-sm-4 {
               width: 33.33333333%;
          }

          .col-sm-3 {
               width: 25%;
          }

          .col-sm-2 {
               width: 16.66666667%;
          }

          .col-sm-1 {
               width: 8.33333333%;
          }
     }
</style>

</html>