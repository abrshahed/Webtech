/* =========================
   LOGIN
========================= */
const loginForm = document.getElementById("loginForm");

if (loginForm) {
    loginForm.onsubmit = function (e) {
        e.preventDefault();

        const email = document.getElementById("email").value.trim();
        const pass  = document.getElementById("password").value.trim();

        if (email === "" || pass === "") {
            alert("All fields required");
            return;
        }

        const fd = new FormData(this);

        fetch("/controlers/UserControler.php?action=login", {
            method: "POST",
            body: fd
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                window.location.href = "/views/seller/dashboard.php";
            } else {
                alert(data.msg);
            }
        });
    };
}


/* =========================
   REGISTRATION
========================= */
const registerForm = document.getElementById("registerForm");

if (registerForm) {
    registerForm.onsubmit = function (e) {
        e.preventDefault();

        const name  = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const p1    = document.getElementById("password").value;
        const p2    = document.getElementById("cpassword").value;

        if (name === "" || email === "" || p1 === "" || p2 === "") {
            alert("All fields required");
            return;
        }

        if (p1.length < 5) {
            alert("Password must be at least 5 characters");
            return;
        }

        if (p1 !== p2) {
            alert("Password not match");
            return;
        }

        const fd = new FormData(this);

        fetch("/controlers/UserControler.php?action=register", {
            method: "POST",
            body: fd
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                alert("Registration success!");
                window.location.href = "login.php";
            } else {
                alert(data.msg);
            }
        });
    };
}


/* =========================
   ADD PRODUCT
========================= */
const productForm = document.getElementById("productForm");

if (productForm) {
    productForm.onsubmit = function (e) {
        e.preventDefault();

        const title = document.getElementById("ptitle").value.trim();
        const price = document.getElementById("pprice").value.trim();

        if (title === "" || price === "") {
            alert("All fields required");
            return;
        }

        const fd = new FormData(this);

        fetch("/controlers/UserControler.php?action=addProduct", {
            method: "POST",
            body: fd
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById("productMsg").innerText = data.msg;
        });
    };
}


/* =========================
   LOAD PRODUCTS
========================= */
function loadProducts() {
    fetch("/controlers/UserControler.php?action=getProducts")
        .then(res => res.text())
        .then(data => {
            document.getElementById("productList").innerHTML = data;
        });
}

if (document.getElementById("productList")) {
    loadProducts();
}


/* =========================
   LOAD SELLER SALES
========================= */
function loadSales() {
    fetch("/controlers/UserControler.php?action=sellerSales")
        .then(res => res.text())
        .then(data => {
            document.getElementById("salesHistory").innerHTML = data;
        });
}

