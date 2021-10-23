

<style>
tr.tr-height{
    line-height: 2.3rem !important;
}
</style>
<div class="modal fade text-left" id="view_staff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg modal-xl" role="document" style="margin-left: 8%;margin-right: 8%;">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h5 class="modal-title" id="myModalLabel160" style="font-weight:bold;"><span>{{$data->first_name }} {{$data->last_name}}</span> Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                 <div class="modal-body col-12" style="padding: 1.5rem !important;"> 
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                           <div class="users-view-image col-md-11">
                                                @if($data->photo != '')
                                                    <img class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{ url('/storage/app/staff/'.$data->photo) }}" alt="{{$data->first_name}}'s photo">
                                                @elseif($data->gender == 1)
                                                    <img class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{asset('public/app-assets/images/user/male_user.jpg')}}" alt="{{$data->first_name}}'s photo">
                                                @elseif($data->gender == 2)
                                                    <img class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" src="{{asset('public/app-assets/images/user/female_user.jpg')}}" alt="{{$data->first_name}}'s photo">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mt-1 pr-0 pl-0">
                                            <table>
                                                <tbody>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">First Name </td>
                                                    <td></td>
                                                    <td> {{$data->first_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Last Name </td>
                                                    <td></td>
                                                    <td> {{$data->last_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Father Name </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td> {{$data->father_name}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Tazkira ID </td>
                                                    <td></td>
                                                    <td> {{$data->tazkira_id}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Date of birth </td>
                                                    <td></td>
                                                    <td> {{$data->date_of_birth}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Gender </td>
                                                    <td></td>
                                                    <td>@if($data->gender == 1) Male @else Female @endif</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Email Address </td>
                                                    <td></td>
                                                    <td> {{$data->email}}</td>
                                                </tr>
                                            </tbody></table>
                                        </div>

                                        <div class="col-md-4 col-12 mt-1 pr-0 pl-0">
                                        <table>
                                            <tbody>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Phone Number </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td> 0{{$data->phone}}</td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Education </td>
                                                    <td></td>
                                                    <td>
                                                        @if($data->education == 1) Bachelor
                                                        @elseif($data->education == 2) Master
                                                        @elseif($data->education == 3) PHD
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr class="tr-height">
                                                    <td class="font-weight-bold">Position </td>
                                                    <td></td>
                                                    <td> {{$data->position->position_name}}</td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

