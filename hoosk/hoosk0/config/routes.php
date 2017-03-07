<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['admin/fb'] = "admin/fb";
$route['sitemap\.xml'] = "Update_sitemap/index";

//$route['sitemap']        = "Sitemap/index";
$route['attachments'] = "Admin/upload";

$route['admin'] = "Admin";
$route['admin/status/(:any)'] = "Admin/index/$1";
$route['admin/assessment_dashboard'] = "Admin/assessment_dashboard";
$route['admin/assessment_dashboard/(:any)'] = "Admin/assessment_dashboard/$1";



$route['admin/login'] = "Admin/login";
$route['admin/login/check'] = "Admin/loginCheck";
$route['admin/logout'] = "Admin/logout";
$route['admin/users'] = "Users";
$route['admin/users/new'] = "Users/addUser";
$route['admin/users/new/add'] = "Users/confirm";
$route['admin/users/delete/(:any)'] = "Users/delete";
$route['admin/users/edit/(:any)'] = "Users/editUser";
$route['admin/users/edited/(:any)'] = "Users/edited";
$route['admin/user/forgot'] = 'Admin/users/forgot'; //
$route['admin/users/(:any)'] = "Users";
$route['admin/reset/(:any)'] = 'Admin/users/getPassword'; //
$route['admin/pages'] = "Pages";

$route['admin/users/email'] = "Users/email"; 
$route['admin/users/email/(:any)'] = "Users/email/$1";
$route['admin/users/single_email'] = "Users/single_email";
$route['admin/users/single_email/(:any)'] = "Users/single_email/$1";

$route['admin/users/single_email_content'] = "Users/single_email_content";


$route['admin/users/single_email_content/(:any)'] = "Users/single_email_content/$1";

$route['admin/users/send_email'] = "Users/send_email";  
$route['admin/users/send_email/(:any)'] = "Users/send_email/$1"; 
$route['admin/users/sent'] = "Users/sent"; 
$route['admin/users/sent/listing'] = "Users/sent/listing"; 
$route['admin/users/sent/delete'] = "Users/sent/delete"; 
 
  
 


//Add of Esic Weebly Live

// manage pre assessment profile
$route['admin/manage_profile']        = "Admin/manage_profile";
$route['admin/manage_profile/(:any)'] = "Admin/manage_profile/$1";
 



$route['admin/assessments_list']        = "Admin/assessments_list";
$route['admin/assessments_list/(:any)'] = "Admin/assessments_list/$1";

$route['admin/assessment_list']       	= "Admin/assessment_list";
$route['admin/assessment_list/(:any)']  = "Admin/assessment_list/$1";
$route['admin/publish_assessment_list']  = "Admin/publish_assessment_list";
$route['admin/publish_assessment_list/(:any)']  = "Admin/publish_assessment_list/$1";


//$route['admin/details']      	= "Admin/details";
$route['admin/details/(:any)']      	= "Admin/details/$1";

$route['admin/getanswers']	= "Admin/getanswers";
$route['admin/saveanswer']	= "Admin/saveanswer";
$route['admin/savedate']  	= "Admin/savedate";
$route['admin/savedesc']  	= "Admin/savedesc";
$route['admin/saveshortdesc']	= "Admin/saveshortdesc";
$route['admin/savelogo']		= "Admin/savelogo";
$route['admin/saveBannerImage']  	= "Admin/saveBannerImage";
$route['admin/saveProductImage']  	= "Admin/saveProductImage";
$route['admin/updatename']  	= "Admin/updatename";
$route['admin/resetThumbsUp']  	= "Admin/resetThumbsUp";
$route['admin/updatewebsite']	= "Admin/updatewebsite";
$route['admin/updatecompany']	= "Admin/updatecompany";
$route['admin/updateemail']  	= "Admin/updateemail";
$route['admin/updateip']  		= "Admin/updateip";
$route['admin/updateacn']  		= "Admin/updateacn";
$route['admin/updateAddress']  		= "Admin/updateAddress";

$route['admin/updatebsName']  	= "Admin/updatebsName";
$route['admin/getsectors']		= "Admin/getsectors";
$route['admin/savesector']		= "Admin/savesector";
$route['admin/updateemail']  	= "Admin/updateemail";
$route['admin/updateip']  		= "Admin/updateip";

$route['admin/manage_status']          	= "Admin/manage_status";
$route['admin/manage_status/(:any)']    = "Admin/manage_status/$1";

$route['admin/manage_appstatus']       	= "Admin/manage_appstatus";
$route['admin/manage_appstatus/(:any)'] = "Admin/manage_appstatus/$1";

$route['admin/manage_universities']    		= "Admin/manage_universities";
$route['admin/manage_universities/(:any)']  = "Admin/manage_universities/$1";

$route['admin/manage_sectors']         	= "Admin/manage_sectors";
$route['admin/manage_sectors/(:any)']   = "Admin/manage_sectors/$1";

$route['admin/manage_rd']              	= "Admin/manage_rd";
$route['admin/manage_rd/(:any)']        = "Admin/manage_rd/$1";

$route['admin/manage_acc_commercials'] 			= "Admin/manage_acc_commercials";
$route['admin/manage_acc_commercials/(:any)'] 	= "Admin/manage_acc_commercials/$1";

$route['admin/manage_accelerators']    			= "Admin/manage_accelerators";
$route['admin/manage_accelerators/(:any)']    	= "Admin/manage_accelerators/$1";

$route['admin/showExpDate']  	= "Admin/showExpDate";

$route['contact']  	= "contact/contact_us";
$route['contact/submit']  	= "contact/submit";
$route['contact/submit/(:any)']  	= "contact/submit/$1";
$route['admin/contact/manage_contact']  	= "contact/index";
$route['admin/contact/manage_contact/listing']  	= "contact/manage_contact/listing";
$route['admin/contact/manage_contact/delete']  	= "contact/manage_contact/delete";
$route['admin/contact/view_contact']  	= "contact/view_contact";    // view single email
$route['admin/contact/view_contact/(:any)']  	= "contact/view_contact/$1";
$route['admin/contact/single_email_content']  	= "contact/single_email_content";
$route['admin/contact/single_email_content/(:any)']  	= "contact/single_email_content/$1";  // view NEXT ETC single email 

//admin panel
$route['admin/blog']  	= "Blog"; 
$route['admin/blog/show']=  "Blog/show"; 
$route['admin/blog/show/listing']=  "Blog/show/listing"; 
$route['admin/blog/show/delete']  	= "Blog/show/delete";
$route['admin/blog/show/status']  	= "Blog/show/status";
$route['admin/blog/add_blog']  	= "blog/add_blog";
$route['admin/blog/add_blog/(:any)']  	= "blog/add_blog/$1";
$route['admin/blog/insert_blog']  	= "blog/insert_blog";
$route['admin/blog/insert_blog/(:any)']  	= "blog/insert_blog/$1";
//Comment section
$route['admin/blog/comments']=  "Blog/comments";
$route['admin/blog/comments/listing']=  "Blog/comments/listing"; 
$route['admin/blog/comments/delete']  	= "Blog/comments/delete";
$route['admin/blog/delete_comments']  	= "Blog/delete_comments";
$route['admin/blog/delete_comments/(:any)']  	= "Blog/delete_comments/$1";
$route['admin/blog/delete_comments_reply']  	= "Blog/delete_comments_reply";
$route['admin/blog/delete_comments_reply/(:any)']  	= "Blog/delete_comments_reply/$1";

$route['admin/blog/change_comment_status']       	= "Blog/change_comment_status";
$route['admin/blog/change_comments_reply_status']  	= "Blog/change_comments_reply_status";

//for front end
$route['blog']  	= "blog/lists";
$route['blog/lists']  	= "blog/lists";
$route['blog/lists/(:any)']  	= "blog/lists/$1";
$route['blog/(:any)/(:any)']  	= "blog/details/$1/$2";   //for single blog

$route['blog/insert_comment']  	= "blog/insert_comment";
$route['blog/insert_comment/(:any)']  	= "blog/insert_comment/$1";
$route['blog/insert_comment/(:any)/(:any)']  	= "blog/insert_comment/$1/$2";
 
 
//investor front end Routes nvestor/submit
$route['investor_pre_assessment']  	= "Investor/investor_form";
$route['Investor/submit']  	= "Investor/submit";
$route['Investor/submit/(:any)']  	= "Investor/submit/$1";

$route['Investor/email_check']  	= "Investor/email_check";
$route['Investor/email_check/(:any)']  	= "Investor/email_check/$1";
$route['Investor/password_check']  	= "Investor/password_check";

 
$route['admin/investor_list']        = "Investor/investor_list";
$route['admin/investor/investor_list/listing']        = "Investor/investor_list/listing";
$route['admin/investor_list/(:any)'] = "Investor/investor_list/$1";

$route['admin/investor/investor_list/delete']        = "Investor/investor_list/delete";
$route['admin/investor/investor_list/status']        = "Investor/investor_list/status";
$route['admin/investor/edit_profile']        = "Investor/edit_profile";                   //view investor edit profile
$route['admin/investor/edit_profile/(:any)']        = "Investor/edit_profile/$1";
$route['admin/investor/edit_investor_profile/(:any)']        = "Investor/edit_investor_profile/$1";  // edit investor profile

$route['admin/investor/view_profile']        = "Investor/view_profile";                   //view investor profile
$route['admin/investor/view_profile/(:any)']        = "Investor/view_profile/$1";
 
//upload image for investor 

$route['admin/investor/edit_certificate_picture'] = "Investor/edit_certificate_picture";
$route['admin/investor/edit_certificate_picture/(:any)'] = "Investor/edit_certificate_picture/$1";

$route['admin/investor/edit_profile_picture'] = "Investor/edit_profile_picture";
$route['admin/investor/edit_profile_picture/(:any)'] = "Investor/edit_profile_picture/$1";
 


$route['admin/investor/investor_list/(:any)']        = "Investor/investor_list/$1";
 

// Esic 2 Controller
$route['esic_database']  	= "Esic2/index";
$route['Esic2']  	= "Esic2";
$route['Esic2/index']  			= "Esic2/index";
$route['Esic2/index/(:any)']  	= "Esic2/index/$1";



$route['Esic2/getlist']  		= "Esic2/getlist";
$route['Esic2/getlist/(:any)']  		= "Esic2/getlist/$1";
$route['Esic2/getfilterlist']	= "Esic2/getfilterlist";
$route['Esic2/updatethumbs']	= "Esic2/updatethumbs";

$route['Esic2/info']  		= "Esic2/info";
$route['Esic2/info/(:any)'] = "Esic2/info/$1";

$route['esic_database/company/(:any)'] = "Esicdetails/getdetails/$1";
$route['admin/UpDateSocials']  = "admin/UpDateSocials";
$route['admin/social_creaditional']  = "admin/social_creaditional";



// Esicdetails Controller

$route['Esicdetails']  			 = "Esicdetails";

$route['Esicdetails/getdetails'] = "Esicdetails/getdetails";
$route['Esicdetails/getdetails/(:any)'] = "Esicdetails/getdetails/$1";


// Esicfilter Controller

$route['Esicfilter']  		= "Esicfilter";

$route['Esicfilter/index'] 	= "Esicfilter/index";
$route['Esicfilter/index/(:any)'] = "Esicfilter/index/$1";



// Imagecreate Controller

$route['Imagecreate']  		= "Imagecreate";
$route['Imagecreate/index'] 	= "Imagecreate/index";

$route['Imagecreate/Resize_image'] = "Imagecreate/Resize_image";
$route['Imagecreate/Resize_image/(:any)'] = "Imagecreate/Resize_image/$1"; //1
$route['Imagecreate/Resize_image/(:any)/(:any)'] = "Imagecreate/Resize_image/$1/$2";//2
$route['Imagecreate/Resize_image/(:any)/(:any)/(:any)'] = "Imagecreate/Resize_image/$1/$2/$1";//3
$route['Imagecreate/Resize_image/(:any)/(:any)/(:any)/(:any)'] = "Imagecreate/Resize_image/$1/$2/$3/$4";//4
$route['Imagecreate/Resize_image/(:any)/(:any)/(:any)/(:any)/(:any)'] = "Imagecreate/Resize_image/$1/$2/$3/$5/$6";//5

$route['Imagecreate/Get_file_extension/(:any)'] = "Imagecreate/Get_file_extension/$1";


// Reg Controller
$route['Reg']  = "Reg";
$route['Reg/index'] 	= "Reg/index";
$route['Reg/submit'] 	= "Reg/submit";
$route['Reg/step2'] 	= "Reg/step2";
$route['Reg/addInstitution'] 			= "Reg/addInstitution";
$route['Reg/addRnD'] 					= "Reg/addRnD";
$route['Reg/addIndustryClassification'] = "Reg/addIndustryClassification";
$route['Reg/addEntrepreneurProgramme'] 	= "Reg/addEntrepreneurProgramme";
$route['Reg/addAcceleratorProgramme'] 	= "Reg/addAcceleratorProgramme";

// Reg2 Controller
$route['Reg2']  = "Reg2";
$route['Reg2/index'] 	= "Reg2/index";
//$route['innovators/esic_pre_assessment'] 	= "Reg2/index";
$route['innovators'] 	= "Reg2/index";

$route['Reg2/submit'] 	= "Reg2/submit";
$route['Reg2/step2'] 	= "Reg2/step2";
$route['Reg2/addInstitution'] 			= "Reg2/addInstitution";
$route['Reg2/addRnD'] 					= "Reg2/addRnD";
$route['Reg2/addIndustryClassification'] = "Reg2/addIndustryClassification";
$route['Reg2/addEntrepreneurProgramme'] 	= "Reg2/addEntrepreneurProgramme";
$route['Reg2/addEntrepreneurProgramme/(:any)'] 	= "Reg2/addEntrepreneurProgramme/$1";
$route['Reg2/addAcceleratorProgramme'] 	= "Reg2/addAcceleratorProgramme";

$route['admin/pages/new'] = "Pages/addPage";
$route['admin/pages/new/add'] = "Pages/confirm";
$route['admin/pages/delete/(:any)'] = "Pages/delete";
$route['admin/pages/edit/(:any)'] = "Pages/editPage";
$route['admin/pages/edited/(:any)'] = "Pages/edited";
$route['admin/pages/jumbo/(:any)'] = "Pages/jumbo";
$route['admin/pages/jumbotron/(:any)'] = "Pages/jumboAdd";
$route['admin/pages/(:any)'] = "Pages";
$route['admin/navigation'] = "Navigation";
$route['admin/navigation/new'] = "Navigation/newNav";
$route['admin/navigation/edit/(:any)'] = "Navigation/editNav";
$route['admin/navigation/delete/(:any)'] = "Navigation/deleteNav";
$route['admin/navadd/(:any)'] = "Navigation/navAdd";
$route['admin/navigation/insert'] = "Navigation/insert";
$route['admin/navigation/update/(:any)'] = "Navigation/update";
$route['admin/navigation/(:any)'] = "Navigation";
$route['admin/settings'] = "Admin/settings";
$route['admin/settings/submit'] = "Admin/uploadLogo";
$route['admin/settings/update'] = "Admin/updateSettings";
$route['admin/social'] = "Admin/social";
$route['admin/social/update'] = "Admin/updateSocial";
$route['admin/posts'] = "Posts";
$route['admin/posts/new'] = "Posts/addPost";
$route['admin/posts/new/add'] = "Posts/confirm";
$route['admin/posts/delete/(:any)'] = "Posts/delete";
$route['admin/posts/edit/(:any)'] = "Posts/editPost";
$route['admin/posts/edited/(:any)'] = "Posts/edited";
$route['admin/posts/categories'] = "Categories";
$route['admin/posts/categories/new'] = "Categories/addCategory";
$route['admin/posts/categories/new/add'] = "Categories/confirm";
$route['admin/posts/categories/delete/(:any)'] = "Categories/delete";
$route['admin/posts/categories/edit/(:any)'] = "Categories/editCategory";
$route['admin/posts/categories/edited/(:any)'] = "Categories/edited";
$route['admin/posts/categories/(:any)'] = "Categories";
$route['admin/posts/(:any)'] = "Posts";

$route['category/(:any)'] = "Hoosk_default/category";
$route['article/(:any)'] = "Hoosk_default/article";

$route['(.+)'] = "hoosk_default";

//$route['default_controller'] = "admin";
$route['default_controller'] = "hoosk_default";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;





