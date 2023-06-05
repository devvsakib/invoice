@include('salon/header')
<style type="text/css">
	.border-custom {
		border: 2px solid #3BB2B8;
	}

	.err_spn {
		color: red;
		font-size: 12px;
		display: none
	}

	.cursor-pointer {
		cursor: pointer;
	}

	.rotate {
		animation: rotate 1.5s linear infinite;
	}

	@keyframes rotate {
		to {
			transform: rotate(360deg);
		}
	}


	/* SPINNER JUST FOR DEMO */
	.spinner {
		display: inline-block;
		width: 18px;
		height: 18px;
		vertical-align: middle;
		border-radius: 50%;
		box-shadow: inset -2px 0 0 2px #0bf;
	}

	.tooltip {
		/*display: inline-block !important;*/
		opacity: 1 !important;
		font-size: 15px !important;
		position: relative !important;
		/*top: -20px;*/
		/*display: none !important;*/
	}

	.tooltip .tooltiptext {
		visibility: hidden;
		color: #ffffff;
		text-align: center;
		padding: 5px 5px;
		border-radius: 3px;
		top: 5px;
		position: absolute;
		z-index: 1;
		border: 1px solid #fff;
		left: 0px;
		/*width: 70vw;*/
		/*min-width: 100%;*/
		background-color: #0d9da3;
	}

	.tooltip_spn,
	.tooltip_spn1 {
		cursor: pointer;
		font-size: 16px;
	}

	/*.tooltip_spn_1{    float: right;margin-top: -28px;}*/
	.tooltip_spn:hover+.tooltip .tooltiptext,
	.tooltip_spn1:hover+.tooltip .tooltiptext {
		visibility: visible;
	}
</style>
<!--Tabs Start-->
<!-- <div class="container mb-4">
   <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="#">Profile</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="#">BOOKING</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="#">CALENDAR</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">TRANSACTION</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">ANALYSIS</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">CARD SETTINGS</a>
      </li>
   </ul>
</div> -->
<!--Tabs End-->
<!--User Info Start-->
<div class="container mb-4 info_form">
	<input type="hidden" id="csrf-token" value="{{ Session::token() }}" />
	<div class="block-heading text-white rounded">{{$lang_kwords['user_info']['english']}}</div>
	<div class="container signupGroup d-flex justify-content-center">
		<div class="signup-card p-4 grid gap-3 justify-content-center align-items-center">
			<form action="" id="frm1" method="post" enctype="multipart/form-data" class="d-grid gap-1 interCardGroupLogin">
				<input type="hidden" name="_token" value="{{ Session::token() }}" />
				<input type="hidden" name="act" value="profile">
				<input type="hidden" name="preferred_lang" value="en">
				@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<!-- 
				<div class="d-flex mb-4">
						<div class="form-number d-flex  justify-content-center me-4" style="line-height: 24px;">1</div>
	         <span class="form-number-label me-2">{{$lang_kwords['basic-info']['english']}}</span>
	         <div class="form-header-line flex-grow-1"></div>
			</div>
			 -->
				<div class="">
					<label for="legal_name" class="form-label">{{$lang_kwords['legal-name']['english']}}
						<i class="ri-information-fill tooltip_spn1 tooltip_spn_1">
							<img src="{{URL::asset('public/images/warning.svg')}}" />
						</i>
						<div class="tooltip">
							<span class="tooltiptext">
								<small>{{$lang_kwords['name-with-a-legal-form']['english']}}</small>
							</span>
						</div>
					</label>
					<input type="text" placeholder="Enter Legal Name" class="form-control" name="legal_name" id="legal_name" value="{{ old('legal_name') }}">
					<span class="err_spn legal_name_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
				</div>
				<div class="">
					<label class="form-label">{{$lang_kwords['coc-number']['english']}}</label>
					<input type="text" class="form-control" name="coc" id="coc" value="{{ old('coc') }}" />
					<span class="err_spn legal_name_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
				</div>
				<div class="">
					<label class="form-label">{{$lang_kwords['vat-number']['english']}}</label>
					<input type="text" class="form-control" name="vat" id="vat" value="{{ old('vat') }}" />
					<span class="err_spn vat_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
				</div>

				<!-- <div class="form-number d-flex justify-content-center me-4 mt-1" style="line-height: 24px;">2</div> -->
				<div class="">
					<label for="email" class="form-label">
						{{$lang_kwords['address']['english']}}
						<i class="ri-information-fill tooltip_spn1 tooltip_spn_1">
							<img src="{{URL::asset('public/images/warning.svg')}}" />
						</i>
						<div class="tooltip">
							<span class="tooltiptext">
								<small>{{$lang_kwords['linked-to-coc-and-vat-number']['english']}}</small>
							</span>
						</div>
					</label>
					<div class="row px-1">
						<div class="col-6 px-1 mb-2">
							<input type="text" placeholder="Street" class="form-control" id="street" name="street" value="{{ old('street') }}">
							<span class="err_spn street_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
						</div>
						<div class="col-6 px-1">
							<input type="text" placeholder="Number" class="form-control" name="number" id="number" value="{{ old('number') }}">
							<span class="err_spn number_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
						</div>
						<div class="col-6 px-1">
							<input type="text" class="form-control" name="postal" id="postal" value="{{ old('postal') }}" />
							<span class="err_spn postal_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
						</div>
						<div class="col-6 px-1">
							<label class="custom-select custom-select-address">
								<input type="hidden" name="province_id" id="province_id">
								<select class="mollure-select-address" name="province" id="province">
									<option value="">{{$lang_kwords['select']['english']}}</option>
									@foreach($province as $k=>$v)
									<option value="{{$v->name}}" data-i="{{$v->id}}">{{$v->name}}</option>
									@endforeach
								</select>
							</label>
							<span class="err_spn province_err">Please Select Province</span>
						</div>
						<div class="col-6 px-1">
							<label class="custom-select custom-select-address">
								<input type="hidden" name="province_id" id="province_id">
								<select class="mollure-select-address" name="province" id="province">
									<option value="">{{$lang_kwords['select']['english']}}</option>
									@foreach($province as $k=>$v)
									<option value="{{$v->name}}" data-i="{{$v->id}}">{{$v->name}}</option>
									@endforeach
								</select>
							</label>
							<span class="err_spn province_err">Please Select Province</span>
						</div>
						<div class="col px-1">
							<label class="custom-select custom-select-address">
								<select class="mollure-select-address" name="municipality" id="municipality">
									<option value="" data-i="">{{$lang_kwords['select']['english']}}</option>
								</select>
								<span class="err_spn municipality_err">Please Select Municipality</span>
								</select>
							</label>
						</div>
					</div>
				</div>
				<!-- Prof chamber -->
				<div class="">
					<label for="uploadfile" class="form-label"> {{$lang_kwords['professional-must-provide-documentation-of-registration-in-chamber-of-commerce']['english']}}
						<i class="ri-information-fill tooltip_spn1 tooltip_spn_1">
							<img src="{{URL::asset('public/images/warning.svg')}}" />
						</i>
						<div class="tooltip">
							<span class="tooltiptext">
								<small>{{$lang_kwords['registration-doc-tooltip']['english']}}</small>
							</span>
						</div>
					</label>
					<input type="file" id="uploadfile" hidden />
					<div class="custom-file-select">
						<label class="chosefile" for="uploadfile" id="reg_spn_img"><img src="./upload.svg" alt="Upload Doc" srcset=""></label>
						<label id="file-chosen">No file chosen</label>
						<i class="ri-upload-2-line"></i>
						<span class="err_spn registration_doc_err">{{$lang_kwords['please-upload-doc']['english']}}</span>
					</div>
					<!-- <input type="file" class="form-control" id="uploadfile"> -->
				</div>
				<div class="mb-4">
					<div class="justify-content-between">
						<div class="row">
							<div class="col-md-10 col-sm-8 col-12">
								<label class="fs-5 text-wrap form-label">{{$lang_kwords['professional-must-provide-documentation-of-registration-in-chamber-of-commerce']['english']}}
									<div style="display:inline-block;width:20px">
										<i class="ri-information-fill tooltip_spn1 tooltip_spn_1"></i>
										<div class="tooltip" style="width:200px;left:-30px">
											<span class="tooltiptext">
												<small>{{$lang_kwords['registration-doc-tooltip']['english']}}</small>
											</span>
										</div>
									</div>
								</label>
							</div>
							<div class="col-md-2 col-sm-3 col-12">
								<label for="registration_doc" class="form-control d-flex align-items-center justify-content-between w-lg-25 w-sm-100 bg-light">
									<span id="reg_spn_img">Upload Files</span>
									<i class="ri-upload-2-line"></i>
								</label>

								<!-- <input type="file" class="d-none" name="" accept="image/png,image/jpeg,application/pdf"  /> -->
								<span class="err_spn registration_doc_err">{{$lang_kwords['please-upload-doc']['english']}}</span>
							</div>
							<div class="col-md-12 col-sm-3 col-12">
								<div class="progress" style="display:none;">
									<div id="progress" class="progress-bar progress-bar-success progress-bar-striped active" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>
								</div>
								<div id="reg_doc_prev_sec" style="display:flex;">
								</div>
								<!-- <img src="" style="width:100px;display:none" class="border p-1" id="registration_doc_prev"> -->
							</div>
						</div>
						<!-- <div class="">
	                  <label class="fs-5 text-wrap form-label">Professional must provide documentation of registration in Chamber of Commerce</label>
	               </div>
	               <div class="">
	                  
	               </div> -->
					</div>
				</div>
				<div class="">
					<div class="label-container"><label class="form-label">{{$lang_kwords['contact-person']['english']}}</label></div>
					<div class="field-container d-flex">
						<div class="flex-fill me-4">
							<input type="text" placeholder="{{$lang_kwords['first-name']['english']}}" class="form-control" name="contact_person_first_name" id="contact_person_first_name" value="{{ old('contact_person_first_name') }}" />
							<span class="err_spn contact_person_first_name_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
						</div>
						<div class="flex-fill">
							<input type="text" placeholder="{{$lang_kwords['last-name']['english']}}" class="form-control" name="contact_person_last_name" id="contact_person_last_name" value="{{ old('contact_person_last_name') }}" />
						</div>
					</div>
				</div>
				<div class="">
					<div class="label-container"><label class="form-label">{{$lang_kwords['contact-number']['english']}}</label></div>
					<div class="field-container"><input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" /><span class="err_spn contact_number_err">{{$lang_kwords['please-fill-detail']['english']}}</span></div>
				</div>
				<div class="mb-4">
					<label class="fs-5 text-wrap d-block mb-3 form-label">{{$lang_kwords['professional-must-provide-examples-of-past-work-that-satisfy-mollures-quality-and-professional-standards']['english']}}</label>
					<input type="text" class="form-control" placeholder="{{$lang_kwords['examples-of-past-work_1']['english']}}" name="insta_link" id="insta_link" value="{{ old('insta_link') }}" />
					<input type="text" class="form-control frm_inp mt-2" placeholder="{{$lang_kwords['examples-of-past-work_2']['english']}}" name="facebook_link" id="facebook_link" value="{{ old('facebook_link') }}" />
					<input type="text" class="form-control frm_inp mt-2" placeholder="{{$lang_kwords['examples-of-past-work_3']['english']}}" name="youtube_link" id="youtube_link" value="{{ old('youtube_link') }}" />
					<span class="err_spn insta_link_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
				</div>
				<div class="">
					<div class="label-container"><label class="form-label">{{$lang_kwords['email']['english']}}</label></div>
					<div class="field-container"><input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" />
						<!-- <span id="email_err" style="color:red"></span> -->
						<span class="err_spn email_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
					</div>

				</div>
				<div class="">
					<div class="label-container"><label class="form-label">{{$lang_kwords['passwords']['english']}}</label></div>
					<div class="field-container"><input type="password" class="form-control" name="password" id="password" />
						<span class="err_spn password_err">{{$lang_kwords['please-fill-detail']['english']}}</span>
					</div>
				</div>
				<div class="">
					<div class="label-container"><label class="form-label">{{$lang_kwords['repeat-password']['english']}}</label></div>
					<div class="field-container"><input type="password" class="form-control" name="conf_password" id="conf_password" /><span class="err_spn conf_password_err">Password don't match</span></div>
				</div>
				<div class="">
					<div class="label-container"><label class="form-label">{{$lang_kwords['gender']['english']}}</label></div>
					<div class="field-container d-flex align-items-center flex-wrap">
						<div class="form-check me-5">
							<input class="form-check-input" type="radio" checked name="gender" id="male" value="male" />
							<label class="form-check-label" for="male"> {{$lang_kwords['male']['english']}} </label>
						</div>
						<div class="form-check me-5">
							<input class="form-check-input" type="radio" name="gender" id="female" value="female" />
							<label class="form-check-label" for="female"> {{$lang_kwords['female']['english']}} </label>
						</div>
						<div class="form-check me-5">
							<input class="form-check-input" type="radio" name="gender" id="neutral" value="neutral" />
							<label class="form-check-label" for="neutral"> {{$lang_kwords['gender-neutral']['english']}} </label>
						</div>
						<div class="form-check">
							<input class="form-check-input me-2" type="radio" name="gender" id="not_prefer" value="not_prefer" />
							<label class="form-check-label" for="not_prefer"> {{$lang_kwords['i-prefer-not-to-answer']['english']}} </label>
						</div>
					</div>
				</div>
				<div class="form-check d-flex align-items-center mb-4">
					<input class="form-check-input me-2 flex-shrink-0" style="margin-top: -5px;" type="checkbox" value="1" id="term_condition" checked />
					<label class="form-check-label fs-5 form-label" for="flexCheckDefault"> Accept our <a href="{{route('term_condition')}}" target="_blank" style="text-decoration:none">Terms and Conditions</a> </label>
				</div>
				<div class="d-flex justify-content-center">
					<button class="btn custom-btn-primary fs-5" type="button" name="form_submit" id="form_submit" value="Submit" onclick="form_validate()">{{$lang_kwords['submit']['english']}}</button>
				</div>
		</div>
	</div>
	</form>
</div>
</div>
</div>
<!--User Info End-->

<!-- Modal -->
<div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->


			<div class="modal-body border-custom rounded p-4" style="max-height: 95vh;height: auto;">
				<div class="text-center">
					@if(isset($contents['register_popup']))
					<img src="{{asset('public')}}{{$contents['register_popup']['image']}}" alt="logo" class="mt-3" style="width:65px">
					@endif
					<!-- <img src="{{ URL::asset('public/images/logo-lg.png')}}" alt="logo" class="mt-3" style="width:65px"/> -->
					@if(isset($contents['register_popup']))
					{!! $contents['register_popup']['content'] !!}
					@endif
					<!-- <h3 class="text-custom-primary my-4">Thank you <br> for registering with Mollure!</h3>
        	<p class="mt-4" style="font-size:24px;">Please check your email box to verify your Email.</p>
        	<p class="mt-4" style="font-size:16px;">If email not recieved, please ensure Junk/Spam box.</p>
        	<p class="mt-4" style="font-size:20px;"><a href="{{config('app.url')}}">Bakc To Home</a></p> -->
				</div>
			</div>
			<!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
		</div>
	</div>
</div>

<form id="pic-form" enctype="multipart/form-data" class="d-none">
	<input type="file" accept="image/png, image/jpeg,image/jpg, application/pdf" name="doc" id="registration_doc" style="visibility:hidden;height:0px;" />
	<input type="hidden" name="_token" value="{{ Session::token() }}" />
	<input type="hidden" name="type" value="registration_doc" />
</form>


@include('salon/footer')

<script type="text/javascript">
	$(document).ready(function() {
		$('input[type="text"],select').on('change keypress', function() {
			var nm = $(this).attr('name');
			$('.' + nm + '_err').hide();
		})

		$("#registration_doc").on('change', function() {
			var rtn = ValidateSize(this, 'registration_doc');
			/*if(rtn!=0)
			  readURL(this,'registration_doc');*/
		});

		/*$("#registration_doc").on('change',function() {
		  var fcnt = ($(this)[0].files.length);

		  if(fcnt>5){
		  	alert("You can select only 5 images");
		  	$("#registration_doc").val('');
		  	return false;
		  }

		  if(fcnt>0){

		  	var rtn=ValidateSize(this,'registration_doc', fcnt);
	       	if(rtn!=0){
	       		$.each(this.files,function(k,v){
	        		readURL(v,'registration_doc');
	        	})
		    	$('#reg_spn_img').html(fcnt+' files selected');
	     	}

		  }
		  else{
		    $('#reg_spn_img').html('Upload Files');
		  }

		  return;
		});*/

		$('#municipality').on('change', function() {
			let i = $(this).find('option:selected').attr('data-i')
			$('#municipality_id').val(i);

		});
		$('#province').on('change', function() {
			let i = $(this).find('option:selected').attr('data-i')
			$('#province_id').val(i);
			get_municipality(i);
		});


	});

	var tr = 0;

	function get_municipality(i) {

		$('#municipality').val('');
		$('#municipality_id').val('');
		$('#municipality').find('option.pv').remove();

		if (!i) {
			return false;
		}

		tr++;

		$('#prov_spn').show();

		$.ajax({
			url: '{{route("municipality_list")}}',
			type: 'post',
			data: {
				'prov': i,
				'_token': '{{ csrf_token() }}',
			},
			dataType: 'json',
			success: function(r) {
				$('#prov_spn').hide();
				if (r.status == 'SUCCESS') {
					var prov = r.data;
					var str = '';
					$.each(prov, function(k, v) {
						str += '<option class="pv" data-i="' + v.i + '" value="' + v.name + '">' + v.name + '</option>';
					});

					$('#municipality').append(str);
				}
			},
			error: function(e) {
				$('#prov_spn').hide();
				if (tr < 3) {
					get_municipality(i);
				}
			}
		});
	}


	function ValidateSize(file, ph) {
		// var FileSize = file.files[0].size / 1024 / 1024;
		/*if (FileSize > 10) {
		    alert('File size exceeds 10 MB');
		    if(ph=='')
		      $(file).val('');  
		    else
		      $('#'+ph).val('');  
		    return 0;        
		}*/

		// var val = $("#"+ph).val();
		var flg = 1;

		// console.log(file.files.name);

		$.each(file.files, function(k, v) {
			if (flg == 0) return false;
			const val = v.name;
			switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
				case 'jpeg':
				case 'jpg':
				case 'png':
				case 'pdf':
					flg = 1;
					upload_reg_doc(v.type);
					break;
				default:
					flg = 0;
					$("#" + ph).val('');
					alert("Valid format: jpeg, jpg, png, PDF");
					$('#reg_spn_img').html('Upload Files');
					break;
			}
		})

		/*switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
		    case 'jpeg': case 'jpg':  case 'png': 
		  			flg=1;            
		        break;
		    default:
		        	$("#"+ph).val('');
		        	alert("Valid format: jpeg, jpg, png");
		        break;
		}*/
		return flg;
	}

	function readURL(input, ph) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {

				$('#registration_doc_prev').attr('src', e.target.result).show();
				// $('#img_not_up_spn').hide();

			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	function upload_reg_doc(tp) {
		$.ajax({
			url: "{{route('upload_image')}}",
			type: 'post',
			data: new FormData($("#pic-form")[0]),
			contentType: false,
			cache: false,
			processData: false,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						var percentComplete = parseInt(((evt.loaded / evt.total) * 100));
						$("#progress").width(percentComplete + '%');
						$("#progress").html(percentComplete + '%');
					}
				}, false);
				return xhr;
			},
			beforeSend: function() {
				$("#progress").parent().css("display", "block");
				$("#progress").width('0%');
				$('#uploadStatus').html("<div class='spinner-border' ></div>");
			},
			success: function(r) {

				$('#pic-form')[0].reset();
				$("#progress").width('0%');
				$("#progress").parent().css("display", "none");

				if (r != 'ERR') {
					var str = '<div class="reg_doc_sec1" style="position: relative;padding: 6px;width:115px;border: 1px solid #dfdfdf;margin-right: 10px;">';

					str += '<p style="position: absolute;right: 1px;top: -13px;color: red;font-size: 29px;font-weight: bold;"><label class="cursor-pointer" onclick="remove_reg_doc($(this))"> &times; </label></p><input type="hidden" name="registration_doc[]" value="' + r + '" class="registration_doc_inp">';
					// console.log();
					if (tp == 'application/pdf') {
						var imgd = '{{URL::to("/")."/public/imgs/docs/pdf_logo.jpg"}}';

						str += '<img src="' + imgd + '" onclick="open_pdf(\'' + r + '\')" style="max-width:100px;max-height:100px" class="border p-1" class="reg_doc_img">';
					} else
						str += '<img src="' + r + '" style="max-width:100px;max-height:100px" class="border p-1" class="reg_doc_img">';
					str += '</div>';

					$('#reg_doc_prev_sec').append(str);
					// var str = '<img src="'+r+'" style="max-width:100px;max-height:100%" class="border p-1" id="registration_doc_prev">';
				}
			}
		})
	}

	function open_pdf(pdf) {
		window.open(pdf);
	}

	function remove_reg_doc(el) {
		// console.log(el);
		el.closest('.reg_doc_sec1').remove();
	}

	function form_validate() {
		var legal_name = $('#legal_name').val();
		var coc = $('#coc').val();
		var vat = $('#vat').val();
		var street = $('#street').val();
		var postal = $('#postal').val();
		var municipality = $('#municipality').val();
		var province = $('#province').val();
		// var registration_doc = $('#registration_doc').val();	
		var contact_person_first_name = $('#contact_person_first_name').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var conf_password = $('#conf_password	').val();


		if ($.trim(legal_name) == '') {
			$('#legal_name').focus();
			$('.legal_name_err').show();
			return false;
		}
		// console.log('111');
		if ($.trim(coc) == '') {
			$('#coc').focus();
			$('.coc_err').show();
			return false;
		}
		// console.log('222');
		if ($.trim(vat) == '') {
			$('#vat').focus();
			$('.vat_err').show();
			return false;
		}
		// console.log('3333');
		if ($.trim(street) == '') {
			$('#street').focus();
			$('.street_err').show();
			return false;
		}
		// console.log('444');
		if ($.trim(postal) == '') {
			$('#postal').focus();
			$('.postal_err').show();
			return false;
		}
		// console.log('555');
		if ($.trim(municipality) == '') {
			$('#municipality').focus();
			$('.municipality_err').show();
			return false;
		}
		// console.log('666');
		if ($.trim(province) == '') {
			$('#province').focus();
			$('.province_err').show();
			return false;
		}
		// console.log('777');
		// if($.trim(registration_doc)==''){
		if ($('.registration_doc_inp').length <= 0) {
			// $('#registration_doc').focus();
			$('.registration_doc_err').show();
			$('html, body').animate({
				scrollTop: $('#reg_spn_img').offset().top - 100
			}, 500);
			return false;
		}
		// console.log('888');
		if ($.trim(contact_person_first_name) == '') {
			$('#contact_person_first_name').focus();
			$('.contact_person_first_name_err').show();
			return false;
		}
		// console.log('999');
		if ($.trim(email) == '') {
			$('#email').focus();
			$('.email_err').html('{{$lang_kwords["please-fill-detail"]["dutch"]}}').show();
			return false;
		}
		// console.log('aaaa');
		if ($.trim(password) == '') {
			$('#password').focus();
			$('.password_err').show();
			return false;
		}
		// console.log('bbbb');
		if ($.trim(conf_password) == '') {
			$('#conf_password').focus();
			$('.conf_password_err').show();
			return false;
		}
		// console.log('cccc');
		if (password != conf_password) {
			$('#conf_password').focus();
			$('.conf_password_err').show();
			return false;
		}

		if ($('#term_condition').prop('checked') == false) {
			$('#term_condition').focus();
			return false;
		}

		var frm = new FormData($('#frm1')[0]);
		$('#form_submit').html('Wait..!').attr('disabled', true);
		// return;
		$.ajax({
			url: "{{route('profile_save')}}",
			type: 'post',
			data: frm,
			contentType: false,
			processData: false,
			success: function(r) {
				$('#form_submit').html('Save').attr('disabled', false);
				if (r == 'SUC') {
					$('#modal1').modal('show');
				}
				if (r == 'email') {
					$('.email_err').html('Email already exist.').show();
					$('html, body').animate({
						scrollTop: $('.email_err').offset().top - 100
					}, 500);
				}
			}
		})

		// console.log('dddd');
		//$('#frm1').submit();
		// console.log('eeee');
	}
</script>