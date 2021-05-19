document.addEventListener("DOMContentLoaded", () => {
  const signupUserForm = document.querySelector("#form-daftar-user");
  const signupPemilikiRestoForm = document.querySelector(
    "#form-daftar-pemilik-resto"
  );
  const signupRestoForm = document.querySelector("#form-daftar-resto");

  document
    .querySelector("#linkFormPemilikResto")
    .addEventListener("click", (e) => {
      e.preventDefault();
      signupUserForm.classList.add("form-daftar-pemilik-resto-hidden");
      signupPemilikiRestoForm.classList.remove(
        "form-daftar-pemilik-resto-hidden"
      );
    });
  document
    .querySelector("#button-lanjut-daftar-resto")
    .addEventListener("click", (e) => {
      e.preventDefault();
      signupPemilikiRestoForm.classList.add("form-daftar-resto-hidden");
      signupRestoForm.classList.remove("form-daftar-resto-hidden");
    });
});

document.getElementById("daftar-user-button").onclick = function (e) {
  e.preventDefault();
  location.href = "./homepage-profile.html";
};

document.getElementById("daftar-resto-button").onclick = function (e) {
  e.preventDefault();
  location.href = "./homepage-profile.html";
};
