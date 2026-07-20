function validateRegister() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    if (name === "") {
        alert("Name is required");
        return false;
    }

    if (email === "") {
        alert("Email is required");
        return false;
    }

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("Enter a valid email address");
        return false;
    }

    if (password === "") {
        alert("Password is required");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    return true;
}

function validateLogin() {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    if (email === "") {
        alert("Email is required");
        return false;
    }

    if (password === "") {
        alert("Password is required");
        return false;
    }

    return true;
}