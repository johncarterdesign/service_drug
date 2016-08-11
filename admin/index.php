---
layout: default
title: Admin
permalink: /admin/
---

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="trashModalLabel" id="adminWeddingTrashModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="lead text-warning modal-title">Are you sure you want to delete this registry account?</div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-8">

                        <h4 class="modal-names" id="gridSystemModalLabel">Modal title</h4>
                        <img class="img-responsive modal-img" src="">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-danger btn-delete" href="">Delete account</a>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container">

    <div class="row">
        <div class="col-xs-12">
            {% raw %}
            <?php if ($_GET["deleteSuccess"]) {
    echo "<p class='lead text-success'>Account successfully deleted.</p>";

} else if ($_GET["deleteFailure"]) {
    echo "<p class='lead text-danger'>Sorry, there was a problem with your connection. please try again later</p>";
}
            ?>
            {% endraw %}
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#wedding" aria-controls="wedding" role="tab" data-toggle="tab">Wedding Registry</a></li>
            </ul>

        </div>
    </div>

    <!-- Tab panes -->
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="wedding">
            <div class="row">
                <div class="col-xs-12">

                    <h2 class="sr-only">Wedding Registry</h2>

                    {% raw %}

                    <?php

                    // WEDDING REGISTRY
                    $servernameWedding = "45.40.164.16";
                    $usernameWedding = "sdweddingreg";
                    $passwordWedding = "Sd%w3dd1ng";
                    $dbnameWedding = "sdweddingreg";

                    $connWedding = new mysqli($servernameWedding, $usernameWedding, $passwordWedding, $dbnameWedding);
                    if ($connWedding->connect_error) {
                        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
                        return false;
                    } 

                    $sqlWeddingcouples = "SELECT * 
            FROM  `registeredcouples` 
            LIMIT 0 , 30";
                    function sqlWeddinggifts($id) {
                        $gifts = "SELECT * 
                FROM  `contributions`
                WHERE coupleid = " . $id . "
                LIMIT 0 , 30";
                        return $gifts;
                    }

                    $resultWeddingcouples = $connWedding->query($sqlWeddingcouples);

                    if ($resultWeddingcouples->num_rows > 0) {
                        while($rowWeddingcouples = $resultWeddingcouples->fetch_assoc()) {

                            echo "<div class='row admin-panel'><div class='col-xs-6 col-sm-6 col-md-3'>";

                            echo "<img class='img-responsive' style='margin-top: 20px' src='http://servicedrug.net/uploads/" . $rowWeddingcouples["image"] . "'>";

                            echo "</div>";

                            echo "<div class='col-xs-12 col-sm-6 col-md-9'>";

                            echo "<h3>" . $rowWeddingcouples["name1"] . " and " . $rowWeddingcouples["name2"] . " <span class='glyphicon glyphicon-trash sd-trash' aria-hidden='true' data-id='" . $rowWeddingcouples["id"] . "'  data-toggle='modal' data-target='#trashModal' data-names='" . $rowWeddingcouples["name1"] . " and " . $rowWeddingcouples["name2"] . "' data-img='" . $rowWeddingcouples["image"] . "'></span></h3>";
                            echo "<p class='lead'>" . $rowWeddingcouples["weddingdate"] . "</p>";
                            $resultWeddinggifts = $connWedding->query(sqlWeddinggifts($rowWeddingcouples["id"]));
                            if ($resultWeddinggifts->num_rows > 0) {
                                echo "<h4>Gifts</h4>";
                                echo "<div class='row'>";
                                while($rowWeddinggifts = $resultWeddinggifts->fetch_assoc()) {

                                    echo "<div class='col-xs-5 col-md-3 col-lg-2'>";

                                    echo "<h5>" . $rowWeddinggifts["name"] . "</h5>";

                                    echo "<p><span class='lead text-success'>$" . $rowWeddinggifts["amount"] . "</span><br>";

                                    echo $rowWeddinggifts["date"] . "</p>";

                                    echo "<address>";
                                    echo "<p>" . $rowWeddinggifts["phone"] . "</p>";
                                    echo "</address>";

                                    echo "<p><a href='mailto:" . $rowWeddinggifts["email"] . "'>" . $rowWeddinggifts["email"] . "</a></p>";

                                    echo "<address>";
                                    echo "<p>" . $rowWeddinggifts["address1"] . "<br>";
                                    if ($rowWeddinggifts["address2"]) { echo $rowWeddinggifts["address2"] . "<br>"; }
                                    echo $rowWeddinggifts["city"] . ", " . $rowWeddinggifts["state"] . " " . $rowWeddinggifts["zip"] . "</p>";
                                    echo "</address>";

                                    echo "</div>";
                                }
                                echo "</div>";
                            } else {
                                echo "<p>No gifts</p>";
                            }

                            echo "</div></div>";
                        }
                    } else {
                        echo "<p class='lead'>No registered couples</p>";
                    }

                    $connWedding->close();

                    ?>

                    {% endraw %}

                </div>
            </div>
        </div>

    </div>

</div>