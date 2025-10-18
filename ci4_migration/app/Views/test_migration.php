<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Phase 3 Migration Test</h1>
                <div class="card">
                    <div class="card-header">
                        <h3>Controller Migration Status</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Controllers</h5>
                                <ul class="list-group">
                                    <?php foreach ($controllers as $name => $status): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= esc($name) ?>
                                            <span class="badge bg-success rounded-pill"><?= esc($status) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Filters</h5>
                                <ul class="list-group">
                                    <?php foreach ($filters as $name => $status): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= esc($name) ?>
                                            <span class="badge bg-success rounded-pill"><?= esc($status) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h5>Libraries</h5>
                                <ul class="list-group">
                                    <?php foreach ($libraries as $name => $status): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= esc($name) ?>
                                            <span class="badge bg-success rounded-pill"><?= esc($status) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Routes</h5>
                                <ul class="list-group">
                                    <?php foreach ($routes as $name => $status): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= esc($name) ?>
                                            <span class="badge bg-success rounded-pill"><?= esc($status) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>API Tests</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" onclick="testBaseController()">Test BaseController</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-success" onclick="testRoutes()">Test Routes</button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div id="test-result" class="alert" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function testBaseController() {
            fetch('/phase3test/testBaseController')
                .then(response => response.json())
                .then(data => {
                    const resultDiv = document.getElementById('test-result');
                    resultDiv.style.display = 'block';
                    
                    if (data.status === 'success') {
                        resultDiv.className = 'alert alert-success';
                        resultDiv.innerHTML = '<strong>Success!</strong> ' + data.message;
                    } else {
                        resultDiv.className = 'alert alert-danger';
                        resultDiv.innerHTML = '<strong>Error!</strong> ' + data.message;
                    }
                })
                .catch(error => {
                    const resultDiv = document.getElementById('test-result');
                    resultDiv.style.display = 'block';
                    resultDiv.className = 'alert alert-danger';
                    resultDiv.innerHTML = '<strong>Error!</strong> ' + error.message;
                });
        }

        function testRoutes() {
            fetch('/phase3test/testRoutes')
                .then(response => response.json())
                .then(data => {
                    const resultDiv = document.getElementById('test-result');
                    resultDiv.style.display = 'block';
                    
                    if (data.status === 'success') {
                        resultDiv.className = 'alert alert-success';
                        resultDiv.innerHTML = '<strong>Success!</strong> ' + data.message + 
                            '<br>Routes configured: ' + data.routes_count;
                    } else {
                        resultDiv.className = 'alert alert-danger';
                        resultDiv.innerHTML = '<strong>Error!</strong> ' + data.message;
                    }
                })
                .catch(error => {
                    const resultDiv = document.getElementById('test-result');
                    resultDiv.style.display = 'block';
                    resultDiv.className = 'alert alert-danger';
                    resultDiv.innerHTML = '<strong>Error!</strong> ' + error.message;
                });
        }
    </script>
</body>
</html>