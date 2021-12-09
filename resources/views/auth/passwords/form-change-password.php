<?= $errorResult ?? '' ?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 offset-md-3">

            <!-- form card -->
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Change Password</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="/change-password" autocomplete="off">

                        <div class="form-group">
                            <label for="current_password">Current Password <span style="color: #FF0000;">*</span></label>
                            <input id="current_password"
                                   name="current_password"
                                   type="password"
                                   class="form-control <?= !empty($error['current_password']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['current_password']) ? html_escape($_POST['current_password']) : '' ?>"
                                   autocomplete="current_password"
                                   autofocus
                            >

                            <?php if (!empty($error['password'])): ?>
                                <span class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : '' ?>"><?= $error['password'] ?></span>
                            <?php endif; ?>
                            <span id="helpPassword" class="form-text small text-muted">You will be automatically logged out after password change. You will need to re-login.</span>
                        </div>

                        <div class="form-group">
                            <label for="password">New Password <span style="color: #FF0000;">*</span></label>
                            <input id="password"
                                   name="password"
                                   type="password"
                                   class="form-control <?= !empty($error['password']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['password']) ? html_escape($_POST['password']) : '' ?>"
                            >

                            <?php if (!empty($error['password'])): ?>
                                <span class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : '' ?>"><?= $error['password'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Confirm New Password <span
                                        style="color: #FF0000;">*</span></label>
                            <input id="password_confirm"
                                   name="password_confirm"
                                   type="password"
                                   class="form-control <?= !empty($error['password_confirm']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['password_confirm']) ? html_escape($_POST['password_confirm']) : '' ?>"
                            >

                            <?php if (!empty($error['password_confirm'])): ?>
                                <span class="form-text <?= !empty($error['password_confirm']) ? 'invalid-feedback' : '' ?>"><?= $error['password_confirm'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">&#128190; Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
