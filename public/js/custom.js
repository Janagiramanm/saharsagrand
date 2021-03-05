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
                        mobile: $("input[number='mobile']").val()
                    },
                    dataFilter: function(data) {
                        alert(data);
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
                // remote: {

                //     url: "checkflat",
                //     type: "post",
                //     data: {
                //         block: $('select[name="block"] option:selected').val(),
                //         flat: $('select[name="flat_number"] option:selected').val(),
                //         type: $('select[name="type"] option:selected').val()
                //     },
                //     dataFilter: function(data) {
                //         if (data == "true") {
                //             return  false;
                //         } else {
                //             return true;
                //         }
                //     }
                // }
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
                required: "Please enter enter valid email",
                email: "Please enter valid email",
                maxlength: "The email name should less than or equal to 50 characters",
                remote: "Email is already exists",
            },
            block:{
                required: "Please enter block",
            },
            flat_number: {
                required: "Please enter flat number",
                // remote:" Flat Number already registered",
            } ,
            type: {
                required: "Please select type",
            } 
           
            
        },
        submitHandler: function(form) {
       
          $('#user-reg-submit').html('Sending..');
          $("#error-flat").text('');
          $.ajax({
            // url: "{{ url('jquery-ajax-form-submit-validation')}}" ,
            url: "/user/store" ,
            type: "POST",
            data: $('#register_form').serialize(),
            success: function( resp ) {
              
                if(resp.status == 0){
                    $('#user-reg-submit').html('Submit');
                    $("#error-flat").text(resp.message);
                }
                if(resp.status == 1){
                    $('.register-form').hide();
                    $('.otp-form').show();
                    $("#user_id").val(resp.data.id);
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
                    if(response.status == 2){
                        $(".invalid-login").text('Your account has been de activated.');
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
                       window.location.href = "/admin/user-list"; 
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
     
        // $('.itemName').select2({
        //     placeholder: 'Select an item',
        //     ajax: {
        //       url: '/autocomplete',
        //       dataType: 'json',
        //       delay: 250,
        //       processResults: function (data) {
        //         return {
        //           results:  $.map(data, function (item) {
        //                 return {
        //                     text: item.name,
        //                     id: item.id
        //                 }
        //             })
        //         };
        //       },
        //       cache: true
        //     }
        //   });
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
                        //("#flat_number").select2();
                    }
                  });
            }

        });

        $("#flat_number").select2({
            placeholder: "Select a Flat",
            allowClear: true,
            // dropdownParent: $("#registerModal")
        });

        $("#user_name_filter").select2({
            placeholder: "Select User",
            allowClear: true,
        });
        $("#postings").select2({
            placeholder: "Select Posting",
            allowClear: true,
        });

        $("#amenity_name_filter").select2({
            placeholder: "Select Amenity",
            allowClear: true,
        })


            // $('.user-change-status').on('mouseover',function(){

            // })

            $('.user-change-status').on('change',function() {
               
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var user_id = $(this).data('id'); 
                var chk = $(this);
            // var status = $(this).attr('data-status');
           var confirm_alert = (status == 1) ? confirm("    Are you sure you want to activate this user?") : confirm("Are you sure you want to de-activate this user?");
           if (confirm_alert == true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '/change-user-status',
                    data: {'status': status, 'userid': user_id},
                    success: function(resp){
                        $(".success-msg").addClass('alert alert-success');
                        $(".success-msg").text(resp.message)
                        setInterval(function () {
                           location.reload()
                        }, 2000);
                      // console.log(data.success)
                    }
                });
            }else{
                var preClass = $(this).parent().prop('className');
               
                if(preClass == 'toggle btn btn-danger off'){
                    setClass = 'toggle btn btn-success';
                }
                if(preClass == 'toggle btn btn-success'){
                    setClass = 'toggle btn btn-danger off'
                }
                $(this).parent().removeClass(preClass);
                $(this).parent().addClass(setClass);
                location.reload()
                //$(".container").load(location.href + ".container");
                
            }
        })

        $("#search-book").on('click',function(){
             var booking_code = $("#booking-code").val();
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/search-booking',
                data: {'code': booking_code},
                success: function(resp){
                    if(resp.status == 1){
                        $(".info-card-block").html(resp.data)
                    }else{

                    }
                 
                }
            });
        });
    
        $("#time-required").on('change',function(){
            if($(this).is(':checked')){
                
                $(".time-settings-sec").show();
            }else{
               
                $(".time-settings-sec").hide();
            }

        })
        
        if($("#time-required").is(':checked')){
            $(".time-settings-sec").show();
        }else{
            $(".time-settings-sec").hide();
        }


        $("#forget-pwd").on('click',function(){
             $(".login-section").hide();
             $(".forget-section").show();
        });

        $("#forget-pwd-btn").on('click',function(){
            var username = $("#forget_username").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/user/forgot-password',
                data: {'username': username},
                beforeSend: function() {
                    // setting a timeout
                    $("#forget-pwd-btn").text('Checking..');
                  
                },
                success: function(resp){
                    if(resp.status == 1){
                         $(".forget-section").hide();
                         $("#user-id").val(resp.data.id);
                         $(".change-your-pwd-section").show();
                        //  $(".info-card-block").html(resp.data)
                    }else{
                        $(".invalid-user-forgot").html(resp.message)

                    }
                 
                }
            });
        });
      
        $("#change-password-forgot").on('click',function(){
            var otp = $("#change-otp").val();
            var newPassword = $("#new-password").val();
            var confirmPassword = $("#confirm-password").val();
            var userId = $("#user-id").val();
           
            if(newPassword != confirmPassword){
                
                 $(".confirm-mismatch").text('Confirm Password is mismatch with new password');
                 return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/user/forgot-password-change',
                data: {'userid': userId, otp:otp, newpassword:newPassword},
                success: function(resp){
                    if(resp.status == 1){
                         $(".confirm-success").text(resp.message)
                         setTimeout(function(){
                             location.reload();
                         },1300)
                      
                    }else{
                        $(".confirm-mismatch").html(resp.message)

                    }
                 
                }
            });

        });


        $(".nominee-validate").on('click',function(){
             var id =  $(this).attr('data-id');
             var act = $(this).attr('data-act');
             $("#act_lbl").text(act);
             $("#nominee_id").val(id);
             $("#nominee_act").val(act);
        })

        $("#nominee-validate-submit").on('click',function(){
            var id = $("#nominee_id").val();
            var act = $("#nominee_act").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                dataType: "json",
                url: '/admin/nominee/verification',
                data: {'id': id, 'act':act },
                success: function(resp){
                    if(resp.status == 1){
                          location.reload();
                    }
                 
                }
            });
        })
       

       
        $("#menu-humberger-btn").on('click',function(){
            if($( ".sidebar" ).hasClass( "d-none" )){
                $( ".sidebar" ).removeClass( "d-none" );
            }else{
                $( ".sidebar" ).addClass( "d-none" );
            }
            
             
        });


        $('.dropdown a.dropdown-toggle').on('click', function(e) {
          
            if (!$(this).next().hasClass('show')) {
              $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
            }
            var $subMenu = $(this).next('.dropdown-menu');
            $subMenu.toggleClass('show');
          
          
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
              $('.dropdown-submenu .show').removeClass('show');
            });
          
          
            return false;
          });

        $().on('click',function(e){

        })

});