@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">
		@include('layouts.flash')
		<div class="writer-n_orders-table-v2__tab-content-row">
			<div class="order-view-v2__header-button">
				<a href="{{url(url_prefix().'/client-details')}}" class="js_button_order js_button_order btn btn_customer-n_orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga">Client details</a>
				<h3>Writer Details</h3>
                <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#add_writer">Create Writer</button>
            </div>
            <table id="table_id" class="table">
                <thead>
                   <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Finished Papers</th>
                    <th>Skills</th>
                    <th>Profile Summary</th>
                    <th>Profile Summary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($users as $user)
               <tr>
                  <td>{{$user->writer->writer_code}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->writer->rating}}</td>
                  <td>{{$user->writer->finished_papers}}</td>
                  <td>{{$user->writer->skills}}</td>
                  <th>Profile Summary</th>
                  <td>{{$user->writer->profile_summary}}</td>
                  <td> <a href="{{url('main/edit-writer/'.$user->writer->writer_code)}}" class="btn btn-info">Edit</button></td>
                  </tr>
                  @endforeach

              </tbody>
          </table>
          <div class="">
            <ul class="pagination">
               {{ $users->links() }}
           </ul>
       </div>
   </div>
</div>
</div>
<!-- Begin Modal -->
<div class="modal" tabindex="-1" role="dialog" id="add_writer">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="uk-modal-header">
               Add new writer to the system                          
               <a aria-label="Close" data-dismiss="modal" class="uk-modal-close sm-round"></a>
           </div>
           <div class="modal-body">
            <form action="{{url('main/create-writer')}}" method="post">
                @csrf
                <div class="uk-clearfix"></div>
                <div class="form-group">
                    <div class="form-control-left">
                        <label><b>Full Name</b></label>
                    </div>
                    <div class="form-control-right">
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div class="uk-clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="form-control-left">
                        <label><b>Email Address</b></label>
                    </div>
                    <div class="form-control-right">
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="uk-clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="form-control-left">
                        <label><b>Profile Summary</b></label>
                    </div>
                    <div class="form-control-right">
                       <textarea name="profile_summary" required=""></textarea>
                   </div>
                   <div class="uk-clearfix"></div>
               </div>

               <div class="form-group">
                <div class="form-control-left">
                    <label><b>Skills(separated by comma ,)</b></label>
                </div>
                <div class="form-control-right">
                 <input type="text" id="skills" name="skills" required>
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
                     <input type="number" name="rating" max="100" min="0" required="">
                 </div>
             </div>

             <div class="col-md-6 right">
                <div class="form-control-left">
                    <label><b>Finished Papers</b></label>
                </div>
                <div class="form-control-right">
                    <input type="number" name="finished_papers" min="0" required="">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-control-left">
            <label><b>Set a Password</b></label>
        </div>
        <div class="form-control-right">
            <input type="Password" id="password" name="password" required>
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
</div>
<!-- End Modal -->
@endsection