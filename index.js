 function toggleSidebar() {
      document.getElementById("sidebar").classList.toggle("open");
      document.getElementById("overlay").classList.toggle("show");
    }

    function toggleSubmenu(id, triggerElement) {
      const submenu = document.getElementById(id);
      const isVisible = submenu.classList.contains('show');

      if (isVisible) {
        submenu.classList.remove('show');
        triggerElement.setAttribute('aria-expanded', 'false');
      } else {
        submenu.classList.add('show');
        triggerElement.setAttribute('aria-expanded', 'true');
      }
    }
    function copyLink() {
  const link = window.location.href;
  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(link)
      .then(() => alert("Link copied to clipboard!"))
      .catch(() => fallbackCopy(link));
  } else {
    fallbackCopy(link);
  }
}

function fallbackCopy(link) {
  // Create temporary input
  const tempInput = document.createElement("input");
  tempInput.value = link;
  document.body.appendChild(tempInput);
  tempInput.select();
  try {
    document.execCommand("copy");
    alert("Link copied (fallback method)!");
  } catch (err) {
    alert("Copy failed. Please copy it manually:\n" + link);
  }
  document.body.removeChild(tempInput);
}
  const form = document.getElementById("contact-form");
  const successMessage = document.getElementById("success-message");

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    successMessage.style.display = "block";


    setTimeout(() => {
      successMessage.style.display = "none";
    }, 3000);
    form.reset();
  });