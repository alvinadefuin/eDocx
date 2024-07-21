var inputs = document.querySelectorAll('[name="option[]"]');
var radioForCheckboxes = document.getElementById("radio-for-checkboxes");
function checkCheckboxes() {
  var isAtLeastOneServiceSelected = false;
  for (var i = inputs.length - 1; i >= 0; --i) {
    if (inputs[i].checked) isAtLeastOneCheckboxSelected = true;
  }
  radioForCheckboxes.checked = isAtLeastOneCheckboxSelected;
}
for (var i = inputs.length - 1; i >= 0; --i) {
  inputs[i].addEventListener("change", checkCheckboxes);
}
