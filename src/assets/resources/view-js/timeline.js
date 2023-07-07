function like(id, type) {
  var xhttp = new XMLHttpRequest()
  xhttp.open("POST", "", true)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhttp.send("request=like&id=" + id + "&type=" + type)
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText)
    }
  }
}