<?php

use App\Http\Controllers\GenerateSupplierInformationPdf;
use App\Http\Livewire\Admin\AdminAddSupplierInformation;
use App\Http\Livewire\Admin\AdminEditSupplierInformation;
use App\Http\Livewire\Component\ComperativeStatementQuotationPriceBase;
use App\Http\Livewire\Component\DeadStock;
use App\Http\Livewire\Component\DemandForm;
use App\Http\Livewire\Component\IssueVoucherForm;
use App\Http\Livewire\Component\PartyWorkOrderTotal;
use App\Http\Livewire\Component\QuotationLowestPrice;
use App\Http\Livewire\Component\Repair;
use App\Http\Livewire\Component\RepairVehicleList;
use App\Http\Livewire\Component\SparePartsWiseAsRespectWorkorder;
use App\Http\Livewire\Component\Supplier;
use App\Http\Livewire\Component\VehicleRegWiseAsRespectWorkorder;
use App\Http\Livewire\Component\WorkorderLetter;
use App\Http\Livewire\Component\WorkorderTotal;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\PartsInformationComponent;
use App\Http\Livewire\PDF\SupplierInformationPdfGenerate;
use App\Http\Livewire\QuotationInformationComponent;
use App\Http\Livewire\SupplierInformationComponent;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/home', HomeComponent::class)->name('home');
    Route::get('/supplier-information', SupplierInformationComponent::class)->name('suplier-information');
    Route::get('/parts-information', PartsInformationComponent::class)->name('parts-information');
    Route::get('/quotation-information', QuotationInformationComponent::class)->name('quotation-information');

    // Report components
    Route::get('/comperative-statement-quotation-price-base', ComperativeStatementQuotationPriceBase::class)->name('comperative-statement-quotation-price-base');
    Route::get('/Dead-stock', DeadStock::class)->name('dead-stcok');
    Route::get('/demand-form', DemandForm::class)->name('demand-family');
    Route::get('/issue-voucher-form', IssueVoucherForm::class)->name('issue-voucher');
    Route::get('/party-workorder-total', PartyWorkOrderTotal::class)->name('party-workorder-total');
    Route::get('/quotation-lowest-price', QuotationLowestPrice::class)->name('quotation-lowest-price');
    Route::get('/repair', Repair::class)->name('repair');
    Route::get('/repair-vehicle-list', RepairVehicleList::class)->name('repair-vehicle-list');
    Route::get('/spare-parts-as-respected-workorder', SparePartsWiseAsRespectWorkorder::class)->name('spare-parts-as-respected-workorder');
    Route::get('/supplier-report', Supplier::class)->name('supplier');
    Route::get('/vehcile-reg-as-respect-workorder', VehicleRegWiseAsRespectWorkorder::class)->name('vehcile-reg-as-respect-workorder');
    Route::get('/workorder-letter', WorkorderLetter::class)->name('workorder-letter');
    Route::get('/workorder-total', WorkorderTotal::class)->name('workorder-total');

    // Admin Routes 
    Route::get('/admin-add-supplier-information', AdminAddSupplierInformation::class)->name('admin-add-supplier');
    Route::get('/admin-edit-supplier-information/{supplierid}', AdminEditSupplierInformation::class)->name('admin-edit-supplier');
    Route::get('/pdf-generate-supplier-information/{supplierid}', [GenerateSupplierInformationPdf::class, 'supplierInformation'])->name('pdf-generate-supplier-information');
    Route::get('/pdf-generate-supplier-information', [GenerateSupplierInformationPdf::class, 'allSuppliersInformation'])->name('pdf-generate-all-suppliers-information');
});
