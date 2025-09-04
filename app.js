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

function handleFilterSelection() {
  const filterForm = document.getElementById("filter-form");
  const filterFormSelect = document.querySelector("#filter-form select");
  if (!filterForm || !filterFormSelect) {
    return;
  }

  filterFormSelect.addEventListener("change", () => {
    filterForm.submit();
  });
}

function handleSortSelection() {
  const sortForm = document.getElementById("sort-form");
  const sortFormSelect = document.querySelectorAll("#sort-form select");
  if (!sortForm || !sortFormSelect) {
    return;
  }
  sortFormSelect.forEach((sortSelect) => {
    sortSelect.addEventListener("change", () => {
      sortForm.submit();
    });
  });
}

function scrollPageDown() {
  const taskTable = document.getElementById("task-table");
  const taskInput = document.querySelector(".task-input");
  const header = document.querySelector('header');
  const headerHeight = header.getBoundingClientRect().height;
  const taskInputHeight = taskInput.getBoundingClientRect().height;
  if (!taskTable) return;
  window.scrollBy({
    behavior: "smooth",
    top: headerHeight + taskInputHeight + 250,
    left: 0,
  });
}

scrollPageDown();
handleSortSelection();
handleFilterSelection();
