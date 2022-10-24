//로그인
const loginBtn = document.querySelector(".loginBtn");
const loginPop = document.querySelector(".login__popup");
const loginClose = document.querySelector(".btn-close");

loginBtn.addEventListener("click", () => {
    loginPop.classList.add("open");
});

loginClose.addEventListener("click", () => {
    loginPop.classList.remove("open");
})