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
