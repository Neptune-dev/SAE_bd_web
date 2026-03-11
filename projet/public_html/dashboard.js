
let sidebar = document.getElementById("sidebar");
let contentContainer = document.getElementById("contentContainer");

//contenus
let contents = Array.from(contentContainer.getElementsByClassName("content"));

//sidebar boutons
let sidebarButtons = Array.from(sidebar.getElementsByClassName("sidebarButton"));

// interaction clickable de la sidebar
sidebarButtons.forEach(btn => {
    btn.addEventListener("click", () => {
        ChangeSelection(btn);
    });
});

// changement du content
function ChangeSelection (selected) {
    // selection dans la sidebar
    sidebarButtons.forEach(btn => {
        btn.classList.remove("selected");
    });
    selected.classList.add('selected');

    // selection dans les contents
    const id = selected.id.replace(/Button$/, '');
    
    contents.forEach(ct => {
        if (ct.id.replace(/Content$/, '') == id) {
            ct.style.visibility = "visible";
            ct.style.order = "0";
        } else {
            ct.style.visibility = "hidden";
            ct.style.order = "1";
        }
    });
}