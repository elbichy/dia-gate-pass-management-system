$(document).ready(function () {

    // STAFF NO DATA ROW
    let tables = document.querySelectorAll('#myRequests');
    for (let i = 0; i < tables.length; i++) {
        const myrows = tables[i];
        if(myrows.rows.length == 0){
            myrows.innerHTML = `
                <tr style="padding:14px 0;">
                    <td colspan="5">No records available<td>
                </tr>
            `;
        }
    }
    
    // ADMIN NO DATA ROW
    let requestsApprovaltables = document.querySelectorAll('#requestsApproval');
    for (let i = 0; i < requestsApprovaltables.length; i++) {
        const requestRows = requestsApprovaltables[i];
        if(requestRows.rows.length == 0){
            requestRows.innerHTML = `
                <tr style="padding:14px 0;">
                    <td colspan="7">No records available<td>
                </tr>
            `;
        }
    }
    
    // ADMIN HISTORY NO DATA ROW
    let requestsApprovaltablesHistory = document.querySelectorAll('#requestsApprovalHistory');
    for (let i = 0; i < requestsApprovaltablesHistory.length; i++) {
        const requestHistoryRows = requestsApprovaltablesHistory[i];
        if(requestHistoryRows.rows.length == 0){
            requestHistoryRows.innerHTML = `
                <tr style="padding:14px 0;">
                    <td colspan="4">No records available<td>
                </tr>
            `;
        }
    }
    

    // MATERIALIZE INITS
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    $('.modal').modal({
        dismissible: true
    });
    $(".dropdown-trigger").dropdown();
    $('.materialboxed').materialbox();
    $('select').formSelect();
    $('#selectBranch').formSelect();
    $('.nav-wrapper .dropdown-content li').click(function(e){
        $('form.switchBranch').submit();
    });
    $('.addSaleSubmitBtn').click(function(e){
        $('form.addSalesForm').submit();
    });
    $('.timepicker').timepicker({
        defaultTime: '9:00',
        showClearBtn: true
    });
    $('.tabs').tabs({
        swipeable: false
    });

    // DELETE MY REQUEST
    $('.deleteRequest').click(e => {
        let requestid = e.currentTarget.dataset.requestid;
        $('#deleterequestid').val(requestid);
        let confirmIt = confirm('Are you sure you want to cancel this request?');
        confirmIt ? $('#deleteRequestForm').submit() : '';
    });
    
    // APPROVE REQUEST AT GATE
    $('.approveRequest').click(e => {
        let requestid = e.currentTarget.dataset.requestid;
        $('#approverequestid').val(requestid);
        let confirmIt = confirm('Are you sure you want to approve this request?');
        confirmIt ? $('#approveRequestForm').submit() : '';
    });
    
    // DECLINE REQUEST AT GATE
    $('.declineRequestbtn').click(e => {
        let requestid = e.currentTarget.dataset.requestid;
        $('#declinerequestid').val(requestid);
        let confirmIt = confirm('Are you sure you want to decline this request?');
        confirmIt ? $('#declineRequestForm').submit() : '';
    });
    
    // APPROVE REQUEST AT RECEPTION
    $('.approveRequestReception').click(e => {
        let requestid = e.currentTarget.dataset.requestid;
        $('#approverequestid').val(requestid);
        let confirmIt = confirm('Are you sure you want to approve this request?');
        confirmIt ? $('#approveRequestReceptionForm').submit() : '';
    });
    
    // DECLINE REQUEST AT RECEPTION
    $('.declineRequestReceptionbtn').click(e => {
        let requestid = e.currentTarget.dataset.requestid;
        $('#declinerequestid').val(requestid);
        let confirmIt = confirm('Are you sure you want to decline this request?');
        confirmIt ? $('#declineRequestReceptionForm').submit() : '';
    });
});
// GET COORDINATES
    // chrome --unsafely-treat-insecure-origin-as-secure="http://bitssolutions.test"  --user-data-dir=C:\testprofile