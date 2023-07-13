function share() {
  var title = document.getElementById("title").value
  var description = document.getElementById("description").value
  var location = document.getElementById("location").value
  var start_date = document.getElementById("start_date").value
  var end_date = document.getElementById("end_date").value
  var event_type = document.getElementById("type").value

  if (title == "" || description == "" || start_date == "" || end_date == "" || event_type == "") {
    document.getElementById("error").innerHTML = "Please fill out all fields"
    document.getElementById("error").style.display = "block"
    return
  }

  if (location != "" && !location.match(/^(https:\/\/www\.google\.com\/maps\/place\/)(.*)/)) {
    document.getElementById("error").innerHTML = "Please enter a valid Google Maps link"
    document.getElementById("error").style.display = "block"
    return
  }

  var start = new Date(start_date)
  var end = new Date(end_date)
  if (end < start) {
    document.getElementById("error").innerHTML = "The end date must be after the start date"
    document.getElementById("error").style.display = "block"
    return
  }

  document.getElementById("event-form").style.display = "none"
  document.getElementById("loader").style.display = "grid"

  var xhttp = new XMLHttpRequest()
  xhttp.open("POST", "", true)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhttp.send("request=new_event&title=" + title + "&description=" + description + "&location=" + location + "&start_date=" + start_date + "&end_date=" + end_date + "&type=" + event_type)
  xhttp.onreadystatechange = function() {
    if (this.responseText != "") {
      var response = JSON.parse(this.responseText)
  
      if (response.state == "success") {        
        // post every image form to the hidden iframe, then redirect to feed
        post_form(0, response.event_id)
      } else {
        document.getElementById("error").innerHTML = response.message
        document.getElementById("error").style.display = "block"
      }

    }
  }
}

function post_form(i, event_id) {
  var image_forms = document.getElementsByClassName("image-input")
  var frame = document.getElementById("image_upload_target")

  frame.onload = function() {
    if (i < image_forms.length - 1) {
      post_form(i + 1, event_id)
    } else {
      // window.location.href = "."
    }
  }

  image_forms[i].elements["event_id"].value = event_id
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

  var event_id = document.createElement("input")
  event_id.setAttribute("type", "hidden")
  event_id.setAttribute("name", "event_id")

  form.appendChild(event_id)
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

document.getElementById("start_date").onchange = function() {
  document.getElementById("end_date").value = document.getElementById("start_date").value
}