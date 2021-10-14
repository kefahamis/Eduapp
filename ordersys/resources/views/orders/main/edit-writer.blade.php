@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content inner-content_bg_gray">

        <div class="writer-n_orders-table-v2__tab-content-row">
            <div class="order-view-v2__header-button">
                <a href="{{url(url_prefix().'/writer-details')}}" class="js_button_order js_button_order btn btn_customer-n_orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga"> << Writer Details</a>
            </div>
            <h3>Edit Writer Details</h3>
            @include('layouts.flash')
            <form action="{{url('main/save-writer/'.$writer->writer_code)}}" method="post">
                @csrf
                <div class="uk-clearfix"></div>
                <div class="form-group">
                    <div class="form-control-left">
                        <label><b>Full Name</b></label>
                    </div>
                    <div class="form-control-right">
                        <input type="text" id="full_name" name="full_name" value="{{$writer->user->name}}" required>

                    </div>
                    <div class="uk-clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="form-control-left">
                        <label><b>Email Address</b></label>
                    </div>
                    <div class="form-control-right">
                        <input type="email" id="email" name="email" value="{{$writer->user->email}}" required>
                    </div>
                    <div class="uk-clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="form-control-left">
                        <label><b>Profile Summary</b></label>
                    </div>
                    <div class="form-control-right">
                        <textarea name="profile_summary" required="">{{$writer->profile_summary}}</textarea>
                    </div>
                    <div class="uk-clearfix"></div>
                </div>

                <div class="form-group">
                    <div class="form-control-left">
                        <label><b>Skills(separated by comma ,)</b></label>
                    </div>
                    <div class="form-control-right">
                       <input type="text" id="skills" name="skills" value="{{$writer->skills}}" required>
                   </div>
                   <div class="uk-clearfix"></div>
               </div>

               <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6 left">
                        <div class="form-control-left">
                            <label><b>Writer Rating</b></label>
                        </div>
                        <div class="form-control-right">
                           <input type="number" name="rating" max="100" min="0" value="{{$writer->rating}}" required="">
                       </div>
                   </div>

                   <div class="col-md-6 right">
                    <div class="form-control-left">
                        <label><b>Finished Papers</b></label>
                    </div>
                    <div class="form-control-right">
                        <input type="number" name="finished_papers" min="0" value="{{$writer->finished_papers}}" required="">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="form-control-left">
                <label><b>Update Password</b></label>
            </div>
            <div class="form-control-right">
                <input type="password" id="password" name="password" placeholder="Leave blank for password unchanged">
            </div>
            <div class="uk-clearfix"></div>
        </div>

        <div class="uk-text-right">
            <button type="button" class="btn btn-danger uk-button js_customer_deposit_form_loading_hide" data-dismiss="modal">Cancel</button> 
            <button type="submit" class="btn btn-info uk-button js_customer_deposit_form_loading_hide">Save</button>
        </div>

    </form>

</div>
</div>
</div>

@endsection