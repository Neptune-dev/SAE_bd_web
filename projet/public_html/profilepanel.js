
let updateBtn = document.getElementById("updateBtn");

let profileDisplay = document.getElementById("profileDisplay");
let updateProfileForm = document.getElementById("updateProfileForm");

updateBtn.addEventListener("click", () => { 
    profileDisplay.style.display = "none";
    updateProfileForm.style.display = "flex";
});