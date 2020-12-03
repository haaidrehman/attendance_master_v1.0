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
	$routes->match(['get', 'post'], 'login', 'Teacher::login', ['filter' => 'honeypot']);
	$routes->match(['get', 'post'], 'add', 'Admin::teacher_add', ['filter' => 'auth_admin']);
	$routes->post('manage', 'Admin::teacher_manage', ['filter' => 'auth_admin']);
	$routes->get('activation_link/([a-zA-Z]+(_|\.)?[a-zA-Z0-9]*@[a-z]+\.(com))', 'Admin::resendActivationLink/$1', ['filter' => 'auth_admin']);
	$routes->get('dashboard', 'Teacher::dashboard', ['filter' => 'auth_teacher']);
	$routes->get('logout', 'Teacher::logout', ['filter' => 'auth_teacher']);
	$routes->post('d/a/class_add', 'Teacher::add_attendance_class', ['filter' => 'auth_teacher']);
	$routes->get('d/attendance/([0-9]{1,2})', 'Teacher::disp_attendance_chart/$1', ['filter' => 'auth_teacher_csrf']);
	$routes->post('d/([0-9]{1})/([0-9]{1,2})/([0-9]{1,2})/([0-9]{1,2})/([0-9]{1,2})', 'Teacher::add_student_attendance/$1/$2/$3/$4/$5');
});

$routes->get('registrations/class/([0-9]{1,2})/?([a-zA-Z0-9]{20})?', 'Admin::student_add/$1/$2', ['filter' => 'auth_admin']);

$routes->group('class', ['filter' => 'auth_admin'], function($routes){
	$routes->get('', 'Admin::student_classes');
	$routes->get('detail/?([0-9]{1,2})?', 'Admin::class_list/$1');
	$routes->get('([0-9]{1,2})/student/([0-9]{1,2})/roll/([0-9]{1,2})', 'Admin::update_rollno/$1/$2/$3');
	$routes->get('timetable', 'Admin::class_time_tbl');
});

// To add optional parameter in uri simply put the placeholder or expression between ?(placeholder)?
$routes->get('register/activate/?([a-zA-Z0-9]{32})?', 'Admin::verifyToken/$1');

$routes->get('registration/success', 'Student::reg_success', ['filter' => 'auth_user']);

$routes->group('student', function($routes){
	$routes->get('class', 'Admin::class_categories', ['filter' => 'auth_admin']);
	$routes->match(['get', 'post'], 'login', 'Student::login');
	$routes->get('account', 'Student::student_account');
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