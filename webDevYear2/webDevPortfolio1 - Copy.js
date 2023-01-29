function validateForm() {
  //initialise all required values from form
  let name1 = document.forms["frmRegister"]["frmForename"].value;
  let otherNames = document.forms["frmRegister"]["frmMiddleName"].value;
  let name2 = document.forms["frmRegister"]["frmSurname"].value;
  let gender = document.forms["frmRegister"]["frmGender"].value;
  let dob = document.forms["frmRegister"]["frmDateOfBirth"].value;
  let course = document.forms["frmRegister"]["frmCourse"].value;
  let age = document.forms["frmRegister"]["frmAge"].value;
  let date = document.forms["frmRegister"]["frmDateReg"].value;

  //validation for ensure only letters are inputted
  let regex0 = /^[a-z,.''-]{2,}$/;

  //checks form to make sure all required fields are not blank
  if (name1 == "") {
    alert("Please enter your Forename.");
    return false;
  } else {
      if (!regex0.test(name1)) {
        alert("You have entered invalid characters, please check your FORENAME and try again.");
        return false;
    }
  }
  if (!regex0.test(otherNames) && otherNames !="") {
    alert("You have entered invalid characters, please check your MIDDLE NAME(S) and try again.");
    return false;
  }
  if (name2 == "") {
    alert("Please enter your surname.");
    return false;
  } else {
      if (!regex0.test(name2)) {
        alert("You have entered invalid characters, please check your SURNAME and try again.");
        return false;
    }
  }
  if (gender == "") {
    alert("Please select a gender.");
    return false;
  }
  if (dob == "") {
    alert("Please enter your date of birth.");
    return false;
  }
  if (age == "") {
    alert("Please click on the 'Set age' button to set your age.");
    return false;
  } else {
    if (!(12 < age < 150)) {
      alert("You have entered an invalid date of birth, you must be aged 13+ to proceed.");
      return false;
    }
  }
  if (course == "") {
    alert("Please enter your chosen course");
    return false;
  }
  if (date == "") {
    alert("Please click the button 'Set Current Date' to set the date.")
    return false;
  }
  if (true) {
    alert("Data has been submitted!");
  }
};

//function that sets current date
function setDate() {
  //initialising/declaring current date
  let today = new Date();
  let year = today.getFullYear();
  let month = today.getMonth() + 1;
  let day = today.getDate();
  //sets date into readable format
  let currentDate = `${day}/${month}/${year}`;
  //when clicked, date will be set to today
  document.getElementById("frmDateReg").value = currentDate;
};

//function that will limit the dates selected for date of birth
function limitDOB() {
  frmDateOfBirth.min = "1900-01-01";
  frmDateOfBirth.max = new Date().toLocaleDateString('en-ca');
};

function setAge() {
  //declaring variables and new dates to be used in the if statement below
  let dob = document.forms["frmRegister"]["frmDateOfBirth"].value;
  let x = document.getElementById("frmDateOfBirth").value;
  var today = new Date();
  var birthDateYear = today.getFullYear();

  var year = Number(dob.substr(0,4));
  if (dob == "") {
    alert("You need to input your date of birth first.");
  } else {
    var age =birthDateYear - year;
    document.getElementById("frmAge").value = age;
  };
};

function confirmAction() {
  let confirmAction = confirm("Are you sure?");
      if (confirmAction) {
        alert("Action successfully executed");
      } else {
        alert("Action cancelled");
        return false;
      }
};