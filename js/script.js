// Live Update Full Name Field When Entering First & Last Name Separately
var fname = document.getElementById('fname');
var lname = document.getElementById('lname');
var fullname = document.getElementById('fullname');

fname.addEventListener("input", ()=> {
  if (!fname.value.match(/^[a-zA-Z]+$/)) {
    alert("First Name Field Can Only Contain Alphabets")
  }
  else {
    fullname.value = fname.value
  }
})

lname.addEventListener("input", ()=> {
  if (!lname.value.match(/^[a-zA-Z]+$/)) {
    alert ("Last Name Field Can Only Contain Alphabets")
  }
  else {
    fullname.value = fname.value + " " + lname.value
  }
})

function populateForm() {
  var formData = JSON.parse(localStorage.getItem('formData'));
      if (formData) {
        document.getElementById('username').value = formData.username;
        document.getElementById('fname').value = formData.fname;
        document.getElementById('lname').value = formData.lname;
        document.getElementById('phone').value = formData.phone;
        document.getElementById('email').value = formData.email;
      }

}

function storeFormData() {
    var formData = {
        username: document.getElementById('username').value,
        fname: document.getElementById('fname').value,
        lname: document.getElementById('lname').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value,
    };
    localStorage.setItem('formData', JSON.stringify(formData));
}
