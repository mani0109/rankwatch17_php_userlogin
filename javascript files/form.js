$(document).ready(function() {

    if (alert_status ==1) {
        var url = location.href.split("?");
        history.pushState(null, '', url[0]);
        setTimeout(function() {
            $('.alert').fadeOut();
        },500);
    }

    var email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; 
    
    $('#registerSubmitButton').click(function(){
        
        var full_name = $('#full_name').val();
        var email = $('#email').val();
        var user_password = $('#user_password').val();
        var confirm_password = $('#confirm_password').val();
        var contact_no = $('#contact_no').val();
        var age = $('#age').val();
        var gender = $('#gender').val();
        var address = $('#address').val();
        var country = $('#country').val();

        var valid = false;

        if (full_name == '' || typeof full_name == 'undefined') {
            $('#full_nameErr').html('Please enter your full name');
            valid = true;
        }
        else if (checkTextContainSpaces(full_name, "name")) {
            $('#full_nameErr').html('Full Name contain SPACE(s) only');
            valid = true;
        }
        else
            $('#full_nameErr').html('');
      
        if (email == '' || typeof email == 'undefined') {
            $('#emailErr').html('Please enter your Email Id');
            valid = true;
        }
        else if (email_regex.test(email) == false ) {
            $('#emailErr').html('Invalid Email Id');
            valid = true;
        }
        else
            $('#emailErr').html(''); 

        if (user_password == '' || typeof user_password == 'undefined') {
            $('#user_passwordErr').html('Please enter a Password');
            valid = true;
        }
        else if (user_password.length < 4 ) {
            $('#user_passwordErr').html('Password should be at of least 4 digit/character');
            valid = true;
        }
        else if (checkTextContainSpaces(user_password, "pass")) {
            $('#user_passwordErr').html('Password should not contain SPACE(s)');
            valid = true;
        }
        else
            $('#user_passwordErr').html('');

        if (confirm_password == '' || typeof confirm_password == 'undefined') {
            $('#confirm_passwordErr').html('Confirm Password cannot be left blank');
            valid = true;
        }
        else if (confirm_password != user_password ) {
            $('#confirm_passwordErr').html('Password didn\'t match. Please confirm again');
            valid = true;
        }
        else
            $('#confirm_passwordErr').html('');

        if (contact_no == '' || typeof contact_no == 'undefined') {
            $('#contact_noErr').html('Contact Number cannot be left blank');
            valid = true;
        }
        else if (Number(contact_no) == 'NaN') {
            $('#contact_noErr').html('Invalid Contact Number');
            valid = true;
        }
        else if (contact_no.length != 10){
            $('#contact_noErr').html('Contact Number format invalid');
            valid = true;
        }
        else
            $('#contact_noErr').html('');

        if (age == '' || typeof age == 'undefined') {
            $('#ageErr').html('Contact Number cannot be left blank');
            valid = true;
        }
        else if (Number(age) == 'NaN') {
            $('#ageErr').html('Invalid age');
            valid = true;
        }
        else
            $('#ageErr').html('');

        if (gender == '' || typeof gender == 'undefined') {
            $('#genderErr').html('Choose your gender');
            valid = true;
        }
        else if (gender != 'male' && gender != 'female') {
            $('#genderErr').html('Invalid gender');
            valid = true;
        }
        else
            $('#genderErr').html('');

        if (address == '' || typeof address == 'undefined') {
            $('#addressErr').html('Please enter your address');
            valid = true;
        }
        else if (checkTextContainSpaces(address, "name")) {
            $('#addressErr').html('Address contain SPACE(s) only');
            valid = true;
        }
        else
            $('#addressErr').html('');

        if (address == '' || typeof address == 'undefined') {
            $('#addressErr').html('Choose your address');
            valid = true;
        }
        else
            $('#addressErr').html('');

        if (country == '' || typeof country == 'undefined') {
            $('#countryErr').html('Choose your country');
            valid = true;
        }
        else
            $('#countryErr').html('');

        if ($('.state_display').is(":visible")) {
            var state = $('#state').val();
            if (state == '' || typeof state == 'undefined') {
                $('#stateErr').html('Choose your state');
                valid = true;
            }
            else
                $('#stateErr').html('');
        }
        else
            $('#stateErr').html('');

        if ($('.city_display').is(":visible")) {
            var city = $('#city').val();
            if (city == '' || typeof city == 'undefined') {
                $('#cityErr').html('Choose your city');
                valid = true;
            }
            else
                $('#cityErr').html('');
        }
        else
            $('#cityErr').html('');

        if (valid == true)
            return false;
        $("#registerationForm").submit();
    });

    $('#loginSubmitButton').click(function(){
        
        var email = $('#email').val();
        var user_password = $('#user_password').val();

        var valid = false; 

        if (email == '' || typeof email == 'undefined') {
            $('#emailErr').html('Please enter your Email Id');
            valid = true;
        }
        else if (email_regex.test(email) == false ) {
            $('#emailErr').html('Invalid Email Id');
            valid = true;
        }
        else
            $('#emailErr').html(''); 

        if (user_password == '' || typeof user_password == 'undefined') {
            $('#user_passwordErr').html('Please enter a Password');
            valid = true;
        }
        else if (user_password.length < 4 ) {
            $('#user_passwordErr').html('Password should be at of least 4 digit/character');
            valid = true;
        }
        else if (checkTextContainSpaces(user_password, "pass")) {
            $('#user_passwordErr').html('Password should not contain SPACE(s)');
            valid = true;
        }
        else
            $('#user_passwordErr').html('');

        if (valid == true)
            return false;
        $("#loginFrom").submit();
    });

    $('#sendEmailButton').click(function(){
        
        var full_name = $('#full_name').val();        
        var email_to = $('#email_to').val();
        var subject = $('#subject').val();

        var valid = false; 

        if (full_name == '' || typeof full_name == 'undefined') {
            $('#full_nameErr').html('Please enter your full name');
            valid = true;
        }
        else if (checkTextContainSpaces(full_name, "name")) {
            $('#full_nameErr').html('Full Name contain SPACE(s) only');
            valid = true;
        }
        else
            $('#full_nameErr').html('');

        if (email_to == '' || typeof email_to == 'undefined') {
            $('#email_toErr').html('Please enter your Email Id');
            valid = true;
        }
        else if (email_regex.test(email_to) == false ) {
            $('#email_toErr').html('Invalid Email Id');
            valid = true;
        }
        else
            $('#email_toErr').html(''); 

        if (subject == '' || typeof subject == 'undefined') {
            $('#subjectErr').html('Please enter a Subject');
            valid = true;
        }
        else if (checkTextContainSpaces(subject, "name")) {
            $('#subjectErr').html('Subject should not contain SPACE(s)');
            valid = true;
        }
        else
            $('#subjectErr').html('');

        if (valid == true)
            return false;
        $("#sendMailFrom").submit();
    });

    function checkTextContainSpaces(text, field) {
        var textlength = text.length;
        var textsplit = text.split("");
        var textcount = 0;
        for (var i = 0; i < textlength; i++) 
            if (textsplit[i] == ' ')
                textcount++;
        if (field == "name" && textcount == textlength)
            return true;
        if (field == "pass" && textcount > 0)
            return true;
        return false;
    }

    $('#country').change(function() {
        var country = $(this).val();
        if (country == '' || typeof country == 'undefined') {
            $('.state_display').hide();
            $('.city_display').hide();
        }
        else {
            $.ajax({
                url:     'server-request-route.php',
                method:  'POST',
                data:    {'country_id' : country},
                success: function(fetched_data) {
                    if (fetched_data) {
                        var option = $('#state').html();
                        var res = $.parseJSON(fetched_data);
                        if (res.length > 0) {
                            for (var i = 0 ; i < res.length; i++) 
                                option += res[i];
                            $('#state').html(option);
                            $('.state_display').show();
                        }
                    }
                },
                error:   function(err) {
                    console.log(err);
                }
            });
        }
    });

    $('#state').change(function() {
        var state = $(this).val();
        if (state == '' || typeof state == 'undefined') {
            $('.city_display').hide();
        }
        else {
            $.ajax({
                url:     'server-request-route.php',
                method:  'POST',
                data:    {'state_id' : state},
                success: function(fetched_data) {
                    if (fetched_data) {
                        var option = $('#city').html();
                        var res = $.parseJSON(fetched_data);
                        if (res.length > 0) {
                            for (var i = 0 ; i < res.length; i++) 
                                option += res[i];
                            $('#city').html(option);
                            $('.city_display').show();
                        }
                    }
                },
                error:   function(err) {
                    console.log(err);
                }
            });
        }
    });

    $('#webSubmitButton').click(function() {
        var url = $('#url').val().trim();
        if (url == '' || typeof url == 'undefined') {
            $('#urlErr').html('Enter a URL').css('color', 'red').show();
            return false;
        }
        else {
            $('#webSubmitButton').css({'pointer-events' : 'none','opacity': '0.5'});
            $('#urlErr').hide();
            $('#progress').show();
            $.ajax({
                url:     'server-request-route.php',
                method:  'POST',
                data:    {'url' : url},
                success: function(fetched_data) {
                    $('#progress').hide();
                    if (fetched_data) {
                        var res = $.parseJSON(fetched_data);
                        var tr = '';
                        if (typeof res['http'] == 'object') {
                            tr += '<tr><th>URL<\/th><td>'+res['http'].url+'<\/td><\/tr><tr><th>IP<\/th><td>'+res['http'].primary_ip+'<\/td><\/tr><tr><th>Load Time<\/th><td>'+res['http'].total_time+'<\/td><\/tr><tr><th>HTTP Status<\/th><td>'+res['http'].http_code+'<\/td><\/tr>';
                        }
                        if (typeof res['meta'] == 'object') {
                            tr += '<tr><th colspan="2" style="text-align:center;">META<\/th><tr>';
                            for(var meta in res['meta']) {
                                switch(meta) {
                                    case 'description':
                                        tr += '<tr><th>Description<\/th><td>';
                                        for(var i = 0; i < res['meta'][meta].length; i++)
                                            tr += res['meta'][meta][i]+' <b>|<\/b> ';
                                        tr += '<\/td><\/tr>';
                                    break;
                                    case 'keywords':
                                        tr += '<tr><th>Keywords<\/th><td>';
                                        for(var i = 0; i < res['meta'][meta].length; i++)
                                            tr += res['meta'][meta][i]+' <b>|<\/b> ';
                                        tr += '<\/td><\/tr>';
                                    break;
                                }
                            }
                        }
                        if (typeof res['internal'] == 'object') {
                            tr += '<tr><th colspan="2" style="text-align:center;">Internal Links<\/th><\/tr><tr><td colspan="2"><ul>';
                            for(var i = 0; i < res['internal'].length; i++)
                                tr += '<li>'+res['internal'][i]+'<\/li>';
                            tr += '<\/ul><\/td><\/tr>';
                        }
                        if (typeof res['external'] == 'object') {
                            tr += '<tr><th colspan="2" style="text-align:center;">External Links<\/th><\/tr><tr><td colspan="2"><ul>';
                            for(var i = 0; i < res['external'].length; i++)
                                tr += '<li>'+res['external'][i]+'<\/li>';
                            tr += '<\/ul><\/td><\/tr>';
                        }
                        $('#web-data').html(tr);
                        $('#webSubmitButton').css({'pointer-events' : 'auto', 'opacity': '1'});
                    }
                },
                error:   function(err) {
                    console.log(err);
                }
            });
        }
    });
});