---
layout: default
title: Admin - Login
permalink: /admin/login
---

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">

            {% raw %}

            <?php
            
            $failure = $_GET['failure'];
            if ($failure) {
                echo "<p class='text-danger'>Invalid username/password combination</p>";
            }
            
            ?>
            
            {% endraw %}

            <div class='panel panel-default'>

                <div class='panel-heading'>
                    <h2 class='panel-title'>Login</h2>
                </div>

                <div class='panel-body'>

                    <form action='check.php' method='post' enctype='multipart/form-data'>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <p class="warning" id="email-warning"></p>
                            <input type="text" name="email" class="form-control" id="email" required>
                        </div>

                        <div class='form-group'>
                            <label for='password'>Password</label>
                            <p class='warning' id='password1-warning'></p>
                            <input type='password' name='password' class='form-control' id='password' required>
                        </div>

                        <input class='btn btn-primary' type='submit' value='Submit' name='submit' id='submit' style='margin-top: 15px'>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

