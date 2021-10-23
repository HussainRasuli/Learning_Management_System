<style>
    .disabl{ 
        pointer-events: not-allowed; 
        cursor: not-allowed; 
    }
    .disabl:hover {
        cursor:not-allowed;
    }
</style>
<div class="div-devider" style="margin-top: 10px;"></div>
    <div class="card-content">
        <div class="card-body card-dashboard admin_approve_credits" style="padding-bottom: 0;" admin_approved="{{$admin_approve_credits}}" semester="{{$semester_id}}">
            <div class="table-responsive table-data">
            <div class="col-12 pl-0 pr-0">
                <form id="advance_credit_submit_form">
                    @csrf
                <table class="table zero-configuration table-hover-animation dataTable no-footer" style="margin-bottom:1.7rem;">
                    <thead>
                    <tr>
                        <th class="th-tag">Select</th>
                        <th class="th-tag">Course</th>
                        <th class="th-tag">Teacher</th>
                        <th class="th-tag">Credit</th>
                        <th class="th-tag">Semester</th>
                        <th class="th-tag">Shift</th>
                        <th class="th-tag">Department</th>
                    </tr>
                    </thead>
                    <tbody id="table_data">
                    @php $i=1 @endphp
                    @foreach($all_course as $x)
                    <tr>
                        <td>
                          @if(! in_array($x->tc_id, $selected_courses->pluck('tc_id')->toArray()))
                            <fieldset>
                                <div class="vs-checkbox-con vs-checkbox-primary">
                                    <input type="checkbox" name="advance_course[]" value="{{$x->tc_id}}" class="checkitem change" credit="{{$x->course->credit}}">
                                    <span class="vs-checkbox">
                                        <span class="vs-checkbox--check">
                                            <i class="vs-icon feather icon-check"></i>
                                        </span>
                                    </span>
                                </div>
                            </fieldset>
                            @else 
                                <div class="fonticon-wrap" style="padding-left: 4px;"><i class="fa fa-check"></i></div>
                            @endif
                        </td>
                        <td>{{$x->course->co_name}}</td>
                        <td>{{$x->teacher->first_name}} {{$x->teacher->last_name}}</td>
                        <td>{{$x->course->credit}}</td>
                        <td>{{$x->sem_id}}</td>
                        <td>@if($x->shift == 1) Morning @elseif($x->shift == 2) Afternoon @elseif($x->shift == 3) Evening @endif</td>
                        <td>{{$x->department->dep_name}}</td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
            </form>
            @if($admin_approve_credits == 1)
             @if($semester_id <= 7)
               <span style="font-weight: bold;"> The Minimum Number of Selected Credits is 17 and The Maximum is 21.</span> 
             @else
               <span style="font-weight: bold;"> The Maximum Number of Selected Credits is 21.</span> 
             @endif
            <div class="div-devider" style="margin-top: 10px; margin-bottom:25px;"></div>
              <button class="btn btn-primary advance_send_btn disabl">Save</button>
            @endif
            <div class="total_credit_div">
            @if($admin_approve_credits == 1)
                  <div class="text-center bg-light colors-container rounded text-black width-350 height-100 d-flex align-items-center justify-content-center mr-1 ml-50 mp-0 mb-2 float-right" style="background-color:#e8e9ea !important;">
                        <span class="align-middle" style="font-weight: bold;">Total Credits Selected :</span>&nbsp;&nbsp;
                        <span class="align-middle advance_total_credit" style="font-weight: bold;" total_credits="{{$total_credit}}"> {{$total_credit}}</span>
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>

<script>
   var w = parseInt($('.admin_approve_credits').attr('admin_approved'));
   if(w == 1){
       $('.change').addClass('advance_checkitem');
   }
$('.advance_send_btn').click( function(){ 
            Swal.fire({
                title: 'Are you sure, You want to Submit this Credits?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, Submit it`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{route('advance_credit_submited')}}", $('#advance_credit_submit_form').serialize() , function(response){
                        if(response == 'Submited'){
                            Swal.fire('Your Credits successfully Submited', '', 'success');
                            loadPage();
                        }else{
                            alert('Error');
                        }
                    });
                }
            });
        });
   
  
    let total_credit_approve = parseInt($('.advance_total_credit').attr('total_credits'));
    let advance_first_value = 0;
    let advance_total_credit = 0;
    if(total_credit_approve > 0){
        advance_total_credit = total_credit_approve;
    }
    
    $('.advance_send_btn').prop('disabled', true); 
    let student_sem = $('.admin_approve_credits').attr('semester');
    let t = 0;

    $(document).on("click",".advance_checkitem",function () {
    if($(this).prop("checked") == true){
        advance_first_value = parseInt($(this).attr('credit'));
        advance_total_credit = advance_total_credit + advance_first_value;
        t++;
        if(student_sem <= 7){
         if(advance_total_credit >= 17 && advance_total_credit <= 21){
            if(t > 0){
                $('.advance_send_btn').prop('disabled', false);
                $('.advance_send_btn').removeClass('disabl');
            }
            else{
                $('.advance_send_btn').prop('disabled', true);
                $('.advance_send_btn').addClass('disabl'); 
            }
          }
          else{
                $('.advance_send_btn').prop('disabled', true);
                $('.advance_send_btn').addClass('disabl'); 
          }
        }
         else{
            if(advance_total_credit <= 21){
                if(t > 0){
                    $('.advance_send_btn').prop('disabled', false);
                    $('.advance_send_btn').removeClass('disabl');
                }
                else{
                    $('.advance_send_btn').prop('disabled', true);
                    $('.advance_send_btn').addClass('disabl'); 
                }
            }
            else{
                $('.advance_send_btn').prop('disabled', true);
                $('.advance_send_btn').addClass('disabl')
            }
         }
        $('.advance_total_credit').html(advance_total_credit);
        
    }

    if($(this).prop("checked") == false){
        var Uncheck_value = parseInt($(this).attr('credit'));
        advance_total_credit = advance_total_credit - Uncheck_value;
        t--;
        if(student_sem <= 7){
         if(advance_total_credit >= 17 && advance_total_credit <= 21){
            if(t > 0){
                $('.advance_send_btn').prop('disabled', false);
                $('.advance_send_btn').removeClass('disabl');
            }
            else{
                $('.advance_send_btn').prop('disabled', true);
                $('.advance_send_btn').addClass('disabl'); 
            }
          }
          else{
                $('.advance_send_btn').prop('disabled', true);
                $('.advance_send_btn').addClass('disabl'); 
          }
        }
        else{
            if(advance_total_credit <= 21){
                if(t > 0){
                    $('.advance_send_btn').prop('disabled', false);
                    $('.advance_send_btn').removeClass('disabl');
                }
                else{
                    $('.advance_send_btn').prop('disabled', true);
                    $('.advance_send_btn').addClass('disabl'); 
                }
            }
            else{
                $('.advance_send_btn').prop('disabled', true);
                $('.advance_send_btn').addClass('disabl')
            }
         }
        $('.advance_total_credit').html(advance_total_credit);
    }

    });
</script>