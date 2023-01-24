// Radio click redirect to page Report List
const btn = document.querySelector('#generate');
const radioButtons = document.querySelectorAll('input[name="reportList"]');
btn.addEventListener("click", () => {
    let selectedReoprt;
    for (const radioButton of radioButtons) {
        if (radioButton.checked) {
            selectedReoprt = radioButton.id;
            break;
        }
    }
    switch (selectedReoprt) {
        case 'QuotationLowestPrice':
            window.location.assign("quotation-lowest-price");
            break;
        case 'ComperativeStatementQuotationPriceBase':
            window.location.assign("comperative-statement-quotation-price-base");
            break;
        case 'WorkOrderLetter':
            window.location.assign("workorder-letter");
            break;
        case 'VehicleRegWiseAsRespectWorkorder':
            window.location.assign("vehcile-reg-as-respect-workorder");
            break;
        case 'SparePartsWiseAsRespectWorkorder':
            window.location.assign("spare-parts-as-respected-workorder");
            break;
        case 'Supplier':
            window.location.assign("supplier-report");
            break;
        case 'IssueVoucherForm':
            window.location.assign("issue-voucher-form");
            break;
        case 'Repair':
            window.location.assign("repair");
            break;
        case 'DemandForm':
            window.location.assign("demand-form");
            break;
        case 'WorkorderTotal':
            window.location.assign("workorder-total");
            break;
        case 'PartyWorkorderTotal':
            window.location.assign("party-workorder-total");
            break;
        case 'DeadStock':
            window.location.assign("Dead-stock");
            break;
        case 'RepairVehicleList':
            window.location.assign("repair-vehicle-list");
            break;
        default:
            output.innerHTML = selectedReoprt ? `You selected ${selectedReoprt}` : `You haven't selected any report`;

    }


});

// pdf generate for comperative statement
$('.printComporative').on('click', function () {
    $("#Comperative").print({
        globalStyles: true,
        mediaPrint: false,
        stylesheet: null,
        noPrintSelector: ".no-print",
        iframe: true,
        append: null,
        prepend: null,
        manuallyCopyFormValues: true,
        deferred: $.Deferred(),
        timeout: 750,
        title: null,
        doctype: '<!doctype html>'
    });    // select print button with class "print," then on click run callback function
    // $.print("#Comperative"); // inside callback function the section with class "content" will be printed
});


// pdf generate for QuotationLowest Price
$('.printQuotationLowestPrice').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#Quotation"); // inside callback function the section with class "content" will be printed
});


// pdf generate for WorkLetter
$('.printWorkLetter').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#WorkLetter"); // inside callback function the section with class "content" will be printed
});


// pdf generate for vehicle-reg-as-respected Workorder
$('.printVehicleRegWorkorder').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#vehicleRegAsRespectedWorkorder"); // inside callback function the section with class "content" will be printed
});

// pdf generate for spare-parts-as-respected Workorder
$('.spareParts').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#spareParts"); // inside callback function the section with class "content" will be printed
});


// pdf generate for supplier
$('.supplier').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#supplier"); // inside callback function the section with class "content" will be printed
});

// pdf generate for repair
$('.repair').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#repair"); // inside callback function the section with class "content" will be printed
});

// pdf generate for demand-from
$('.demand-from').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#demandFrom"); // inside callback function the section with class "content" will be printed
});


// pdf generate for workorderTotal
$('.workorderTotal').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#workorderTotal"); // inside callback function the section with class "content" will be printed
});

// pdf generate for deadStock
$('.deadStock').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#deadStock"); // inside callback function the section with class "content" will be printed
});

// pdf generate for repair vehicleList
$('.vehicleList').on('click', function () { // select print button with class "print," then on click run callback function
    $.print("#vehicleList"); // inside callback function the section with class "content" will be printed
});
