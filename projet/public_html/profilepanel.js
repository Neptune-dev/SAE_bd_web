
let updateBtn = document.getElementById("updateBtn");
let cancelUpdateBtn = document.getElementById("cancelUpdateBtn");

let profileDisplay = document.getElementById("profileDisplay");
let updateProfileForm = document.getElementById("updateProfileForm");

updateBtn.addEventListener("click", () => { 
    profileDisplay.style.display = "none";
    updateProfileForm.style.display = "flex";
});

cancelUpdateBtn.addEventListener("click", () => {
    updateProfileForm.style.display = "none";
    profileDisplay.style.display = "flex";
});