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
                        $('.otp-form').hide();
                        $('.mobile-verified').show();
                        setTimeout(function(){
                            location.reload();
                        },3000)
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
                              //  window.location.href = "/admin/user-list";
                            }
                        }
                      });
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
                        if(response.status == 1){
                            let flat_no = response.data;
                           
                            $("#flat_number_by_block").val(flat_no);
                            //$(".confirm-success").text('Password changed successfully');
                          //  window.location.href = "/admin/user-list";
                        }
                    }
                  });
            }

        });

        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) { return false;}
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                  /*check if the item starts with the same letters as the text field value:*/
                  if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                  }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                  /*If the arrow DOWN key is pressed,
                  increase the currentFocus variable:*/
                  currentFocus++;
                  /*and and make the current item more visible:*/
                  addActive(x);
                } else if (e.keyCode == 38) { //up
                  /*If the arrow UP key is pressed,
                  decrease the currentFocus variable:*/
                  currentFocus--;
                  /*and and make the current item more visible:*/
                  addActive(x);
                } else if (e.keyCode == 13) {
                  /*If the ENTER key is pressed, prevent the form from being submitted,*/
                  e.preventDefault();
                  if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                  }
                }
            });
            function addActive(x) {
              /*a function to classify an item as "active":*/
              if (!x) return false;
              /*start by removing the "active" class on all items:*/
              removeActive(x);
              if (currentFocus >= x.length) currentFocus = 0;
              if (currentFocus < 0) currentFocus = (x.length - 1);
              /*add class "autocomplete-active":*/
              x[currentFocus].classList.add("autocomplete-active");
            }
            function removeActive(x) {
              /*a function to remove the "active" class from all autocomplete items:*/
              for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
              }
            }
            function closeAllLists(elmnt) {
              /*close all autocomplete lists in the document,
              except the one passed as an argument:*/
              var x = document.getElementsByClassName("autocomplete-items");
              for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                  x[i].parentNode.removeChild(x[i]);
                }
              }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });
          }
          
          $("#flat_number").on('input',function(){

            //    var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
            var flats = $("#flat_number_by_block").val();  
            autocomplete(document.getElementById("flat_number"), flats);
          });
         
       
    


});