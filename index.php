<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collezioni - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f9f9f9; }
    .card:hover { transform: scale(1.05); transition: transform 0.2s ease; }
    h2 { margin-bottom: 20px; }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Collezioni</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="fumetti.php">Fumetti</a></li>
        <li class="nav-item"><a class="nav-link" href="cosplay.php">Cosplay</a></li>
        <li class="nav-item"><a class="nav-link" href="figurine.php">Figurine</a></li>
        <li class="nav-item"><a class="nav-link" href="carte.php">Carte</a></li>
        <li class="nav-item"><a class="nav-link" href="chisiamo.php">Chi siamo</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['username'])): ?>
          <li class="nav-item"><span class="nav-link text-info">Ciao, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Registrati</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 pt-4">
  <h1 class="text-center mb-5">Benvenuto nel nostro negozio di collezionismo!</h1>
  <!-- FUNZIONE PER MOSTRARE SEZIONE -->
  <?php
  function mostraSezione($conn, $tabella, $titolo) {
      echo '<section class="mt-5">';
      echo '<h2>'.$titolo.'</h2>';
      echo '<div class="row">';
      $sql = "SELECT * FROM $tabella LIMIT 4";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<div class="col-md-3 mb-3">
                      <div class="card shadow-sm">
                          <img src="'.htmlspecialchars($row['immagine_url']).'" class="card-img-top" alt="'.htmlspecialchars($row['nome']).'">
                          <div class="card-body text-center">
                              <p class="card-text">'.htmlspecialchars($row['nome']).'</p>
                          </div>
                      </div>
                    </div>';
          }
      } else {
          echo "<p>Nessun elemento trovato.</p>";
      }
      echo '</div>';
      echo '</section><hr>';
  }

  // Mostra le sezioni
  mostraSezione($conn, "fumetti", "Fumetti");
  mostraSezione($conn, "cosplay", "Cosplay");
  mostraSezione($conn, "figurine", "Figurine");
  mostraSezione($conn, "carte", "Carte");
  ?>

  <!-- AREA RISERVATA -->
  <?php if (isset($_SESSION['username'])): ?>
    <section class="bg-light p-4 rounded shadow-sm mt-5">
      <h3>Area riservata</h3>
      <p>Ciao <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! 🎉</p>
      <p>Qui puoi vedere contenuti esclusivi riservati agli utenti registrati.</p>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </section>
  <?php else: ?>
    <section class="bg-light p-4 rounded shadow-sm mt-5 text-center">
      <h4>Accedi per entrare nell'area riservata</h4>
      <p>
        <a href="login.php" class="btn btn-success me-2">Login</a>
        <a href="register.php" class="btn btn-primary">Registrati</a>
      </p>
    </section>
  <?php endif; ?>

</div>

<footer class="text-center py-3 mt-5 bg-dark text-light">
  &copy; 2025 Collezioni - Tutti i diritti riservati
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
