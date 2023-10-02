<?php require  'components/header.php';
$name = $email = $body = '';
$name_error = $email_error = $body_error = '';
if (isset($_POST['submit'])) {
    // validations
    if (empty($_POST['name'])) {
        $name_error = 'Name is required';
    } else {
        $name = htmlspecialchars($_POST['name']);
    }
    if (empty($_POST['email'])) {
        $email_error = 'Email is required';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }
    if (empty($_POST['body'])) {
        $body_error = 'Body is required';
    } else {
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    // them dau ?
    $validate_sucess = empty($name_error) && empty($email_error) && empty($body_error);
    if ($validate_sucess) {
        $sql = "INSERT INTO feedback(name, email, body) VALUES(?, ? ,?)";
        try {
            $satement = $connection->prepare($sql);
            $satement->bindParam(1, $name);
            $satement->bindParam(2, $email);
            $satement->bindParam(3, $body);
            $satement->execute();
            // echo "Feedback insertecd successfully";
            header("Location: feedback_list.php");
        } catch (PDOException $e) {
            echo "Cannot insert feedback into database" . $e->getMessage();
        }
    }
}
?>
<!-- require: bat buoc phai co, khong thi bao loi -->

<h1>Enter your feedback here</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="mb-3">
        <input type="text" class="form-control  <?php echo $name_error ? 'is-invalid' : ''; ?>" name="name" placeholder="Enter your name">
        <p class="text-danger">
            <?php echo $name_error; ?>
        </p>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control
        <?php echo $email_error ? 'is-invalid' : ''; ?>" name="email" placeholder="Enter your email">
        <p class="text-danger">
            <?php echo $email_error; ?>
        </p>
    </div>
    <div class="mb-3">
        <textarea class="form-control  <?php echo $body_error ? 'is-invalid' : ''; ?>" name="body" placeholder="Enter your feedback" row="2"></textarea>
        <p class="text-danger">
            <?php echo $body_error; ?>
        </p>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" name="submit" value="Send">
    </div>
</form>

<?php include 'components/footer.php'; ?>
<!-- include: khong bat buoc -->