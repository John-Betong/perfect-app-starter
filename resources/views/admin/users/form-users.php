<?= $errorResult ?? '' ?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 offset-md-3">

            <!-- form card -->
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><?= !empty($_GET['id'])  ? 'Edit' : 'Add' ?> User</h3>
                </div>
                <div class="card-body">
                    <form method="post" autocomplete="off" action="<?= $uri ?>">

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input id="is_active" name="is_active" type="checkbox" class="custom-control-input"
                                       value="1"
                                    <?= !empty($form_data['is_active']) ? 'checked' : '' ?> >
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role_id">Select Role</label>
                            <select id="role_id"
                                    name="role_id"
                                    class="form-control <?= !empty($error['role_id']) ? 'is-invalid' : '' ?>"
                                    required>
                                <option value='' style="display:none">Select Role</option>
                                <?php
                                foreach ($roles as $role)
                                {
                                    $selected = isset($form_data['role_id']) && $form_data['role_id'] == $role['role_id'] ? 'selected' : '';
                                    echo "<option value='{$role['role_id']}' $selected>{$role['role_description']}</option>\n";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="username">Username <span style="color: #FF0000;">*</span></label>
                            <input id="username"
                                   name="username"
                                   type="text"
                                   class="form-control <?= !empty($error['username']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($form_data['username']) ? html_escape($form_data['username']) : '' ?>"
                                   required>

                            <?php if (!empty($error['username'])): ?>
                                <span class="form-text <?= !empty($error['username']) ? 'invalid-feedback' : '' ?>"><?= $error['username'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span style="color: #FF0000;">*</span></label>
                            <input id="password"
                                   name="password"
                                   type="text"
                                   class="form-control <?= !empty($error['password']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($form_data['password']) ? html_escape($form_data['password']) : '' ?>"
                                   required>

                            <?php if (!empty($error['password'])): ?>
                                <span class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : '' ?>"><?= $error['password'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span style="color: #FF0000;">*</span></label>
                            <input id="email"
                                   name="email"
                                   type="email"
                                   class="form-control <?= !empty($error['email']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($form_data['email']) ? html_escape($form_data['email']) : '' ?>"
                                   required>

                            <?php if (!empty($error['email'])): ?>
                                <span class="form-text <?= !empty($error['email']) ? 'invalid-feedback' : '' ?>"><?= $error['email'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name <span style="color: #FF0000;">*</span></label>
                            <input id="first_name"
                                   name="first_name"
                                   type="text"
                                   class="form-control <?= !empty($error['first_name']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($form_data['first_name']) ? html_escape($form_data['first_name']) : '' ?>"
                            >

                            <?php if (!empty($error['first_name'])): ?>
                                <span class="form-text <?= !empty($error['first_name']) ? 'invalid-feedback' : '' ?>"><?= $error['first_name'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name <span style="color: #FF0000;">*</span></label>
                            <input id="last_name"
                                   name="last_name"
                                   type="text"
                                   class="form-control <?= !empty($error['last_name']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($form_data['last_name']) ? html_escape($form_data['last_name']) : '' ?>"
                            >

                            <?php if (!empty($error['last_name'])): ?>
                                <span class="form-text <?= !empty($error['last_name']) ? 'invalid-feedback' : '' ?>"><?= $error['last_name'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="owned_by" value="<?= html_escape($_SESSION['user_id']) ?>">
                            <?= !empty($_REQUEST['id']) ? '<input type="hidden" name="id" value="' . html_escape($_REQUEST['id']) . '">' : '' ?>
                            <button class="btn btn-primary"><span></span>&#128190; Save</button>
                            <button class="btn btn-primary" name="new">&#9989; Save &amp; New</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
