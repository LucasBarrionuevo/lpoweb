<?php include 'header.php'; ?>


<!-- Carrusel -->
<div class="carousel-container">
  <!-- Busqueda -->
  <div class="busq">
    <form id="searchForm">
      <input type="text" id="searchInput" placeholder="Buscar">
      <button id="searchButton" type="submit">B</button>
    </form>
  </div>
  <div class="carousel">
    <div class="news-item active">
      <img src="images/img.png" alt="Imagen 1">
      <div class="news-content">
        <div class="vertical-bar"></div> <!-- Barra vertical -->
        <p>este texto hay que ponerlo dinamicamente </p>
      </div>
    </div>
    <div class="news-item">
      <img src="images/img.png" alt="Imagen 2">
      <div class="news-content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus, officia
          nostrum quod fuga ab, perspiciatis reiciendis eaque ex itaque assumenda explicabo vitae
          corrupti.
          Explicabo quaerat assumenda voluptatem atque dolores?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus, officia
          nostrum quod fuga ab, perspiciatis reiciendis eaque ex itaque assumenda explicabo vitae
          corrupti. </p>
      </div>
    </div>
    <div class="news-item">
      <img src="images/img2.png" alt="Imagen 2">
      <div class="news-content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus, officia
          nostrum quod fuga ab, perspiciatis reiciendis eaque ex itaque assumenda explicabo vitae
          corrupti.
          Explicabo quaerat assumenda voluptatem atque dolores?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus, officia
          nostrum quod fuga ab, perspiciatis reiciendis eaque ex itaque assumenda explicabo vitae
          corrupti. </p>
      </div>
    </div>
    <div class="news-item">
      <img src="images/img3.png" alt="Imagen 2">
      <div class="news-content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus, officia
          nostrum quod fuga ab, perspiciatis reiciendis eaque ex itaque assumenda explicabo vitae
          corrupti.
          Explicabo quaerat assumenda voluptatem atque dolores?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis accusamus, officia
          nostrum quod fuga ab, perspiciatis reiciendis eaque ex itaque assumenda explicabo vitae
          corrupti. </p>
      </div>
    </div>
  </div>
</div>

<!-- Redes -->
<div class="container-redes">
  <div class="red">
    <div class="header">
      <p>Seguinos en nuestras redes</p>
      <div class="redes-container">
        <a href="https://www.instagram.com/lapatria.eselotro" target="_blank">
          <img src="images/ig.png" alt="Instagram" class="redes">
          <span>@lapatria.eselotro</span>
        </a>
        <a href="https://www.facebook.com/profile.php?id=100075785448949&mibextid=dGKdO6" target="_blank">
          <img src="images/fb.png" alt="Facebook" class="redes">
          <span>@lapatriaeselotro</span>
        </a>
        <a href="https://twitter.com/patriaeselotrok" target="_blank">
          <img src="images/tw.png" alt="Twitter" class="redes">
          <span>@patriaeselotrok</span>
        </a>
      </div>
    </div>
  </div>
</div>




<?php

include "admin/config.php";
$limit = 5;

if (isset($_GET['page'])) {
  $page_number = $_GET['page'];
} else {
  $page_number = 1;
}

$offset = ($page_number - 1) * $limit;


$query = "SELECT post.post_id, post.title, post.description, post.post_img, post.post_date, post.category, category.category_name, user.username, post.author 
          FROM post
          LEFT JOIN category ON post.category = category.category_id
          LEFT JOIN user ON post.author = user.user_id
          ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";

$result = mysqli_query($connection, $query) or die("Failed");
$count = mysqli_num_rows($result);

if ($count > 0) {
  // Almacenar las categorías para evitar duplicados
  $categories = [];

  while ($row = mysqli_fetch_assoc($result)) {
    // Agregar categoría si no está ya en el array
    if (!in_array($row['category_name'], $categories)) {
      $categories[] = $row['category_name'];
?>


    <?php
    }
    ?>

    <div class="barra-titulo">
      <h1><a href="<?php echo strtolower($row['category_name']); ?>.html" style="color: white;"><?php echo ucfirst($row['category_name']); ?></a></h1>
    </div>

    <div class="post-content ocultar">
      <div class="row">
        <div class="col-md-4">
          <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
        </div>
        <div class="col-md-8">
          <div class="inner-content clearfix">
            <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
            <div class="post-information">
              <span>
                <i class="fa fa-user" aria-hidden="true"></i>
                <a href='author.php?author_id=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
              </span>
              <span>
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <?php echo $row['post_date']; ?>
              </span>
            </div>
            <p class="description">
              <?php echo substr($row['description'], 0, 170) . "..."; ?>
            </p>
            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
          </div>
        </div>
      </div>
    </div>

    <div class="contenido">
      <div class="izquierda">
        <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" />
        <h2><?php echo $row['title']; ?></h2>
        <p><?php echo $row['description']; ?></p>
      </div>

      <div class="nota">
        <img src="https://via.placeholder.com/100" alt="Imagen de nota">
        <h3>Nota Importante</h3>
        <p>Esta es una nota adicional que puedes incluir a la derecha del contenido principal. Puedes usar este espacio para proporcionar información relevante, advertencias o cualquier otro detalle que quieras destacar.</p>
        <h3>Título de la Nota</h3>
        <p>Este es un párrafo adicional que explica más sobre la nota. Aquí puedes agregar información extra o detalles relevantes que desees compartir.</p>
      </div>
    </div>

<?php
  }
} else {
  echo "No Record Found.";
}
?>

</div>
</div>
</div>
<?php include 'footer.php'; ?>

<script src="js/carro.js"></script>