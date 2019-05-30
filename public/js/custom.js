$(document).ready(function () {

    // STAFF NO DATA ROW
    let tables = document.querySelectorAll('#myRequests');
    for (let i = 0; i < tables.length; i++) {
        const myrows = tables[i];
        if(myrows.rows.length == 0){
            myrows.innerHTML = `
                <tr style="padding:14px 0;">
                    <td colspan="4">No records available<td>
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
                    <td colspan="6">No records available<td>
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
                    <td colspan="2">No records available<td>
                </tr>
            `;
        }
    }
    

    // MATERIALIZE INITS
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.modal').modal({
        dismissible: true
    });
    $('.dropdown-trigger').dropdown();
    $('select').formSelect();

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

    $('.item').click(function(event){
        // event.preventDefault();
        event.currentTarget.innerHTML = `
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>
            </div>
        `;
    });
    
    $('#loginForm').submit(function(event){
        // event.preventDefault();
        
        $('.btn_login').html(`
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>
            </div>
        `);
        $('.btn_login').css('border', 'none');
        $('.btn_login').css('background', 'transparent');
        $('.btn_login:focus').css('background', 'transparent');
        $('.btn_login').removeClass('btn waves-effect waves-light green darken-2');
    });
    
    $('#newVisitorForm').submit(function(event){
        // event.preventDefault();
        
        $('.newVisitorSubmit').html(`
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>
            </div>
        `);
        $('.newVisitorSubmit').css('border', 'none');
        $('.newVisitorSubmit').css('background', 'transparent');
        $('.newVisitorSubmit').css('margin-top', '6px');
        $('.newVisitorSubmit:focus').css('background', 'transparent');
        $('.newVisitorSubmit').removeClass('btn waves-effect waves-light green darken-2');
        $('.newVisitorSubmit').siblings('button').remove();
    });






});
// GET COORDINATES
    // chrome --unsafely-treat-insecure-origin-as-secure="http://bitssolutions.test"  --user-data-dir=C:\testprofile