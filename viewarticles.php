<?php

require "includes/dbh.inc.php";
global $conn; ?>

<?php
require "header.php" ?>

<?php
$check = $conn->prepare('select * from administrateur where email = ?');
$check->execute(array($_SESSION['email']));
$existemail = $check->rowCount();


$articlelist = $conn->prepare('select id,titre, auteur, contenu, source, date_pub, theme, urgence, tendance, lien, employé  from article');
$articlelist->execute();
$options = $articlelist->fetchAll();


if (!$existemail == 0) { ?>
    <main>
        <div class="container">
            <table class="table table-striped sampleTable" id="sampleTableB">

                <thead>
                <tr>
                    <th><a class="" data-n="0" style="cursor: pointer;">Titre</a></th>
                    <th><a class="" data-n="1" style="cursor: pointer;">Auteur</a></th>
                    <th><a class="" data-n="2" style="cursor: pointer;">Contenu</a></th>
                    <th><a class="" data-n="3" style="cursor: pointer;">Source</a></th>
                    <th><a class="" data-n="4" style="cursor: pointer;">Date Pub</a></th>
                    <th><a class="" data-n="5" style="cursor: pointer;">Theme</a></th>
                    <th><a class="" data-n="6" style="cursor: pointer;">Urgence</a></th>
                    <th><a class="" data-n="7" style="cursor: pointer;">Tendance</a></th>
                    <th><a class="" data-n="8" style="cursor: pointer;">Lien</a></th>
                    <th><a class="" data-n="9" style="cursor: pointer;">Employé</a></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($options as $o) { ?>
                    <tr>

                        <td><?php echo $o['titre'] ?></td>
                        <td><?php echo $o['auteur'] ?></td>
                        <td style="  max-width: 150px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;"><?php echo $o['contenu'] ?></td>
                        <td><?php echo $o['source'] ?></td>
                        <td><?php echo $o['date_pub'] ?></td>
                        <td><?php echo $o['theme'] ?></td>
                        <td><?php echo $o['urgence'] ?></td>
                        <td><?php echo $o['tendance'] ?></td>
                        <td><a href="<?= (urldecode($o['lien'])) ?>" target="_blank"
                               rel="noopener noreferrer"><?php echo(($o['lien'])) ?> </a></td>
                        <td><?php echo $o['employé'] ?></td>
                        <td><a href="<?= 'informations.php?id='.$o['id']?>">
                                <button type="button"> Afficher</button>
                            </a>
                        </td>
                        <td> <form method="POST" action= <?='includes/deletearticle.inc.php?id='.$o['id']?>>
                            <button type="submit" name="delart"> Supprimer</button>
                            </form> </td>
                        <td> <form method="POST" action= <?='word.inc.php?id='.$o['id']?>>
                                <button type="submit" name="word"> Download </button>
                            </form> </td>

                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td class="pag" colspan="3"><a class="btn btn-light active" data-n="1"
                                                   style="margin: 0.2em; cursor: pointer;">1</a><a class="btn btn-light "
                                                                                                   data-n="2"
                                                                                                   style="margin: 0.2em; cursor: pointer;">2</a><a
                                class="btn btn-light " data-n="3" style="margin: 0.2em; cursor: pointer;">3</a><a class="btn btn-light "
                                                                                                                  data-n="4"
                                                                                                                  style="margin: 0.2em; cursor: pointer;">4</a><span>...</span><a
                                class="btn btn-light " data-n="200" style="margin: 0.2em; cursor: pointer;">200</a></td>
                </tr>
                </tfoot>


            </table>

            <style>
                .form-inline .form-control {
                    margin: 5px;
                }
            </style>


        </div>


        <br> <br>

        <h2>
            Generate Excel File :
        </h2>
        <form method="post" action="includes/excel.inc.php">
            <label for="debutdate"> Date debut</label>
            <input type="date" name="debutdate" required>
            <label for="findate"> Date fin</label>
            <input type="date" name="findate" required>
            <select name="theme" >
                <option disabled selected value> -- select an option -- </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

            <button type="submit" name="excel"> Generate Excel</button>
        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/moment.min.js"></script>

        <script src="fancyTable.js"></script>
        <script type="text/javascript">
            // Word genarator
            function rWord(r) {
                var t, n = "bcdfghjklmnpqrstvwxyz", a = "aeiou", e = function (r) {
                    return Math.floor(Math.random() * r)
                }, o = "";
                r = parseInt(r, 10), n = n.split(""), a = a.split("");
                for (t = 0; t < r / 2; t++) {
                    var l = n[e(n.length)], p = a[e(a.length)];
                    o += 0 === t ? l.toUpperCase() : l, o += 2 * t < r - 1 ? p : ""
                }
                return o
            }

            $(document).ready(function () {
                // Generate a big table
                for (var n = 0; n < 1000; n++) {
                    var row = $("<tr>");
                    $("#sampleTableA").find("thead th").each(function () {
                        $("<td>", {
                            html: rWord(8),
                            style: "padding:2px;"
                        }).appendTo($(row));
                    });
                    row.appendTo($("#sampleTableA").find("tbody"));
                }
                // Load data simulation
                $("#loadDataSimulation").click(function () {
                    $(fancyTableA).find("tbody").empty();
                    for (var n = 0; n < 1000; n++) {
                        var row = $("<tr>");
                        $(fancyTableA).find("thead tr:nth-child(1) th").each(function () {
                            $("<td>", {
                                html: rWord(8),
                                style: "padding:2px;"
                            }).appendTo($(row));
                        });
                        row.appendTo($(fancyTableA).find("tbody"));
                    }
                    fancyTableA.reinit();
                });
                // And a simple one
                for (var n = 0; n < 10; n++) {
                    var row = $("<tr>");
                    for (var nn = 0; nn < 5; nn++) {
                        $("<td>", {
                            html: rWord(8),
                            style: "padding:2px;"
                        }).appendTo($(row));
                    }
                    $(row).find("td:last").first().html(moment(new Date(Math.floor(new Date().getTime() * Math.random()))).format('l'));
                    //row.appendTo($("#sampleTableB"));
                }

                // And one with location data
                $('#getNavigatorLocation').bind("click", function () {
                    window.navigator.geolocation.getCurrentPosition(function (pos) {
                        var myLocation = new geotools().position(pos.coords.latitude, pos.coords.longitude);
                        $("#sampleTableC").find("tbody tr").each(function () {
                            var arr = $(this).find("td").eq(1).html().match(/([\-\d\.]+)/g);
                            if (arr.length == 2) {
                                var dest = new geotools().position(arr[0], arr[1]);
                                $(this).find("td").eq(2).html((Math.round(myLocation.distanceTo(dest) / 100) / 10) + " km");
                            }
                        });
                        $('#sampleTableC td:nth-child(3),#sampleTableC th:nth-child(3)').show();
                        $("#sampleTableC")[0].fancyTable.sortColumn = 2;
                        $("#sampleTableC")[0].fancyTable.sortOrder = 1;
                        $.fn.fancyTable().tableSort($("#sampleTableC")[0]);
                    });
                });
                $('#getZipCodeLocation').bind("click", function () {
                    var myLocation = new geotools().position().fromZip($('#zipCode').val());
                    if (!myLocation.latitude) {
                        return;
                    }
                    $("#sampleTableC").find("tbody tr").each(function () {
                        var arr = $(this).find("td").eq(1).html().match(/([\-\d\.]+)/g);
                        if (arr.length == 2) {
                            var dest = new geotools().position(arr[0], arr[1]);
                            $(this).find("td").eq(2).html((Math.round(myLocation.distanceTo(dest) / 100) / 10) + " km");
                        }
                    });
                    $('#sampleTableC td:nth-child(3),#sampleTableC th:nth-child(3)').show();
                    $("#sampleTableC")[0].fancyTable.sortColumn = 2;
                    $("#sampleTableC")[0].fancyTable.sortOrder = 1;
                    $.fn.fancyTable().tableSort($("#sampleTableC")[0]);
                });
                $('#sampleTableC td:nth-child(2),#sampleTableC th:nth-child(2)').hide();
                $('#sampleTableC td:nth-child(3),#sampleTableC th:nth-child(3)').hide();

                // And make them fancy
                var fancyTableA = $("#sampleTableA").fancyTable({
                    sortColumn: 0,
                    pagination: true,
                    perPage: 5,
                    globalSearch: true
                });
                $("#sampleTableB").fancyTable({
                    pagination: true,
                    perPage: 10
                });
                $("#sampleTableC").fancyTable({
                    searchable: false
                });
                $("#sampleTableD").fancyTable({
                    searchable: false
                });
            });
        </script>
    </main>


<?php } else header("Location: ./index.php?message=dont "); ?>

<?php
require "footer.php" ?>
