<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calculator PHP</title>
  <!-- Относительные пути к стилям -->
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    .custom-box {
      width: 100%;
      max-width: 100%;
    }

    @media (min-width: 992px) {
      .custom-box {
        max-width: 25%;
      }
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">

  <header class="bg-primary text-white py-4">
    <div class="container">
      <h1 class="display-6 mb-0">Calculator PHP</h1>
    </div>
  </header>

  <div class="flex-grow-1 d-flex align-items-center justify-content-center bg-white">
   <div class="custom-box d-flex flex-column h-50 mx-3 mx-lg-0 justify-content-center align-items-center p-3">
      <div id="display" style="background-color: black; color: white; height: 60px; font-size: 1.5rem;" class="w-100 text-end p-2 rounded">
        <?= isset($error) ? htmlspecialchars($error) : ($result ?? '') ?>
      </div>

      <form id="calcForm" method="POST" action="" class="d-grid gap-2 w-100 mt-3" style="--bs-columns: 4; display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;">
        <input type="hidden" name="query" id="expressionInput">

        <button type="button" data-type="clear" value="C" class="btn btn-secondary calcBtn">C</button>
        <button type="button" data-type="operator" value="(" class="btn btn-secondary calcBtn">(</button>
        <button type="button" data-type="operator" value=")" class="btn btn-secondary calcBtn">)</button>
        <button type="button" data-type="operator" value="/" class="btn btn-secondary calcBtn">/</button>

        <button type="button" data-type="number" value="7" class="btn btn-light calcBtn">7</button>
        <button type="button" data-type="number" value="8" class="btn btn-light calcBtn">8</button>
        <button type="button" data-type="number" value="9" class="btn btn-light calcBtn">9</button>
        <button type="button" data-type="operator" value="*" class="btn btn-secondary calcBtn">*</button>

        <button type="button" data-type="number" value="4" class="btn btn-light calcBtn">4</button>
        <button type="button" data-type="number" value="5" class="btn btn-light calcBtn">5</button>
        <button type="button" data-type="number" value="6" class="btn btn-light calcBtn">6</button>
        <button type="button" data-type="operator" value="-" class="btn btn-secondary calcBtn">-</button>

        <button type="button" data-type="number" value="1" class="btn btn-light calcBtn">1</button>
        <button type="button" data-type="number" value="2" class="btn btn-light calcBtn">2</button>
        <button type="button" data-type="number" value="3" class="btn btn-light calcBtn">3</button>
        <button type="button" data-type="operator" value="+" class="btn btn-secondary calcBtn">+</button>

        <button type="button" data-type="number" value="0" class="btn btn-light calcBtn">0</button>
        <button type="button" data-type="operator" value="." class="btn btn-light calcBtn">.</button>
        <button type="submit" data-type="equals" value="=" class="btn btn-success calcBtn" style="grid-column: span 2;">=</button>
      </form>

    </div>
  </div>

  <footer class="bg-primary text-white py-4">
    <div class="container">
      <p class="mb-0 text-white">&#169; Calculator, 2025</p>
    </div>
  </footer>

  <!-- Относительный путь к скрипту -->
  <script src="js/script.js"></script>

  <script>
    const buttons = document.querySelectorAll('.calcBtn');
    const expressionInput = document.getElementById('expressionInput');
    const form = document.getElementById('calcForm');
    const display = document.getElementById('display');

    let expression = '';

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        const type = button.dataset.type;
        const value = button.value;

        if (type === 'clear') {
          expression = '';
          expressionInput.value = '';
          display.textContent = '';
        } else if (type === 'equals') {
          expressionInput.value = expression;
          form.submit();
        } else {
          expression += value;
          display.textContent = expression;
        }
      });
    });
  </script>
</body>

</html>
