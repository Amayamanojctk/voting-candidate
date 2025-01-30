document.addEventListener("DOMContentLoaded", function () {
   
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', function () {
            this.style.transform = "scale(1.1)";
        });

        btn.addEventListener('mouseleave', function () {
            this.style.transform = "scale(1)";
        });
    });

    // Confirmation on logout
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function (event) {
            if (!confirm("Are you sure you want to logout?")) {
                event.preventDefault();
            }
        });
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const loginBtn = document.querySelector(".login-btn");

    
    loginBtn.addEventListener("mouseenter", function () {
        this.style.transform = "scale(1.05)";
    });

    loginBtn.addEventListener("mouseleave", function () {
        this.style.transform = "scale(1)";
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            if (!confirm("Are you sure you want to delete this candidate?")) {
                event.preventDefault();
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const submitBtn = document.querySelector(".submit-btn");

   
    submitBtn.addEventListener("mouseenter", function () {
        this.style.transform = "scale(1.05)";
    });

    submitBtn.addEventListener("mouseleave", function () {
        this.style.transform = "scale(1)";
    });
});





