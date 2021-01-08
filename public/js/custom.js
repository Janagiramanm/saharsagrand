$(document).ready(function(){

    $('.otp-form').hide();
    // $('#user-reg-submit').click(function(e){
    
    //     let name =  $("#name").val();
    //     let mobile =  $("#mobile").val();
    //     let email =  $("#email").val();
    //     let block =  $("#block").val();
    //     let flat_number =  $("#flat_number").val();
    //     let type =  $("#type").val();
    //     e.preventDefault();
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: "/user/store",
    //         method: 'post',
    //         data: {
    //             name: name, mobile:mobile, email:email,block:block,flat_number:flat_number,type:type
    //         },
    //         success: function(result){
    //            if(result!='failed'){
    //               $('.register-form').hide();
    //               $('.otp-form').show();
    //            }
    //         }
    //     });
    
    // });


    $('#user-reg-submit').click(function(e){
    
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
            success: function( response ) {
                // $('#send_form').html('Submit');
                // $('#res_message').show();
                // $('#res_message').html(response.msg);
                // $('#msg_div').removeClass('d-none');
    
                // document.getElementById("contact_us").reset(); 
                // setTimeout(function(){
                // $('#res_message').hide();
                // $('#msg_div').hide();
                // },10000);
            }
          });
        }
      })
    });


});