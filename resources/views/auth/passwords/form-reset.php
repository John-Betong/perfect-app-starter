<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 offset-md-3">

            <!-- form card -->
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Password Reset</h3>
                </div>
                <div class="card-body">
                    <form method="post" autocomplete="off">

                        <div class="form-group">
                            <label for="reset_code">Reset Code <span style="color: #FF0000;">*</span></label>
                            <input id="reset_code"
                                   name="reset_code"
                                   type="text"
                                   class="form-control <?= !empty($error['reset_code']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($reset_code) ? html_escape($reset_code) : '' ?>"
                                   autofocus
                            >

                            <?php if (!empty($error['reset_code'])): ?>
                                <span class="form-text <?= !empty($error['reset_code']) ? 'invalid-feedback' : '' ?>"><?= $error['reset_code'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password <span style="color: #FF0000;">*</span></label>
                            <input id="new_password"
                                   name="new_password"
                                   type="password"
                                   class="form-control <?= !empty($error['new_password']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['new_password']) ? html_escape($_POST['new_password']) : '' ?>"
                            >

                            <?php if (!empty($error['new_password'])): ?>
                                <span class="form-text <?= !empty($error['new_password']) ? 'invalid-feedback' : '' ?>"><?= $error['new_password'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="confirm_new_password">Confirm New Password <span
                                        style="color: #FF0000;">*</span></label>
                            <input id="confirm_new_password"
                                   name="confirm_new_password"
                                   type="password"
                                   class="form-control <?= !empty($error['confirm_new_password']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['confirm_new_password']) ? html_escape($_POST['confirm_new_password']) : '' ?>"
                            >

                            <?php if (!empty($error['confirm_new_password'])): ?>
                                <span class="form-text <?= !empty($error['confirm_new_password']) ? 'invalid-feedback' : '' ?>"><?= $error['confirm_new_password'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-md">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
