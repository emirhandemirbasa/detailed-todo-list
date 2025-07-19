<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
?>
<?php include "partials/_header.php" ?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #3c00a4ff, #5500c5ff);
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        background: linear-gradient(180deg, #0d6efd, #6610f2);
        box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
        padding-top: 25px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1050;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .sidebar .side {
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        font-size: 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 30px 0 0 30px;
        margin: 5px 0;
    }

    .sidebar .side i {
        font-size: 1.3rem;
        margin-right: 12px;
        background: rgba(255, 255, 255, 0.15);
        padding: 8px;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .sidebar .side:hover {
        background-color: rgba(255, 255, 255, 0.15);
        padding-left: 35px;
    }

    .sidebar .side:hover i {
        transform: rotate(360deg) scale(1.2);
    }

    @media (min-width: 768px) {
        .sidebar {
            transform: translateX(0);
        }

        #main-content {
            margin-left: 250px;
        }

        #menu-btn {
            display: none;
        }
    }

.icon-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
}

.footer-icon {
    all: unset;
    cursor: pointer;
    font-size: 2rem;
    color: black;
    transition: transform 0.3s ease, color 0.3s ease;
}

.footer-icon:hover {
    transform: scale(1.3);
}

.github{
    background: black;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: transform 0.3s ease;
}

.instagram{
    background: linear-gradient(45deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
    background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: transform 0.3s ease;
}

.linkedin{
    background: #0055b0ff;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: transform 0.3s ease;
}

</style>

<nav class="d-md-none bg-primary text-white p-3 d-flex justify-content-between align-items-center">
    <div class="fw-bold fs-4">ToDo Web Uygulaması</div>
    <button id="menu-btn" class="btn btn-outline-light">
        <i class="bi bi-list fs-4"></i>
    </button>
</nav>

<div class="sidebar" id="sidebar">
    <div class="fw-bold fs-4 text-white text-center">ToDo Web Uygulaması</div>
    <a href="index.php" class="side"><i class="bi bi-house-door-fill"></i> Anasayfa</a>
    <a href="notlar.php" class="side"><i class="bi bi-card-checklist"></i> Notlarım</a>
    <a href="#" class="side" data-bs-toggle="modal" data-bs-target="#notEkle"><i class="bi bi-plus-circle-fill"></i> Not Ekle</a>
    <a href="profil.php" class="side"><i class="bi bi-person-fill"></i> Profil</a>
    <a href="#" class="side" data-bs-toggle="modal" data-bs-target="#onay">
        <i class="bi bi-box-arrow-right me-2"></i> Çıkış
    </a>

    <!-- Footer -->
    <div class="text-center mt-auto p-3 position-absolute bottom-0 w-100 border-top border-white">
        <div class="icon-wrapper">
            <a href="https://www.github.com/emirhandemirbasa" class="footer-icon github shadow" target="_blank"><i class="bi bi-github"></i></a>
            <a href="https://www.linkedin.com/in/emirhan-demirba%C5%9Fa-905664297/" target="_blank" class="footer-icon linkedin shadow"><i class="bi bi-linkedin"></i></a>
            <a href="https://www.instagram.com/emirhan.demirbasa" class="footer-icon instagram" target="_blank"><i class="bi bi-instagram shadow"></i></a>
        </div>
        <p class="d-block mt-2 text-white">Emirhan Demirbaşa &copy; 2025</p>
    </div>
</div>

<?php include "modals/logout-modal.php"; ?>
<?php include "modals/not_ekle-modal.php"; ?>
<script>
    document.getElementById("menu-btn").addEventListener("click", function() {
        document.getElementById("sidebar").classList.toggle("active");
    });
</script>



<?php include "partials/_footer.php" ?>