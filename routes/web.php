<?php

use App\Http\Controllers\GeneratePartsInformationPdf;
use App\Http\Controllers\GenerateQuotationInformationPdf;
use App\Http\Controllers\GenerateSupplierInformationPdf;
use App\Http\Controllers\GenerateVehicleInformationPdf;
use App\Http\Controllers\GenerateWorkorderInformationPDF;
use App\Http\Controllers\partsInformation;
use App\Http\Controllers\QuotationInformationController;
use App\Http\Controllers\ReportsPDF\CompretiveReoportPDF;
use App\Http\Controllers\ReportsPDF\GeneratePDFall;
use App\Http\Controllers\ReportsPDF\QuotationLowestPriceReportPDF;
use App\Http\Controllers\ReportsPDF\WorkorderLetterReportPDF;
use App\Http\Controllers\WorkorderInformationController;
use App\Http\Livewire\Admin\AdminEditPartsInformation;
use App\Http\Livewire\Admin\AdminEditSupplierInformation;
use App\Http\Livewire\Admin\AdminEditVehicleInformation;
use App\Http\Livewire\Admin\AdminEditWorkorderInformation;
use App\Http\Livewire\Admin\AdminUpdateQuotationInformation;
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
use App\Http\Livewire\SupplierInformationComponent;
use App\Http\Livewire\VehicleInformationComponent;
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
    Route::get('/home', HomeComponent::class)->name('home');
    Route::get('/supplier-information', SupplierInformationComponent::class)->name('suplier-information');

    // Quotation
    Route::get('/quotationInformation', [QuotationInformationController::class, 'index'])->name('quotationInformation');
    Route::post('addQuotationInformation', [QuotationInformationController::class, 'addQuotation'])->name('addQuotationInformation');
    Route::get('deleteQuotation/{id}', [QuotationInformationController::class, 'deleteQuotation'])->name('deleteQuotation');
    Route::get('/findSupplierQuotation', [QuotationInformationController::class, 'findSupplierQuotation'])->name('findSupplierQuotation');
    Route::get('/findVehicleQuotation', [QuotationInformationController::class, 'findVehicleQuotation'])->name('findVehicleQuotation');
    Route::get('/findPrtsQuotation', [QuotationInformationController::class, 'findPrtsQuotation'])->name('findPrtsQuotation');
    Route::post('addFiscalYear', [QuotationInformationController::class, 'addFiscalYear'])->name('addFiscalYear');

    // parts
    Route::get('/parts-information', [partsInformation::class, 'render'])->name('parts-information');
    Route::post('/parts-information', [partsInformation::class, 'addPartsInformation'])->name('addPartsInformation');
    Route::get('/parts-information/{id}', [partsInformation::class, 'deletePartsInfo'])->name('deletePartsInfo');
    Route::get('/findVehicleParts', [partsInformation::class, 'findVehicleParts'])->name('findVehicleParts');
    // vehicles
    Route::get('/vehicle-information', VehicleInformationComponent::class)->name('vehicle-information');

    // Workorders
    Route::get('/workorder-information', [WorkorderInformationController::class, 'render'])->name('workorder-information');
    Route::post('/workorder-information', [WorkorderInformationController::class, 'addWorkorderInformation'])->name('addWorkorderInformation');
    Route::get('/workorder-information/{id}', [WorkorderInformationController::class, 'deleteWorkorder'])->name('deleteWorkorder');
    Route::get('/findSupplier', [WorkorderInformationController::class, 'findSupplier'])->name('findSupplier');
    Route::get('/findVehicle', [WorkorderInformationController::class, 'findVehicle'])->name('findVehicle');
    Route::get('/findParts', [WorkorderInformationController::class, 'findParts'])->name('findParts');
    Route::get('/findVehicleWorkOrder', [WorkorderInformationController::class, 'findVehicleWorkOrder'])->name('findVehicleWorkOrder');


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
    // Supplier Information setup routes
    Route::get('/admin-edit-supplier-information/{supplierid}', AdminEditSupplierInformation::class)->name('admin-edit-supplier');
    Route::get('/pdf-generate-supplier-information/{supplierid}', [GenerateSupplierInformationPdf::class, 'supplierInformation'])->name('pdf-generate-supplier-information');
    Route::get('/pdf-generate-supplier-information', [GenerateSupplierInformationPdf::class, 'allSuppliersInformation'])->name('pdf-generate-all-suppliers-information');

    // parts information setup routes
    Route::get('/admin-edit-parts-information/{parts_id}', AdminEditPartsInformation::class)->name('edit.parts');
    Route::get('/pdf-generate-parts-information/{parts_id}', [GeneratePartsInformationPdf::class, 'partInformation'])->name('pdf-generate-parts-information');
    Route::get('/pdf-generate-parts-information', [GeneratePartsInformationPdf::class, 'allPartsInformation'])->name('pdf-generate-all-parts-information');

    // Vehicle information
    Route::get('/admin-edit-vehicle-information/{vehicle_id}', AdminEditVehicleInformation::class)->name('edit.vehicle');
    Route::get('/pdf-generate-vehicle-information/{vehicle_id}', [GenerateVehicleInformationPdf::class, 'vehicleInformation'])->name('pdf.vehicle');
    Route::get('/pdf-generate-vehicle-information', [GenerateVehicleInformationPdf::class, 'allVehicleInformation'])->name('pdf.all-vehicles');

    //Quotation Information
    Route::get('/admin-update-quotation-information/{quotation_id}', AdminUpdateQuotationInformation::class)->name('edit.quation');
    Route::get('/pdf-generate-quotation-information/{quotation_id}', [GenerateQuotationInformationPdf::class, 'quotationInformation'])->name('pdf.quotation');
    Route::get('/pdf-generate-quotation-information', [GenerateQuotationInformationPdf::class, 'allquotationsInformation'])->name('pdf.all-quotations');

    // Workorder Information
    Route::get('/admin-edit-workorders/{workorder_id}', AdminEditWorkorderInformation::class)->name('edit.workorders');
    Route::get('/pdf-generate-all-workorders', [GenerateWorkorderInformationPDF::class, 'allWorkorders'])->name('pdf.workorders');

    // Report Routes Generate PDF
    Route::get('/comparativeStatement-pdf', [CompretiveReoportPDF::class, 'ComparativeStatementPDF'])->name('pdf.comparartive-statement');
    Route::get('/quotationLowestPrice-pdf', [QuotationLowestPriceReportPDF::class, 'quotationLowestPrice'])->name('pdf.quotationLowestPrice');
    Route::get('/workorderLetter-pdf', [WorkorderLetterReportPDF::class, 'workorderLetterPDF'])->name('pdf.workorderLetter');
    Route::get('/vehicle-reg-wise-as-respected-workorder', [GeneratePDFall::class, 'vehicleRegWiseAsRespectedWorkorder'])->name('vehicle-reg-as-respectedWorkorder');
    Route::get('/spareparts-wise-as-respected-workorder', [GeneratePDFall::class, 'sparePartsWiseAsRespectedWorkorder'])->name('spareparts-reg-as-respectedWorkorder');
    Route::get('/supplier-reportPdf', [GeneratePDFall::class, 'supplierReportPdf'])->name('supplier-reportPdf');
    Route::get('/repair-reportPdf', [GeneratePDFall::class, 'repairReportPdf'])->name('repair-reportPdf');
    Route::get('/demandForm-reportPdf', [GeneratePDFall::class, 'demandFormReoprtPdf'])->name('demandForm-reportPdf');
    Route::get('/workorder-total-reportPdf', [GeneratePDFall::class, 'workorderTotal'])->name('workorder-total-reportPdf');
    Route::get('/repairVehicleList-reportPdf', [GeneratePDFall::class, 'repairVehicleList'])->name('repairVehicleList-reportPdf');
    Route::get('/dead-stock-reportPdf', [GeneratePDFall::class, 'deadStock'])->name('dead-stock-reportPdf');
});
