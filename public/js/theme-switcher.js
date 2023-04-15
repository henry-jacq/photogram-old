// Get current theme
let current_theme = $("html").attr("data-bs-theme");
// Theme value stored in local storage
let stored_theme = localStorage.getItem("theme-value");

// Set theme from local storage
if (stored_theme == null) {
  // Set dark in theme-value as default
  localStorage.setItem("theme-value", current_theme);
} else {
  if (stored_theme == "auto" || stored_theme == "light") {
    $("html").attr("data-bs-theme", "light");
    $("#themeSwitcher > i").removeClass("bi-moon-stars");
    $("#themeSwitcher > i").addClass("bi-brightness-high");
  } else if (stored_theme == "dark") {
    $("html").attr("data-bs-theme", "dark");
    $("#themeSwitcher > i").removeClass("bi-brightness-high");
    $("#themeSwitcher > i").addClass("bi-moon-stars");
  }
}

// Change theme on click
$("#themeSwitcher").on("click", function () {
  let theme_attr = "data-bs-theme";
  let current_theme = $("html").attr(theme_attr);

  if (current_theme == "light") {
    $("#themeSwitcher").attr("data-bs-title", "Change to dark theme");
    $("#themeSwitcher > i").removeClass("bi-brightness-high");
    $("#themeSwitcher > i").addClass("bi-moon-stars");
    $("html").attr(theme_attr, "dark");
    localStorage.setItem("theme-value", "dark");
  } else if (current_theme == "dark") {
    $("#themeSwitcher").attr("data-bs-title", "Change to light theme");
    $("#themeSwitcher > i").removeClass("bi-moon-stars");
    $("#themeSwitcher > i").addClass("bi-brightness-high");
    $("html").attr(theme_attr, "light");
    localStorage.setItem("theme-value", "light");
  }
});

// To trigger the tooltip
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);
