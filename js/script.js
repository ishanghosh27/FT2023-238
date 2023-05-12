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
