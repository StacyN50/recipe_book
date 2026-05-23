/* ====================================
   APP INITIALIZATION
==================================== */

document.addEventListener("DOMContentLoaded", () => {

    console.log("Recipe Book App Loaded");

    initializeSearch();

    initializeImagePreview();

    initializeScrollEffects();

    initializeMobileMenu();

});

/* ====================================
   SEARCH FUNCTION
==================================== */

function initializeSearch(){

    const searchInput = document.querySelector("#liveSearch");

    if(searchInput){

        searchInput.addEventListener("keyup", function(){

            let filter = this.value.toLowerCase();

            let cards = document.querySelectorAll(".recipe-card");

            cards.forEach(card => {

                let title = card.querySelector("h3").innerText.toLowerCase();

                let category = card.querySelector("p").innerText.toLowerCase();

                if(
                    title.includes(filter) ||
                    category.includes(filter)
                ){
                    card.style.display = "block";
                }else{
                    card.style.display = "none";
                }

            });

        });

    }

}

/* ====================================
   IMAGE PREVIEW
==================================== */

function initializeImagePreview(){

    const imageInput = document.querySelector("#imageInput");

    if(imageInput){

        imageInput.addEventListener("change", function(e){

            const file = e.target.files[0];

            if(file){

                const reader = new FileReader();

                reader.onload = function(event){

                    let preview = document.querySelector("#imagePreview");

                    if(preview){

                        preview.src = event.target.result;

                        preview.style.display = "block";

                    }

                }

                reader.readAsDataURL(file);

            }

        });

    }

}

/* ====================================
   DELETE CONFIRMATION
==================================== */

function confirmDelete(){

    return confirm(
        "Are you sure you want to delete this recipe?"
    );

}

/* ====================================
   SCROLL ANIMATIONS
==================================== */

function initializeScrollEffects(){

    const cards = document.querySelectorAll(".recipe-card");

    const observer = new IntersectionObserver(entries => {

        entries.forEach(entry => {

            if(entry.isIntersecting){

                entry.target.style.opacity = "1";

                entry.target.style.transform = "translateY(0px)";

            }

        });

    });

    cards.forEach(card => {

        card.style.opacity = "0";

        card.style.transform = "translateY(30px)";

        card.style.transition = "0.5s";

        observer.observe(card);

    });

}

/* ====================================
   MOBILE MENU
==================================== */

function initializeMobileMenu(){

    const menuBtn = document.querySelector(".menu-btn");

    const navLinks = document.querySelector("nav ul");

    if(menuBtn){

        menuBtn.addEventListener("click", () => {

            navLinks.classList.toggle("show");

        });

    }

}

/* ====================================
   FAVORITE BUTTON
==================================== */

function toggleFavorite(button){

    button.classList.toggle("active");

    if(button.classList.contains("active")){

        button.innerHTML = "❤️ Favorited";

    }else{

        button.innerHTML = "🤍 Add to Favorites";

    }

}

/* ====================================
   RECIPE FORM VALIDATION
==================================== */

function validateRecipeForm(){

    const title = document.querySelector("#title");

    const ingredients = document.querySelector("#ingredients");

    const instructions = document.querySelector("#instructions");

    if(title.value.trim() === ""){

        alert("Recipe title is required");

        title.focus();

        return false;

    }

    if(ingredients.value.trim() === ""){

        alert("Ingredients are required");

        ingredients.focus();

        return false;

    }

    if(instructions.value.trim() === ""){

        alert("Instructions are required");

        instructions.focus();

        return false;

    }

    return true;

}

/* ====================================
   DARK MODE
==================================== */

function toggleDarkMode(){

    document.body.classList.toggle("dark-mode");

    localStorage.setItem(
        "darkMode",
        document.body.classList.contains("dark-mode")
    );

}

/* ====================================
   LOAD DARK MODE
==================================== */

window.onload = function(){

    if(localStorage.getItem("darkMode") === "true"){

        document.body.classList.add("dark-mode");

    }

}

/* ====================================
   TOAST MESSAGE
==================================== */

function showToast(message){

    const toast = document.createElement("div");

    toast.className = "toast";

    toast.innerText = message;

    document.body.appendChild(toast);

    setTimeout(() => {

        toast.classList.add("show");

    }, 100);

    setTimeout(() => {

        toast.remove();

    }, 3000);

}