<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$id = $this->uri->segment(2);
$route['default_controller'] = "index";
$route['404_override'] = '';

$route['tentang-kami'] = 'index/about';
$route['kontak'] = 'index/contact';
$route['service'] = 'index/service';
$route['faq'] = 'index/faq';
$route['kredit-mobil'] = 'index/kredit_mobil/'.$id;
$route['kredit-pemilikan-rumah'] = 'index/kredit_perumahan';
$route['product_data'] = 'index/product_data';
$route['add_order'] = 'index/add_order';
$route['konfirmasi-refinance/:any'] = 'index/konfirmasi_refinance/';
$route['succses'] = 'index/succses/';
$route['add_loan'] = 'index/add_loan/';
$route['success/(:any)'] = 'index/success/';
$route['pilihan'] = 'index/pilihan/';
$route['test-email'] = 'index/test_email/';
$route['max_min_interest'] = 'index/max_min_interest';


/* End of file routes.php */
/* Location: ./application/config/routes.php */