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
$route['default_controller'] = 'productsController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//////Własne przekierowania/////////
    ////Kategorie////
$route['editKatPage'] = 'categoryController/editCatPage';   //Strona do edycji kategori
$route['podkat/(:num)'] = 'categoryController/getPodKategorie'; //Pobieranie podkategori
$route['addKat'] = 'categoryController/dodKategorie';   //Dodawanie kategori
$route['addPodKat'] = 'categoryController/dodPodKategorie'; //Dodawanie podkategori
$route['editKat'] = 'categoryController/editKategorie'; //Edytowanie kategori
$route['editPodKat'] = 'categoryController/editPodKategorie'; //Edytowanie podkategori
    ////Użytkownicy////
$route['users/(:num)'] = 'userController/userList'; //Wys. Użytkowników
$route['users'] = 'userController/userList';    //Wys. Użytkowników
$route['login'] = 'userController/loginFormUser'; //Formularz logowania
$route['logout'] = 'userController/wyloguj';    //Wylogowywanie
$route['register'] = 'userController/addFormUser';   //Formularz dodawania użytkownika
$route['edit'] = 'userController/editFormUser'; //Formularz edycji użytkownika
$route['loginF'] = 'userController/login'; //Funkcja logowania
$route['registerF'] = 'userController/addUser'; //Funkcja dodawania użytkownika
$route['editF'] = 'userController/editUser';    //Funkcja edycji użytkownika
    ////Produkty////
$route['addProdukt'] = 'productsController/addFormProduct'; //Formularz dodawania produktu
$route['editProdukt/(:num)'] = 'productsController/editFormProduct';    //Formularz edycji produktu
$route['addProduktF'] = 'productsController/addProduct';    //Funkcja dodawania produktu
$route['editProduktF'] = 'productsController/editProduct';  //Funkcja edycji produktu
$route['categoryPageLG'] = 'productsController/productCategoryPageLinkGenerator';  //Funkcja do tworzenia linków
$route['categoryPage/(:num)/(:num)/(:num)'] = 'productsController/productCategoryPage'; //Wyświetlanie strony z produktami
$route['categoryPage/(:num)/(:num)'] = 'productsController/productCategoryPage';    //Wyświetlanie strony z produktami
$route['product/(:num)'] = 'productsController/singleProduct';  //Pojedynczy produkt
$route['selectProductToEdit'] = 'productsController/selectProduct'; //Formularz wybierania produktu do edycji
$route['productSel/(:num)/(:num)'] = 'productsController/produktySel'; //Wybieranie produktu do edycji
    ////Koszyk////
$route['addToCart/(:num)'] = 'cartController/addToCart'; //Dodawanie do koszyka
$route['cart'] = 'cartController/cartView'; //Wyświetlanie koszyka
$route['cartAct/(:num)'] = 'cartController/cartActualization';  //Aktualizacja Koszyka
$route['cartRemove/(:num)'] = 'cartController/cartRemove';  //Usuwanie z koszyka
$route['checkout'] = 'cartController/cartCheckout'; //Zamawianie koszyka
    ////Statusy////
$route['status'] = 'statusController/statusView';   //Wyświetlanie statusów
$route['editStatus'] = 'statusController/statusEditView';   //Edytowanie statusów
$route['editStatusF/(:num)'] = 'statusController/statusEdit';   //Edytowanie statusów - funkcja