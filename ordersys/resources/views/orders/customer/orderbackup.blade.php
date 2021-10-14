@extends('layouts.customer')

@section('content')
<div class="container">
 <div class="row justify-content inner-content_bg_gray">
  <!-- ?? -->

  <div class="order-view-v2__container">
   <div>
    <a href="{{url(url_prefix().'/orders')}}" class="js_button_order js_button_order btn"><span><<</span> Back</a>
</div>
<div class="order-view-v2__header">
    <h1 class="order-view-v2__title">
     Order ID: {{$order->order_code}}
 </h1>
 <h4>
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
</h4>
@include('layouts.flash')
<div class="order-view-v2__header-button">
   <button class="btn btn_chat writer-n_orders-table-v2__user-info-cell js_order_start_chat" type="button" onclick="javascript:void(Tawk_API.toggle())">
    <small class="btn__chat-num js_new_messages_count" style="display:none;"></small>
    <span class="js_order_start_chat_btn_text">Start chat</span>
</button>
<a href="{{url('ordernow')}}" class="js_button_order js_button_order btn btn_customer-n_orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga">Place new order</a>
</div>
</div>

<!--  -->
<div class="order-view-v2__body js_order_view_guide_wrapper">
  <div class="order-view-v2__card">
   <div class="order-view-v2__card-body js-show-more-container">
    <div class="order-view-v2__card-grid">
     <div class="order-view-v2__essay-info-col">
      <div class="essay-info">
       <h3 class="essay-info__title">Subject</h3>
       <p class="essay-info__description">{{ $order->subject }}</p>
   </div>
</div>
<div class="order-view-v2__essay-info-col">
  <div class="essay-info">
   <h3 class="essay-info__title">
   Type of paper        </h3>
   <p class="essay-info__description">{{ $order->paper_type }}</p>
</div>
</div>
<div class="order-view-v2__essay-info-col">
  <div class="essay-info">
   <h3 class="essay-info__title">Number of cited resources</h3>
   <p class="essay-info__description">
    {{ $order->no_of_citations }}
</p>
</div>
</div>
<div class="order-view-v2__essay-info-col">
  <div class="essay-info">
   <h3 class="essay-info__title">Number of pages</h3>
   <p class="essay-info__description">
    {{ $order->pages }} pages    </p>
</div>
</div>
<div class="order-view-v2__essay-info-col">
   <div class="essay-info">
    <h3 class="essay-info__title">Format of citation</h3>
    <p class="essay-info__description">{{ $order->citation_style }}</p>
</div>
</div>
<div class="order-view-v2__essay-info-col">
   <div class="essay-info">
    <h3 class="essay-info__title">
    Due Date       </h3>
    <p class="essay-info__description">{{ $order->deadline }} </p>
</div>
</div>




</div>
</div>

<div class="order-view-v2__essay-details js-show-more-details order-view-wrapper" style="display: block!important;">
 <div class="js_order_upload_review_new_attachments_container"></div>
 <div class="order-view-v2__essay-info-row">
  <div class="essay-info">
   <h3 class="essay-info__title">Paper instructions</h3> 
   <p class="essay-info__description">{{$order->paper_instructions}}</p>
   @can('is_customer',auth()->user())
   <a class="btn btn-primary" data-toggle="modal" data-target="#paper_instructions_modal" style="float: right; color: #ffff;">Edit instructions</a>
   @endcan
</div>
</div>
</div>
@can('is_customer',auth()->user())
<!-- edit paper instructions modal -->
<div class="modal" tabindex="-1" role="dialog" id="paper_instructions_modal">
 <div class="modal-dialog" role="document" style="max-width: 680px;">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title">Edit Paper Instructions</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
 </button>
</div>
<div class="modal-body">
    <form action="{{url('order/edit-paper-instructions')}}" method="post">
     @csrf
     <label for="paper_instructions">Edit Paper instructions</label>
     <textarea class="form-control" name="paper_instructions" id="paper_instructions">{{$order->paper_instructions}} </textarea>
     <input type="hidden" name="order_code" value="{{$order->order_code}}">
 </div>
 <div class="modal-footer">
     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
     <button type="submit" class="btn btn-info btncol">Save</button>
 </div>
</form>
</div>
</div>
</div>
@endcan
<!--  -->

</div>

<div class="order-view-v2__card">
    <div class="order-view-v2__card-col">
     <div class="b-form-group">
      <h4>Uploaded files:</h4>
      @foreach($order->order_files as $order_file)
      @if($order_file->user_role == 'customer')
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
      @can('is_customer',auth()->user())
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
@can('is_customer',auth()->user())
<div class="b-form-group">
  <div class="b-form-group__file-dropzone">
   <div class="dropzone js_order_upload_review_input" id="dropzone">
    <!-- dropzone -->
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
</div>
</div>
@endcan

</div>
</div> 


<div class="order-view-v2__card">
    <header class="order-view-v2__card-header">
     <h3 class="order-view-v2__card-title">
      Order status
  </h3>
</header>
<div class="order-view-v2__card-body">

 <div class="order-view-v2__card-grid order-view-v2__card-grid_ai_fe">
  <div class="order-view-v2__card-col">
   <div class="order-view-v2__essay-info-grid order-view-v2__essay-info-grid_order-status">
    <div class="order-view-v2__essay-info-col">
     <div class="b-order-status {{ orderStatus($order->status)['class'] }}">
      <span class="status"> {{ orderStatus($order->status)['status'] }}</span>
  </div>
</div>

</div>
</div>
<div class="order-view-v2__card-col">
   <div class="order-view-v2__essay-info-grid order-view-v2__essay-info-grid_order-status" style="margin-top: -50px;">
    <div class="order-view-v2__essay-info-col">
     <h3 class="order-view-v2__card-title">
      Order Actions
  </h3>
  <div class="">
      {!! customerOrderAction($order) !!}
  </div>
</div>

</div>
</div>

<div class="order-view-v2__card-col">
   <div class="order-view-v2__flex-justify">
    <div class="order-view-v2__release-money" style="margin-top: -65px;">
     <div class="b-release-money b-release-money_disabled b-release-money_tooltip-hidden">
      <div class="b-release-money__label">
       Reserved money $ {{auth()->user()->account_bal}}

       <div class="info-tooltip dropdown-block-wrapper d-none-desktop-tablet">
        <div class="info-under-place" data-uk-dropdown="{pos:'center'}" aria-haspopup="true" aria-expanded="true">
         <div class="uk-dropdown">
          Once you are satisfied with the work provided, release funds to your writer proportional to the amount completed i.e. $0.00 for 0 % completion.
      </div>
  </div>
</div>                    
</div>
<div class="b-release-money__form">     
   <div class="compensation_form_imitation" id="js-tour-step-3">
    <input class="b-release-money__input" type="text" value="0%" disabled="" readonly="">
    <button class="b-release-money__button btn" disabled="">
    Release money</button>
</div>
</div>
<div class="b-release-money__tooltip-container">
   <div class="b-release-money__tooltip d-none-mobile">
    <span>Released money</span>
    <div class="info-tooltip info-tooltip_bottom-right dropdown-block-wrapper">
     <div class="info-under-place" data-uk-dropdown="{pos:'right'}" aria-haspopup="true" aria-expanded="false">
      <div class="uk-dropdown">
       Once you are satisfied with the work provided, release funds to your writer proportional to the amount completed i.e. $0.00 for 0 % completion.
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
</div>
</div>

<div class="order-view-v2__card" id="js-tour-step-2">
   <header class="order-view-v2__card-header">
    <h3 class="order-view-v2__card-title">
    List of uploaded files by writer </h3>
</header>
<div class="order-view-v2__card-body">
    <div class="order-view-v2__files-list">
     <p class="order-view-v2__file-info">Once the writer completes your order, the file will be uploaded here.</p>
 </div>

 @foreach($order->order_files as $order_file)
 @if($order_file->user_role == 'writer' || $order_file->user_role == 'admin')
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
    <form id="delete{{$order_file->id}}" action="{{route('deleteFile', encrypt($order_file->id))}}" method="post">
        @csrf
        <a class="dropdown-item" onclick="confirmDeleteFile('delete{{ $order_file->id}}')">Delete</a>
    </form>

</div>
</div>
</div>
@endif
@endforeach
</div>
</div>

</div>
</div>
</div>


</div>

<!-- ?? -->
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
</script>
<script type="text/javascript">
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

function removeThisField(field_id){
  var the_idd=field_id;
  if(count >= 3){
   count=2;
}else{
   count=count-1;
}

$("#"+the_idd).parent('div').remove();
$("#max_error").remove();
}
</script>
<script type="text/javascript">
 $(document).ready(function(){
  $("#more_details").hide();
  $("#less_details").show();
  $("#show_more_details").show();
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

</script>
@endsection
<?php
if($request->hasfile('documents'))
{

 foreach($request->file('documents') as $key => $file)
 {
    $allowed = ['pdf','PDF','csv','docx','xls','xlsx','jpg','jpeg','png'];
    $ext = $file->getClientOriginalExtension();
    $file_name = $file->getClientOriginalName();
    if(!in_array($ext,$allowed)){
       return response(['errors'=>['documents'=>'Please upload a valid file(pdf,csv,docx,xls,xlsx,jpg,jpeg,png)']],422);
   }
   $uploaded = FileRepository::move($file);
   if($uploaded['uploaded'] == false){
       return response(['errors'=>['documents'=>$uploaded['error']]],422);
   }

   $document_path = $uploaded['path'];

   $document = new OrderFile;
   $document->order_code =$order_code;
   $document->user_id =auth()->user()->id;
   $document->user_role =auth()->user()->level;
   $document->file_name = $file_name;
   $document->mime_type = $ext;
   $document->path = $document_path;
   $document->save();

}
}
?>