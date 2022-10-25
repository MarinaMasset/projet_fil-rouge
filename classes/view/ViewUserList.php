<?php
require_once "../model/ModelList.php";

class ViewUserList
{
    public static function userList()
    {
        $list = ModelList::UserList();
?>
        <div class="container">
            <?php
            if ($list) {
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Mail</th>
                            <th scope="col">tel</th>
                            <th scope="col">Rôle</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php


                        foreach ($list  as $colonne => $value) {
                        ?> 
                            <tr>
                                <th scope="row"><?= $value['id'] ?></th>
                                <td><?= $value['nom'] ?></td>
                                <td><?= $value['prenom'] ?></td>
                                <td><?= $value['mail'] ?></td>
                                <td><?= $value['tel'] ?></td>
                                <td>
                                    <a href="voir.php?id=<?= $value['id'] ?>" class="btn btn-success">Mon espace</a>
                                    <a href="modif.php?id=<?= $value['id'] ?>" class="btn btn-secondary text-white">Modifier mon compte</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            <?php
            } else {
                echo "aucun utilisateur n'a été trouvé dans la liste.";
            }
            ?> 
        </div>
<?php
    }

    public static function adminList() {
        $list = ModelList::UserList();
?>

        <div class="container">
            <?php
            if ($list) {
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Mail</th>
                            <th scope="col">tel</th>
                            <th scope="col">Rôle</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php


                        foreach ($list  as $colonne => $value) {
                        ?> 
                            <tr>
                                <th scope="row"><?= $value['id'] ?></th>
                                <td><?= $value['nom'] ?></td>
                                <td><?= $value['prenom'] ?></td>
                                <td><?= $value['mail'] ?></td>
                                <td><?= $value['tel'] ?></td>
                                <td>
                                    <a href="voir.php?id=<?= $value['id'] ?>" class="btn btn-success">Accès aux comptes</a>
                                    <a href="modif.php?id=<?= $value['id'] ?>" class="btn btn-info text-white">Modifier</a>
                                    <a href="supp.php?id=<?= $value['id'] ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            <?php
            } else {
                echo "aucun utilisateur n'a été trouvé dans la liste.";
            }
            ?> 
        </div>
<?php
    }
}
