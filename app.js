"use strict";

function handleTaskAdd() {
  const taskForm = document.querySelector(".task-input > form");
  taskForm.addEventListener("submit", (event) => {
    handleSubmit(event, taskForm);
  });
}

let hasAnimationRan = false;
function handleSubmit(event, form) {
  if (hasAnimationRan) {
    return;
  }
  event.preventDefault();
  const alertContainer = document.querySelector(".alert-container");
  alertContainer.classList.add("visible");
  setTimeout(() => {
    alertContainer.classList.remove("visible");
    hasAnimationRan = true;
    form.submit();
  }, 2000);
}
handleTaskAdd();
