<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="page-header flex-wrap">
        <h3 class="mb-0"> Hi, welcome back! <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Your web analytics dashboard template.</span>
        </h3>
        <div class="d-flex">
            
            <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
                <i class="mdi mdi-printer btn-icon-prepend"></i> Imprimir stock </button>
                @livewire('stock.strock-create')
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Stock de artificios</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>
                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>ID del artificio</th>
                                    <th>Nombre del artificio</th>
                                    <th>Cantidad</th>
                                    <th>cantidad</th>
                                
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-1">
                                        <img src="../assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td>Herman Beck</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>$ 77.99</td>
                                    <td>May 15, 2015</td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        <img src="../assets/images/faces-clipart/pic-2.png" alt="image" />
                                    </td>
                                    <td>Messsy Adam</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>$245.30</td>
                                    <td>July 1, 2015</td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        <img src="../assets/images/faces-clipart/pic-3.png" alt="image" />
                                    </td>
                                    <td>John Richards</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>$138.00</td>
                                    <td>Apr 12, 2015</td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        <img src="../assets/images/faces-clipart/pic-4.png" alt="image" />
                                    </td>
                                    <td>Peter Meggik</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>$ 77.99</td>
                                    <td>May 15, 2015</td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        <img src="../assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td>Edward</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>$ 160.25</td>
                                    <td>May 03, 2015</td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        <img src="../assets/images/faces-clipart/pic-2.png" alt="image" />
                                    </td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>$ 123.21</td>
                                    <td>April 05, 2015</td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        <img src="../assets/images/faces-clipart/pic-3.png" alt="image" />
                                    </td>
                                    <td>Henry Tom</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>$ 150.00</td>
                                    <td>June 16, 2015</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <span class="d-flex justify-content-between">
                            <span>Actividad</span>
                            <span class="dropdown dropleft d-block">
                                <span id="dropdownMenuButton1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span><i class="mdi mdi-dots-horizontal"></i></span>
                                </span>
                                <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item" href="#">Contact</a>
                                    <a class="dropdown-item" href="#">Helpdesk</a>
                                    <a class="dropdown-item" href="#">Chat with us</a>
                                </span>
                            </span>
                        </span>
                    </h4>
                    <ul class="gradient-bullet-list border-bottom">
                        <li>
                            <h6 class="mb-0"> It's awesome when we find a new solution </h6>
                            <p class="text-muted">2h ago</p>
                        </li>
                        <li>
                            <h6 class="mb-0">Report has been updated</h6>
                            <p class="text-muted">
                                <span>2h ago</span>
                                <span class="d-inline-block">
                                    <span class="d-flex d-inline-block">
                                        <img class="ml-1" src="assets/images/faces/face1.jpg" alt="">
                                        <img class="ml-1" src="assets/images/faces/face10.jpg" alt="">
                                        <img class="ml-1" src="assets/images/faces/face14.jpg" alt="">
                                    </span>
                                </span>
                            </p>
                        </li>
                        <li>
                            <h6 class="mb-0"> Analytics dashboard has been created#Slack </h6>
                            <p class="text-muted">2h ago</p>
                        </li>
                        <li>
                            <h6 class="mb-0"> It's awesome when we find a new solution </h6>
                            <p class="text-muted">2h ago</p>
                        </li>
                    </ul>
                    <a class="text-black mt-3 mb-0 d-block h6" href="#">View all <i class="mdi mdi-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>