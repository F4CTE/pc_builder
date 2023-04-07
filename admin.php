<?php
$pageTitle = "Admin Panel";
require_once __DIR__ . '/vendor/autoload.php';

use App\User\UserPdo;

session_start();
if (!(new UserPdo())->getById($_SESSION['user'])->isAdmin()) {
    header('Location: index.php');
    exit();
}
require_once __DIR__ . '/public/templates/head.php';
?>

<body>
    <?php require_once __DIR__ . '/public/templates/header.php'; ?>
    <main>
        <div class="accordion a" id="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Database alteration !
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        <ul class="nav nav-pills my-3 flex-row justify-content-around" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Users-tab" data-bs-toggle="pill" data-bs-target="#pills-Users" type="button" role="tab" aria-controls="pills-Users" aria-selected="true">Users</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Builds-tab" data-bs-toggle="pill" data-bs-target="#pills-Builds" type="button" role="tab" aria-controls="pills-Builds" aria-selected="false">Builds</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Chassis-tab" data-bs-toggle="pill" data-bs-target="#pills-Chassis" type="button" role="tab" aria-controls="pills-Chassis" aria-selected="false">Chassis</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-CpuCoolres-tab" data-bs-toggle="pill" data-bs-target="#pills-CpuCoolers" type="button" role="tab" aria-controls="pills-CpuCoolers" aria-selected="false">Cpu Coolers</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Cpus-tab" data-bs-toggle="pill" data-bs-target="#pills-Cpus" type="button" role="tab" aria-controls="pills-Cpus" aria-selected="false">Cpus</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Gpus-tab" data-bs-toggle="pill" data-bs-target="#pills-Gpus" type="button" role="tab" aria-controls="pills-Gpus" aria-selected="false">Gpus</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Hdds-tab" data-bs-toggle="pill" data-bs-target="#pills-Hdds" type="button" role="tab" aria-controls="pills-Hdds" aria-selected="false">Hdds</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-motherboards-tab" data-bs-toggle="pill" data-bs-target="#pills-Motherboards" type="button" role="tab" aria-controls="pills-Motherboards" aria-selected="false">Motherboards</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Psus-tab" data-bs-toggle="pill" data-bs-target="#pills-Psus" type="button" role="tab" aria-controls="pills-Psus" aria-selected="false">Psus</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Rams-tab" data-bs-toggle="pill" data-bs-target="#pills-Rams" type="button" role="tab" aria-controls="pills-Rams" aria-selected="false">Rams</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button onclick="getElements(this.innerHTML)" class="nav-link text-nowrap" id="pills-Ssds-tab" data-bs-toggle="pill" data-bs-target="#pills-Ssds" type="button" role="tab" aria-controls="pills-Ssds" aria-selected="false">Ssds</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="pills-Users" role="tabpanel" aria-labelledby="pills-Users-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Builds" role="tabpanel" aria-labelledby="pills-Builds-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Chassis" role="tabpanel" aria-labelledby="pills-Chassis-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-CpuCoolers" role="tabpanel" aria-labelledby="pills-CpuCoolers-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Cpus" role="tabpanel" aria-labelledby="pills-Cpus-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Gpus" role="tabpanel" aria-labelledby="pills-Gpus-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Hdds" role="tabpanel" aria-labelledby="pills-Hdds-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Motherboards" role="tabpanel" aria-labelledby="pills-Motherboards-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Psus" role="tabpanel" aria-labelledby="pills-Psus-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Rams" role="tabpanel" aria-labelledby="pills-Rams-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="pills-Ssds" role="tabpanel" aria-labelledby="pills-Ssds-tab" tabindex="0">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 id="modal-title" class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="modal-body" class="modal-body">

                    </div>
                    <div id="modal-footer" class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once __DIR__ . '/public/templates/footer.php'; ?>
</body>