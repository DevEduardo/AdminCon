<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index');

//Agency
Route::resource('agencias', 'AgencyController');
Route::get('agencia/edit', 'AgencyController@agencyEdit');
Route::get('agencia/password', 'AgencyController@newPassword');
Route::post('password', 'AgencyController@postPassword');

//Condominium
Route::resource('condominios', 'CondominiumController');
Route::get('condominios/{id}/lockOrUnlock', 'CondominiumController@lockOrUnlock');

//Estates
Route::resource('inmuebles', 'EstateController');
Route::get('inmuebles/{id}/lockOrUnlock', 'EstateController@lockOrUnlock');
Route::get('residente/salones', 'EstateController@salon');
Route::get('residente/correos', 'EstateController@email');
Route::get('residente/pagos', 'EstateController@payments');
Route::post('notificacion', 'EstateController@notificacion');
Route::get('getData/{id}', 'EstateController@getData');

//Salons
Route::resource('salones', 'SalonController');
Route::get('reservados', 'SalonController@reservation');
Route::post('reservar/salon', 'SalonController@reserved');
Route::post('reservar/salon/agency', 'SalonController@reservedAgency');
Route::get('property/reservacione', 'SalonController@reservedProperty');
Route::get('alquiler/aprobado/{id}', 'SalonController@approved');

//Expenses
Route::resource('gastos', 'ExpenseController');
Route::post('gastos/mes', 'ExpenseController@index');
Route::get('copy/expense', 'ExpenseController@copy');
Route::get('calcular', 'ExpenseController@calculate');
Route::get('calcular/fondos', 'ExpenseController@calculateFunds');

//Payments
Route::get('inmuebles/pago/{id}', 'EstateController@getPayment');
Route::get('inmuebles/deudas/{id}', 'EstateController@debts');
Route::post('inmuebles/deudas/{id}', 'EstateController@postDebts');
Route::get('pago', 'EstateController@payment');
Route::post('pago', 'EstateController@postPayment');
Route::get('approved/{id}', 'EstateController@approved');
Route::get('deny/{id}', 'EstateController@deny');
Route::get('mora', 'EstateController@mora');
Route::post('mora', 'EstateController@postMora');

//Bills
Route::resource('cuentas', 'BillController');

//Dues
Route::post('pago/deuda', 'DuesController@pago');

//Invoice
Route::get('facturacion/', 'InvoiceController@invoice');
Route::post('agregar/factura', 'InvoiceController@postInvoice');
Route::post('factura/store', 'InvoiceController@storeInvoice');
Route::get('search/invoice/{value}', 'InvoiceController@getInvoice');

//Emails
Route::get('correos', 'EmailController@getEmail');
Route::post('email', 'EmailController@email');
Route::get('envia', 'EmailController@sendEmail');
Route::post('email/admin', 'EmailController@emailAdmin');


//Reports
Route::get('informes', 'ReportController@index');
Route::get('aviso/cobro/{month}', 'ReportController@avisoCobro');
Route::get('informe/gastos/{month}', 'ReportController@informeGatos');
Route::get('cuotas/pendientes/{year}', 'ReportController@cuotasPendientes');
Route::get('facturacion/{month}', 'ReportController@facturas');

//Employees
Route::resource('empleados', 'EmployeeController');
