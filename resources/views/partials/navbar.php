<!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/"><?= APP_NAME ?> <?= VERSION ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Admin
                </a>
                <div class="dropdown-menu" aria-labelledby="adminDropdown">
                    <?php
                    $navArray = [
                          '/settings' => 'Settings'
                        , '/errors' => 'Error Log'
                        , '/add-user' => 'Add User'
                        , '/list-users' => 'List Users'
                        , '/list-logins' => 'Login Attempts'
                        , '/change-password' => 'Change Password'
                    ];
                    foreach ($navArray as $path => $linkText)
                    {
                        echo "<a class='dropdown-item' href='$path'>$linkText</a>\n";
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Themes
                </a>
                <div class="dropdown-menu" aria-labelledby="themeDropdown">
                    <?php
                    $navArray = [
                          'default' => 'Default'
                        , 'cerulean' => 'Cerulean'
                        , 'cosmo' => 'Cosmo'
                        , 'cyborg' => 'Cyborg'
                        , 'darkly' => 'Darkly'
                        , 'lumen' => 'Lumen'
                        , 'lux' => 'Lux'
                        , 'minty' => 'Minty'
                        , 'pulse' => 'Pulse'
                        , 'sandstone' => 'Sand Stone'
                        , 'simplex' => 'Simplex'
                        , 'slate' => 'Slate'
                        , 'solar' => 'Solar'
                        , 'spacelab' => 'Spacelab'
                        , 'superhero' => 'Super Hero'
                        , 'united' => 'United'
                        , 'yeti' => 'Yeti'

                    ];
                    foreach ($navArray as $path => $linkText)
                    {
                        $active = $theme === $path ? 'active' : '';
                        echo "<a class='dropdown-item $active' href='?theme=$path'>$linkText</a>\n";
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link">Logged In As <?= $_SESSION['first_name'] ?> <?= $_SESSION['last_name'] ?></a></li>
            <li class="nav-item"><a class="nav-link" href="/logout">Log Out</a></li>
        </ul>
    </div>
</nav>
