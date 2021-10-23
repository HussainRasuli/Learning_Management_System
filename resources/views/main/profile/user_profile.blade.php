
@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
<style>
    tr{
        border-bottom: 1px solid #dadada;
    }

    #imageUpload
    {
        display: none;
    }

    #profileImage:hover
    {
        cursor: pointer;
        opacity: .5;
    }
    

</style>

@if(Session::has('pass_changed'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
  <div class="toast toast-success" aria-live="polite" style="display:block;">
   <div class="toast-title">Your password:</div>
   <div class="toast-message">{{Session::get('pass_changed')}}</div>
  </div>
</div>
@endif

@if(Session::has('NotMatch'))
<div id="toast-container" class="toast-container toast-bottom-right toast_message">
  <div class="toast toast-warning" aria-live="polite" style="display:block;">
   <div class="toast-title">Incorrect</div>
   <div class="toast-message">{{Session::get('NotMatch')}}</div>
  </div>
</div>
@endif
    <!-- BEGIN: Content-->
            <div class="content-body"><div class="div-devider" style="margin-top: 13px;"></div>
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0 pt-2" style="background-color: #ffffff; border-radius: 5px;">
                        <div id="profile-container" class="users-view-image col-md-11">
                        @php 
                            $x= '';
                            if($type == 1 || $type == 2 || $type == 5){
                                $x="/storage/app/staff/";
                            }
                            elseif($type == 3){
                                $x="/storage/app/teacher/";
                            }
                            elseif($type == 4){
                                $x="/storage/app/student/";
                            }
                        @endphp
                    
                        <form id="update_pic" method="post" enctype="multipart/form-data">
                            @csrf
                            @if($data->photo != '')
                                <img id="profileImage" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{ url($x.$data->photo) }}" alt="{{$data->first_name}}'s photo">
                                <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture accept="image/png, image/jpg, image/jpeg">
                            @elseif($data->gender == 1)
                                <img id="profileImage" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{asset('public/app-assets/images/user/male_user.jpg')}}" alt="{{$data->first_name}}'s photo">
                                <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture accept="image/png, image/jpg, image/jpeg">
                            @elseif($data->gender == 2)
                                <img id="profileImage" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{asset('public/app-assets/images/user/female_user.jpg')}}" alt="{{$data->first_name}}'s photo">
                                <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture accept="image/png, image/jpg, image/jpeg">
                            @endif
                            <div style="text-align: center;padding-left: 10px;">
                                <button type="submit" class="btn mr-1 mb-1 btn-primary waves-effect waves-light save_btn">Save</button>
                                <button type="button" class="btn btn-outline-warning mr-1 mb-1  waves-effect waves-light cancel_btn">Cancel</button>
                            </div>
                        </form>
                         </div>  
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-user mr-50 font-medium-3"></i>
                                        Personal Info
                                    </a>
                                </li>
                            </li>
                        </ul>
                    </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <!-- Student -->
                                      @if($type == 4)
                                        <div class="row">
                                            <div class="col-md-6 col-12 pr-0" style="line-height: 2.9rem;">
                                            <table>
                                                <tbody>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">ID </td>
                                                    <td></td>
                                                    <td>{{$data->unique_id}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">First&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->first_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Last&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->last_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Father&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->father_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Tazkira&nbsp;ID </td>
                                                    <td></td>
                                                    <td>{{$data->tazkira_id}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Date&nbsp;of&nbsp;birth </td>
                                                    <td></td>
                                                    <td>{{$data->date_of_birth}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Gender </td>
                                                    <td></td>
                                                    <td>@if($data->gender == 1) Male @else Female @endif</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Email&nbsp;Address </td>
                                                    <td></td>
                                                    <td>{{$data->email}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Phone&nbsp;Number </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>0{{$data->phone}}</td>
                                                </tr>
                                            </tbody></table>
                                        </div>

                                        <div class="col-md-6 col-12 pr-0" style="line-height: 2.9rem;">
                                        <table>
                                            <tbody>
                                            <tr class="tr-height">
                                                    <td class="font-weight-bold">Faculty </td>
                                                    <td></td>
                                                    <td>{{$data->faculties->fac_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Department &nbsp; </td>
                                                    <td></td>
                                                    <td>{{$data->dep->dep_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Semester </td>
                                                    <td></td>
                                                    <td>{{$data->semester_id}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Shift </td>
                                                    <td></td>
                                                    <td>@if($data->shift_id == 1) Morning @elseif($data->shift_id == 2) Afternoon @elseif($data->shift_id == 3) Night @endif </td>
                                                </tr>
                                            </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    @endif
                            <!-- Staff or Admin  -->
                                    @if($type == 1 || $type == 2 || $type == 5)
                                            <div class="row">
                                            <div class="col-md-6 col-12 pr-0" style="line-height: 2.9rem;">
                                            <table>
                                                <tbody>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">ID </td>
                                                    <td></td>
                                                    <td>{{$data->unique_id}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">First&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->first_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Last&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->last_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Father&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->father_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Tazkira&nbsp;ID </td>
                                                    <td></td>
                                                    <td>{{$data->tazkira_id}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Date&nbsp;of&nbsp;birth </td>
                                                    <td></td>
                                                    <td>{{$data->date_of_birth}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Gender </td>
                                                    <td></td>
                                                    <td>@if($data->gender == 1) Male @else Female @endif</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Email&nbsp;Address </td>
                                                    <td></td>
                                                    <td>{{$data->email}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Phone&nbsp;Number </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>0{{$data->phone}}</td>
                                                </tr>
                                            </tbody></table>
                                        </div>

                                        <div class="col-md-6 col-12 pr-0" style="line-height: 2.9rem;">
                                        <table>
                                            <tbody>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Education </td>
                                                    <td></td>
                                                    <td>@if($data->education == 1) Bachelor @elseif($data->education == 2) Master @elseif($data->education == 3) PHD @endif</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Position </td>
                                                    <td></td>
                                                    @if($type == 2)
                                                       <td>{{$position_type}}</td>
                                                    @elseif($type == 1)
                                                       <td>Super Admin</td>
                                                    @elseif($type == 5)
                                                       <td>Employee</td>
                                                    @endif
                                                </tr>
                                                @if($type == 2)
                                                    <tr class="tr-height">
                                                        <td class="font-weight-bold">Department &nbsp; </td>
                                                        <td></td>
                                                        <td>{{$data->dep->dep_name}}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    @endif
                            <!-- Teacher -->
                                    @if($type == 3)
                                            <div class="row">
                                            <div class="col-md-6 col-12 pr-0" style="line-height: 2.9rem;">
                                            <table>
                                                <tbody>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">ID </td>
                                                    <td></td>
                                                    <td>{{$data->unique_id}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">First&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->first_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Last&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->last_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Father&nbsp;Name </td>
                                                    <td></td>
                                                    <td>{{$data->father_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Tazkira&nbsp;ID </td>
                                                    <td></td>
                                                    <td>{{$data->id_card_number}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Date&nbsp;of&nbsp;birth </td>
                                                    <td></td>
                                                    <td>{{$data->date_of_birth}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Gender </td>
                                                    <td></td>
                                                    <td>@if($data->gender == 1) Male @else Female @endif</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Email&nbsp;Address </td>
                                                    <td></td>
                                                    <td>{{$data->email}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Phone&nbsp;Number </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>0{{$data->phone}}</td>
                                                </tr>
                                            </tbody></table>
                                        </div>

                                        <div class="col-md-6 col-12 pr-0" style="line-height: 2.9rem;">
                                        <table>
                                            <tbody>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Education </td>
                                                    <td></td>
                                                    <td>@if($data->education == 1) Bachelor @elseif($data->education == 2) Master @elseif($data->education == 3) PHD @endif</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Position </td>
                                                    <td></td>
                                                    <td>Teacher</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Department &nbsp; </td>
                                                    <td></td>
                                                    <td>{{$data->dep->dep_name}}</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 @endif
                             </div>
        
                            <div class="tab-pane active" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-12">
                                        <form id="user_change_password" action="{{ route('change_password') }}" method="post" novalidate>
                                            @csrf
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-old-password">Old Password</label>
                                                    <input type="password" name="old_password" class="form-control" id="account-old-password" placeholder="Old Password">
                                                    @if($errors->has('old_password'))
                                                        <strong style="color:red;font-size: 13px;">{{$errors->first('old_password')}}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-new-password">New Password</label>
                                                    <input type="password" name="new_password" id="account-new-password" class="form-control" placeholder="New Password">
                                                    @if($errors->has('new_password'))
                                                        <strong style="color:red;font-size: 13px;">{{$errors->first('new_password')}}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-retype-new-password">Retype New
                                                        Password</label>
                                                    <input type="password" name="confirm_password" class="form-control" required id="account-retype-new-password">
                                                    @if($errors->has('confirm_password'))
                                                            <strong style="color:red;font-size: 13px;">{{$errors->first('confirm_password')}}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 save_changes">Save Changes</button>
                                            <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                        </div>
                                        </form>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- account setting page end -->

</div>
    <!-- END: Content-->
@section('script')
<script src="{{asset('public/app-assets/js/scripts/extensions/toastr.js')}}"></script>
 <script>
    $('.save_btn').hide();
    $('.cancel_btn').hide();

    $("#profileImage").click(function(e) {
        $("#imageUpload").click();
    });

    function fasterPreview( uploader ) {
        if ( uploader.files && uploader.files[0] ){
            $('#profileImage').attr('src', 
                window.URL.createObjectURL(uploader.files[0]) );
        }
    }

    $("#imageUpload").change(function(){
        fasterPreview( this );
        $('.save_btn').show();
        $('.cancel_btn').show();
    });

    $('#update_pic').submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: '{{ route("update_picture") }}',
            method: 'post',
            data: formData,
            contentType : false,
            processData : false,
            success: function(response){
                if(response == 'Updated'){
                    Swal.fire('Successfully Updated', '', 'success');
                    loadPage();
                }
                else{
                    alert('error');
                }
            }
        });
    });


    $('.cancel_btn').click(function(){
        CancelLoader();
    });


    function CancelLoader()
    {
        setTimeout(function() {
            location.reload();
        }, 1);
    }

    function loadPage()
    {
        setTimeout(function() {
            location.reload();
        }, 2500);
    }

   setTimeout(function() {
        $('.toast_message').fadeOut('slow');
    }, 6000);

 </script>
@endsection

@endsection