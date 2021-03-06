@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content">
        
        <div class="progress-banner ">
            <ul class="progress-banner__list">
                <li class="progress-banner__list-item is-active">
                    <span>Place order</span>
                </li>
                <li class="progress-banner__list-item">
                    <span>Select a writer</span>
                </li>
                <li class="progress-banner__list-item ">
                    <span>Check order</span>
                </li>
                <li class="progress-banner__list-item">
                    <span>Add funds to my balance</span>
                </li>
            </ul>
        </div>

        <div class="order-form-v2__row">
            <form class="js_order_form" id="js_order_form" enctype="multipart/form-data" action="{{url('save-order-edit')}}" method="post">
                @csrf
                <!--  -->
                <div class="order-form-v2__flex-wrap js_order-slider order-slider">
                    <div id="step-1" class="order-form-v2__column order-slide js_order-slide   passed">
                        <div class="order-form-v2__form-row js_order_form_paper_type" style="direction: ltr;">
                            <!--  -->
                            <div class="b-form-group">
                                <label class="b-form-group__text-label" for="order_product_paper_type">Type of paper</label>
                                <select id="order_product_paper_type" name="paper_type" data-atest="atest_order_create_form_type" js_default_value="1" js_field_code="foc_o_paper_type" class="b-form-group__select js_without_styler" onchange="calculatePrice()">
                                    <option value="11" selected="selected">Essay (Any Type)</option>
                                    <option value="12">Article (Any Type)</option>
                                    <option value="13">Assignment</option>
                                    <option value="14">Content (Any Type)</option>
                                    <option value="15">Admission Essay</option>
                                    <option value="16">Annotated Bibliography</option>
                                    <option value="17">Application Essay</option>
                                    <option value="18">Argumentative Essay</option>
                                    <option value="19">Article Review</option>
                                    <option value="20">Book/Movie Review</option>
                                    <option value="21">Business Plan</option>
                                    <option value="22">Capstone Project</option>
                                    <option value="23">Case Study</option>
                                    <option value="24">Coursework</option>
                                    <option value="25">Creative Writing</option>
                                    <option value="26">Critical Thinking</option>
                                    <option value="27">Dissertation</option>
                                    <option value="28">Dissertation chapter</option>
                                    <option value="29">Lab Report</option>
                                    <option value="30">Math Problem</option>
                                    <option value="31">Research Paper</option>
                                    <option value="32">Research Proposal</option>
                                    <option value="33">Research Summary</option>
                                    <option value="34">Scholarship Essay</option>
                                    <option value="35">Speech</option>
                                    <option value="36">Statistic Project</option>
                                    <option value="37">Term Paper</option>
                                    <option value="38">Thesis</option>
                                    <option value="39">Other</option>
                                    <option value="40">Presentation or Speech</option>
                                    <option value="41">Q&amp;A</option>
                                </select>
                                <div class="errorText fv1_error" id="order_product_paper_type_fv1_error" style="display: none"></div>
                            </div>

                            <!--  -->

                            <div class="order-form-v2__form-row" style="direction: ltr; padding-top: 25px;">
                                <div class="b-form-group">
                                    <label class="b-form-group__text-label" for="order_name">What is your topic?</label>
                                    <input type="text" id="order_name" name="topic" maxlength="255" data-atest="atest_order_create_form_name" js_default_value="" js_field_code="foc_o_name" class="b-form-group__input" placeholder="Write about???" value="{{$order->topic}}">
                                    <div class="warningText js_order_form_topic_length_warning"></div>
                                    <div class="errorText fv1_error" id="order_name_fv1_error" style="display: none"></div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="order-form-v2__form-row js_order_form_subject" style="direction: ltr;">
                                <div class="b-form-group">
                                    <label class="b-form-group__text-label" for="order_product_subject">Select your subject</label>
                                    <select id="order_product_subject" name="subject" data-atest="atest_order_create_form_subject" js_default_value="88" js_field_code="foc_o_subject" class="b-form-group__select js_without_styler" onchange="calculatePrice()">>
                                        <option value="50">English</option>
                                        <option value="51">Business and Entrepreneurship</option>
                                        <option value="52">Nursing</option>
                                        <option value="53">History</option>
                                        <option disabled="disabled">-------------------</option>
                                        <option value="54">African-American Studies</option>
                                        <option value="55">Accounting</option>
                                        <option value="56">Anthropology</option>
                                        <option value="57">Architecture</option>
                                        <option value="58">Art, Theatre and Film</option>
                                        <option value="59">Biology</option>
                                        <option value="60">Business and Entrepreneurship</option>
                                        <option value="61">Chemistry</option>
                                        <option value="62">Communication Strategies</option>
                                        <option value="63">Computer Science</option>
                                        <option value="64">Criminology</option>
                                        <option value="65">Economics</option>
                                        <option value="66">Education</option>
                                        <option value="68">Engineering</option>
                                        <option value="69">Environmental Issues</option>
                                        <option value="70">Ethics</option>
                                        <option value="71">Finance</option>
                                        <option value="72">Geography</option>
                                        <option value="73">Healthcare</option>
                                        <option value="74">History</option>
                                        <option value="75">International and Public Relations</option>
                                        <option value="76">Law and Legal Issues</option>
                                        <option value="77">Linguistics</option>
                                        <option value="78">Literature</option>
                                        <option value="79">Management</option>
                                        <option value="80">Marketing</option>
                                        <option value="81">Mathematics</option>
                                        <option value="82">Music</option>
                                        <option value="83">Nursing</option>
                                        <option value="84">Nutrition</option>
                                        <option value="85" selected="selected">Other</option>
                                        <option value="86">Philosophy</option>
                                        <option value="87">Physics</option>
                                        <option value="88">Political Science</option>
                                        <option value="89">Psychology</option>
                                        <option value="90">Religion and Theology</option>
                                        <option value="91">Sociology</option>
                                        <option value="92">Sport</option>
                                        <option value="93">Technology</option>
                                        <option value="94">Tourism</option>
                                    </select>
                                    <div class="errorText fv1_error" id="order_product_subject_fv1_error" style="display: none"></div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="order-form-v2__form-row js_order_form_subject" style="direction: ltr;">
                                <div class="b-form-group">
                                    <label class="b-form-group__text-label" for="order_product_subject">Academic Level</label>
                                    <select id="academic_level" name="academic_level" data-atest="atest_order_create_form_subject" js_default_value="88" js_field_code="foc_o_subject" class="b-form-group__select js_without_styler" onchange="calculatePrice()">>
                                        <option value="0">Please Select</option>
                                        <option value="1">High School</option>
                                        <option value="2">College</option>
                                        <option value="3">Undergraduate</option>
                                        <option value="4">Masters</option>
                                        <option value="5">PhD</option>
                                    </select>
                                    <div class="errorText fv1_error" id="order_product_subject_fv1_error" style="display: none"></div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="order-form-v2__form-row js_field_placeholder" style="">
                                <div class="b-form-group" style="direction: ltr;">
                                    <label class="b-form-group__text-label" for="order_product_pages">Number of pages</label>
                                    <div class="b-form-group__flex-wrap ">
                                        <div class="b-form-group__col">
                                            <div class="b-form-group__counter">
                                                <input type="text" id="order_product_pages" name="pages" maxlength="3" data-atest="atest_order_create_form_pages"  js_field_code="foc_o_pages" class="b-form-group__counter-input js_order_product_pages" value="2"  oninput="manualPages(); calculatePrice()">
                                                <div class="b-form-group__counter-inc js_oc_product_pages__inc" id="order_add_pages" onclick="addPages();calculatePrice();"></div>
                                                <div class="b-form-group__counter-dec js_oc_product_pages__dec" id="order_remove_pages" onclick="reducePages();calculatePrice();"></div>
                                            </div>
                                        </div>
                                        <div class="b-form-group__col" style="direction: ltr;">
                                            <div class="b-form-group__col-text">
                                                <span id="order_form_words" class="js_order_form_words"></span>
                                                <br>(double spaced)
                                            </div>
                                        </div>
                                    </div>
                                    <div class="errorText fv1_error" id="order_product_pages_fv1_error" style="display: none"></div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="order-form-v2__form-row">
                                <div class="b-form-group" style="direction: ltr;">
                                    <div class="b-form-group__flex-wrap">
                                        <label class="b-form-group__text-label required">Deadline</label>
                                        <span class="b-form-group__text-label b-form-group__text-label_tip">
                                            <span class="js_oc_deadline_datetime_left" id="order_deadline_days_left"></span>
                                        </span>
                                    </div>
                                    <div class="b-form-group__flex-wrap b-form-group__flex-wrap_with-minutes">
                                        <div class="b-form-group__col">
                                            <input type="text" id="order_deadline_date" name="order_deadline_date" value="" class="b-form-group__date" onchange="calculatePrice();">
                                        </div>
                                        <div class="b-form-group__col">
                                            <input type="text" id="order_deadline_time" value="" class="b-form-group__time" onchange="calculatePrice();">
                                        </div>
                                        <div class="b-form-group__col b-form-group__col_minutes">
                                            <input type="text" id="order_deadline_minutes" value="" class="b-form-group__time" onchange="calculatePrice();">
                                        </div>
                                    </div>
                                    <div class="errorText fv1_error" id="order_deadline_fv1_error"></div>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                    <!-- End step 1 -->
                    <div id="step-2" class="order-form-v2__column order-slide js_order-slide passed">
                        <div class="order-form-v2__form-row">
                            <div class="b-form-group">
                                <h3 class="b-form-group__text-label">Type of service</h3>
                                <div class="b-tabs">
                                    <div class="b-tabs__controls">
                                        <div class="b-tabs__item">
                                            <input type="radio" id="order_product_service_1" name="order_product_service"  class="b-tabs__control" value="1" checked="checked" onchange="calculatePrice()">
                                            <label class="b-tabs__label" for="order_product_service_1">Writing</label>
                                        </div>
                                        <div class="b-tabs__item">
                                            <input type="radio" id="order_product_service_2" name="order_product_service" class="b-tabs__control" value="2" onchange="calculatePrice()">
                                            <label class="b-tabs__label" for="order_product_service_2">Rewriting</label>
                                        </div>
                                        <div class="b-tabs__item">
                                            <input type="radio" id="order_product_service_3" name="order_product_service" class="b-tabs__control" value="3" onchange="calculatePrice()">
                                            <label class="b-tabs__label" for="order_product_service_3">Editing</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="errorText fv1_error" id="order_product_service_fv1_error" style="display: none"></div>
                        </div>
                        <!--  -->
                        <div class="order-form-v2__form-row order-form-v2__form-row_mt_50 order-form-v2__form-row_mob-mb_12">
                            <div class="b-form-group">
                                <h3 class="b-form-group__text-label">Writer quality</h3>
                                <div class="b-tabs b-tabs_descr">
                                    <div class="b-tabs__controls">
                                        <div class="b-tabs__item js_writer_quality_label" data-wr_level="1">
                                            <input type="radio" id="order_product_wrlevel_1" name="order_product_wrlevel" js_default_value="1" js_field_code="foc_o_wrlevel" class="b-tabs__control" value="1" checked="checked" onchange="calculatePrice()">
                                            <label class="b-tabs__label" data-best-choise="Best Choice" for="order_product_wrlevel_1">All writers</label>
                                        </div>
                                        <div class="b-tabs__item js_writer_quality_label b-tabs__item_top" data-wr_level="2">
                                            <input type="radio" id="order_product_wrlevel_2" name="order_product_wrlevel" js_default_value="1" js_field_code="foc_o_wrlevel" class="b-tabs__control" value="2" onchange="calculatePrice()">
                                            <label class="b-tabs__label" data-best-choise="Best Choice" for="order_product_wrlevel_2">Premium</label>
                                        </div>
                                        <div class="b-tabs__item js_writer_quality_label" data-wr_level="3">
                                            <input type="radio" id="order_product_wrlevel_3" name="order_product_wrlevel" js_default_value="1" js_field_code="foc_o_wrlevel" class="b-tabs__control" value="3" onchange="calculatePrice()">
                                            <label class="b-tabs__label" data-best-choise="Best Choice" for="order_product_wrlevel_3">Platinum</label>
                                        </div>
                                    </div>

                                    <div class="b-tabs__descr-wrap">
                                        <div class="b-tabs__descr ">
                                            <div class="js_writer_quality_desc" id="all_writers_desc" data-wr_level="1" style="display:block;" >
                                                <ul class="b-tabs__descr-list">
                                                    <li>Access to experienced, verified writers by Eddusaver.</li>
                                                    <li>100% of our writers will see your order: Beginners, Intermediate, Advanced and Expert.</li>
                                                </ul>
                                            </div>
                                            <div class="js_writer_quality_desc" id="premium_desc" data-wr_level="2" style="display: none;">
                                                <h4 class="b-tabs__descr-title " style="direction: ltr">
                                                Premium quality (Add 10% to price). </h4>
                                                <ul class="b-tabs__descr-list">
                                                    <li style="direction: ltr"><b>OUR TOP 50% of writers</b> will see your order. Get exclusive access to Advanced and Expert writers.</li>
                                                    <li>Over 90% success rate.</li>
                                                    <li>Bachelor???s degree or higher.</li>
                                                </ul>
                                            </div>
                                            <div class="js_writer_quality_desc" id="platinum_desc" data-wr_level="3" style="display: none">
                                                <h4 class="b-tabs__descr-title" style="direction: ltr">Platinum quality (Add 20% to price).</h4>
                                                <ul class="b-tabs__descr-list">
                                                    <li style="direction: ltr"><b>OUR TOP 20% of writers</b> will see your order. Get exclusive access to Expert writers.</li>
                                                    <li>With an over 95% success rate, 1 out of every 2 students comes back to hire these writers again and again.</li>
                                                    <li>Master???s degree or higher</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--  -->
                        <div class="order-form-v2__form-row" style="direction: ltr;">
                            <div class="b-form-group">
                                <label class="b-form-group__text-label">Number of cited resources</label>
                                <div class="b-form-group__flex-wrap">
                                    <div class="b-form-group__col">
                                        <div class="b-form-group__counter">
                                            <input type="text" id="order_product_sources" name="sources" data-atest="atest_order_create_form_sources" js_default_value="0" js_field_code="foc_o_sources" class="b-form-group__counter-input js_order_product_sources" value="0" oninput="manualSources()">
                                            <div class="b-form-group__counter-inc js_oc_product_sources__inc" onclick="addSources();calculatePrice();"></div>
                                            <div class="b-form-group__counter-dec js_oc_product_sources__dec" onclick="reduceSources();calculatePrice();"></div>
                                        </div>
                                    </div>
                                    <div class="b-form-group__col" style="width: 132px;"></div>
                                </div>
                                <div class="errorText fv1_error" id="order_product_sources_fv1_error" style="display: none"></div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="order-form-v2__form-row" style="direction: ltr;">
                            <div class="b-form-group">
                                <label class="b-form-group__text-label">Format of citation</label>
                                <select id="order_product_style" name="citation_style" data-atest="atest_order_create_form_style" js_default_value="5" js_field_code="foc_o_style" class="b-form-group__select js_without_styler">
                                    <option value="MLA">MLA</option>
                                    <option value="APA">APA</option>
                                    <option value="Chicago/Turabian">Chicago/Turabian</option>
                                    <option value="Harvard">Harvard</option>
                                    <option value="Vancouver">Vancouver</option>
                                    <option value="Not Applicable">Not Applicable</option>
                                    <option value="Other" selected="selected">Other</option>
                                </select>
                                <div class="errorText fv1_error" id="order_product_style_fv1_error" style="display: none"></div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                    <!-- End step 2 -->

                    <div id="step-3" class="order-form-v2__column order-slide js_order-slide active">
                        <div class="order-form-v2__form-row" style="direction: ltr;">
                            <!--  -->
                            <div class="order-form-v2__popup-wrap js_co_description_wrapper">
                                <div class="order-form-v2__popup js_co_description_popup ">
                                    <button type="button" class="order-form-v2__popup-close js_co_description_close"></button>
                                    <div class="b-form-group">
                                        <label class="b-form-group__text-label" for="order_description">Paper instructions</label>
                                        <textarea id="order_description" name="paper_instructions" data-atest="atest_order_create_form_description" class="b-form-group__textarea" placeholder="{{$order->paper_instructions}}">{{$order->paper_instructions}}</textarea>
                                        <div class="errorText fv1_error" id="order_description_fv1_error" style="display: none;"></div>
                                    </div>
                                    <div class="order-form-v2__popup-info">
                                        <div class="order-form-v2__popup-btn">
                                            <span class="btn btn_bordered btn_bgc_transparent btn_slim js_co_description_close">Done</span>
                                        </div>
                                        <h5 class="order-form-v2__popup-title">Tips on how to fill in the "Paper instructions" field</h5>
                                        <ul class="order-form-v2__popup-list">
                                            <li>include paper structure and/or outline,</li>
                                            <li>add grading scale or rubrics,</li>
                                            <li>insert useful links or resources,</li>
                                            <li>indicate academic level and/or level of English (ESL/ENL) needed,</li>
                                            <li>share your personal wishes.</li>
                                        </ul>
                                        <p class="order-form-v2__popup-attention">Please don???t insert any personal information here or in the attachments.</p>
                                    </div>
                                </div>
                                <div class="order-form-v2__popup-bg"></div>
                            </div>
                            <!--  -->
                        </div>
                        <div class="order-form-v2__form-row" >
                            <div class="b-form-group">
                                <label class="align-left control-label">Uploaded files:</label>

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
                            <div class="b-form-group">
                                <!-- dropzone -->
                                <div class="order-form-v2__form-row" style="padding-bottom: 10px">
                                   <div id="dropzone_" class="dropzone">
                                   </div>
                                   <div id="preview_template">
                                    <span class="dropzone-previews js_orderuf_previews attached">
                                        <div class="dz-preview dz-file-preview dz-processing dz-complete">
                                         <div class="dz-details">
                                             <div class="dz-filename"><span data-dz-name></span></div>
                                         </div>  
                                         <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div> 
                                         <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                         <div class="dz-success-mark"></div>
                                         <div class="dz-error-mark"></div>
                                     </div>
                                 </span>
                             </div>   
                             <div id="div_files">
                             </div>
                         </div>
                         <!-- End dropzone -->
                     </div>

                 </div>

                 <input type="hidden" id="total_price_calculated" name="total_price_calculated">
                 <input type="hidden" id="order_urgency" name="order_urgency">
                 <input type="hidden" id="the_urgency" name="the_urgency">
                 <div class="order-form-v2__form-row order-form-v2__form-row_mt30">
                     <div class="order-form-v2__proceed-btn form-submit" id="client_pick" style="display: block;">
                        <button class="btn btn_order-form btn-next js_order_next_step js_submit_form js_order_loading_hide" type="button" onclick="placeOrderFunc();">
                           <span>Save Changes</span>
                       </button>
                   </div>

               </div>
               <!--  -->
           </div>
           <!-- End step 3 -->

       </div>
       <!--  -->

   </form>
</div>

</div>
</div>
@include('order_modals')
<script type="text/javascript">
//
var CSRF_TOKEN = "{{csrf_token()}}";
var myDropzone = new Dropzone("#dropzone_", {
    url: "{{url('/file/post')}}",
    maxFilesize: 12,
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.xls,.xlsx,.doc,.docx,.ppt,.pptx",
    addRemoveLinks: true,
    removedfile: function(file) {
       var name = file.name; 

       jQuery.ajax({
         type: 'POST',
         url: "{{url('/file/delete')}}",
         data: {
            file_name: name,
        },
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        sucess: function(data){

        }
    });
       var _ref;
       return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
   },
   timeout: 5000,
   previewTemplate: document.getElementById('preview_template').innerHTML,
   previewsContainer: document.getElementById('div_files'),
   init: function() {
    this.on("sending", function(file, xhr, formData) {
       $("#client_pick").hide();
       $("#system_pick").hide();
       $("#js_order_loading_img").show();
       formData.append("_token", CSRF_TOKEN);
   });
    this.on("success", function(file, responseText) {
        if ($("#writer_pick").val() == 'system') {
            $("#client_pick").hide();
            $("#system_pick").show();
        }else{
            $("#client_pick").show();
            $("#system_pick").hide();
        }
        $("#js_order_loading_img").hide();

    });
},

error: function(file, response)
{
   return false;
}
});

</script>

<script src="{{asset('vendor/datetimepicker/js/jquery.datetimepicker.full.js')}}"></script>
<!-- <script src="{{asset('js/5iUssLo91n.js')}}"></script> -->
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
</script>
<script>
    jQuery('#order_deadline_date').datetimepicker({
        timepicker:false,
        format: 'M d',
        formatDate: 'Y-m-d',
        minDate:new Date(),
        disabledDates: [new Date()],
        defaultDate: false,
        validateOnBlur:false,
        onChangeDateTime:function(dp,$input){
            calculatePrice();
        }

    });

    jQuery('#order_deadline_time').datetimepicker({
        datepicker:false,
        format: 'h A',
        formatTime: 'h A',
        validateOnBlur:false,
        onChangeDateTime:function(dp,$input){
            calculatePrice();
        }

    });


    jQuery('#order_deadline_minutes').datetimepicker({
        datepicker:false,
        format: 'i',
        formatTime: 'i',
        step:1,
        onChangeDateTime:function(dp,$input){
            calculatePrice();
        }
    });
</script>

<script type="text/javascript">

    $(document).ready(function(){
        // $("#order_product_paper_type").val("{{$order->paper_type}}").change();
        // $("#order_product_subject").val("{{$order->subject}}").change();
        // $("#academic_level").val("{{$order->academic_level}}").change();
        // $("#order_product_style").val("{{$order->citation_style}}").change();

    });


    var url_cu = "{{url(url_prefix().'/orders')}}";
    var url_wr = "{{url('orderbidding')}}";
    var url_save = "{{url('/ordernow/save-edit/'.$order->order_code)}}";
    var randKey = $("#randKey").val();
    var paper_instructions = $("#order_description").val();


    function placeOrderFunc(){

      var form = $('#js_order_form')[0];
      var order_data = new FormData(form);
      var client_email = $("#client_email").val();
      var writer_pick = $("#writer_pick").val();
      order_data.append("writer_pick", writer_pick);

      $("#login_button").prop("disabled", true);

      $.ajax({
       type: "POST",
       enctype: 'multipart/form-data',
       url: url_save,
       data: order_data,
       headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
    },
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (response) {
        var bid_url = '{{ route("orderBidding", ":oid") }}';
        var check_url = '{{ route("checkOrder", ":oid") }}';
        check_url = check_url.replace(':oid', response.order_code);

        if(response.status == 'pick_writer'){
         bid_url = bid_url.replace(':oid', response.order_code);
         $(location).attr('href',bid_url);
     }
     else if(response.status == 'writer_picked'){
         $(location).attr('href',check_url);
     }
     else{
         $(location).attr('href',check_url);
     }

 },
 error: function (e) {
    console.log("ERROR : ", e);
}
});
  };


  function  validateFields(){
      var form = $('#order_login')[0];
      var client_email = $("#llogin_email").val();
      if(client_email == ""){
       $("#error_div").html("Email cannot be empty");
       $("#llogin_button").prop("disabled", false);
       return false;
   }
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(client_email)) {
       return true;
   }
   $("#error_div").html("Invalid email adress");
   $("#llogin_button").prop("disabled", false);
   return false;
}


</script>
<script src="{{asset('js/43Yn0pDEO2.js')}}"></script>
<script src="{{asset('js/style.js')}}"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
<script src="{{ asset('sweetalert/dist/sweetalert.min.js') }}"></script>
@endsection