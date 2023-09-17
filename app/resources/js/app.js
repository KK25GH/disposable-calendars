import './bootstrap';

const input = document.querySelector("textarea");
const log = document.getElementById("memo");

input.addEventListener("input", updateValue);

function updateValue(e) {
    const view = e.target.value;
}
