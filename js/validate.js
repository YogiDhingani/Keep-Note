let nameError = true;
let phoneError = true;
let emailError = true;
let passwordError = true;
let confirmPasswordError = true;

$(document).ready(function(){
  
    $('#namecheck').hide();     
      nameError = true; 
      $('#nm').keyup(function () { 
          validateName(); 
      }); 
        
        $('#phonecheck').hide();     
          phoneError = true; 
          $('#phone_no').keyup(function () { 
              validatePhone(); 
          }); 
  
          $('#emailcheck').hide();     
          emailError = true; 
          $('#eid').keyup(function () { 
              validateEmail(); 
          }); 
  
        const email =  
              document.getElementById('eid'); 
          email.addEventListener('blur', ()=>{ 
            let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/; 
            let s = email.value; 
            if(regex.test(s)){ 
                email.classList.remove( 
                      'is-invalid'); 
                emailError = true; 
              } 
              else{ 
                  email.classList.add( 
                        'is-invalid'); 
                  emailError = false; 
              } 
          })
  
          $('#passcheck').hide(); 
          passwordError = true; 
          $('#password').keyup(function () { 
              validatePassword(); 
          }); 
          
                
          $('#conpasscheck').hide(); 
          confirmPasswordError = true; 
          $('#cpassword').keyup(function () { 
              validateConfirmPasswrd(); 
          }); 
          
        });

        function validate() { 
            validateName();
            validatePhone(); 
            validateEmail();
            validatePassword(); 
            validateConfirmPasswrd();  
            console.log(nameError);
            console.log(phoneError);
            console.log(emailError);
            console.log(passwordError);
            console.log(confirmPasswordError);
            if ((nameError == true) && (phoneError == true) && 
                (passwordError == true) &&  
                (confirmPasswordError == true) &&  
                (emailError == true)) { 
                return true; 
            } else { 
                return false; 
            } 
        };

        
        function validateName() { 
            let usernameValue = $('#nm').val();
            let regex = /^[a-zA-Z ]{2,30}$/; 
            if (usernameValue.length == '' || usernameValue == null) { 
            $('#namecheck').show(); 
                nameError = false; 
                return false; 
            }  
            else if((usernameValue.length < 2)) { 
                $('#namecheck').show(); 
                $('#namecheck').html("**length of username must be atleast 2"); 
                nameError = false; 
                return false; 
            }  
            else if(!(regex.test(usernameValue)))
            {
              $('#namecheck').show(); 
                $('#namecheck').html 
                ("**Please enter only alphabets"); 
                nameError = false; 
                return false; 
            }
            else { 
                $('#namecheck').hide(); 
                return true;
            } 
          }

        function validatePhone() { 
            let phoneValue = $('#phone_no').val();
            let regex = /^\d{10}$/; 
            if (phoneValue.length == '' || phoneValue == null) { 
            $('#phonecheck').show(); 
                phoneError = false; 
                return false; 
            }  
            else if(!(regex.test(phoneValue))) { 
                $('#phonecheck').show(); 
                $('#phonecheck').html("**Please enter 10 digit phone number."); 
                phoneError = false; 
                return false; 
            }  
            else { 
                $('#phonecheck').hide(); 
            } 
          }

        function validateEmail() { 
            let emailValue = $('#eid').val();
            let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/; 
            if (emailValue.length == '' || emailValue == null) { 
            $('#emailcheck').show(); 
                emailError = false; 
                return false; 
            }  
            else if(!(regex.test(emailValue))) { 
                $('#emailcheck').show(); 
                $('#emailcheck').html("**Please enter valid email address."); 
                emailError = false; 
                return false; 
            }  
            else { 
                $('#emailcheck').hide(); 
            } 
          }

        function validatePassword() { 
            let passwrdValue =  
                $('#password').val(); 
            if (passwrdValue.length == '') { 
                $('#passcheck').show(); 
                passwordError = false; 
                return false; 
            }  
            if ((passwrdValue.length < 3)||  
                (passwrdValue.length > 10)) { 
                $('#passcheck').show(); 
                $('#passcheck').html("**length of your password must be between 3 and 10"); 
                $('#passcheck').css("color", "red"); 
                passwordError = false; 
                return false; 
            } else { 
                $('#passcheck').hide(); 
                passwordError = true;
            } 
        } 

        function validateConfirmPasswrd() { 
            let confirmPasswordValue =  
                $('#cpassword').val(); 
            let passwrdValue =  
                $('#password').val(); 
            if (passwrdValue != confirmPasswordValue) { 
                $('#conpasscheck').show(); 
                $('#conpasscheck').html( 
                    "**Password didn't Match"); 
                $('#conpasscheck').css( 
                    "color", "red"); 
                confirmPasswordError = false; 
                return false; 
            } else { 
                $('#conpasscheck').hide(); 
                confirmPasswordError = true;
            } 
        }


        
  
