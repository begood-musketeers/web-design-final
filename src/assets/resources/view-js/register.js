function login() {
  var username = document.getElementById("username").value
  var password = document.getElementById("password").value

  if (username == "" || password == "") {
    document.getElementById("error").innerHTML = "Please fill out all fields"
    document.getElementById("error").style.display = "block"
    return
  }

  var xhttp = new XMLHttpRequest()
  xhttp.open("POST", "", true)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhttp.send("request=login&username=" + username + "&password=" + password)
  xhttp.onreadystatechange = function() {
    if (this.responseText != "") {
      var response = JSON.parse(this.responseText)
  
      if (response.state == "success") {
        alert(this.responseText)
        window.location.href = "."
      } else {
        document.getElementById("error").innerHTML = response.message
        document.getElementById("error").style.display = "block"
      }

    }
  }
}

function register() {
  var username = document.getElementById("username").value
  var password = document.getElementById("password").value
  var password_confirm = document.getElementById("password_confirm").value
  var email = document.getElementById("email").value
  var security_question_id = document.getElementById("security_question_id").value
  var security_question_answer = document.getElementById("security_question_answer").value

  // Check if all fields are filled
  if (username == "" || password == "" || password_confirm == "" || email == "" || security_question_id == "" || security_question_answer == "") {
    document.getElementById("error").innerHTML = "Please fill out all fields"
    document.getElementById("error").style.display = "block"
    return
  }
  // Check if password and password confirm match
  if (password != password_confirm) {
    document.getElementById("error").innerHTML = "Passwords do not match"
    document.getElementById("error").style.display = "block"
    return
  }
  // manually check if email is valid with regex
  if (!email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)) {
    document.getElementById("error").innerHTML = "Please enter a valid email"
    document.getElementById("error").style.display = "block"
    return
  }

  var xhttp = new XMLHttpRequest()
  xhttp.open("POST", "", true)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhttp.send("request=register&username=" + username + "&password=" + password + "&password_confirm=" + password_confirm + "&email=" + email + "&security_question_id=" + security_question_id + "&security_question_answer=" + security_question_answer)
  xhttp.onreadystatechange = function() {
    if (this.responseText != "") {
      var response = JSON.parse(this.responseText)
  
      if (response.state == "success") {
        window.location.href = "."
      } else {
        document.getElementById("error").innerHTML = response.message
        document.getElementById("error").style.display = "block"
      }

    }
  }
}