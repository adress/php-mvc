<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1><?= $data; ?></h1>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias quidem accusamus, non facere debitis
                    ducimus ex architecto maiores ad deserunt itaque repellat molestias amet neque animi dolorem molestiae!
                    Illum, asperiores.
                    Corporis vero esse laborum, consequuntur, inventore molestias ab impedit vel distinctio nihil dolore
                    recusandae, eum illum sed? Animi ut iste quaerat ducimus nam dolor, impedit architecto repellendus
                    nesciunt eveniet beatae.
                    Aliquam nemo ratione beatae commodi voluptate accusantium id tenetur sequi quis ab inventore maxime
                    quae consequuntur eos ducimus accusamus iure facere, error mollitia, hic quia laborum eveniet. Ducimus,
                    accusantium corrupti.
                </p>
                <div class="text-center">
                    <nav aria-label="Page navigation example" style="float: right;">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="/home/1">1</a></li>
                            <li class="page-item"><a class="page-link" href="/home/2">2</a></li>
                            <li class="page-item"><a class="page-link" href="/home/3">3</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="card-footer text-muted text-center">
                <?= $footer; ?>
            </div>
        </div>
    </div>
</body>

</html>