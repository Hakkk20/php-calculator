const display = document.getElementById("display");
const expressionInput = document.getElementById("expressionInput");
const form = document.getElementById("calcForm")
const buttons = document.getElementsByClassName("calcBtn");

Array.from(buttons).forEach(button => {
    button.addEventListener("click", () => {
         const type = button.dataset.type;
         const value = button.value;

         if(type === "number" || type === "operator") {
            if (display.innerText === "0") {
                display.innerText = value;
            } else {
                display.innerText += value;
            }
         }

         if(type === "clear") {
            display.innerText = "0";
         }

         if (type === "equals") {
            expressionInput.value = display.innerText;
            form.submit();
         }
    })
});