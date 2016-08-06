---
layout: default
title: Admin - Create User
permalink: /admin/create-user
---

<div class="container">
    <div class="row">
        <div class="col-xs-9 col-sm-8 col-md-6 col-lg-4">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h2 class="panel-title">Create user form</h2>
                </div>

                <div class="panel-body">

                    <form action="create-user-success.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="email">Email</label>
                            <p class="warning" id="email-warning"></p>
                            <input type="text" name="email" class="form-control" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <p class="warning" id="password-warning"></p>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>

                        <div class="form-group">
                            <label for="password2">Confirm password</label>
                            <p class="warning" id="password2-warning"></p>
                            <input type="password" name="password2" class="form-control" id="password2" required>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Submit" name="submit" id="submit" style="margin-top: 15px">
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>