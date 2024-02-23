const accordionItemHeaders = document.querySelectorAll(".accordion__head");
accordionItemHeaders.forEach(accordionItemHeader => {
  accordionItemHeader.addEventListener("click", event => {
    const currentlyActiveAccordionItemHeader = document.querySelector(".accordion__head.accordion__head--active");
    if (currentlyActiveAccordionItemHeader && currentlyActiveAccordionItemHeader !== accordionItemHeader) {
      currentlyActiveAccordionItemHeader.classList.toggle("accordion__head--active");
      currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
      currentlyActiveAccordionItemHeader.nextElementSibling.style.marginBottom = 0;
    }
    accordionItemHeader.classList.toggle("accordion__head--active");
    const accordionItemBody = accordionItemHeader.nextElementSibling;
    if (accordionItemHeader.classList.contains("accordion__head--active")) {
      accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
      accordionItemBody.style.marginBottom = "15px";
    } else {
      accordionItemBody.style.maxHeight = 0;
      accordionItemBody.style.marginBottom = 0;
    }
  });
});