function like(id, type) {
  var xhttp = new XMLHttpRequest()
  xhttp.open("POST", "", true)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhttp.send("request=like&id=" + id + "&type=" + type)
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("l-"+ id + type).innerHTML = this.responseText
      document.getElementById("l-"+ id + type).parentElement.classList.toggle("liked")
      document.getElementById("l-"+ id + type).parentElement.setAttribute("onclick", "unlike(" + id + ", '" + type + "')")
    }
  }
}

function unlike(id, type) {
  var xhttp = new XMLHttpRequest()
  xhttp.open("POST", "", true)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhttp.send("request=unlike&id=" + id + "&type=" + type)
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("l-"+ id + type).innerHTML = this.responseText
      document.getElementById("l-"+ id + type).parentElement.classList.toggle("liked")
      document.getElementById("l-"+ id + type).parentElement.setAttribute("onclick", "like(" + id + ", '" + type + "')")
    }
  }
}