<?php
session_start() or die('Error iniciando gestor de variables de sesión');
;

// Verificar si el usuario está autenticado
if(!isset($_SESSION['username'])) {
    //header("Location: index.html"); // Redirecciona a la página de inicio de sesión si no está autenticado
    header('Location: login.php');
}

$username = $_SESSION['username'];
$id_restaurante = $_SESSION['id_restaurante'];
$nombre_restaurante = $_SESSION['nombre_restaurante'];
include "phps/Conexion_BBDD.php";

function obtenerReservas() {
    // Obtener la conexión
    $conn = conectarBaseDeDatos();
    $id_restaurante = $_SESSION["id_restaurante"];
    // Obtener la hora actual en el formato de la base de datos
    $fechaHoraActual = date("Y-m-d H:i:s");

    // Calcular la fecha y hora 1 hora atrás
    $fechaHoraHaceUnaHora = date("Y-m-d H:i:s", strtotime("-1 hour", strtotime($fechaHoraActual)));
//uso corriente de la funcion:
    // $sql = "SELECT usuario.nombre, reservas.num_personas, reservas.fecha, reservas.hora, usuario.id_usuario, reservas.id_reserva
    //         FROM reservas
    //         INNER JOIN usuario ON reservas.id_usuario = usuario.id_usuario
    //         WHERE fecha >= CURDATE() AND hora >= '$fechaHoraHaceUnaHora' AND estado = 1 AND id_restaurante = '$id_restaurante'";

    $sql = "SELECT usuario.nombre, reservas.num_personas, reservas.fecha, reservas.hora, usuario.id_usuario, reservas.id_reserva
            FROM reservas
            INNER JOIN usuario ON reservas.id_usuario = usuario.id_usuario
            WHERE fecha >= CURDATE() AND estado = 1 AND id_restaurante = '$id_restaurante'";

    $result = $conn->query($sql);

    // Cerrar la conexión
    $conn->close();

    return $result;
}

function obtenerNumeroReservasDelDia() {
    // Obtener la conexión
    $conn = conectarBaseDeDatos();
    $id_restaurante = $_SESSION["id_restaurante"];
    // Obtener la fecha actual en el formato de la base de datos
    $fecha_actual = date("Y-m-d");

    // Consulta para obtener el número de reservas del día en curso y esl estado es confirmado
    $sql = "SELECT COUNT(*) as totalReservas
            FROM reservas
            WHERE fecha = '$fecha_actual' and estado = 1 and id_restaurante = '$id_restaurante'";

    $result = $conn->query($sql);

    // Verificar si la consulta fue exitosa
    if($result === false) {
        die("Error en la consulta: ".$conn->error);
    }

    // Obtener el número de reservas del día en curso
    $numeroReservas = $result->fetch_assoc()['totalReservas'];

    // Cerrar la conexión
    $conn->close();

    return $numeroReservas;
}
function obtenerNumeroPendientes() {
    // Obtener la conexión
    $conn = conectarBaseDeDatos();
    $id_restaurante = $_SESSION["id_restaurante"];

    // Consulta para obtener el número de reservas del día en curso
    $sql = "SELECT COUNT(*) as totalReservas
            FROM reservas
            WHERE estado = 2 and id_restaurante = '$id_restaurante'";

    $result = $conn->query($sql);

    // Verificar si la consulta fue exitosa
    if($result === false) {
        die("Error en la consulta: ".$conn->error);
    }

    // Obtener el número de reserves pendientes
    $numeroPendientes = $result->fetch_assoc()['totalReservas'];

    // Cerrar la conexión
    $conn->close();

    return $numeroPendientes;
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="javier" content="">

    <title>MESSING Admin - CP</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="indexPC.html">
                <div class="sidebar-brand-icon ">
                    <svg xmlns="http://www.w3.org/2000/svg" height="2em"
                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                            svg {
                                fill: #ffffff
                            }
                        </style>
                        <path
                            d="M416 0C400 0 288 32 288 176V288c0 35.3 28.7 64 64 64h32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352 240 32c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V255.6c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16V150.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8V16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z" />
                    </svg>
                </div>
                <div class="sidebar-brand-text mx-3">MESSING Admin<sup>0.5</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="pendiente.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pendientes</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="pendiente.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>KPI</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 medium">
                                    <?php $nombre_restaurante = $_SESSION['nombre_restaurante'];
                                    echo "$nombre_restaurante" ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Reservas Servico en curso</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">7</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Reservas del dia</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $numeroReservasDelDia = obtenerNumeroReservasDelDia();
                                                echo "$numeroReservasDelDia";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">aforo
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">70%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 70%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div id = "#recargaP" class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Reservas pendientes
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="contadorPendiente">
                                                <?php
                                                $numeroPendientes = obtenerNumeroPendientes();
                                                echo "$numeroPendientes";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <!-- Tabla -->
                    <div id="recarga" class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">RESERVAS PARA HOY</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableSA" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Personas</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Asistencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id_restaurante = $_SESSION['id_restaurante'];
                                        $reservas = obtenerReservas();
                                        if($reservas->num_rows > 0) {
                                            while($row = $reservas->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>".$row["nombre"]."</td>
                                                        <td>".$row["num_personas"]."</td>
                                                        <td>".$row["fecha"]."</td>
                                                        <td>".$row["hora"]."</td>
                                                        <td>
                                                            <a href=\"#\" class=\"btn btn-success btn-icon-split\">
                                                                <span class=\"icon text-white-100\">
                                                                    <i class=\"fas fa-check\"></i>
                                                                </span>
                                                            </a>
                                                            <a href=\"#\" class=\"btn btn-danger btn-icon-split\" onclick=\"eliminarReserva(".$row["id_reserva"].")\">
                                                                <span class=\"icon text-white-100\">
                                                                    <i class=\"fas fa-trash\"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>";
                                            }

                                            echo "</tbody></table>";
                                        } else {
                                            echo "No hay reservas para el día de hoy después de la hora actual. id restaurante";

                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <script>
                                    $(document).ready(function () {
                                        var dataTableSA = $("#dataTableSA").DataTable(); // Guarda la referencia a la instancia DataTable

                                        setInterval(function () {
                                            $("#recarga").load("indexPC.php #recarga", function () {
                                                // Destruye la tabla actual antes de la recarga
                                                dataTableSA.destroy();

                                                // Vuelve a inicializar la tabla después de la recarga
                                                $("#dataTableSA").DataTable({
                                                    "language": {
                                                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                                                    },
                                                    "order": [[2, 'asc'], [3, 'asc']]
                                                });
                                            });
                                            console.log(1);

                                            //$.getScript("js/tdata.js");
                                        }, 50000);
                                    });
                                    function eliminarReserva(idReserva) {
                                        // Utiliza la función confirm para mostrar una ventana emergente
                                        var confirmacion = confirm("¿Estás seguro de que deseas eliminar esta reserva?");

                                        // Si el usuario hace clic en "Aceptar", entonces realiza la eliminación
                                        if (confirmacion) {
                                            $.ajax({
                                                url: 'phps/eliminar_reserva.php',
                                                type: 'POST',
                                                data: { idReserva: idReserva },
                                                success: function (response) {
                                                    console.log(response);
                                                    var dataTableSA = $("#dataTableSA").DataTable();
                                                    console.log(idReserva + " eliminado");
                                                    $("#recarga").load("indexPC.php #recarga", function () {
                                                        dataTableSA.destroy();
                                                        $("#dataTableSA").DataTable({
                                                            "language": {
                                                                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                                                            },
                                                            "order": [[2, 'asc'], [3, 'asc']]
                                                        });
                                                    });
                                                },
                                                error: function (error) {
                                                    console.error('Error al eliminar reserva:', error);
                                                }
                                            });
                                        } else {
                                            console.log("Eliminación cancelada.");
                                        }
                                    }

                                </script>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /.container-fluid -->
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!-- <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer> -->
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="phps/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            var dataTableSA = $("#dataTableSA").DataTable(); // Guarda la referencia a la instancia DataTable

            setInterval(function () {
                $("#recarga").load("indexPC.php #recarga", function () {
                    // Destruye la tabla actual antes de la recarga
                    dataTableSA.destroy();

                    // Vuelve a inicializar la tabla después de la recarga
                    $("#dataTableSA").DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                        },
                        "order": [[2, 'asc'], [3, 'asc']]
                    });
                });
                console.log(1);

                //$.getScript("js/tdata.js");
            }, 5000);
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>

    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/tdata.js"></script>
</body>

</html>