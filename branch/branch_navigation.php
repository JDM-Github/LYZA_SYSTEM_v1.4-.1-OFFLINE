<header>
    <!----- Navigation | Branch Page ----->
    <div class="custom-nav-header">
        <div class="container align-items-bottom justify-content-between pt-1">
            <small class="text-white">Branch Panel > Welcome, Staff!</small>
        </div>
    </div>

    <nav class="navbar custom-navbar shadow" id="navbar">
        <div class="container">
            <!----- Logo/Brand ----->
            <div class="justify-content-start align-self-center">
                <img class="align-self-start" src="img/BusinessName.png" alt="Lyza Drugmart" width="190" height=""><br>
                <span class="pt-0 fw-bold" style="color: var(--dark);">BRANDED & GENERIC MEDICINES</span>
            </div>

            <!----- Log Out ----->
            <div class="justify-content-start align-self-center d-flex">
                <form action="backend/redirector.php" method="POST">
                    <input type="hidden" name="type" value="save-config">
                    <button class="btn custom-btn-success rounded-4 py-2 px-4 me-2" type="submit" href="index.php">
                        <small>SAVE CONFIG</small>
                    </button>
                </form>
                <a class="btn custom-btn-success rounded-4 py-2 px-4" type="button" href="index.php">
                    <small>LOG OUT</small>
                </a>
            </div>
        </div>
    </nav>
</header>