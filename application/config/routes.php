<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login/Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dioceses-load/(:any)'] = 'web/Web/dioceses_load';
$route['validation'] = 'Form';
$route['login'] = 'login/Login/login';
$route['login/(:any)'] = 'login/Login/login';
$route['logout'] = 'login/Login/logout';
$route['logout/(:any)'] = 'login/Login/logout';
$route['preregistration'] = 'login/Login/preregistration';
$route['preregistration/(:any)'] = 'login/Login/preregistration';
$route['insertBasicdata'] = 'login/Login/insertBasicdata';
$route['intern-insertBasicdata'] = 'login/Login/intern_insertBasicdata';
$route['program_volunteerbasicData'] = 'login/Login/program_volunteerbasicData';
$route['secondinsertBasicdata'] = 'login/Login/secondinsertBasicdata';
$route['intern-secondinsertBasicdata'] = 'login/Login/intern_secondinsertBasicdata';
$route['program_volunteersecondinsertBasicdata'] = 'login/Login/program_volunteersecondinsertBasicdata';
$route['insertoccupationDetails'] = 'login/Login/insertoccupationDetails';
$route['intern-insertoccupationDetails'] = 'login/Login/intern_insertoccupationDetails';
$route['programVolunteer_insertoccupationDetails'] = 'login/Login/programVolunteer_insertoccupationDetails';
$route['post-registration-volunteer/(:any)'] = 'login/Login/post_registration_volunteer';
$route['post-registration-intern/(:any)'] = 'login/Login/post_registration_intern';
$route['update_volunteer_data'] = 'login/Login/update_volunteer_data';
$route['volunteer-programs/(:any)'] = 'login/Login/volunteer_programs';
$route['verify'] = 'login/Login/verify';
$route['verify/(:any)'] = 'login/Login/verify';
$route['verify/(:any)/(:any)'] = 'login/Login/verify';
$route['verify/(:any)/(:any)/(:any)'] = 'login/Login/verify';
$route['reset'] = 'login/Login/resetPassword';
$route['reset/(:any)'] = 'login/Login/resetPassword';
$route['reset/(:any)/(:any)'] = 'login/Login/resetPassword';
$route['reset/(:any)/(:any)/(:any)'] = 'login/Login/resetPassword';
$route['reset-password'] = 'login/Login/reset_password';
$route['reset-password/(:any)'] = 'login/Login/reset_password';
$route['all-state'] = 'login/Login/all_city';
$route['fetch-city'] = 'login/Login/fetch_city';
$route['all-state/(:any)'] = 'login/Login/all_city';
$route['all-valunteers'] = 'login/Login/all_valunteers';
$route['all-valunteers/(:any)'] = 'login/Login/all_valunteers';
$route['all-intern'] = 'login/Login/all_intern';
$route['all-intern/(:any)'] = 'login/Login/all_intern';
$route['dashboard'] = 'users/User/dashboard';
$route['dashboard/(:any)'] = 'users/User/dashboard';
$route['task'] = 'users/User/task';
$route['task/(:any)'] = 'users/User/task';
$route['add-daily-report'] = 'users/User/add_daily_report';
$route['add-daily-report/(:any)'] = 'users/User/add_daily_report';
$route['daily-report'] = 'users/User/daily_report';
$route['daily-report/(:any)'] = 'users/User/daily_report';
$route['find-task'] = 'users/User/find_task';
$route['find-task/(:any)'] = 'users/User/find_task';
$route['timeline'] = 'users/User/timeline';
$route['timeline/(:any)'] = 'users/User/timeline';
$route['change-password'] = 'users/User/change_password';
$route['change-password/(:any)'] = 'users/User/change_password';
$route['profile'] = 'users/User/profile';
$route['profile/(:any)'] = 'users/User/profile';
$route['edit-profile'] = 'users/User/edit_profile';
$route['edit-profile/(:any)'] = 'users/User/edit_profile';
$route['update-data'] = 'users/User/update_data';
$route['update-data/(:any)'] = 'users/User/update_data';
$route['final-report'] = 'users/User/final_report';
$route['view-final-report'] = 'users/User/view_final_report';
$route['admin-dashboard'] = 'admin/Admin/dashboard';
$route['admin-dashboard/(:any)'] = 'admin/Admin/dashboard';
$route['master-menu'] = 'admin/Admin/master_menu';
$route['master-menu/(:any)'] = 'admin/Admin/master_menu';
$route['sub-menu-list'] = 'admin/Admin/sub_menu_list';
$route['sub-menu-list/(:any)'] = 'admin/Admin/sub_menu_list';
$route['create-permission'] = 'admin/Admin/create_permission';
$route['create-permission/(:any)'] = 'admin/Admin/create_permission';
$route['role-permission'] = 'admin/Admin/role_permission';
$route['role-permission/(:any)'] = 'admin/Admin/role_permission';
$route['addregions'] = 'admin/Admin/addregions';
$route['insert-region'] = 'admin/Admin/insert_region';
$route['edit-addregions/(:any)'] = 'admin/Admin/edit_addregions';
$route['regions-list'] = 'admin/Admin/region_list';
$route['update_region'] = 'admin/Admin/update_region';
$route['add-theme'] = 'admin/Admin/add_theme';
$route['cause-list/(:any)'] = 'admin/Admin/cause_list';
// $route['view-task-details'] = 'users/User/view_task_details';
$route['view-task-details/(:any)'] = 'users/User/view_task_details';
$route['view-intern-task-details'] = 'intern/intern/view_intern_task_details';
$route['view-intern-task-details/(:any)'] = 'intern/intern/view_intern_task_details';
$route['view-task/(:any)'] = 'admin/Volunteer_task/view_task';
$route['edit-task/(:any)'] = 'admin/Volunteer_task/edit_task';
$route['intern-edit-task/(:any)'] = 'admin/Admin/intern_edit_task';
$route['task-member'] = 'users/User/task_member';
$route['task-member/(:any)'] = 'users/User/task_member';
$route['volenteership'] = 'admin/Volunteer/volenteership';
$route['volenteership/(:any)'] = 'admin/Volunteer/volenteership';
$route['intern-volenteership'] = 'admin/Admin/intern_volenteership';
$route['intern-volenteership/(:any)'] = 'admin/Admin/intern_volenteership';
$route['intern-add-task'] = 'admin/Admin/intern_add_task';
$route['add-task'] = 'admin/Volunteer_task/add_task';
$route['update_task'] = 'admin/Volunteer_task/update_task';
$route['intern_update_task'] = 'admin/Admin/update_task';
$route['insert_add_task'] = 'admin/Volunteer_task/insert_add_task';
$route['interninsert_add_task'] = 'admin/Admin/interninsert_add_task';
// $route['add-task/(:any)'] = 'admin/Volunteer_task/intern_add_task';
// $route['internedit-task/(:any)'] = 'admin/Admin/internedit_task';
$route['task-list'] = 'admin/Volunteer_task/task_list';
$route['task-list/(:any)'] = 'admin/Volunteer_task/task_list';
$route['intern-task-list'] = 'admin/Admin/intern_task_list';
$route['intern-task-view/(:any)'] = 'admin/Admin/intern_task_view';
$route['assigned-task'] = 'admin/Volunteer_assign_task/assigned_task';

$route['intern-assigned-task'] = 'admin/Admin/intern_assigned_task';
$route['intern-assigned-task/(:any)'] = 'admin/Admin/intern_assigned_task';
$route['view-assigned-task'] = 'admin/Volunteer_assign_task/view_assigned_task';
$route['view-assigned-task/(:any)'] = 'admin/Admin/intern_view_assigned_task';
$route['intern-view-assigned-task'] = 'admin/Admin/intern_view_assigned_task';
$route['intern-view-assigned-task/(:any)'] = 'admin/Admin/view_assigned_task';
$route['view-intern-assigned-task'] = 'admin/Admin/view_assigned_task_intern';
$route['view-intern-assigned-task/(:any)'] = 'admin/Admin/view_assigned_task_intern';
$route['internlist'] = 'admin/Admin/internlist';
//$route['intern-request-task'] = 'admin/Admin/intern_request_task';
$route['volunteer-task-report'] = 'admin/Volunteer_report/task_report';
// $route['volunteer-task-report/(:any)'] = 'admin/Volunteer_report/task_report';
$route['admin-final-daily-report'] = 'admin/Admin/final_daily_report';
$route['admin-intern-daily-report'] = 'admin/Admin/intern_daily_report';
//$route['admin-final-daily-report/(:any)'] = 'admin/Admin/final_daily_report';
$route['volunteer'] = 'admin/Admin/volunteer';
$route['volunteer/(:any)'] = 'admin/Admin/volunteer';
$route['co-volunteer-report'] = 'admin/Admin/co_volunteer_report';
$route['co-volunteer-report/(:any)'] = 'admin/Admin/co_volunteer_report';
$route['admin-user-profile'] = 'admin/Admin/user_profile';
$route['admin-user-profile/(:any)'] = 'admin/Admin/user_profile';
$route['admin-change-pwd'] = 'admin/Admin/change_pwd';
$route['admin-change-pwd/(:any)'] = 'admin/Admin/change_pwd';
$route['admin-user-form'] = 'admin/Admin/admin_user_form';
$route['admin-user-form/(:any)'] = 'admin/Admin/admin_user_form';
$route['view-daily-report'] = 'admin/Admin/view_daily_report';
$route['view-daily-report/(:any)'] = 'admin/Admin/view_daily_report';
$route['create-role'] = 'admin/Admin/create_role';
$route['create-role/(:any)'] = 'admin/Admin/create_role';
$route['volenteership-verify'] = 'admin/Admin/volenteership_verify';
$route['volenteership-verify/(:any)'] = 'admin/Admin/volenteership_verify';
$route['volenteership-verify/(:any)/(:any)'] = 'admin/Admin/volenteership_verify';
$route['volenteership-block'] = 'admin/Admin/volenteership_block';
$route['volenteership-block/(:any)'] = 'admin/Admin/volenteership_block';
$route['volenteership-block/(:any)/(:any)'] = 'admin/Admin/volenteership_block';
$route['insert_menu_master'] = 'admin/Admin/insert_menu_master';
$route['insert_sub_menu_master'] = 'admin/Admin/insert_sub_menu_master';
$route['add-menu-form'] = 'admin/Admin/add_menu_form';
$route['add-state-list'] = 'admin/Admin/add_state_list';
$route['add-state-list'] = 'admin/Admin/add_state_list';
$route['edit-state/(:any)'] = 'admin/Admin/edit_state';
$route['update_state'] = 'admin/Admin/update_state';
$route['add-state'] = 'admin/Admin/add_state';
$route['insert_state'] = 'admin/Admin/insert_state';
$route['insert_city'] = 'admin/Admin/insert_city';
$route['employee-master-list'] = 'admin/Admin/employee_master_list';
$route['edit-employee/(:any)'] = 'admin/Admin/edit_employee';
$route['add-employee'] = 'admin/Admin/add_employee';
$route['insert_employee'] = 'admin/Admin/insert_employee';
$route['update_employee'] = 'admin/Admin/update_employee';
$route['add-district-list'] = 'admin/Admin/add_city_list';
$route['add-city'] = 'admin/Admin/add_city';
$route['edit-city/(:any)'] = 'admin/Admin/edit_city';
$route['update_city'] = 'admin/Admin/update_city';
$route['view-menu'] = 'admin/Admin/view_add_menu';
$route['edit-menu-form/(:any)'] = 'admin/Admin/edit_menu_form';
$route['update_menu_master'] = 'admin/Admin/update_menu_master';
$route['update_sub_menu_master'] = 'admin/Admin/update_sub_menu_master';
$route['sub-menu-form'] = 'admin/Admin/sub_menu_form';
$route['edit-sub-menu-form/(:any)'] = 'admin/Admin/edit_sub_menu_form';
$route['view-sub-menu'] = 'admin/Admin/view_sub_menu';
$route['new-role'] = 'admin/Admin/new_role';
$route['insert_role_master'] = 'admin/Admin/insert_role_master';
$route['edit-role/(:any)'] = 'admin/Admin/edit_role';
$route['update_role_master'] = 'admin/Admin/update_role_master';
$route['view-add-role'] = 'admin/Admin/view_add_role';
$route['add-permission'] = 'admin/Admin/add_permission';
$route['view-add-permission'] = 'admin/Admin/view_add_permission';
$route['insert_permission_master'] = 'admin/Admin/insert_permission_master';
$route['edit-permission/(:any)'] = 'admin/Admin/edit_permission';
$route['update_permission_master'] = 'admin/Admin/update_permission_master';
$route['map-role-permission'] = 'admin/Admin/map_role_permission';
$route['map-role-permission-form-save'] = 'admin/Admin/map_role_permission_form_save';
$route['delete-map-role-permission'] = 'admin/Admin/delete_map_role_permission';
$route['view-map-role-permission/(:any)'] = 'admin/Admin/view_map_role_permission';
$route['edit-map-role-permission/(:any)'] = 'admin/Admin/edit_map_role_permission';
$route['edit-map-role-permission-form-save'] = 'admin/Admin/edit_map_role_permission_form_save';
$route['task-accept'] = 'users/User/task_accept';
$route['task-accept/(:any)'] = 'users/User/task_accept';
$route['reward-point'] = 'users/User/reward_point';
$route['task-report'] = 'users/User/final_task_report';
$route['final-daily-report'] = 'users/User/final_daily_report';
$route['password-match'] = 'users/User/password_match';
$route['task-lists'] = 'users/User/daily_report';
$route['add-daily-data'] = 'users/User/add_daily_data';
$route['fetch-user-info'] = 'admin/Admin/fetch_user_info';
$route['fetch-user-info-intern'] = 'admin/Admin/fetch_intern_info';
$route['intern-send-request'] = 'intern/Intern/send_request';
$route['intern-send-request/(:any)'] = 'intern/Intern/send_request';
$route['search-my-task'] = 'users/User/filter_my_task';
$route['add-report-task-lists'] = 'users/User/add_daily_report';

$route['send-request'] = 'users/User/send_request';
$route['send-request/(:any)'] = 'users/User/send_request';
$route['search-my-task'] = 'users/User/filter_my_task';
$route['add-report-task-lists'] = 'users/User/add_daily_report';
$route['task-reject'] = 'users/User/task_reject';
$route['task-reject/(:any)'] = 'users/User/task_reject';

$route['reward-report'] = 'users/User/reward_report';


$route['dashboard-task-accept'] = 'users/User/dashboard_task_accept';
$route['dashboard-task-accept/(:any)'] = 'users/User/dashboard_task_accept';
$route['intern-dashboard-task-accept'] = 'intern/Intern/intern_dashboard_task_accept';
$route['intern-dashboard-task-accept/(:any)'] = 'intern/Intern/intern_dashboard_task_accept';

$route['dashboard-task-reject'] = 'users/User/dashboard_task_reject';
$route['dashboard-task-reject/(:any)'] = 'users/User/dashboard_task_reject';
$route['daily-report-all-data'] = 'users/User/daily_report_all_data';
$route['daily-report-all-data/(:any)'] = 'users/User/daily_report_all_data';
$route['certificatenew'] = 'users/User/certificate';
$route['view_bronze_certificate/(:any)'] = 'users/User/view_bronze_certificate';

$route['all-city'] = 'login/Login/all_state';
$route['all-city/(:any)'] = 'login/Login/all_state';

$route['all-cities'] = 'login/Login/all_cities';
$route['all-cities/(:any)'] = 'login/Login/all_cities';

$route['fetch-task-info'] = 'admin/Admin/fetch_task_info';
$route['fetch-task-info/(:any)'] = 'admin/Admin/fetch_task_info';
$route['uploadProfileImage'] = 'users/User/uploadProfile';
$route['uploadProfileImageForAdmin'] = 'admin/Admin/uploadProfile';

$route['admin-change-pwd'] = 'admin/Admin/change_password';
$route['admin-change-pwd/(:any)'] = 'admin/Admin/change_password';

$route['search-find-task'] = 'users/User/search_find_task';
$route['final-task-report-filter'] = 'users/User/search_filter_task';
$route['final-daily-filter'] = 'users/User/final_daily_filter';

$route['fetch-daily-report-info'] = 'admin/Admin/daily_report_info';
$route['submission_report'] = 'admin/Admin/submission_report';
$route['fetch-daily-report-intern'] = 'admin/Admin/daily_report_info_intern';

$route['task-members'] = 'users/User/task_member';
$route['task-members/(:any)'] = 'users/User/task_member';
$route['intern-task-members'] = 'intern/Intern/intern_task_member';
$route['intern-task-members/(:any)'] = 'intern/Intern/intern_task_member';

$route['uploadProfileImageForTask'] = 'admin/Admin/uploadProfilefortask';

// $route['dailyreport-approved']='admin/Admin/daily_report_approved';
$route['admin-task-reject/(:any)'] = 'admin/Admin/admin_task_reject';
$route['intern-task-reject/(:any)/(:any)'] = 'admin/Admin/intern_task_reject';
$route['admin-task-accept/(:any)'] = 'admin/Admin/admin_task_accept';
$route['intern-task-accept/(:any)/(:any)'] = 'admin/Admin/intern_task_accept';
$route['dailyreport-approved/(:any)/(:any)/(:any)'] = 'admin/Admin/daily_report_approved';
$route['submission-approved/(:any)/(:any)'] = 'admin/Admin/submission_approved';
$route['interndailyreport-approved/(:any)/(:any)/(:any)'] = 'admin/Admin/intern_daily_report_approved';
$route['disapproved-report'] = 'admin/Admin/daily_report_disapproved';
$route['submission-reportReject'] = 'admin/Admin/submission_reportReject';

$route['dashboard-send-request'] = 'users/User/dashboard_send_request';
$route['dashboard-send-request/(:any)'] = 'users/User/dashboard_send_request';

$route['admin-reward-point'] = 'admin/Admin/admin_reward_point';

$route['account-deactive'] = 'users/User/account_deactive';

$route['requested-task'] = 'admin/Admin/requested_task';
$route['intern-requested-task'] = 'admin/Admin/intern_requested_task';

$route['send-reminder-for-assigned-task_intern/(:any)/(:any)/(:any)'] = 'admin/Admin/send_reminder_intern';
$route['send-reminder-for-assigned-task/(:any)/(:any)/(:any)'] = 'admin/Admin/send_reminder';
$route['cancel-assined-task/(:any)'] = 'admin/Admin/cancel_assined_task';
$route['cancel-assined-task-intern/(:any)'] = 'admin/Admin/cancel_assined_task_intern';

$route['inquiry'] = 'login/Login/inquiry';

$route['patners'] = 'admin/Admin/patners_list';
$route['patners-verify'] = 'admin/Admin/patners_verify';
$route['patners-verify/(:any)'] = 'admin/Admin/patners_verify';
$route['patners-block'] = 'admin/Admin/patners_block';
$route['patners-block/(:any)'] = 'admin/Admin/patners_block';
$route['add-patners'] = 'admin/Admin/add_patners';
$route['edit-patners'] = 'admin/Admin/edit_patners';
$route['edit-patners/(:any)'] = 'admin/Admin/edit_patners';
$route['region-list'] = 'admin/Admin/region_list';
$route['patner-wise-report'] = 'admin/Admin/patner_wise_report';
$route['volenteership-daily-report'] = 'admin/Admin/volenteership_daily_report';
$route['volenteership-daily-report/(:any)'] = 'admin/Admin/volenteership_daily_report';
$route['fetch-daily-report-info-volunteer'] = 'admin/Admin/volenteership_daily_report_info';

$route['partner-csv'] = 'admin/Admin/export';

$route['fetch-daily-report-info-user'] = 'admin/Admin/user_daily_report_info';



/*-----Partners Login--------------*/
$route['partner-login'] = 'login/Login/partner_login';
$route['partner-logout'] = 'login/Login/partner_logout';
$route['partner-dashboard'] = 'partner/Partner/partner_dashboard';
$route['partner-createExcel'] = 'partner/Partner/createExcel';
$route['partner-volunteer'] = 'partner/Partner/partner_volunteer';
$route['fetch-partner-user-info'] = 'partner/Partner/fetch_user_info';
$route['partner-change-pwd'] = 'partner/Partner/change_pwd';
$route['partner-change-pwd/(:any)'] = 'partner/Partner/change_pwd';
$route['partner-profile'] = 'partner/Partner/partner_profile';
$route['partner-volunteer-task'] = 'partner/Partner/partner_volunteer_task';
$route['view-task-info'] = 'partner/Partner/partner_volunteer_task_info';
$route['view-task-info/(:any)'] = 'partner/Partner/partner_volunteer_task_info';
$route['daily-report-volunteer'] = 'partner/Partner/daily_report_volunteer';
$route['fetch-daily-report'] = 'partner/Partner/daily_report_volunteer_info';
$route['uploadProfileImageForPartner'] = 'partner/partner/uploadProfile';




/*-----OTP Process---*/

$route['otp/(:any)/(:any)'] = 'login/Login/otp';
$route['verfy-mobile-otp'] = 'login/Login/verfy_mobile_otp';


$route['referal-link'] = 'users/User/referal_link';
$route['referral-register/(:any)'] = 'users/User/consultant_register';

$route['self-task-daily-report'] = 'users/User/self_task_daily_report';
$route['view-self-task-report'] = 'admin/Admin/view_self_task_report';
$route['view-self-task-report/(:any)'] = 'admin/Admin/view_self_task_report';
$route['dailyreport-self-approved/(:any)/(:any)/(:any)/(:any)'] = 'admin/Admin/daily_report_self_approved';
$route['dailyreport-self-disapproved/(:any)/(:any)/(:any)/(:any)'] = 'admin/Admin/daily_report_self_disapproved';
$route['self-task-view-daily-report'] = 'users/User/self_task_view_daily_report';
$route['donation-report'] = 'users/User/donation_report';
$route['donate_user'] = 'admin/Admin/donate_user';
$route['admin-users-daily-report'] = 'admin/Admin/admin_users_daily_report';
$route['admin-users-donation-report'] = 'admin/Admin/admin_users_donation_report';
$route['send'] = 'login/Login/sendOTP';
$route['otp-login'] = 'login/Login/otp_login';
$route['verfy-login-otp'] = 'login/Login/verfy_login_otp';
$route['admin-self-task-daily-report'] = 'admin/Admin/admin_self_task_daily_report';
$route['fetch-self-daily-report-info'] = 'admin/Admin/fetch_self_daily_report_info';
$route['intern-dashbord'] = 'intern/Intern/dashboard';
$route['intern-task'] = 'intern/Intern/task';
$route['intern-find-task'] = 'intern/Intern/find_task';
$route['intern-add-daily-report'] = 'intern/Intern/add_daily_report';
//$route['intern-find-task/(:any)'] = 'intern/Intern/add_daily_report';
$route['intern-self-task-daily-report'] = 'intern/Intern/intern_self_task_daily_report';
$route['intern-self-task-view-daily-report'] = 'intern/Intern/intern_self_task_view_daily_report';
$route['intern-daily-report'] = 'intern/Intern/daily_report';
$route['intern-daily-report'] = 'intern/Intern/daily_report';
$route['intern-claim-certificate'] = 'intern/Intern/certificate';
$route['intern-claim-certificate'] = 'intern/Intern/certificate';
$route['daily-report-all-data'] = 'intern/Intern/daily_report_all_data';
$route['daily-report-all-data/(:any)'] = 'intern/Intern/daily_report_all_data';
$route['intern-profile'] = 'intern/Intern/profile';
$route['intern-profile/(:any)'] = 'intern/intern/profile';
$route['intern-edit-profile'] = 'intern/Intern/edit_profile';
$route['intern-edit-profile/(:any)'] = 'intern/intern/edit_profile';
$route['intern-login'] = 'intern/Intern/intern_login';
$route['volunteer-login'] = 'users/User/volunteer_login';
$route['intern_logout'] = 'intern/Intern/intern_logout';
$route['intern_logout/(:any)'] = 'intern/Intern/intern_logout';
$route['request-certificate'] = 'admin/Admin/request_certificate';
$route['request-certificate/(:any)'] = 'admin/Admin/request_certificate';
$route['intern-request-certificate'] = 'admin/Admin_new/intern_request_certificate';
//$route['intern-request-certificate/(:any)'] = 'admin/Admin_new/intern_request_certificate';
$route['applied-candidates'] = 'admin/Admin/applied_candidates';
$route['applied-candidates/(:any)'] = 'admin/Admin/applied_candidates';
$route['hr-process'] = 'admin/Admin/hr_process';
$route['update_offer_latter'] = 'admin/Hr_proccess/update_offer_latter';
$route['hr-process/(:any)'] = 'admin/Admin/hr_process';
$route['view-onboarding-candidate'] = 'admin/Admin/view_onboarding_candidate';
$route['enquiry'] = 'admin/Volunteer/enquiry';
$route['send_orientation_emails'] = 'admin/Admin/send_orientation_emails';
$route['offer_lattersend_orientation_emails'] = 'admin/Admin/offer_lattersend_orientation_emails';
$route['send_certificate_emails'] = 'admin/Admin/send_certificate_emails';
$route['send_postRegistration_emailsLink'] = 'admin/Admin/send_postRegistration_emailsLink';
$route['send_volunteerstateUpdate_email'] = 'admin/Admin/send_volunteerstateUpdate_email';
$route['send_internstateUpdate_email'] = 'admin/Admin/send_internstateUpdate_email';
$route['send_loginCredntional_emails'] = 'admin/Admin/send_loginCredntional_emails';
$route['ragistration-volunteer'] = 'admin/Volunteer/ragistration_volunteer';
$route['get-states'] = 'login/Login/get_states';
//$route['get-states-admin-dashbord'] = 'admin/Admin/get_states';
$route['get-states-admin'] = 'admin/Admin/get_states';
$route['get-district-admin'] = 'admin/Admin/get_district_admin';
$route['get-city-by-task'] = 'admin/Admin/get_city_by_task';
$route['get-states-by-task'] = 'admin/Admin/get_states_by_task';
$route['get-city-admin'] = 'admin/Admin/get_city';
$route['get-city'] = 'login/Login/get_city';
$route['thank-you'] = 'login/Login/thank_you';
$route['progrmaVolunteer-thankYou/(:any)'] = 'login/Login/progrmaVolunteer_thankYou';
$route['program-volunteerFulldetails/(:any)'] = 'login/Login/program_volunteerFulldetails';
$route['insert_preregistration_data'] = 'login/Login/insert_preregistration_data';
$route['insert_volunteer_programs'] = 'login/Login/insert_volunteer_programs';
$route['email-ajax-check'] = 'login/Login/email_ajax_check';
$route['volunteer-programs-email-ajax-check'] = 'login/Login/volunteer_programs_email_ajax_check';
$route['create-emailOtp'] = 'login/Login/create_emailOtp';
//$route['volunteer-programs-create-emailOtp'] = 'login/Login/volunteer_programs_create_emailOtp';
$route['volunteer-programs-Createmailotp'] = 'login/Login/volunteer_programsCreatemailotp';

$route['preregistration_sendMail'] = 'login/Login/preregistration_sendMail';
$route['volunteer-programs-preregistration_sendMail'] = 'login/Login/volunteer_programspre_registration_sendMail';
$route['volunteer-logout'] = 'users/User/volunteer_logout';
$route['email_template'] = 'admin/Admin/email_template';
$route['create-template'] = 'admin/Admin/create_template';
$route['insert_template_data'] = 'admin/Admin/insert_template_data';
$route['edit-email-template/(:any)'] = 'admin/Admin/edit_email_template';
$route['update_template_data'] = 'admin/Admin/update_template_data';
$route['getonline_offlineTask'] = 'admin/Admin/getonline_offlineTask';
$route['interngetonline_offlineTask'] = 'admin/Admin/interngetonline_offlineTask';
$route['getTaskstate'] = 'admin/Admin/getTaskstate';
$route['interngetTaskstate'] = 'admin/Admin/interngetTaskstate';
$route['getTaskcity'] = 'admin/Admin/getTaskcity';
$route['update_profile'] = 'users/User/update_profile';
$route['admin-task-reject/(:any)/(:any)'] = 'admin/Admin/admin_task_reject';
$route['admin-task-accept/(:any)/(:any)'] = 'admin/Admin/admin_task_accept';
$route['getStatetask'] = 'admin/Admin/getStatetask';
$route['interngetStatetask'] = 'admin/Admin/interngetStatetask';

//=================UI Design by Amisha Singh==============================
$route['transfer-city'] = 'intern/Intern/transfer_city';
$route['transfer-intern-city'] = 'users/User/transfer_intern_city';
$route['insert_intern_transfer'] = 'intern/Intern/insert_intern_transfer';
$route['insert_daily_report'] = 'intern/Intern/insert_daily_report';
$route['program-list'] = 'admin/Program_volunteer/program_list';
$route['create-program'] = 'admin/Program_volunteer/create_program';
$route['edit-created-program/(:any)'] = 'admin/Program_volunteer/edit_program_volunteer';
$route['insert-program'] = 'admin/Program_volunteer/insert_program';
$route['update-program'] = 'admin/Program_volunteer/update_program';
$route['volunteer-list'] = 'admin/Program_volunteer/volunteer_list';
$route['program-volunteer'] = 'admin/Admin/program_volunteer';
$route['issue-certificate'] = 'admin/Program_volunteer/issue_certificate';
$route['share-link'] = 'admin/Program_volunteer/share_link';
$route['interntransfer-form'] = 'intern/Intern/transfer_form';
$route['transfer-table'] = 'admin/Admin/transfer_table';
$route['voleentur-transfer-table'] = 'admin/Admin/voleentur_transfer_table';
$route['transfer-form'] = 'users/User/transfer_form';
$route['insert_volunteer_transfer'] = 'users/User/insert_volunteer_transfer';
$route['add-country'] = 'admin/Admin/add_country';
$route['insert_country'] = 'admin/Admin/insert_country';
$route['submission_reports'] = 'admin/Admin/submission_reports';
$route['volunteer-program-report'] = 'admin/Admin/volunteer_program_report';
$route['intern-transfer-report'] = 'admin/Admin/intern_transfer_report';
$route['volunteer-transfer-report'] = 'admin/Admin/volunteer_transfer_report';
$route['updatePresent_volunteer'] = 'admin/Admin/updatePresent_volunteer';
$route['sendCertificate'] = 'admin/Admin/sendCertificate';
$route['intern-transfer-form'] = 'intern/Intern/intern_transfer_form';
$route['intern-transfer-report'] = 'intern/Intern/intern_transfer_report';
$route['transfer-report'] = 'users/User/transfer_report';

//---------------------hr Process for Pranshi mam -------------------------
$route['shortlist_status_update'] = 'admin/Hr_proccess/shortlist_status_update';
$route['get_same_day_schedule_user_count'] = 'admin/Hr_proccess/get_same_day_schedule_user_count';
$route['save_interview_schedule_data'] = 'admin/Hr_proccess/save_interview_schedule_data';
$route['clear_interview'] = 'admin/Hr_proccess/clear_interview';
$route['ongoing_interview'] = 'admin/Hr_proccess/ongoing_interview';
$route['reject_interview'] = 'admin/Hr_proccess/reject_interview';
$route['update_job_schedule_data'] = 'admin/Hr_proccess/update_job_schedule_data';
$route['mail_interview_data'] = 'admin/Hr_proccess/mail_interview_data';
$route['interview_final_mail'] = 'admin/Hr_proccess/interview_final_mail';
$route['send_offer_to_user'] = 'admin/Hr_proccess/send_offer_to_user';
$route['shortlist_mail'] = 'admin/Hr_proccess/shortlist_mail';
$route['send_offerLetter_emails/(:any)'] = 'admin/Hr_proccess/send_offerLetter_emails';
$route['send_certificate_on_mail/(:any)'] = 'admin/Admin_new/send_certificate_on_mail';
$route['confirm_joining'] = 'admin/Hr_proccess/confirm_joining';
$route['view_offer_letter/(:any)'] = 'admin/Hr_proccess/view_offer_letter';
$route['view_certificate/(:any)'] = 'admin/Admin_new/view_certificate';

// =================Route by Amisha Singh <!---29/12/2022-->==============================
$route['pre-registration-intern-report'] = 'admin/Intern_report/pre_registration_intern_report';
$route['post-registration-intern-report'] = 'admin/Intern_report/post_registration_intern_report';
$route['intern-task-report'] = 'admin/Admin/intern_tast_report';
$route['intern-self-task-daily-report'] = 'admin/Admin/intern_self_task_daily_report';
$route['intern-transfer-report'] = 'admin/Admin/intern_transfer_report';
$route['sent-certificate'] = 'admin/Intern_report/intern_certificate_report';
$route['volunteer-certificate-report'] = 'admin/Admin/volunteer_certificate_report';
$route['intern-assign-task'] = 'admin/Admin/intern_assign_task';
$route['volunteer-assign-task'] = 'admin/Volunteer_report/volunteer_assign_task';
$route['intern-assign-task-report'] = 'admin/Intern_report/intern_assign_task_report';
$route['pre-registration-volunteer-report'] = 'admin/Volunteer_report/pre_registration_volunteer_report';
$route['post-registration-volunteer-report'] = 'admin/Volunteer_report/post_registration_volunteer_report';
$route['onboard-volunteer'] = 'admin/Volunteer_report/onboard_volunteer';
$route['onboard-volunteer/(:num)'] = 'admin/Admin/onboard_volunteer';
$route['volunteer-self-task-daily-report'] = 'admin/Admin/volunteer_self_task_daily_report';
$route['submission-report'] = 'intern/Intern/submission_report';
$route['feedback'] = 'intern/Intern/feedback';
$route['insert_submission_report'] = 'intern/Intern/insert_submission_report';
$route['insert_feedback'] = 'intern/Intern/insert_feedback';
$route['all-onboard-intern'] = 'admin/Intern_report/all_onboard_intern';
$route['rate_and_review'] = 'admin/Admin/rate_and_review';
$route['view_rating/(:any)'] = 'admin/Admin/view_rating';
$route['update_certificate_data'] = 'admin/Admin_new/update_certificate_data';
$route['designation'] = 'admin/Admin_new/designation';
$route['add-designation'] = 'admin/Admin_new/add_designation';
$route['insert_designation_master'] = 'admin/Admin_new/insert_designation_master';
$route['edit-designation/(:any)'] = 'admin/Admin_new/edit_designation';
$route['update_designation_master'] = 'admin/Admin_new/update_designation_master';
$route['user-form'] = 'intern/intern/user_form';
$route['export_to_excel'] = 'admin/Volunteer_report/export_to_excel';
$route['partner-csv'] = 'admin/Volunteer_report/export';
$route['shortlisted-intern'] = 'admin/Intern_report/shortlisted_intern';
$route['deactive_account'] = 'intern/Intern/deactive_account';
$route['upload_id_proff'] = 'login/Login/upload_id_proff';
$route['upload_add_proof_attach'] = 'login/Login/upload_add_proof_attach';
$route['upload_cv_attach'] = 'login/Login/upload_cv_attach';
$route['upload_ref_attach'] = 'login/Login/upload_ref_attach';
$route['upload_letter_parents_attach'] = 'login/Login/upload_letter_parents_attach';
$route['upload_close_up_photo'] = 'login/Login/upload_close_up_photo';