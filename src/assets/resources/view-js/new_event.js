function add_image_field() {
    const form = document.querySelector("#new_event_form");
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

document.getElementById("start_date").onchange = function() {
  document.getElementById("end_date").value = document.getElementById("start_date").value
}
