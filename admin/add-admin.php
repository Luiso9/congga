<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Account</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tachyons/4.12.0/tachyons.min.css" rel="stylesheet">
</head>

<body class="bg-light-gray">
    <!-- Navigation Bar -->
    <?php include('includes/header.php'); ?>

    <div class="mw6 center bg-white br3 pa4 pa5-ns mv5 ba b--black-10 shadow-1">
        <h3 class="f3 mb3">Create Admin Account</h3>
        <hr class="mb4" />

        <!-- Error Message -->
        <?php if (isset($error)): ?>
            <div class="bg-washed-red dark-red pa3 mb3 br3">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Success Message -->
        <?php if (isset($success)): ?>
            <div class="bg-washed-green dark-green pa3 mb3 br3">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="post" action="">
            <div class="mb3">
                <label class="db fw6 lh-copy f6 mb2" for="fullname">Full Name</label>
                <input type="text" name="fullname" id="fullname" class="input-reset ba b--black-20 pa2 mb2 db w-100 br2" required />
            </div>

            <div class="mb3">
                <label class="db fw6 lh-copy f6 mb2" for="adminemail">Email</label>
                <input type="email" name="adminemail" id="adminemail" class="input-reset ba b--black-20 pa2 mb2 db w-100 br2" required />
            </div>

            <div class="mb3">
                <label class="db fw6 lh-copy f6 mb2" for="username">Username</label>
                <input type="text" name="username" id="username" class="input-reset ba b--black-20 pa2 mb2 db w-100 br2" required />
            </div>

            <div class="mb4">
                <label class="db fw6 lh-copy f6 mb2" for="password">Password</label>
                <input type="password" name="password" id="password" class="input-reset ba b--black-20 pa2 mb2 db w-100 br2" required />
            </div>

            <button type="submit" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-blue">Create Admin</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
</body>

</html>
