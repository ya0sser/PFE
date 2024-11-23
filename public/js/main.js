const menuBtn = document.getElementById("menu-btn1");
const navLinks = document.getElementById("nav-links1");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute("class1", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "ri-menu-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

ScrollReveal().reveal(".container__left1 h1", {
  ...scrollRevealOption,
});
ScrollReveal().reveal(".container__left1 .container__btn1", {
  ...scrollRevealOption,
  delay: 500,
});

ScrollReveal().reveal(".container__right1 h4", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".container__right1 h2", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".container__right1 h3", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".container__right1 p", {
  ...scrollRevealOption,
  delay: 1100,
});

ScrollReveal().reveal(".container__right1 .tent-11", {
  duration: 1000,
  delay: 1200,
});

ScrollReveal().reveal(".location1", {
  ...scrollRevealOption,
  origin: "left",
  delay: 1000,
});

ScrollReveal().reveal(".socials1 span", {
  ...scrollRevealOption,
  origin: "top",
  delay: 1000,
  interval: 500,
});
ScrollReveal().reveal(".item-container1", {
  ...scrollRevealOption,
  delay: 700,
});
document.addEventListener('DOMContentLoaded', function() {
  const selectQuantity = document.getElementById('quantity');
  const totalPriceDisplay = document.getElementById('totalPrice');
  
  // Function to update the total price display
  function updateTotal() {
      const ticketPrice = 8.00;
      const serviceFee = 0.20;
      const quantity = parseInt(selectQuantity.value, 10);
      const total = (ticketPrice + serviceFee) * quantity;
      
      // Format the total as a currency string
      totalPriceDisplay.textContent = total.toFixed(2).replace('.', ',') + ' DH';
  }

  // Event listener to update the total whenever the quantity changes
  selectQuantity.addEventListener('change', updateTotal);

  // Initial update in case the default selected quantity is not zero
  updateTotal();
});
