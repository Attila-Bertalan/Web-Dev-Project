const form = document.getElementById('form');
const First = document.getElementByID('First');
const Last = document.getElementById('Last');
const Password = document.getElementById('Password');
const Gender = document.getElementById('Gender');
const Email = document.getElementByID('Email');
const Phone = document.getElementById('Phone');

form.addEventListener('submit', e => {
    e.preventDefault();

    validateInputs();
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = Email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(Email).toLowerCase());
}

const isValidPhoneNumber = Phone => {
    const re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

    return re.test(input_str);
}

const validateInputs = () => {
    const FirstValue = First.value.trim();
    const LastValue = Last.value.trim();
    const PasswordValue = Password.value.trim();
    const GenderValue = Gender.value.trim();
    const EmailValue = Email.value.trim();
    const PhoneValue = Phone.value.trim();

    if(FirstValue === ''){
        setError(First , "Please enter First Name");
    }
    else{
        setSuccess(First);
    }

    if(LastValue === ''){
        setError(Last , "Please enter Last Name");
    }
    else{
        setSuccess(Last);
    }

    if(PasswordValue === ''){
        setError(Password , "Please enter Password");
    }
    else if(PasswordValue < 8){
        setError(Password, "Password must be more than 8 characters");
    }
    else{
        setSuccess(Password);
    }
    
    if(GenderValue === ''){
        setError(Gender, "Please select Gender")
    }
    else{
        setSucces(Gender)
    }
    
    if(EmailValue === ''){
        setError(Email, "Please enter Email");
    }
    else if(isValidEmail(EmailValue)){
        setError(Email, "Please enter a valid Email");
    }
    else{
        setSuccess(Email);
    }

    if(PhoneValue === ''){
        setError(Phone, "Please enter your Phone Number");
    }
    else if(isValidPhoneNumber(PhoneValue)){
        setError(Phone, "Please enter a valid Phone number");
    }
    else{
        setSuccess(Phone);
    }
       
    
    
}
