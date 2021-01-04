<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('home', 'Admin::index', ['filter' => 'auth_admin']);

$routes->group('admin', function($routes){
	$routes->match(['get', 'post'], '', 'Admin::admin_login', ['filter' => 'csrf']);
	$routes->get('logout', 'Admin::logout', ['filter' => 'auth_admin']);
});

//$routes->match(['get', 'post'], 'login', 'Student::login');
$routes->match(['get', 'post'], 'register', 'Student::register', ['filter' => 'honeypot']);
$routes->post('send_otp', 'Student::email_otp');
$routes->post('verify_otp', 'Student::verify_otp');


$routes->get('teachers', 'Admin::teacher_detail', ['filter' => 'auth_admin']);

$routes->group('teacher', function($routes){
	$routes->match(['get', 'post'], 'login', 'Teacher::login', ['filter' => 'teacher_log_check']);
	$routes->match(['get', 'post'], 'add', 'Admin::teacher_add', ['filter' => 'auth_admin']);
	$routes->post('manage', 'Admin::teacher_manage', ['filter' => 'auth_admin']);
	$routes->get('activation_link/([a-zA-Z]+(_|\.)?[a-zA-Z0-9]*@[a-z]+\.(com))', 'Admin::resendActivationLink/$1', ['filter' => 'auth_admin']);
	$routes->get('dashboard', 'Teacher::dashboard', ['filter' => 'auth_teacher']);
	$routes->get('logout', 'Teacher::logout', ['filter' => 'auth_teacher']);

	$routes->post('d/a/class_add', 'Teacher::add_attendance_class', ['filter' => 'auth_teacher']);

	$routes->get('d/attendance/([0-9]{1,2})/class/([1-9]{1,2})/subject/(:any)/y/([0-9]{4})', 'Teacher::date_wise_filter/$1/$2/$3/$4', ['filter' => 'auth_teacher_csrf']);

	/* => */$routes->get('d/attendance/([0-9]{1,2})/([1-9]{1,2})/(:any)/date/(:any)', 'Teacher::filter_select/$1/$2/$3/$4', ['filter' => 'auth_teacher_csrf']);

	$routes->get('d/attendance/([0-9]{1,2})', 'Teacher::disp_attendance_chart/$1', ['filter' => 'auth_teacher_csrf']);

	$routes->get('d/attendance_detail/([1-9]{1,2})/([1-9]{1,2})/date/(:any)', 'Teacher::class_attendance_detail/$1/$2/$3', ['filter' => 'auth_teacher_csrf']);

	$routes->get('d/attendance_detail/ajax/([1-9]{1,2})/([1-9]{1,2})/date/(:any)', 'Teacher::class_attendance_detail_ajax_load/$1/$2/$3', ['filter' => 'auth_teacher_csrf']);

	// View all students in a class 
	$routes->get('d/attendance_detail/students/([1-9]{1,2})/([1-9]{1,2})/([1-5]){1}', 'Teacher::view_student_list/$1/$2/$3', ['filter' => 'auth_teacher_csrf']);

	// View a single student detail from a specific class
	$routes->get('d/attendance_detail/students/detail/([1-9]{1,2})/([1-9]{1,2})/([1-9]{1,3})/([1-5]{1})', 'Teacher::view_student_details/$1/$2/$3/$4', ['filter' => 'auth_teacher_csrf']);

	// Fetch attendance detail of a specific student from a range of date
	$routes->post('d/attendance_detail/students/attendance_range/([1-9]{1,3})/([1-9]{1,3})/([1-5]{1})/(:any)/(:any)', 'Teacher::view_attendance_from_range/$1/$2/$3/$4/$5');

	$routes->post('d/([0-9]{1})/([0-9]{1,2})/([0-9]{1,2})/([0-9]{1,2})/([0-9]{1,2})', 'Teacher::add_student_attendance/$1/$2/$3/$4/$5');
});

$routes->get('registrations/class/([0-9]{1,2})/?([a-zA-Z0-9]{20})?', 'Admin::student_add/$1/$2', ['filter' => 'auth_admin']);

$routes->group('class', ['filter' => 'auth_admin'], function($routes){
	$routes->get('', 'Admin::student_classes');
	$routes->get('detail/?([0-9]{1,2})?', 'Admin::class_list/$1');
	$routes->get('([0-9]{1,2})/student/([0-9]{1,2})/roll/([0-9]{1,2})', 'Admin::update_rollno/$1/$2/$3');
});

// To add optional parameter in uri simply put the placeholder or expression between ?(placeholder)?
$routes->get('register/activate/?([a-zA-Z0-9]{32})?', 'Admin::verifyToken/$1');

$routes->get('registration/success', 'Student::reg_success', ['filter' => 'auth_user']);

$routes->group('student', function($routes){
	$routes->get('class', 'Admin::class_categories', ['filter' => 'auth_admin']);
	$routes->match(['get', 'post'], 'login', 'Student::login');
	$routes->match(['get', 'post'], 'dashboard', 'Student::student_account', ['filter' => 'student_auth']);
	$routes->match(['get', 'post'], 'profile/upload', 'Student::std_file_upload', ['filter' => 'student_auth']);
	$routes->get('attendance/([1-9]{1,3})', 'Student::student_attendance_base/$1', ['filter' => 'student_auth']);
	$routes->post('attendance/detail/([0-9]{1,3})/([1-5]{1})/([0-9]{1,2})/(:any)', 'Student::student_attendance_detail/$1/$2/$3/$4', ['filter' => 'student_auth']);
	$routes->get('notification/([0-9]{1,3})', 'Student::student_notification/$1', ['filter' => 'student_auth']);
	$routes->match(['get', 'post'], 'statistics', 'Student::attendance_statistics', ['filter' => 'student_auth']);
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}