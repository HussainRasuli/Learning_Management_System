
<style>
    .error_message{
        display: none;
    }
</style>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
             <div class="card-header col-12 pr-0">
                 <h4>Edit Role</h4>
                    <div class="col-3">
                        <a href="{{route('role_list')}}"><button type="button" class="btn btn-icon rounded-circle btn-primary mr-1 mb-1 waves-effect waves-light float-right"><i class="feather icon-arrow-right"></i></button></a>
                   </div>
                </div>
                <div class="div-devider"></div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="{{route('update_role')}}">
                            @csrf
                            <input type="hidden" name="role_id" value="{{$all_role->role_id}}">
                            <div class="form-body">
                                <div class="row content-div">
                                <div class="col-md-6 col-12">
                                <label for="first-name-icon" style="margin-bottom: 0.6rem !important;">Role Name </label>
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" class="form-control lm-input-text role_name"
                                                name="role_name" placeholder="Role Name" value="{{$all_role->role_name}}" required>
                                                <div class="form-control-position">
                                                    <i class="mdi mdi-account-card-details-outline"></i>
                                                </div>
                                            </label>
                                            <h6 class="role-name-error error_message">
                                                Enter Role Name.
                                            </h6>
                                            @error('role_name')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <label for="first-name-icon" style="margin-bottom: 0.6rem !important;">Select Role Type </label>
                                        <div class="form-group">
                                            <select class="select2 form-control role_type" name="role_type">
                                                <option value="" selected hidden>none</option>
                                                @foreach($role_type as $x);
                                                  <option value="{{$x->role_type_id}}" @if($all_role->role_type_id == $x->role_type_id ) selected @endif>{{$x->type}}</option>
                                                @endforeach
                                            </select>
                                            <h6 class="role-type-error error_message">
                                                Select Role Type.
                                            </h6>
                                            @error('role_type')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-12 col-12">   
                                        <div class="form-group" id="x">
                                        <label for="first-name-icon">Permission : </label>
                                        <button type="button" class="btn mr-1 btn-success btn-sm waves-effect waves-light badge badge-primary select_all" style="margin-bottom: 0.5rem !important;margin-right: 0.5rem !important;"><i class="mdi mdi-check-bold"></i> Select All</button>
                                            <select class="select2 form-control permission" id="x" multiple="multiple" name="permission[]">
                                                @foreach($all_permission as $x)
                                                    <option value="{{$x->per_id}}" @foreach($all_role->permission as $y) @if($y->per_id == $x->per_id) selected @endif @endforeach class="multiple-option">{{$x->per_name}}</option>
                                                @endforeach
                                            </select>
                                            <h6 class="permission-error error_message">
                                                Enter Permission.
                                            </h6>
                                            @error('permission')
                                                <h6 class="error_message">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                   </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 btn-submit">
                                    <button type="submit" id="btn_submit" class="btn btn-primary mr-1 mb-1 col-lg-2 col-md-2 col-sm-12 submit_btn">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('public/app-assets/validations/role.js')}}"></script>
    <script>
     $(document).on('click','.select_all', function(){
          $.get(" {{route('select_all')}} ", function(res) {
                $('#x').html(res)
          });
       });

       
       $(document).on('click','.deselect_all', function(){
        $.get(" {{route('deselect_all')}} ", function(res) {
                $('#x').html(res)
          });
       });

       
       $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    </script>

