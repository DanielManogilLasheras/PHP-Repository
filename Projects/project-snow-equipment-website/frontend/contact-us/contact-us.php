<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../nav/nav.css" />
  <link rel="stylesheet" href="contact-us.css">
  <title>Snowbear - Contact Us</title>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar fixed-top navbar-expand-lg" id="nav-bar">
      <div class="container-fluid">
        <button
          class="navbar-toggler bg-secondary"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="offcanvas offcanvas-start bg-secondary"
          tabindex="-1"
          id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5
              class="offcanvas-title justify-content-end"
              id="nav-bar-offcanvas-header">
              SNOWBEAR PIRINEROS
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body" id="nav-bard-offcanvas-body">
            <div class="container-fluid">
              <div class="row align-items-center">
                <div class="col-md-3 justify-content-center align-items-center">
                  <ul
                    class="navbar-nav justify-content-between"
                    id="nav-bar-page-links">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="../products/products.php">Productos</a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <div class="container text-center" id="nav-bar-logo">
                    <div class="row g-0 align-items-center">
                      <div class="col">
                        <h3 class="h3">SNOWBEAR</h3>
                      </div>
                      <div class="col">
                        <img
                          src="../../resources/index-logo.png"
                          class="img-thumbnail bg-transparent border-0"
                          alt="" />
                      </div>
                      <div class="col">
                        <h3 class="h3">PIRINEOS</h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center">
                  <ul
                    class="navbar-nav justify-content-end flex-grow-4"
                    id="nav-bar-social-link">
                    <li>

                    </li>
                    <li>

                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
    </nav>
    <div id="content">
      <form action="" method="post" id="content-formulary">
        <div class="form-outline mb-4">
          <label for="name" id="content-formulary-item">Nombre:</label>
          <input type="text" id="content-formulary-item" required id="name" />
        </div>
        <div class="form-outline mb-4">
          <label for="email" id="content-formulary-item">Email:</label>
          <input type="text" id="content-formulary-item" required id="email">
        </div>
        <div class="row mb-4">
          <label for="message" id="content-formulary-item">¿En qué podemos ayudarte?</label>
          <textarea id="message" id="content-formulary-item" rows="7"></textarea>
        </div>
        <input type="submit" value="Enviar" />
      </form>
    </div>
  </div>
</body>

</html>