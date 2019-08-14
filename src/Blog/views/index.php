<?= $renderer->render('header') ?>
    <h1>Bienvenue sur le Blog (template)</h1>
    <ul>
        <li><a href="<?= $router->generateUri('blog.show', ['slug' => 'azeaze-789']); ?>">Article 1</a></li>
        <li>Article 2</li>
        <li>Article 3</li>
    </ul>
<?= $renderer->render('footer') ?>
