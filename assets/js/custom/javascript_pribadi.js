function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
// Format options
const optionFormat = (item) => {
  if (!item.id) {
      return item.text;
  }

  var span = document.createElement('span');
  var template = '';

  template += '<div class="d-flex align-items-center justify-content-between">';
  template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="h-40px me-3" alt="' + item.text + '"/>';
  template += '<div class="d-flex flex-column text-end">'
  template += '<span class="fs-5 text-dark fw-medium lh-1">' + item.text + '</span>';
  template += '<span class="text-muted fs-8">' + item.element.getAttribute('data-kt-rich-content-subcontent') + '</span>';
  template += '</div>';
  template += '</div>';

  span.innerHTML = template;

  return $(span);
}

// Init Select2 --- more info: https://select2.org/
$('#operator_select2').select2({
  placeholder: "Select an option",
  minimumResultsForSearch: Infinity,
  templateSelection: optionFormat,
  templateResult: optionFormat
});
$('.operator_select2_custom').select2({
  placeholder: "Select an option",
  minimumResultsForSearch: Infinity,
  templateSelection: optionFormat,
  templateResult: optionFormat
});


// Nomor Select2
// Format options
const optionFormatNomor = (item) => {
  if (!item.id) {
      return item.text;
  }

  var span = document.createElement('span');
  var template = '';

  template += '<div class="d-flex align-items-center justify-content-between">';
  template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="h-30px me-3" alt="' + item.text + '"/>';
  template += '<div class="d-flex flex-column text-end">'
  template += '<span class="fs-5 text-dark fw-medium lh-1">' + item.text + '</span>';
  template += '<span class="text-muted fs-8">' + item.element.getAttribute('data-kt-rich-content-subcontent') + '</span>';
  template += '</div>';
  template += '</div>';

  span.innerHTML = template;

  return $(span);
}

// Init Select2 --- more info: https://select2.org/
$('#nomor_select2').select2({
  placeholder: "Select an option",
  minimumResultsForSearch: Infinity,
  templateSelection: optionFormatNomor,
  templateResult: optionFormatNomor
});


function toggleText() {
 
  // Get all the elements from the page
  let points =
      document.getElementById("points");

  let showMoreText =
      document.getElementById("moreText");

  let buttonText =
      document.getElementById("textButton");

  // If the display property of the dots 
  // to be displayed is already set to 
  // 'none' (that is hidden) then this 
  // section of code triggers
  if (points.style.display === "none") {

      // Hide the text between the span
      // elements
      showMoreText.style.display = "none";

      // Show the dots after the text
      points.style.display = "inline";

      // Change the text on button to 
      // 'Show More'
      buttonText.innerHTML = "Selengkapnya";
  }

  // If the hidden portion is revealed,
  // we will change it back to be hidden
  else {

      // Show the text between the
      // span elements
      showMoreText.style.display = "inline";

      // Hide the dots after the text
      points.style.display = "none";

      // Change the text on button
      // to 'Show Less'
      buttonText.innerHTML = "Sembunyikan";
  }
}

  