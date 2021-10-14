@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content inner-content_bg_gray">
        <div class="order-view-v2__container">

         <div>
           <a href="{{url(url_prefix().'/orders')}}" class="js_button_order js_button_order btn"><span><<</span> Back</a>
       </div>
       <div class="order-view-v2__header">
           <h1 class="order-view-v2__title">
              Order ID:  {{$order->order_code}}
          </h1>
          @include('layouts.flash')
          <div class="b-order-status b-order-customer-orders-table__status {{ orderStatus($order->status)['class'] }}">
              <span class="customer-orders-table__status {{ orderStatus($order->status)['class'] }}">
                Order status:{{ orderStatus($order->status)['status'] }}
            </span>
        </div>
        <h3>
            @php
            $payment_status = '';
            $payment_class = '';
            if($order->payment_status == 'pending'){
                $payment_status = 'Unpaid';
                $payment_class = 'unpaid';
            }elseif($order->payment_status == 'completed'){
                $payment_status = 'Paid';
                $payment_class = 'paid';
            }

            @endphp
            Price: USD {{$order->order_price}} <span class="{{$payment_class}}">{{$payment_status}}</span>
        </h3>
    </div>

    <div class="order-view-v2__body js_order_view_guide_wrapper">

        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
               <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Work Details</a>
           </li>
           <li class="nav-item" role="presentation">
               <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Attached Files</a>
           </li>
           <li class="nav-item" role="presentation">
               <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Work Results</a>
           </li>
           <li class="nav-item" role="presentation">
               <a class="nav-link" id="ex1-tab-4" data-mdb-toggle="tab" href="#ex1-tabs-4" role="tab" aria-controls="ex1-tabs-4" aria-selected="false">Order Actions</a>
           </li>
           <li class="nav-item" role="presentation">
               <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Customer</a>
           </li>
       </ul>


       <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
          <div class="order-view-v2__card">
            <div class="order-view-v2__card-col">
               <h3 class="essay-info__title">Topic</h3>
               <h3 class="order-view-v2__essay-title">{{$order->topic}}</h3>
           </div>
           <div class="order-view-v2__card-col">
               <div class="order-view-v2__essay-info-grid">
                <div class="order-view-v2__essay-info-col">
                   <div class="essay-info">
                      <h3 class="essay-info__title">Subject</h3>
                      <p class="essay-info__description">{{$order->subject}}</p>
                  </div>
              </div>
              <div class="order-view-v2__essay-info-col">
                 <div class="essay-info">
                    <h3 class="essay-info__title">
                    Type of paper        </h3>
                    <p class="essay-info__description">{{$order->paper_type}}</p>
                </div>
            </div>
            <div class="order-view-v2__essay-info-col">
               <div class="essay-info">
                  <h3 class="essay-info__title">Number of cited resources</h3>
                  <p class="essay-info__description">
                     {{$order->no_of_citations}}
                 </p>
             </div>
         </div>
         <div class="order-view-v2__essay-info-col">
             <div class="essay-info">
                <h3 class="essay-info__title">Number of pages</h3>
                <p class="essay-info__description">
                   {{$order->pages}} pages /
                   {{$order->pages*275}} words        </p>
               </div>
           </div>
           <div class="order-view-v2__essay-info-col">
              <div class="essay-info">
                 <h3 class="essay-info__title">Format of citation</h3>
                 <p class="essay-info__description">{{$order->citation_style}}</p>
             </div>
         </div>
         <div class="order-view-v2__essay-info-col">
            <div class="essay-info">
               <h3 class="essay-info__title">
               Writer quality        </h3>
               <p class="essay-info__description">{{$order->writer_quality}}</p>
           </div>
       </div>
   </div>
</div>
<div class="order-view-v2__card-col">
  <div class="order-view-v2__essay-details js-show-more-details order-view-wrapper" style="display: block!important;">
     <div class="js_order_upload_review_new_attachments_container"></div>

     <div class="order-view-v2__essay-info-row">
        <div class="essay-info">
           <h3 class="essay-info__title">Paper instructions</h3>
           <p class="essay-info__description">{{$order->paper_instructions}}</p>
       </div>
   </div>
</div>
</div>
</div>
</div>

<div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
 <div class="order-view-v2__card">
   <div class="order-view-v2__card-col">
     <header class="order-view-v2__card-header">
      <h2 class="order-view-v2__card-title">
      List of files uploaded by customer </h2>
  </header>
  @foreach($order->order_files as $order_file)
  @if($order_file->user_role == 'customer')
  <div id="uploaded_drop_files">
    <header class="order-view-v2__card-header">

    </header>
    <div class="btn-group">
      <button class="btn btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{ $order_file->file_name }}
     </button>
     <div class="dropdown-menu">
         <form method="post" action="{{url('order/file-dowload')}}">
            @csrf
            <input type="hidden" name="order_file_id" value="{{$order_file->id}}">
            <input type="hidden" name="call" value="download">
            <button class="dropdown-item" type="submit">Download</button>
        </form>
    </div>
</div>
</div>
@endif
@endforeach
</div>
</div>
</div>


<div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
  <div class="order-view-v2__card">
   <div class="order-view-v2__card-col">
    <header class="order-view-v2__card-header">
        <h3 class="">
         Assigned Writer: <strong>{{getAssignedWriter($order->assigned_to)['name']}}</strong></h3>
         <h2 class="order-view-v2__card-title">
         List of files uploaded by writer </h2>
     </header>
     <div class="order-view-v2__card-body">
         <div class="order-view-v2__files-list">

          @foreach($order->order_files as $order_file)
          @if($order_file->user_role == 'admin')
          <div id="uploaded_drop_files">
           <div class="btn-group">
            <button class="btn btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             {{ $order_file->file_name }}
         </button>
         <div class="dropdown-menu">
             <form method="post" action="{{url('order/file-dowload')}}">
              @csrf
              <input type="hidden" name="order_file_id" value="{{$order_file->id}}">
              <input type="hidden" name="call" value="download">
              <button class="dropdown-item" type="submit">Download</button>
          </form>
          @can('is_admin',auth()->user())
          <form id="delete{{$order_file->id}}" action="{{route('deleteFile', encrypt($order_file->id))}}" method="post">
              @csrf
              <a class="dropdown-item" onclick="confirmDeleteFile('delete{{ $order_file->id}}')">Delete</a>
          </form>
          @endcan
      </div>
  </div>
</div>
@endif
@endforeach
</div>
@can('is_admin',auth()->user())
<div class="b-form-group">
    <form enctype="multipart/form-data" class="model_form_id file-form" method="POST" action="{{url('order/upload-file')}}">
     @csrf
     <div class="order-form-v2__form-row" >
      <div class="b-form-group">
       <label class="align-left control-label">Upload additional files (<strong>Maximum of 3</strong>) :</label>
       <div class="">
        <div id="filesform">
         <input type="file" class="form-control" name="documents[0]" required="" style="margin-bottom: 10px;">
         <input type="hidden" name="order_code_u" value="{{$order->order_code}}" required="">

     </div>
 </div>
</div>
<i class="fa fa-plus" onclick="addAdditionalDocFields();" style="color: red; cursor: pointer;"> Add files</i>
<button class="btn btn-info" type="submit" style="float: right"><i class="fa  fa-upload"></i> Upload Files</button>
</div>
</form>
</div>
@endcan
</div>
</div>
</div>
</div>

<div class="tab-pane fade" id="ex1-tabs-4" role="tabpanel" aria-labelledby="ex1-tab-4">
 <div class="order-view-v2__card">
   <div class="order-view-v2__card-col">
     <header class="order-view-v2__card-header">
      <h3 class="essay-info__title">
      Order Actions </h3>
  </header>

  <div class="order-view-v2__card-col">
   <div class="order-view-v2__essay-info-grid">
    <div class="order-view-v2__essay-info-col">
       <div class="essay-info">
        <h3 class="essay-info__title">Order Status</h3>
        <div class="b-order-status b-order-customer-orders-table__status {{ orderStatus($order->status)['class'] }}">
          <span class="customer-orders-table__status {{ orderStatus($order->status)['class'] }}">
            {{ orderStatus($order->status)['status'] }}
        </span>
    </div>
</div>
</div>
<div class="order-view-v2__essay-info-col">
 <div class="essay-info">
    <h3 class="essay-info__title">
    Due Date</h3>
    <p class="essay-info__description">
      {{$order->deadline}}
  </p>
</div>
</div>
<div class="order-view-v2__essay-info-col">
    <div class="essay-info">
        <h3 class="essay-info__title">
        Order Actions</h3>
        {!! adminOrderActions($order) !!}
        <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#assignWriter">Assign Writer</button>
        <hr class="divider">

        <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#adjustPrice">Adjust Order Price</button>
    </div>
    <!--  -->

    <div class="modal fade" id="assignWriter" role="dialog" style="display: none;">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <h2>Assign Writer to Order</h2>
                    <form action="{{url('main/assign-writer/'.encrypt($order->id))}}" method="post">
                       @csrf
                       <div class="nk-form">
                        <div class="input-group">
                            <div class="nk-int-st">
                                <label><i>Please select the writer.</i></label>
                                <select name="assigned_to_id" required="">
                                    <option selected="" value="">Select writer</option>
                                    @foreach($writers as $writer)
                                    <option value="{{$writer->writer_code}}">{{$writer->user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info waves-effect">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adjustPrice" role="dialog" style="display: none;">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <h2>Adjust Order Price</h2>
                <form action="{{url('main/adjust-price/'.encrypt($order->id))}}" method="post">
                   @csrf
                   <div class="nk-form">
                    <div class="input-group">
                        <div class="nk-int-st">
                            <label><i>Enter new order price</i></label>
                            <input type="number" name="n_order_price" min="0" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info waves-effect">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--  -->

<!--  -->
</div>

</div>
</div>

</div>


</div>
</div>

<div class="tab-pane fade" id="ex1-tabs-5" role="tabpanel" aria-labelledby="ex1-tab-5">
 <div class="order-view-v2__card">
   <div class="order-view-v2__card-col">
     <header class="order-view-v2__card-header">
      <h2 class="order-view-v2__card-title">
      Customer details </h2>
  </header>
  <div class="order-view-v2__essay-info-grid order-view-v2__essay-info-grid_order-status">
      <div class="order-view-v2__essay-info-col">
        <h3 class="essay-info__title">Customer Name: <strong>{{$order->customer->name}}</strong></h3>
        <h3 class="essay-info__title">Customer Email: <strong>{{$order->customer->email}}</strong></h3>
        <h3 class="essay-info__title">Customer Phone Number: <strong>{{$order->customer->phone_number}}</strong></h3>
        <h3 class="essay-info__title">Customer Country: <strong>{{$order->customer->country}}</strong></h3>
        <h3 class="essay-info__title">Customer Acct. Bal: <strong>{{$order->customer->account_bal}}</strong></h3>
    </div>

</div>
</div>
</div>
</div>

</div>


</div>
</div>

</div>
</div>
</div>
<script type="text/javascript">
 function confirmDeleteFile(order_file_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Deleted Files Can not be Recovered!",
       showCancelButton: true,
       cancelButtonColor: '#3085d6',
       confirmButtonColor: '#d33',
       confirmButtonText: 'Delete',
       dangerMode: false,
   }).then(result => {
       if (result.value) {
          $('#'+order_file_id).submit();

      } else {

      }
  });
}
function confirmCancelOrder(order_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Orders cancelled will not be processed by the writer.",
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Proceed',
       dangerMode: true,
   }).then(result => {
       if (result.value) {
          $('#'+order_id).submit();

      } else {

      }
  });
}

function confirmProcessOrder(order_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Client will be notified that order processing has began.",
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Proceed',
       dangerMode: false,
   }).then(result => {
       if (result.value) {
          $('#'+order_id).submit();

      } else {

      }
  });
}

function confirmCompleteOrder(order_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Client will be notified that order has been completed.",
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Proceed',
       dangerMode: false,
   }).then(result => {
       if (result.value) {
          $('#'+order_id).submit();

      } else {

      }
  });
}

function resendCompleteAlert(order_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Client will be notified that order has been completed.",
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Proceed',
       dangerMode: false,
   }).then(result => {
       if (result.value) {
          $('#'+order_id).submit();

      } else {

      }
  });
}

function confirmReviseOrder(order_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Client will be notified that order is under revision.",
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Proceed',
       dangerMode: false,
   }).then(result => {
       if (result.value) {
          $('#'+order_id).submit();

      } else {

      }
  });
}

function PaymentCompleteOrder(order_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Client will be notified that payment has been completed.",
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Proceed',
       dangerMode: false,
   }).then(result => {
       if (result.value) {
          $('#'+order_id).submit();

      } else {

      }
  });
}

function PaymentPendingOrder(order_id){
    Swal.fire({
       title: 'Are you sure?',
       text: "Change Order payment status to 'Pending'.",
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Proceed',
       dangerMode: false,
   }).then(result => {
       if (result.value) {
          $('#'+order_id).submit();

      } else {

      }
  });
}

$(document).ready(function(){
    $(".show-more-btn").click(function(){
       if($("#show_more_details").is(':hidden')) {
          $("#show_more_details").show();
          $("#less_details").show();
          $("#more_details").hide();
      }else{
          $("#show_more_details").hide();
          $("#less_details").hide();
          $("#more_details").show();
      }
  });

});

var count=1;
function addAdditionalDocFields (event) {
    if(count<3){
       $("#filesform").append('<div style="padding-top:20px"><input type="file" class="form-control" name="documents['+count+']"> <i class="fa fa-window-close" onclick="removeThisField(this.id);" style="color: red; cursor: pointer;display: inherit; margin-top: -30px; margin-left: -14px; font-weight: bold;" id="'+count+'">x</i></div>');
       count=count+1;
       return false;
   }
   if(count==3){
       $("#filesform").append('<div id="max_error"><label style="color:red;">Only three(3) files allowed per upload!</label></div>');
       count=count+1;
       return false;
   }
   else{

   }
};
</script>
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"> </script>
@endsection