$(document).ready(function(){

    $('.otp-form').hide();
    $('.mobile-verified').hide();
    

    $('#user-reg-submit').click(function(){
      
        let name =  $("#name").val();
        let mobile =  $("#mobile").val();
        let email =  $("#email").val();
        let block =  $("#block").val();
        let flat_number =  $("#flat_number").val();
        let type =  $("#type").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $("#register_form").validate({
     
         rules: {
            name: {
                required: true,
                maxlength: 50
            },
            mobile: {
                required: true,
                digits:true,
                minlength: 10,
                maxlength:12,
                remote: {
                    url: "checkmobile",
                    type: "post",
                    data: {
                        mobile: $("#mobile").val()
                    },
                    dataFilter: function(data) {
                        if (data == "true") {
                            return  false;
                        } else {
                            return true;
                        }
                    }
                }
            },
            email: {
                    required: true,
                    maxlength: 50,
                    email: true,
                    remote: {

                        url: "checkemail",
                        type: "post",
                        data: {
                            email: $("input[email='email']").val()
                        },
                        dataFilter: function(data) {
                            if (data == "true") {
                                return  false;
                            } else {
                                return true;
                            }
                        }
                    }
            }, 
            block:{
                required: true,
            },
            flat_number: {
                required: true,
            },
            type:{
                required: true,
            }   
        },
        messages: {
           
            name: {
                required: "Please enter name",
                maxlength: "Name should be 50 characters long."
            },
            mobile: {
                required: "Please enter contact number",
                minlength: "The contact number should be 10 digits",
                digits: "Please enter only numbers",
                maxlength: "The contact number should be 12 digits",
                remote: "Mobile Number already exist"
            },
            email: {
                required: "Please enter valid email",
                email: "Please enter valid email",
                maxlength: "The email name should less than or equal to 50 characters",
                remote: "Email is already exists",
            },
            block:{
                required: "Please enter block",
            },
            flat_number: {
                required: "Please enter flat number",
            } ,
            type: {
                required: "Please select type",
            } 
           
            
        },
        submitHandler: function(form) {
       
          $('#user-reg-submit').html('Sending..');
          $.ajax({
            // url: "{{ url('jquery-ajax-form-submit-validation')}}" ,
            url: "/user/store" ,
            type: "POST",
            data: $('#register_form').serialize(),
            success: function( resp ) {
                if(resp.id!=''){
                    $('.register-form').hide();
                    $('.otp-form').show();
                    $("#user_id").val(resp.id);
                }
            }
          });
        }
      })
    });

    $("#verify-otp-btn").on('click',function(){
        
        let otp_val =  $("#otp").val();
        let user_id =  $("#user_id").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#verify_mobile").validate({
     
            rules: {  
                user_id:{
                    required: true,
                },            
                otp: {
                       required: true,
                   
               }              
           },
           messages: {              
            otp: {
                   required: "Please enter OTP",
                //    remote: "OTP value mismatch."
               } ,
               user_id:{
                    required: "User not found",
               }     
           },
           submitHandler: function(form) {
          
             $('#verify-otp-btn').html('Verifying..');
             $.ajax({
              
               url: "/user/mobileVerify" ,
               type: "POST",
               data: $('#verify_mobile').serialize(),
               success: function( response ) {
                   if(response == 'true'){
                        window.location.href = "/user/reg-success";
                       
                   }else{
                       $('#verify-otp-btn').html('Verify Mobile');
                       $("#error-otp").text('OTP did not matched.')
                   }
               }
             });
           }
         })
       });

       $("#login-btn").on('click',function(){
            let username =  $("#username").val();
            let password =  $("#password").val();
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $("#login_form").validate({
     
                rules: {  
                    username:{
                        required: true,
                    },            
                    password: {
                           required: true,
                       
                   }              
               },
               messages: {              
                    username: {
                        required: "Please enter Username",
                    } ,
                    password:{
                            required: "Please enter Password",
                    }     
               },
               submitHandler: function(form) {
              
                 $('#login-btn').html('Signing In..');
                 $.ajax({
                  
                   url: "/login" ,
                   type: "POST",
                   data: $('#login_form').serialize(),
                   success: function( response ) {
                    if(response.status == 1){
                        if(response.type =='superadmin'){
                           window.location.href = "/admin/home";
                        }else{
                            location.reload();
                        }
                    }
                    if(response.status == 0){
                        $(".invalid-login").text('Invalid Username and Password!.');
                        $('#login-btn').html('Login');
                    }
                   
                   }
                 });
               }
             })
           });

           $(".activate-btn").on('click',function(){
              
              let user_id = $(this).attr('form-data');
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
              
                url: "/user/activate" ,
                type: "POST",
                data: { userid: user_id },
                success: function( response ) {
                    if(response.status == 1){
                      //  window.location.href = "/admin/user-list";
                    }
                }
              });
           });

           $("#change-pwd-btn").on('click',function(){
            let password =  $("#change_password").val();
            let confim_pwd =  $("#confirm_password").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if(password != confim_pwd){
                    $(".invalid-confirm").text('Password does not match');
                }else{
                    $.ajax({
              
                        url: "/user/change-password" ,
                        type: "POST",
                        data: { password: password },
                        success: function( response ) {
                            if(response.status == 1){
                                $(".confirm-success").text('Password changed successfully');
                              
                            }
                        }
                      });
                }
           });
     
        $('.itemName').select2({
            placeholder: 'Select an item',
            ajax: {
              url: '/autocomplete',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                return {
                  results:  $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
              },
              cache: true
            }
          });
        $("#block").on('change',function(){
           
            let block_id =  $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if(block_id){
                $.ajax({              
                    url: "/user/get-flats",
                    type: "POST",
                    data: { block_id: block_id },
                    success: function( response ) {
                        $("#flat_number").html(response);
                        ("#flat_number").select2();
                    }
                  });
            }

        });

        $("#flat_number").select2({
            placeholder: "Select a Flat",
            allowClear: true,
            // dropdownParent: $("#registerModal")
        });
    

});