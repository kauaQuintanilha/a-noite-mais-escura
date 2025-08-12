<?php
require 'db.php';

// Fetch comments (most recent first)
$stmt = $pdo->query("SELECT id, name, comment, created_at FROM comments ORDER BY created_at DESC");
$comments = $stmt->fetchAll();

// Simple function to escape output
function h($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// Narratives for the 5 images
$gallery = [
    ['file' => 'images/photo1.jpg', 'title' => 'Ruínas do Entardecer', 'text' => 'O sol se escondeu entre escombros; a cidade fez silêncio.'],
    ['file' => 'images/photo2.jpg', 'title' => 'Rua Sem Luz', 'text' => 'Passos ecoam onde antes havia festa.'],
    ['file' => 'images/photo3.jpg', 'title' => 'Janela Aberta', 'text' => 'Uma vela tremula em frente ao que resta de uma casa.'],
    ['file' => 'images/photo4.webp', 'title' => 'O Retrato', 'text' => 'Olhos que lembram de tempos mais claros, agora emoldurados pela noite.'],
    ['file' => 'images/photo5.jpeg', 'title' => 'Horizonte Partido', 'text' => 'A linha do horizonte rasgada por memórias e prédios.'],
];
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>A noite mais escura</title>
  <style>
    body{font-family: Arial, Helvetica, sans-serif; background:#0f0f14; color:#eee; margin:0; padding:0;}
    header{padding:2rem; text-align:center; border-bottom:1px solid #222;}
    .container{max-width:920px;margin:2rem auto;padding:0 1rem;}
    .gallery{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1rem;}
    .card{background:#131318;padding:1rem;border:1px solid #222;border-radius:8px;}
    .card img{width:100%;height:180px;object-fit:cover;border-radius:6px;background:#111;}
    footer{margin-top:2rem;padding:1rem;background:#0b0b0d;border-top:1px solid #222;}
    form label{display:block;margin-top:.5rem}
    input[type=text], textarea{width:100%;padding:.5rem;margin-top:.25rem;border-radius:6px;border:1px solid #333;background:#0b0b0d;color:#eee}
    button{margin-top:.75rem;padding:.6rem .9rem;border-radius:8px;border:0;background:#2e2e8f;color:#fff;cursor:pointer}
    .comments{margin-top:1rem}
    .comment{border-top:1px dashed #222;padding:.75rem 0}
    .meta{font-size:.85rem;color:#bdbdbd}
    .error{background:#6b1b1b;padding:.5rem;border-radius:6px}
  </style>
</head>
<body>
<header>
  <h1>A noite mais escura</h1>
  <p>Uma pequena galeria de imagens e espaço para deixar suas impressões.</p>
</header>

<main class="container">
  <section class="gallery">
    <?php foreach($gallery as $item): ?>
      <article class="card">
        <img src="<?php echo h($item['file']); ?>" alt="<?php echo h($item['title']); ?>">
        <h3><?php echo h($item['title']); ?></h3>
        <p><?php echo h($item['text']); ?></p>
      </article>
    <?php endforeach; ?>
  </section>

  <footer>
    <h2>Comentários</h2>
    <p>Deixe seu comentário — seja respeitoso.</p>

    <!-- Show flash message if present -->
    <?php if(!empty($_GET['status']) && $_GET['status']=='ok'): ?>
      <div class="meta">Comentário enviado com sucesso.</div>
    <?php elseif(!empty($_GET['status']) && $_GET['status']=='err'): ?>
      <div class="error">Ocorreu um erro ao enviar o comentário. Tente novamente.</div>
    <?php endif; ?>

    <form action="submit_comment.php" method="post" autocomplete="off">
      <label for="name">Nome</label>
      <input type="text" id="name" name="name" required maxlength="100">

      <label for="comment">Comentário</label>
      <textarea id="comment" name="comment" rows="4" required maxlength="1000"></textarea>

      <button type="submit">Enviar comentário</button>
    </form>

    <div class="comments">
      <?php if(count($comments)===0): ?>
        <p class="meta">Ainda não há comentários. Seja o primeiro!</p>
      <?php else: ?>
        <?php foreach($comments as $c): ?>
          <div class="comment">
            <div class="meta"><strong><?php echo h($c['name']); ?></strong> — <?php echo h($c['created_at']); ?></div>
            <div><?php echo nl2br(h($c['comment'])); ?></div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </footer>
</main>
</body>
</html>
