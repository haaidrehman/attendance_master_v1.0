
function email_sent_otp() {
	$('.err_msg').text('');
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var age = $('#age').val();
	var gender = $('#gender').val();
	var std_class = $('#std_class').val();
	var phone = $('#phone').val();
	var email = $('#email').val();

	if (fname != '' && lname != '' && age != '' && gender != '' && std_class != '' && phone != '' && email != '') {
		$('#otp_sent_btn').text('Please wait...');
		//$('#otp_sent_btn').attr('disabled', 'true');
		$.ajax({
			url: 'http://localhost/student_attendance_master_ci_4.0.4/send_otp',
			method: 'post',
			data: {
				email: email,
			},
			dataType: 'json',
			success: function (response) {
				if (response.otp_sent == 1) {
					$('#otp_sent_btn').text('An OTP has been sent to your email address');
					$('#otp_sent_btn').attr('disabled', true);
					$('#otp_verify_btn').attr('disabled', false);
				}
				else if (response.otp_sent == 0) {
					$('#otp_err_msg').text('Something went wrong');
					$('#otp_sent_btn').text('Send OTP');
				}
				else if (response.email_exists == 1) {
					$('#otp_err_msg').text('Email already registered');
					$('#otp_sent_btn').text('Send OTP');
				}
				else if (response.email_invalid == true) {
					$('#email_err_msg').text(response.error_msg);
					$('#otp_sent_btn').text('Send OTP');
				}
				else if (response.email_invalid == 'blank') {
					$('#otp_err_msg').text('Please enter your email');
				}
			}
		});
	}
}

function email_verify_otp() {
	$('.err_msg').text('');
	var otp_verify = $('#email_otp').val();

	if (otp_verify != '') {
		$.ajax({
			url: 'http://localhost/student_attendance_master_ci_4.0.4/verify_otp',
			method: 'post',
			data: {
				otp_verify: otp_verify,
			},
			dataType: 'json',
			success: function (response) {
				if (response.OTP_VERIFIED == 1) {
					$('#otp_verify_btn').text('OTP verifed successfully');
					$('#otp_verify_btn').attr('disabled', true);
					$('#form_register').attr('disabled', false);
				}
				else if (response.OTP_STATUS == 'invalid' || response.OTP_STATUS == 'blank') {
					$('#otp_err_msg').text('Please enter a valid OTP');
				}
			}
		});
	}
	else {
		$('#otp_err_msg').text('Please enter a valid OTP');
	}
}

// Modal
function dispSuccessModal() {
	//$('.modal-area').css('display', 'block');
	alert('djkldllkmmmm');
}


function make_input_field(row_id = '', class_id = '', std_id) {

	if (row_id != '') {

		var row = `#row_${row_id}`;
		var input = `${row} #roll_no_field`;
		var rollNoInputVal = $(input).text();
		html = `<td id="roll_no_field"><form><input type="text" id='roll_no_value' value='${rollNoInputVal}' class='form-control'></input></form></td>`;
		$(input).html(html);


		var a = `<a href="javascript:void(0);" id="update_btn">Add</a>`;
		$(`${row} a`).replaceWith(a);

		// alert(`${row} #update_btn`);
		// $(document).on('click', `${row} #update_btn`, function () {
		// 	console.log(`${row} #update_btn`);
		// 	// var std_id = $(`${row} #roll_no_value`).val();

		// 	// a = `<a href="http://localhost/student_attendance_master_ci_4.0.4/class/${class_id}/roll/${std_id}">Add</a>`
		// 	// $(`${row} a`).html(a);
		// });

		$(document).on('click', `${row} td #update_btn`, function () {
			var roll_no = $(`${row} #roll_no_value`).val();
			console.log(`http://localhost/student_attendance_master_ci_4.0.4/class/${class_id}/student/${std_id}/roll/${roll_no}`);
			window.location.href = `http://localhost/student_attendance_master_ci_4.0.4/class/${class_id}/student/${std_id}/roll/${roll_no}`;
			//window.location.href = `http://localhost/student_attendance_master_ci_4.0.4/class/student/roll/${class_id}/${std_id}/${roll_no}`;
		});
	}
}

function editModal(rowId) {
	var row = `#row_${rowId}`;
	var staff_id = $(`${row} #staff_id`).val();
	var fname = $(`${row} #fname`).val();
	var lname = $(`${row} #lname`).val();
	var gender = $(`${row} #td_gender`).text();
	var date = $(`${row} #td_added_on`).text();
	var email = $(`${row} #td_email`).text();
	var phone = $(`${row} #td_phone`).text();
	var status = $(`${row} #td_status`).text();
	var classname = $(`${row} #td_class`).text();
	var subject = $(`${row} #td_name`).text();

	var modal_form = '.modal .modal-body form';

	$(`${modal_form} #staff_id`).val(staff_id);
	$(`${modal_form} #fname`).val(fname);
	$(`${modal_form} #lname`).val(lname);

	$(`${modal_form} #gender_female`).prop('checked', true);
	if (gender == 'Male') {
		$(`${modal_form} #gender_male`).prop('checked', true);
	}

	$(`${modal_form} #reg_date`).val(date);
	$(`${modal_form} #email`).val(email);
	$(`${modal_form} #phone`).val(phone);
	$(`${modal_form} #status`).val(status);
	$(`${modal_form} #class`).val(classname);
	$(`${modal_form} #subject`).val(subject);

	var link = $(`#act_link`).attr('href');

	$(`#act_link`).attr('href', `${link}${email}`);





	//alert(staff_id);
}

$(document).ready(function () {
	$('#add_attendance_class').on('click', function (e) {
		e.preventDefault();
		$('.err_msg').text('');
		var year = $('#year').val();
		var attendance_class = $('#class').val();
		var subject = $('#subject').val();
		var teacher_id = $('#teacher_id').val();
		var t = 1;
		if (year == '') {
			$('#year_err_msg').text('Class session is required');
			t++;
		}
		if (attendance_class == '') {
			$('#attend_err_msg').text('Class is required');
			t++;
		}
		if (subject == '') {
			$('#subject_err_msg').text('Subject is required');
			t++;
		}

		if (t == 1) {
			$.ajax({
				url: 'http://localhost/student_attendance_master_ci_4.0.4/teacher/d/a/class_add',
				method: 'post',
				data: {
					year: year,
					attendance_class: attendance_class,
					subject: subject,
					teacher_id: teacher_id
				},
				dataType: 'json',
				success: function (response) {
					if (response.class_response_card.success == true) {
						var html = `<a href="http://localhost/student_attendance_master_ci_4.0.4/teacher/d/attendance/${response.class_response_card.id}">
						<div class="inner_border">
							<div>
								<strong>Class</strong>
								<span>${response.class_response_card.class}</span>
							</div>
							<div>
								<strong>Subject</strong>
								<span>${response.class_response_card.subject}</span>
							</div>
							<div>
								<strong>Year</strong>
								<span>${response.class_response_card.year}</span>
							</div>
						</div>
					</a>`;

						$('#attendance_card').prepend(html);
					}
				}
			});
		}

	});

});

// <?php echo base_url().'/teacher/d/absent/'.$v['id'].'/'.$v['class_id'].'/'.$v['subject_id'].'/'.$v['roll_no']; ?>

// <?php echo base_url().'/teacher/d/present/'.$v['id'].'/'.$v['class_id'].'/'.$v['subject_id'].'/'.$v['roll_no']; ?>

function add_to_attendance(type, attnd_cat_id, class_id, sub_id, roll_no, std_id, staff_id, cell_count) {
	url = `http://localhost/student_attendance_master_ci_4.0.4/teacher/d/${type}/${attnd_cat_id}/${class_id}/${sub_id}/${roll_no}`;
	var csrf = $('#afct__estmsnre').val();
	var cell = `#${cell_count}`;
	$.ajax({
		url: url,
		method: 'post',
		data: {
			isPresent: type,
			attnd_cat_id: attnd_cat_id,
			class_id: class_id,
			sub_id: sub_id,
			roll_no: roll_no,
			std_id: std_id,
			staff_id: staff_id,
			csrf: csrf,
		},
		dataType: 'json',
		success: function (response) {
			if (response.result.isPresent == 0) {
				var html = `<a href="javascript:void(0);" class="btn btn-success" onclick="add_to_attendance(${type}, ${attnd_cat_id}, ${class_id}, ${sub_id}, ${roll_no}, ${std_id}, ${staff_id}, '${cell_count}')">A</a>
				`;

				$(`${cell} li .attnd-btn-cell.a`).html(html);
				$(`${cell} li.a-card .result-text`).text('Attendance added');
				$(`${cell} li.a-card .result-text`).css('display', 'block');
			}
			else if (response.result == 'attnd_alrdy_taken') {
				console.log('dkldkldklkdlkdlkldkl');
				$(`${cell} li.a-card .result-text`).text('Attendance already taken');
				$(`${cell} li.a-card .result-text`).css('display', 'block');
			}
		}
	});
}