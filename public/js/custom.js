$(document).ready(function() {

    // STAFF NO DATA ROW
    let tables = document.querySelectorAll('#myRequests');
    for (let i = 0; i < tables.length; i++) {
        const myrows = tables[i];
        if (myrows.rows.length == 0) {
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
        if (requestRows.rows.length == 0) {
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
        if (requestHistoryRows.rows.length == 0) {
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
    $('.modal').modal({
        dismissible: true
    });

    $('.dropdown-trigger').dropdown();
    $('.admin-dropdown-trigger').dropdown({
        onCloseEnd: function() {
            axios.get('/admin/clear-notification')
                .then(function(response) {
                    if (response.data.status) {
                        $('.admin-notifications > li').hide(function() {
                            $('.notificationCount').html(0)
                            $('.notificationCount').addClass('blue');
                        });
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .finally(function() {
                    // always executed
                });
        }
    });
    $('.personnel-dropdown-trigger').dropdown({
        onCloseEnd: function() {
            axios.get('/personnel/clear-notification')
                .then(function(response) {
                    if (response.data.status) {
                        $('.staff-notifications > li').hide(function() {
                            $('.notificationCount').html(0);
                            $('.notificationCount').addClass('blue');
                        });
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .finally(function() {
                    // always executed
                });
        }
    });
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

    $('.item').click(function(event) {
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

    $('#newVisitorForm').submit(function(event) {
        // event.preventDefault();
        $('.newVisitorSubmit').prop('disabled', true);
        $('.newVisitorSubmit').siblings('button').prop('disabled', true);
        $(this).siblings('.progress').show('fade');
    });
});

// ANIMALE LOGIN/REG BUTTON
function submitForm(e) {
    // e.preventDefault();

    $('.btn_login, .btn_login:focus').css({
        'background': 'transparent',
        'border': 'none'
    });
    $('.btn_login').removeClass('btn');
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
}


// LOAD NOTIFICATION ASYNC
function loadNotification(base_url) {
    let count = $('.notificationCount')[0].innerHTML;
    axios.get('/personnel/load-notification/' + count)
        .then(function(response) {
            response.data.newCount != 0 ? $('.notificationCount').removeClass('blue') : '';
            if (response.data.greater) {
                $(`
                <li>
                    <a href="#">
                        <i class="material-icons">monetization_on</i>
                        <div class='notMsg'>
                            <p>${response.data.data.data.data.msg}</p>
                            <sub data-livestamp="${moment.tz(response.data.data.created_at, 'Africa/Lagos')}"></sub>
                        </div>
                        
                    </a>
                </li>
            `).prependTo("#notifications");


                ion.sound({
                    sounds: [{
                        name: "door_bell"
                    }],
                    volume: 0.5,
                    path: base_url + "/sounds/",
                    preload: true
                });
                ion.sound.play("door_bell");
                console.log(response.data.data);
                window.setInterval(function() {
                    location.reload();
                }, 4000);
            }
            $('.notificationCount').html(response.data.newCount);

        })
        .catch(function(error) {
            // handle error
            console.log(error);
        })
        .finally(function() {
            // always executed
        });
}

// LOAD NOTIFICATION ASYNC
function loadAdminNotification(base_url) {
    let count = $('.notificationCount')[0].innerHTML;
    axios.get('/admin/load-notification/' + count)
        .then(function(response) {
            response.data.newCount != 0 ? $('.notificationCount').removeClass('blue') : '';
            if (response.data.greater) {
                $(`
                <li>
                    <a href="#">
                        <i class="material-icons">monetization_on</i>
                        <div class='notMsg'>
                            <p>${response.data.data.data.data.msg}</p>
                            <sub>
                                From: ${response.data.data.data.data.staff} (${response.data.data.data.data.office})<br />
                                <span data-livestamp="${moment.tz(response.data.data.created_at, 'Africa/Lagos')}"></span>
                            </sub>
                        </div>
                        
                    </a>
                </li>
            `).prependTo("#notifications");


                ion.sound({
                    sounds: [{
                        name: "door_bell"
                    }],
                    volume: 0.5,
                    path: base_url + "/sounds/",
                    preload: true
                });
                ion.sound.play("door_bell");
                console.log(response.data.data);
                window.setInterval(function() {
                    location.reload();
                }, 4000);
            }
            $('.notificationCount').html(response.data.newCount);

        })
        .catch(function(error) {
            // handle error
            console.log(error);
        })
        .finally(function() {
            // always executed
        });
}