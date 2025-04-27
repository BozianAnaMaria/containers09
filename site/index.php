<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        .error { color: red; font-size: 12px; }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid black;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Formular de Contact</h2>

    <?php
    $name = $email = $subject = $message = "";
    $nameErr = $emailErr = $subjectErr = $messageErr = "";
    $formValid = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Numele este obligatoriu!";
            $formValid = false;
        } else {
            $name = htmlspecialchars($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email-ul este obligatoriu!";
            $formValid = false;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email invalid!";
            $formValid = false;
        } else {
            $email = htmlspecialchars($_POST["email"]);
        }

        if (empty($_POST["subject"])) {
            $subjectErr = "Subiectul este obligatoriu!";
            $formValid = false;
        } else {
            $subject = htmlspecialchars($_POST["subject"]);
        }

        if (empty($_POST["message"])) {
            $messageErr = "Mesajul este obligatoriu!";
            $formValid = false;
        } else {
            $message = htmlspecialchars($_POST["message"]);
        }

        if ($formValid) {
            echo "<h3>Mesaj trimis cu succes!</h3>";
            echo "<p><b>Nume:</b> $name</p>";
            echo "<p><b>Email:</b> $email</p>";
            echo "<p><b>Subiect:</b> $subject</p>";
            echo "<p><b>Mesaj:</b> $message</p>";
            exit();
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><label for="name">Nume *:</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span></p>

        <p><label for="email">Email *:</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span></p>

        <p><label for="subject">Subiect *:</label>
        <input type="text" name="subject" value="<?php echo $subject; ?>">
        <span class="error"><?php echo $subjectErr; ?></span></p>

        <p><label for="message">Mesaj *:</label><br>
        <textarea name="message" rows="5" cols="30"><?php echo $message; ?></textarea>
        <span class="error"><?php echo $messageErr; ?></span></p>

        <p><input type="submit" value="Trimite"></p>
    </form>
</div>

</body>
</html>
