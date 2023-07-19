function share() {
  var title = document.getElementById("title").value
  var description = document.getElementById("description").value
  var location = document.getElementById("location").value

  if (title == "") {
    document.getElementById("error").innerHTML = "Please fill out all fields"
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
        // post every image form to the hidden iframe, then redirect to feed
        post_form(0, response.post_id)
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
    } else {
      window.location.href = "."
    }
  }

  image_forms[i].elements["post_id"].value = post_id
  image_forms[i].submit()
}

function add_image_field() {
    const form = document.querySelector("#new_post_form");
    const images = document.querySelector("#images")
    const image_count = images.querySelectorAll("img")?.length;
    const image_index = image_count + 1;
    const image = document.createElement("input")
    image.setAttribute("type", "file")
    image.setAttribute("name", "image_" + image_count);
    image.setAttribute("class", "hidden");

    const renderer = document.createElement("img")

    form.appendChild(image)
    images.appendChild(renderer)

    image.onchange = function() {
        var reader = new FileReader()
        reader.onload = function(e) {
            renderer.setAttribute("src", e.target.result);
        }
        reader.readAsDataURL(image.files[0])
    }

    image.click()
}
