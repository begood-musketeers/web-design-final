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