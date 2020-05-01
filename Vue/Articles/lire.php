<?php $this->titre = "Le Blogue du prof - " . $this->nettoyer($article['titre']); ?>

<article>
    <header>
        <h1 class="titreArticle"><?= $this->nettoyer($article['titre']) ?></h1>
        <time><?= $this->nettoyer($article['date']) ?></time>, par utilisateur #<?= $this->nettoyer($article['utilisateur_id']) ?>
        <h3 class=""><?= $this->nettoyer($article['sous_titre']) ?></h3>
    </header>
    <p><?= $this->nettoyer($article['texte']) ?></p>
    <p><?= $this->nettoyer($article['type']) ?></p>
</article>
<hr />
<header>
    <h1 id="titreReponses">Réponses à <?= $this->nettoyer($article['titre']) ?> :</h1>
</header>
<?= ($commentaires->rowCount() == 0) ? '<p class="message">Pas encore de commentaires pour cet article.</p>' : '' ?>
<?php
foreach ($commentaires as $commentaire):
    ?>
    <?php if ($commentaire['efface'] == '0') : ?>
        <p><a href="Commentaires/confirmer/<?= $this->nettoyer($commentaire['id']) ?>" >
                [Effacer]</a>
            <?= $this->nettoyer($commentaire['date']) ?>, <?= $this->nettoyer($commentaire['auteur']) ?> dit : (privé? <?= $this->nettoyer($commentaire['prive']) ?>)<br/>
            <strong><?= $this->nettoyer($commentaire['titre']) ?></strong><br/>
            <?= $this->nettoyer($commentaire['texte']) ?>
        </p>
    <?php else : ?>
        <p class="efface"><a href="Commentaires/retablir/<?= $this->nettoyer($commentaire['id']) ?>" >
                [Rétablir]</a>
            Commentaire du <?= $this->nettoyer($commentaire['date']) ?>, par <?= $this->nettoyer($commentaire['auteur']) ?> effacé! (privé? <?= $this->nettoyer($commentaire['prive']) ?>)
        </p>
    <?php endif; ?>
<?php endforeach; ?>

<form action="Commentaires/ajouter" method="post">
    <h2>Ajouter un commentaire</h2>
    <p>
        <label for="auteur">Courriel de l'auteur (xxx@yyy.zz)</label> : <input type="text" name="auteur" id="auteur" /> 
        <?= ($erreur == 'courriel') ? '<span class="erreur">Entrez un courriel valide s.v.p.</span>' : '' ?> 
        <br />
        <label for="texte">Titre</label> :  <input type="text" name="titre" id="titre" /><br />
        <label for="texte">Commentaire</label> :  <textarea type="text" name="texte" id="texte" >Écrivez votre commentaire ici</textarea><br />
        <input type="hidden" name="prive" value="0" />
        <label for="prive">Privé?</label><input type="checkbox" name="prive" />
        <input type="hidden" name="article_id" value="<?= $this->nettoyer($article['id']) ?>" /><br />
        <input type="submit" value="Envoyer" />
    </p>
</form>


