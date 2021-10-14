<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderFile;
use App\Repositories\FileRepository;
use App\Models\Writer;
use App\User;
use Alert;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminNotification;
use App\Notifications\CustomerNotification;
use App\Notifications\OrderEditedNotification;

class OrderController extends Controller
{

	public function initiateOrder(Request $request){

		$paper_type = $this->getPaperType($request->paper_type);
		$subject = $this->getSubject($request->subject);
		$topic = $request->topic;
		if ($topic == '') {
			$topic = 'Writers Choice';
		}
		$academic_level = $this->getAcademicLevel($request->academic_level);
		$pages = $request->pages;
		$order_service = $request->order_product_service;
		$sources = $request->sources;
		$citation_style = $request->citation_style;
		$paper_instructions = $request->paper_instructions;
		$writer_pick = $request->writer_pick;
		$total_price = $request->total_price_calculated;
		$order_product_wrlevel = $request->order_product_wrlevel;
		$the_urgency = $request->the_urgency;
		$time_zone = date_default_timezone_get();

		$mydate = getdate();
		$currentTimestamp  =$mydate[0];
		if ($the_urgency == 'NaN') {
			$the_urgency = 240;
		}
		$newDeadline = $currentTimestamp + ($the_urgency * 3600);
		$orderDeadline = date("Y-m-d H:i:s", $newDeadline);
		$newDeadline = $currentTimestamp + ($the_urgency * 2160);
		$writerDeadline = date("Y-m-d H:i:s", $newDeadline);

		$order = new Order;
		$track = Order::max('order_code');
		$order_code = 1001;
		if ($track) {
			$order_code = $track + 1;
			$track_check = Order::where('order_code',$order_code)->first();
			if ($track_check) {
				do{
					$order_code = $track + 1;
					$track_check = Order::where('order_code',$order_code)->first();
				}while(!$track_check);
			}
			
		}else{
			$order_code = 1001;
		}
		
		$order->order_code = $order_code;

		$order->customer_id = auth()->user()->id;
		$order->paper_type = $paper_type;
		$order->subject = $subject;
		$order->topic = $topic;
		$order->academic_level = $academic_level;
		$order->pages = $pages;
		$order->service = $order_service;
		$order->citation_style = $citation_style;
		$order->no_of_citations = $sources;
		$order->paper_instructions = $paper_instructions;
		$order->writer_pick = $writer_pick;
		$order->deadline = $orderDeadline;
		$order->time_zone = $time_zone;
		$order->status = 0;
		$order->order_price = $total_price;
		$order->save();
		//

        if (request()->session()->has('order_files')) {
            $order_files = request()->session()->get('order_files');
            foreach ($order_files as $order_file_id) {
                $document = OrderFile::where('id',$order_file_id)->first();
                if ($document) {
                    $document->order_code = $order_code;
                    $document->user_id =auth()->user()->id;
                    $document->save();
                }
            }
        }
        request()->session()->forget('order_files');
		//

        request()->session()->put('order_session',$order->order_code);

        $users = User::where('level','admin')->get();
        Notification::send($users, new AdminNotification($order));

        $client = auth()->user();
        Notification::send($client, new CustomerNotification($order,$client));

        if ($writer_pick == 'client') {
           return response()->json(['status' => 'pick_writer','order_code' => $order_code]);
       }else{
           return response()->json(['status' => 'writer_picked','order_code' => $order_code]);
       }


   }


   public function orderBidding(Request $request){
      if ($request->order_code == '') {
       return redirect('/');
   }
   $order = Order::where('order_code',$request->order_code)->first();
   if (!$order) {
       return redirect('/');
   }
   $writers = Writer::all();
   return view('orderbidding',[
       'order' => $order,
       'writers' => $writers
   ]);
}

public function editPlaceOrder(Request $request){
  if (!$request->order_code) {
   return redirect('/');
}
$order = Order::where('order_code',$request->order_code)->first();
if (!$order) {
   return redirect('/');
}
return view('ordernowedit',[
   'order' => $order
]);
}

public function saveOrderEdit(Request $request){
  $paper_type = $this->getPaperType($request->paper_type);
  $subject = $this->getSubject($request->subject);
  $topic = $request->topic;
  if ($topic == '') {
   $topic = 'Writers Choice';
}
$academic_level = $this->getAcademicLevel($request->academic_level);
$pages = $request->pages;
$order_service = $request->order_product_service;
$sources = $request->sources;
$citation_style = $request->citation_style;
$paper_instructions = $request->paper_instructions;
$writer_pick = $request->writer_pick;
$total_price = $request->total_price_calculated;
$order_product_wrlevel = $request->order_product_wrlevel;
$the_urgency = $request->the_urgency;
$time_zone = date_default_timezone_get();

$mydate = getdate();
$currentTimestamp  =$mydate[0];
if ($the_urgency == 'NaN') {
   $the_urgency = 240;
}
$newDeadline = $currentTimestamp + ($the_urgency * 3600);
$orderDeadline = date("Y-m-d H:i:s", $newDeadline);
$newDeadline = $currentTimestamp + ($the_urgency * 2160);
$writerDeadline = date("Y-m-d H:i:s", $newDeadline);

$order = Order::where('order_code',$request->order_code)->first();
$order->paper_type = $paper_type;
$order->subject = $subject;
$order->topic = $topic;
$order->academic_level = $academic_level;
$order->pages = $pages;
$order->service = $order_service;
$order->citation_style = $citation_style;
$order->no_of_citations = $sources;
$order->paper_instructions = $paper_instructions;

$order->deadline = $orderDeadline;
$order->time_zone = $time_zone;
$order->status = 0;
$order->order_price = $total_price;
$order->save();

        //

if (request()->session()->has('order_files')) {
    $order_files = request()->session()->get('order_files');
    foreach ($order_files as $order_file_id) {
        $document = OrderFile::where('id',$order_file_id)->first();
        if ($document) {
            $document->order_code = $order->order_code;
            $document->user_id =auth()->user()->id;
            $document->save();
        }
    }
}
request()->session()->forget('order_files');
        //
		//
request()->session()->put('order_session',$order->order_code);

$client = $order->customer;
if ($client) {
    $custm_url = 'customer';
    $adm_url = 'main';
    $admins = User::where('level','ad')->get();
    Notification::send($client, new OrderEditedNotification($order, $custm_url));
    Notification::send($admins, new OrderEditedNotification($order, $adm_url));
}

if ($order->writer_pick == 'client') {
   return response()->json(['status' => 'pick_writer','order_code' => $order->order_code]);
}else{
   return response()->json(['status' => 'writer_picked','order_code' => $order->order_code]);
}

}


public function checkOrder(Request $request){
  if ($request->order_code == '') {
   return redirect('/');
}
$order = Order::where('order_code',$request->order_code)->first();
return view('checkorder',[
   'order' => $order
]);
}

public function prgDlry(Request $request){
  if (!$request->order_code) {
   return false;
}
$feature = $request->feature;

$order = Order::where('order_code',$request->order_code)->first();
if (!$order) {
   return response()->json(['status' => 'failed']);
}
$add = 0.00;
if ($feature == 'progressive_delivery' && $order->progressive_delivery == 'No') {
   $add = 8.99; 
   $order->progressive_delivery = 'Yes';
}elseif ($feature == 'progressive_delivery' && $order->progressive_delivery == 'Yes') {
   $add = -8.99; 
   $order->progressive_delivery = 'No';
}elseif ($feature == 'vip_support' && $order->vip_support == 'No') {
   $add = 12.99;
   $order->vip_support = 'Yes';
}elseif ($feature == 'vip_support' && $order->vip_support == 'Yes') {
   $add = -12.99;
   $order->vip_support = 'No';
}elseif ($feature == 'page_abstract' && $order->page_abstract == 'No') {
   $add = 13.90;
   $order->page_abstract = 'Yes';
}elseif ($feature == 'page_abstract' && $order->page_abstract == 'Yes') {
   $add = -13.90;
   $order->page_abstract = 'No';
}elseif ($feature == 'essay_outline' && $order->essay_outline == 'No') {
   $add = 12.00;
   $order->essay_outline = 'Yes';
}elseif ($feature == 'essay_outline' && $order->essay_outline == 'Yes') {
   $add = -12.00;
   $order->essay_outline = 'No';
}
else{
   $add = 0.00;
}
$order->order_price = $order->order_price + $add;
$order->save();
return response()->json(['status' => 'success','new_price'=>number_format($order->order_price,2)]);

}

public function downloadFile(Request $request){
  $order_file_id=$request->order_file_id;
  $order_file=OrderFile::findOrFail($order_file_id);
  if($order_file){
   $orderFile = $order_file->path;
   return response()->download(storage_path($orderFile));
}else{
   Alert::error('File not found');
}

return redirect()->back();
}

public function deleteFile(Request $request){
  $order_file_id = decrypt($request->order_file_id);
  $order_file = OrderFile::findOrFail($order_file_id);
  $order_file->delete();

  return redirect()->back()->with('success',"File has been deleted!");

}

public function uploadFiles(Request $request){
  $order_code = $request->order_code_u;

  if($request->hasfile('documents'))
  {

   foreach($request->file('documents') as $key => $file)
   {
    $allowed = ['pdf','PDF','csv','docx','xls','xlsx','jpg','jpeg','png','txt','ppt'];
    $ext = $file->getClientOriginalExtension();
    $file_name = $file->getClientOriginalName();
    if(!in_array($ext,$allowed)){
     return redirect()->back()->with('error',"Please upload a valid file(pdf,csv,docx,xls,xlsx,jpg,jpeg,png,txt,ppt)!");
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
return redirect()->back()->with('success',"Files uploaded successfully!");
}

return redirect()->back()->with('error',"Files not uploaded!");
}

public function editPaperInstructions(Request $request){
  if (!$request->order_code) {
   return redirect()->back();
}
$order = Order::where('order_code',$request->order_code)->first();
$order->paper_instructions = $request->paper_instructions;
$order->save();

$client = $order->customer;
if ($client) {
    $custm_url = 'customer';
    $adm_url = 'main';
    $admins = User::where('level','ad')->get();
    Notification::send($client, new OrderEditedNotification($order, $custm_url));
    Notification::send($admins, new OrderEditedNotification($order, $adm_url));
}

return redirect()->back()->with('success','Paper instructions saved.');
}


protected function getPaperType($paper_type){
  $paper_type_key["11"] = "Essay (Any Type)";
  $paper_type_key["12"] = "Article (Any Type)";
  $paper_type_key["13"] = "Assignment";
  $paper_type_key["14"] = "Content (Any Type)";
  $paper_type_key["15"] = "Admission Essay";
  $paper_type_key["16"] = "Annotated Bibliography";
  $paper_type_key["17"] = "Application Essay";
  $paper_type_key["18"] = "Argumentative Essay";
  $paper_type_key["19"] = "Article Review";
  $paper_type_key["20"] = "Book/Movie Review";
  $paper_type_key["21"] = "Business Plan";
  $paper_type_key["22"] = "Capstone Project";
  $paper_type_key["23"] = "Case Study";
  $paper_type_key["24"] = "Coursework";
  $paper_type_key["25"] = "Creative Writing";
  $paper_type_key["26"] = "Critical Thinking";
  $paper_type_key["27"] = "Dissertation";
  $paper_type_key["28"] = "Dissertation chapter";
  $paper_type_key["29"] = "Lab Report";
  $paper_type_key["30"] = "Math Problem";
  $paper_type_key["31"] = "Research Paper";
  $paper_type_key["32"] = "Research Proposal";
  $paper_type_key["33"] = "Research Summary";
  $paper_type_key["34"] = "Scholarship Essay";
  $paper_type_key["35"] = "Speech";
  $paper_type_key["36"] = "Statistic Project";
  $paper_type_key["37"] = "Term Paper";
  $paper_type_key["38"] = "Thesis";
  $paper_type_key["39"] = "Other";
  $paper_type_key["40"] = "Presentation or Speech";
  $paper_type_key["41"] = "Q&amp;A";
  $paper_type  = $paper_type_key[$paper_type];
  return $paper_type;
}

protected function getSubject($subject_id){
  $subject_key["50"] = "English";
  $subject_key["51"] = "Business and Entrepreneurship";
  $subject_key["52"] = "Nursing";
  $subject_key["53"] = "History";
  $subject_key["54"] = "African-American Studies";
  $subject_key["55"] = "Accounting";
  $subject_key["56"] = "Anthropology";
  $subject_key["57"] = "Architecture";
  $subject_key["58"] = "Art, Theatre and Film";
  $subject_key["59"] = "Biology";
  $subject_key["60"] = "Business and Entrepreneurship";
  $subject_key["61"] = "Chemistry";
  $subject_key["62"] = "Communication Strategies";
  $subject_key["63"] = "Computer Science";
  $subject_key["64"] = "Criminology";
  $subject_key["65"] = "Economics";
  $subject_key["66"] = "Education";
  $subject_key["68"] = "Engineering";
  $subject_key["69"] = "Environmental Issues";
  $subject_key["70"] = "Ethics";
  $subject_key["71"] = "Finance";
  $subject_key["72"] = "Geography";
  $subject_key["73"] = "Healthcare";
  $subject_key["74"] = "History";
  $subject_key["75"] = "International and Public Relations";
  $subject_key["76"] = "Law and Legal Issues";
  $subject_key["77"] = "Linguistics";
  $subject_key["78"] = "Literature";
  $subject_key["79"] = "Management";
  $subject_key["80"] = "Marketing";
  $subject_key["81"] = "Mathematics";
  $subject_key["82"] = "Music";
  $subject_key["83"] = "Nursing";
  $subject_key["84"] = "Nutrition";
  $subject_key["85"] = "Other";
  $subject_key["86"] = "Philosophy";
  $subject_key["87"] = "Physics";
  $subject_key["88"] = "Political Science";
  $subject_key["89"] = "Psychology";
  $subject_key["90"] = "Religion and Theology";
  $subject_key["91"] = "Sociology";
  $subject_key["92"] = "Sport";
  $subject_key["93"] = "Technology";
  $subject_key["94"] = "Tourism";
  $subject = $subject_key[$subject_id];
  return $subject;
}

protected function getAcademicLevel($academic_level_id){
  $academic_level_key["0"] = "";
  $academic_level_key["1"] = "High School";
  $academic_level_key["2"] = "College";
  $academic_level_key["3"] = "Undergraduate";
  $academic_level_key["4"] = "Masters";
  $academic_level_key["5"] = "PhD";
  $academic_level  = $academic_level_key[$academic_level_id];
  return $academic_level;
}

protected function getService($service_id){
  $order_product_service_key["1"] = "Writing";
  $order_product_service_key["2"] = "Rewriting";
  $order_product_service_key["3"] = "Editing";
  $service  = $order_product_service_key[$service_id];
  return $service;
}

protected function getWriterQuality($wrlevel_id){
  $writer_quality_key["1"] = "All writers";
  $writer_quality_key["2"] = "Premium";
  $writer_quality_key["3"] = "Platinum";
  $writer_quality  = $writer_quality_key[$wrlevel_id];
  return $writer_quality;
}

}
