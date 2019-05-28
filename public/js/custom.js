$(document).ready(function () {

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