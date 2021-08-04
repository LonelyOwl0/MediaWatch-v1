<!--This is the sign up page , where the user enters his information to make an account :
It contains :
The sign up form -->
<?php
require "header.php";
?>

<main>
    <h1>Sign up</h1>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="nom" placeholder="Nom.." required>
        <input type="text" name="prenom" placeholder="Prenom.." required>
        <input type="email" name="email" placeholder="Email.." required>
        <input type="password" name="password" placeholder="Password.." required>
        <input type="password" name="password-repeat" placeholder="Repeat password.." required>
        <select name="type">
            <option value="pe">presse electronique</option>
            <option value="sm">social media</option>
        </select>
        <button type="submit" name="signup-submit"> Sign up</button>

        <?php

        if (isset($_GET['message'])) {
            echo($_GET['message']);
        }

        ?>


    </form>
</main>

<?php
require "footer.php" ?>
