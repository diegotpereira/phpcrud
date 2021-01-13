<?php

include 'functions.php';

$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    # code...
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email, $phone, $title, $created]);
    // Output message
    $msg = 'Adiconado com sucesso!';
}


?>

<?= template_header('Create') ?>

<div class="content update">
    <h2>Adicionar Contato</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Nome</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="Digite seu nome" id="name">
        <label for="email">Email</label>
        <label for="phone">Telefone</label>
        <input type="text" name="email" placeholder="digite seu email@example.com" id="email">
        <input type="text" name="phone" placeholder="Digite seu número de telefone" id="phone">
        <label for="title">Função</label>
        <label for="created">Criado</label>
        <input type="text" name="title" placeholder="Digite seu cargo" id="title">
        <input type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i') ?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>