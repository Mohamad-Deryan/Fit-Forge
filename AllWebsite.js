/* BMI */

document.addEventListener('DOMContentLoaded', function () {

    function calculateBMI() {

        clearPreviousResults();


        var heightCM = document.getElementById('heightCM').value;
        var weightKG = document.getElementById('weightKG').value;
        var age = document.getElementById('age').value;
        var gender = document.querySelector('input[name="gender"]:checked').value;


        var heightM = heightCM / 100;
        var bmi = weightKG / (heightM * heightM);

        var bmiResult = document.createElement('div');
        bmiResult.className = 'bmi-result';
        bmiResult.textContent = 'Your BMI: ' + bmi.toFixed(2);

        var bmiCategory = document.createElement('div');
        bmiCategory.className = 'bmi-category';

        if (bmi < 18.5) {
            bmiCategory.textContent = 'Category: Underweight';
        } else if (bmi >= 18.5 && bmi < 24.9) {
            bmiCategory.textContent = 'Category: Normal weight';
        } else if (bmi >= 25 && bmi < 29.9) {
            bmiCategory.textContent = 'Category: Overweight';
        } else {
            bmiCategory.textContent = 'Category: Obesity';
        }

        var submitBox = document.getElementById('submit_box');
        submitBox.appendChild(bmiResult);
        submitBox.appendChild(bmiCategory);
    }

    function clearPreviousResults() {
        var previousResults = document.querySelectorAll('.bmi-result, .bmi-category');
        previousResults.forEach(function (result) {
            result.remove();
        });
    }

    var submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', calculateBMI);
});




/* Log in page */
function validateForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    var emailFormat = /\S+@\S+\.\S+/;
    if (!emailFormat.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (password.length < 8 || !/[A-Z]/.test(password)) {
        alert('Password must be at least 8 characters and contain one capital letter.');
        return false;
    }


    return true;
}






/* Sign Up Page */

function validateSignUpForm() {
    var firstName = document.getElementById('FN').value;
    var lastName = document.getElementById('LN').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (firstName.trim() === '' || lastName.trim() === '' || email.trim() === '' || password.trim() === '') {
        alert('Please fill in all fields.');
        return false;
    }

    var emailFormat = /\S+@\S+\.\S+/;
    if (!emailFormat.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (password.length < 8 || !/[A-Z]/.test(password)) {
        alert('Password must be at least 8 characters and contain one capital letter.');
        return false;
    }


    return true;
}






/* Info page */


function validateSignUpFormInfo() {

    var age = document.getElementById('age').value;
    var creditCardNumber = document.getElementById('CreditNum').value;

    if (parseInt(age) < 16) {
        alert('You must be at least 16 years old to sign up.');
        return false;
    }


    if (!luhnCheck(creditCardNumber)) {
        alert('Please enter a valid credit card number.');
        return false;
    }


    return true;
}


function luhnCheck(value) {
    var sum = 0;
    var numDigits = value.length;
    var parity = numDigits % 2;

    for (var i = 0; i < numDigits; i++) {
        var digit = parseInt(value.charAt(i));

        if (i % 2 == parity) {
            digit *= 2;
            if (digit > 9) {
                digit -= 9;
            }
        }

        sum += digit;
    }

    return (sum % 10) == 0;
}