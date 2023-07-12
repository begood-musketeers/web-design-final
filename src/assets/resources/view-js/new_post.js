function share() {
  var title = document.getElementById("title").value
  var description = document.getElementById("description").value
  var location = document.getElementById("location").value

  if (title == "" || description == "") {
    document.getElementById("error").innerHTML = "Please fill out all fields"
    document.getElementById("error").style.display = "block"
    return
  }

  if (location != "" && !location.match(/^(https:\/\/www\.google\.com\/maps\/place\/)(.*)/)) {
    document.getElementById("error").innerHTML = "Please enter a valid Google Maps link"
    document.getElementById("error").style.display = "block"
    return
  }

  document.getElementById("post-form").style.display = "none"
  document.getElementById("loader").style.display = "grid"

  var xhttp = new XMLHttpRequest()
  xhttp.open("POST", "", true)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhttp.send("request=new_post&title=" + title + "&description=" + description + "&location=" + location)
  xhttp.onreadystatechange = function() {
    if (this.responseText != "") {
      var response = JSON.parse(this.responseText)
  
      if (response.state == "success") {        
        // post every image form to the hidden iframe
        post_form(0, response.post_id)

        setTimeout(function() {
          window.location.href = "."
        }, 500 * image_forms.length)
      } else {
        document.getElementById("error").innerHTML = response.message
        document.getElementById("error").style.display = "block"
      }

    }
  }
}

function post_form(i, post_id) {
  var image_forms = document.getElementsByClassName("image-input")
  var frame = document.getElementById("image_upload_target")

  frame.onload = function() {
    if (i < image_forms.length - 1) {
      post_form(i + 1, post_id)
    }
  }

  image_forms[i].elements["post_id"].value = post_id
  image_forms[i].submit()
}

function add_image_field() {
  var form = document.createElement("form")
  form.setAttribute("method", "post")
  form.setAttribute("class", "image-input")
  form.setAttribute("target", "image_upload_target")
  form.setAttribute("enctype", "multipart/form-data")

  var image = document.createElement("input")
  image.setAttribute("type", "file")
  image.setAttribute("name", "image")
  image.setAttribute("class", "hidden")

  var request = document.createElement("input")
  request.setAttribute("type", "hidden")
  request.setAttribute("name", "request")
  request.setAttribute("value", "add_image")

  var post_id = document.createElement("input")
  post_id.setAttribute("type", "hidden")
  post_id.setAttribute("name", "post_id")

  form.appendChild(post_id)
  form.appendChild(request)

  form.onclick = function() {
    image.click()
  }

  image.onchange = function() {
    var reader = new FileReader()
    reader.onload = function(e) {
      form.style.backgroundImage = "url(" + e.target.result + ")"
      form.style.backgroundSize = "cover"
      form.style.backgroundPosition = "center"
      form.style.backgroundColor = "none"
    }
    reader.readAsDataURL(image.files[0])
  }

  form.appendChild(image)  
  document.getElementById("images").appendChild(form)

  image.click()
}