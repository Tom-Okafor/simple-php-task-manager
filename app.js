"use strict";

function handleTaskAdd() {
  const taskForm = document.querySelector(".task-input > form");
  taskForm.addEventListener("submit", (event) => {
    handleSubmit(event);
  });
}

let hasAnimationRan = false;
function handleSubmit(event) {
  if (hasAnimationRan) {
    return;
  }
  event.preventDefault();
  const alertContainer = document.querySelector(".alert-container");
  alertContainer.classList.add("visible");
  const submitButton = document.querySelector(".task-input button");
  setTimeout(() => {
    alertContainer.classList.remove("visible");
    hasAnimationRan = true;
    submitButton.click();
  }, 2000);
}
handleTaskAdd();
