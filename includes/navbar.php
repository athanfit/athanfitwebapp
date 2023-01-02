<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                <a class="nav-link" aria-label="go to workout page" href="../workout/">Workouts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-label="go to program page" href="../program/">Program</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-label="go to program page" href="../body/">Body</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item navbar-rightFloat">
                <a class="nav-link" aria-label="go to account page" href="../Account/">Account</a>
            </li>
            <li class="nav-item navbar-rightFloat">
                <a class="nav-link" aria-label="here to logout" href="../php/logout.php">Logout</a>
            </li>
            <?php
            }
            ?>
        </ul>
        </div>
    </div>
</nav>