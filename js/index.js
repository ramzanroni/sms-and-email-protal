
function alertMessage(title, type) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });
    Toast.fire({
        icon: type,
        title: title
    })
};

// page load
function department()
{
    $.ajax({
        url: "reports/department.php",
        success: function (result) {
			$("#content").html(result);
        }
    }); 
}
function users()
{
    $.ajax({
        url: "reports/users.php",
        success: function (result) {
        $("#content").html(result);
        }
    }); 
}
function templete(action)
{   
    $.ajax({
        url: "reports/smsTemplete.php?type=" + action,
        success: function (result) {
            $("#content").html(result);
        }
    }); 
}

function sms()
{
    $.ajax({
        url: "reports/sendSMS.php",
        success: function (result) {
        $("#content").html(result);
        }
    }); 
}
function smsReport()
{
    $.ajax({
        url: "reports/smsReport.php",
        success: function (result) {
        $("#content").html(result);
        }
    }); 
}
function emailReport()
{
    $.ajax({
        url: "reports/emailReport.php",
        success: function (result) {
        $("#content").html(result);
        }
    }); 
}
function email()
{
    $.ajax({
        url: "reports/sendEmail.php",
        success: function (result) {
        $("#content").html(result);
        }
    }); 
}
// departmentData
function departmentData()
{
    $('#deptModal').modal('show');
    var check="departmentData";
    $.ajax({
        url: "reports/department-action.php",
        type: "POST",
        data: {
            check: check
        },
        success: function (response) {
            $("#deptData").html(response);
        }
    });
}

// addDept
function addDept()
{
    var deptName=$("#deptName").val();
    var check="addDept";
    if(deptName=='')
    {
        $("#deptName").css({ "border": "1px solid red" });
    }
    else
    {
        Swal.fire('Please Wait. Data Loading.');
        Swal.showLoading();
        $.ajax({
            url: "reports/department-action.php",
            type: "POST",
            data: {
                check: check,
                deptName:deptName
            },
            success: function (response) {
                swal.close();
                if(response=='success')
                {
                    alertMessage('Department Add Success', 'success');
                    $('#deptModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    department();
                }
                else{
                    alertMessage(response, 'error');
                }
            }
        });
    }
}

// openEditModal
function openEditModal(id)
{
    $('#deptModal').modal('show');
    var check="editDeptData";
    $.ajax({
        url: "reports/department-action.php",
        type: "POST",
        data: {
            check: check,
            id:id
        },
        success: function (response) {
            $("#deptData").html(response);
        }
    });
}

// updateDept
function updateDept(upId)
{
    var upDeptName=$("#upDeptName").val();
    var check="updateDept";
    if(upDeptName=='')
    {
        $("#upDeptName").css({ "border": "1px solid red" });
    }
    else
    {
        Swal.fire('Please Wait. Data Loading.');
        Swal.showLoading();
        $.ajax({
            url: "reports/department-action.php",
            type: "POST",
            data: {
                check: check,
                upId:upId,
                upDeptName:upDeptName
            },
            success: function (response) {
                swal.close();
                if(response=='success')
                    {
                        alertMessage('Department Update Success', 'success');
                        $('#deptModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        department();
                    }
                    else{
                        alertMessage(response, 'error');
                    }
            }
        });
    }
}

// changeActive
function changeActive(id, action)
{
    var check="updateAction";
    Swal.fire('Please Wait. Data Loading.');
    Swal.showLoading();
    $.ajax({
        url: "reports/department-action.php",
        type: "POST",
        data: {
            check: check,
            id:id,
            action:action
        },
        success: function (response) {
            swal.close();
            if(response=='success')
            {
                alertMessage('Status Change Success', 'success');
                department();
            }
            else{
                alertMessage(response, 'error');
            }
        }
    });
}

// usertData

function usertData()
{
    $('#userModal').modal('show');
    var check="addUserData";
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            check: check
        },
        success: function (response) {
            $("#userData").html(response);
        }
    });
}


// checkPassword
function checkPassword(password)
{
    var testResult;
    var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*_])(?=.{8,12}$)");
  
    $('.error').hide();
    $('.fa-check-circle').hide();
    testResult = regex.test(password);
    if (testResult) {
        $('.password-field').css('border-color', 'green');
        $('.error').hide();
        $("#errorField").val('ok');
        $('.fa-check-circle').show();
    }
    else {
        $('.error').show().css('color', 'red');
        $('.password-field').css('border-color', 'red');
        $('.fa-check-circle').hide();
        $("#errorField").val('');
    }
}
// addUser
function addUser()
{
    var check="addUser";
    var name=$("#name").val();
    var userName=$("#userName").val();
    var userEmail=$("#userEmail").val();
    var userPhone=$("#userPhone").val();
    var userPass=$("#userPass").val();
    var userRole=$("#userRole").val();
    var userDept=$("#userDept").val();
    var error=$("#errorField").val();
    var flag=0;
    if(name=='')
    {
        $("#name").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userName=='')
    {
        $("#userName").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userEmail=='')
    {
        $("#userEmail").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userPhone=='')
    {
        $("#userPhone").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userPass=='')
    {
        $("#userPass").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userRole=='')
    {
        $("#upDeptName").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userDept=='')
    {
        $("#userDept").css({ "border": "1px solid red" });
        flag=1;
    }
    if(flag==0 && error =="ok")
    {
        Swal.fire('Please Wait. Data Loading.');
        Swal.showLoading();
        $.ajax({
            url: "reports/userAction.php",
            type: "POST",
            data: {
                check: check,
                name:name,
                userName:userName,
                userEmail:userEmail,
                userPhone:userPhone,
                userPass:userPass,
                userRole:userRole,
                userDept:userDept
            },
            success: function (response) {
                swal.close();
                if(response=='success')
                {
                    alertMessage('User Add Success.', 'success');
                    $('#userModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    users();
                }
                else{
                    alertMessage(response, 'error');
                }
            }
        });
    }
}
// userEditModal
function userEditModal(id)
{
    var check="userEditData";
    $('#userModal').modal('show');
    var check="addUserDataModal";
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            check: check,
            id:id
        },
        success: function (response) {
            $("#userData").html(response);
        }
    });
}

// userUpdate

function userUpdate(id)
{
    var check="updateUser";
    var nameUp=$("#nameUp").val();
    var userNameUp=$("#userNameUp").val();
    var userEmailUp=$("#userEmailUp").val();
    var userPhoneUp=$("#userPhoneUp").val();
    var userPassUp=$("#userPassUp").val();
    var userRoleUp=$("#userRoleUp").val();
    var userDeptUp=$("#userDeptUp").val();
    var flag=0;
    var error=$("#errorField").val();
    if(nameUp=='')
    {
        $("#nameUp").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userNameUp=='')
    {
        $("#userNameUp").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userEmailUp=='')
    {
        $("#userEmailUp").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userPhoneUp=='')
    {
        $("#userPhoneUp").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userPassUp=='')
    {
        $("#userPassUp").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userRoleUp=='')
    {
        $("#upDeptNameUp").css({ "border": "1px solid red" });
        flag=1;
    }
    if(userDeptUp=='')
    {
        $("#userDeptUp").css({ "border": "1px solid red" });
        flag=1;
    }
    if(flag==0 && error =="ok")
    {
    Swal.fire('Please Wait. Data Loading.');
    Swal.showLoading();
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            check: check,
            id:id,
            nameUp:nameUp,
            userNameUp:userNameUp,
            userEmailUp:userEmailUp,
            userPhoneUp:userPhoneUp,
            userPassUp:userPassUp,
            userRoleUp:userRoleUp,
            userDeptUp:userDeptUp
        },
        success: function (response) {
            swal.close();
            if(response=='success')
            {
                alertMessage('User Update Success.', 'success');
                $('#userModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                users();
            }
            else{
                alertMessage(response, 'error');
            }
        }
    });
}
}

// userActivity
function userActivity(id, action)
{
    var check="userActivity";
    Swal.fire('Please Wait. Data Loading.');
    Swal.showLoading();
    $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
            check: check,
            id:id,
            action:action
        },
        success: function (response) {
            swal.close();
            if(response=='success')
            {
                alertMessage('Activity Change Success', 'success');
                users();
            }
            else{
                alertMessage(response, 'error');
            }
        }
    });
}

// tempModal
function tempModal()
{
    var check="tempModal";
    $('#tempModal').modal('show');
    $.ajax({
        url: "reports/templeteAction.php",
        type: "POST",
        data: {
            check: check
        },
        success: function (response) {
            $("#tempData").html(response);
        }
    });
}

function getType(type)
{
    var check="changeTYpe";
    $.ajax({
        url: "reports/templeteAction.php",
        type: "POST",
        data: {
            check: check,
            type:type
        },
        success: function (response) {
            $("#messageBodyArea").html(response);
        }
    });
}
// addTemplete
function addTemplete()
{
   var check = "storeTemplete";
   var templeteName=$("#templeteName").val();
   var tempType=$("#tempType").val();
   var message_body=CKEDITOR.instances["message_body"].getData();
   var templeteSubject=$("#templeteSubject").val();
   var flag=0;
   if(templeteName=='')
   {
       $("#templeteName").css({ "border": "1px solid red" });
       flag=1;
   }
   if(tempType=='')
   {
       $("#tempType").css({ "border": "1px solid red" });
       flag=1;
   }
   if(message_body=='')
   {
       $("#message_body").css({ "border": "1px solid red" });
       flag=1;
   }
   if(templeteSubject=='')
   {
       $("#templeteSubject").css({"border": "1px solid red"});
        flag=1;
   }
   if(flag==0)
   {
    Swal.fire('Please Wait. Data Loading.');
    Swal.showLoading();
   $.ajax({
    url: "reports/templeteAction.php",
    type: "POST",
    data: {
        check: check,
        templeteName:templeteName,
        tempType:tempType,
        templeteSubject:templeteSubject,
        message_body:message_body
    },
    success: function (response) {
        swal.close();
        if(response=='success')
            {
                alertMessage('Templete Add Success.', 'success');
                $('#tempModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                templete();
            }
            else{
                alertMessage(response, 'error');
            }
    }
});
   }
}

function addSMSTemplete()
{
   var check = "storeTemplete";
   var templeteName=$("#templeteName").val();
   var tempType=$("#tempType").val();
   var message_body=$("#message_body").val();
   var templeteSubject=$("#templeteSubject").val();
   var flag=0;
   if(templeteName=='')
   {
       $("#templeteName").css({ "border": "1px solid red" });
       flag=1;
   }
   if(tempType=='')
   {
       $("#tempType").css({ "border": "1px solid red" });
       flag=1;
   }
   if(message_body=='')
   {
       $("#message_body").css({ "border": "1px solid red" });
       flag=1;
   }
   if(templeteSubject=='')
   {
       $("#templeteSubject").css({"border": "1px solid red"});
        flag=1;
   }
   if(flag==0)
   {
    Swal.fire('Please Wait. Data Loading.');
    Swal.showLoading();
   $.ajax({
    url: "reports/templeteAction.php",
    type: "POST",
    data: {
        check: check,
        templeteName:templeteName,
        tempType:tempType,
        templeteSubject:templeteSubject,
        message_body:message_body
    },
    success: function (response) {
        swal.close();
        if(response=='success')
            {
                alertMessage('Templete Add Success.', 'success');
                $('#tempModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                templete();
            }
            else{
                alertMessage(response, 'error');
            }
    }
});
   }
}


// tempEditModal
function tempEditModal(id)
{
    var check="tempEditView";
    $('#tempModal').modal('show');
    $.ajax({
        url: "reports/templeteAction.php",
        type: "POST",
        data: {
            check: check,
            id:id
        },
        success: function (response) {
            $("#tempData").html(response);
        }
    });
}

// updateTemplete
function updateTemplete(id)
{
    var check = "updateTemplete";
   var templeteNameUp=$("#templeteNameUp").val();
   var tempTypeUp=$("#tempTypeUp").val();
   if(tempTypeUp=="SMS")
   {
    var message_bodyUp=$("#message_bodyUp").val();
   }
   else
   {
    var message_bodyUp=CKEDITOR.instances["message_bodyUp"].getData();
   }
   var templeteSubjectUp=$("#templeteSubjectUp").val();
   var flag=0;
   if(templeteNameUp=='')
   {
       $("#templeteNameUp").css({ "border": "1px solid red" });
       flag=1;
   }
   if(tempTypeUp=='')
   {
       $("#tempTypeUp").css({ "border": "1px solid red" });
       flag=1;
   }
   if(message_bodyUp=='')
   {
       $("#message_bodyUp").css({ "border": "1px solid red" });
       flag=1;
   }
   if(templeteSubjectUp=='')
   {
       $("#templeteSubjectUp").css({ "border": "1px solid red" });
       flag=1;
   }
   if(flag==0)
   {
    Swal.fire('Please Wait. Data Loading.');
    Swal.showLoading();
   $.ajax({
    url: "reports/templeteAction.php",
    type: "POST",
    data: {
        check: check,
        templeteNameUp:templeteNameUp,
        tempTypeUp:tempTypeUp,
        message_bodyUp:message_bodyUp,
        templeteSubjectUp:templeteSubjectUp,
        id:id
    },
    success: function (response) {
        swal.close();
        if(response=='success')
            {
                alertMessage('Templete Update Success.', 'success');
                $('#tempModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                templete();
            }
            else{
                alertMessage(response, 'error');
            }
    }
});
   }
}

// selectSMS
function selectSMS(templeteID)
{
    // $("#message_body").val('');
    var check="selectSMStemp";
    $.ajax({
        url: "reports/templeteAction.php",
        type: "POST",
        dataType: 'json',
        data: {
            check: check,
            templeteID:templeteID
        },
        success: function (response) {
            if(response.role=="User")
            {
                $('#message_body').prop('readonly', true);
                $("#message_body").val(response.message);
            }
            else
            {
                $("#message_body").val(response.message);
            }
        }
    });
}
// selectEmail
function selectEmail(templeteID)
{
    var check="selectEmailtemp";
    $.ajax({
        url: "reports/templeteAction.php",
        type: "post",
        dataType: "json",
        data: {
            check: check,
            templeteID:templeteID
        },
        success: function (response) {
        //   $('#message_body_email').val(response.body);
          CKEDITOR.instances['message_body_email'].setData(response.body)
          $("#subject").val(response.subject);
        }
    });
}
// sendSMS
function sendSMS()
{
    var receiverPhone=$("#receiverPhone").val();
    var message=$("#message_body").val();
    var flag=0;
    if(receiverPhone=='')
    {
        $("#receiverPhone").css({ "border": "1px solid red" });
       flag=1;
    }
    else{
        var firstTwo=receiverPhone.substring(0, 2);
        if(receiverPhone.length>11 || receiverPhone.length<10 || firstTwo !="01")
        {
            flag=1;
            $("#numberErr").html("Please Enter Valid Number");
        }
        else{
            $("#numberErr").html("");
        }
    }
    if(message=='')
    {
        $("#message_body").css({ "border": "1px solid red" });
       flag=1;
    }
   
    
    var check="sendSMS";
    if(flag==0)
    {
        Swal.fire('Please Wait. Data Loading.');
        Swal.showLoading();
        $.ajax({
            url: "reports/smsAction.php",
            type: "POST",
            data: {
                check: check,
                receiverPhone:receiverPhone,
                message:message
            },
            success: function (response) {
                swal.close();
                if(response=='success')
                {
                    alertMessage('SMS Send Success.', 'success');
                    sms();
                }
                else{
                    alertMessage(response, 'error');
                }
            }
        });
    }
    
}


// function sendEmail()
// {
//     alert('ok');
    // var form_data = new FormData();
	// 	var file_data = $('#email_file').prop('files')[0];
	// 	var to_email = $("#receiver_email").val();
	// 	var email_subject = $("#subject").val();
	// 	var email_body = $("#message_body_email").val();
	// 	var cc = $('#cc').val();
    // var check="sendEmail";
    // var flag=0;
    // if(to_email=='')
    // {
    //     $("#receiver_email").css({ "border": "1px solid red" });
    //    flag=1;
    // }
    // if(email_body=='')
    // {
    //     $("#message_body_email").css({ "border": "1px solid red" });
    //    flag=1;
    // }
    // if(email_subject=='')
    // {
    //     $("#subject").css({ "border": "1px solid red" });
    //    flag=1;
    // }

    // if(flag==0)
    // {
    //     form_data.append('email_file', file_data);
	// 	form_data.append('to_email', to_email);
	// 	form_data.append('email_subject', email_subject);
	// 	form_data.append('email_body', email_body);
	// 	form_data.append('cc', cc);
	// 	form_data.append('type', "EMAIL_SEND_DATA_FILE");

    //     Swal.fire('Please Wait. Data Loading.');
    //     Swal.showLoading();
    //     $.ajax({
    //        url: 'reports/sendEmailAction.php',
	// 		dataType: 'text',
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,
	// 		data: form_data,
	// 		type: 'POST',
    //         success: function (response) {
    //             swal.close();
    //             if(response=='success')
    //             {
    //                 alertMessage('Email Send Success.', 'success');
    //                 email();
    //             }
    //             else{
    //                 alertMessage(response, 'error');
    //                 console.log(response);
    //             }
    //         }
    //     });
    // }

// }