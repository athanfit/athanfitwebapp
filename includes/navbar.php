<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../">Athanfit</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php
            if (isset($_SESSION["ID"])){
            if ($_SESSION['verified'] == "1")
            {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="../workout/">Workouts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../program/">Program</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="../Account/">Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../php/logout.php">Logout</a>
            </li>
            <?php
            }
            ?>
        </ul>
        </div>
    </div>
</nav>