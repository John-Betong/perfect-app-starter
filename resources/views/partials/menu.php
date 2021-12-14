<div class="card border-primary mb-3" style="max-width: 15rem;">
    <div class="card-header">
        <img src="/images/default-profile.jpg" width="140" height="140" alt="Profile Image">
    </div>
    <?php
    $navArray = [
          '/' =>'Home'
        , '/list-users' => 'List Users'
        , '/change-password '=> 'Change Password'
        , '/settings'=>'Settings'
        , '/list-logins' => 'Login Attempts'
        , '/errors' => 'Error Log'
        , '/logout' => 'Log Out'
    ];
    echo '<ul class="list-group list-group-flush">';
    foreach($navArray as $path => $linkText) {
        echo "<li class='list-group-item'><a href='$path'>$linkText</a></li>\n";
    }
    echo '</ul>';
    ?>
</div>