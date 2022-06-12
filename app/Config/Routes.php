<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('contact', 'Home::contact');
$routes->get('login', 'Home::Login_Page');
$routes->get('logout', 'Home::Logout');
$routes->get('registration', 'Home::Registration_Page');
$routes->get('search', 'Home::Search_Page');


$routes->group('admin', function($routes){
    $routes->get('/', 'Admin::index');
    $routes->post('confirm', 'Admin::confirm');

    $routes->get('address','Address::index');
    $routes->get('vaccine','Vaccine::index');

    $routes->get('address','Address::index');
    $routes->get('address/list','Address::list');
    $routes->post('address/save', 'Address::save');
    $routes->get('address/get-by-id', 'Address::getById');
    $routes->post('address/delete', 'Address::delete');

    $routes->get('vaccine','Vaccine::index');
    $routes->get('vaccine/list','Vaccine::list');
    $routes->post('vaccine/save', 'Vaccine::save');
    $routes->get('vaccine/get-by-id', 'Vaccine::getById');
    $routes->post('vaccine/delete', 'Vaccine::delete');

    $routes->group('api', function($routes){
        $routes->post('add_vaccine', 'Home::Add_Vaccine_API');
        $routes->post('update_vaccine', 'Home::Update_Vaccine_API');
        $routes->post('delete_vaccine', 'Home::Delete_Vaccine_API');
        $routes->post('add_place', 'Home::Add_Place_API');
        $routes->post('update_place', 'Home::Update_Place_API');
        $routes->post('delete_place', 'Home::Delete_Place_API');
        $routes->get('list_people', 'Admin::List_People_API');
        $routes->post('update_information', 'Home::Update_Information_API');
        $routes->post('delete_information', 'Home::Delete_Information_API');
        $routes->get('total_vaccine', 'Home::Total_Vaccine_API');
        $routes->get('total_injected', 'Home::Total_Injected_API');
        $routes->get('total_not_injected_yet', 'Home::Total_Not_Injected_Yet_API');
        $routes->get('total_people_injecting', 'Home::Total_People_Injecting_API');
        
    });
});

$routes->group('api', function($routes){
    $routes->post('register', 'Home::Register_API');
    $routes->post('login', 'Home::Login_API');
    $routes->post('registration', 'Home::Registration_API');
    $routes->post('search', 'Home::Search_API');

});


/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
