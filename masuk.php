<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">KARYA LANGGENG</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                STOK BARANG
                            </a>

                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                BARANG MASUK
                            </a>

                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                BARANG KELUAR
                            </a>
                            <div class="sb-sidenav-menu-heading">EXPORT</div>
                            <a class="nav-link" href="export.php">
                                CETAK
                            </a><div class="sb-sidenav-menu-heading">KELOLA ADMIN</div>
                            <a class="nav-link" href="admin.php">
                                KELOLA AKUN
                            </a>
                            <div class="sb-sidenav-menu-heading">LOGOUT</div>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">BARANG MASUK</h1>
                      
                        <div class="card mb-4">
                            <div class="card-header">
                               <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Tambah Barang
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Masuk </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post">
                                    <div class="modal-body">
                                        <select name="barangnya" class="form-control">
                                            <?php
                                            $ambilsemuadatanya = mysqli_query($conn,"select * from stok");
                                            while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                                $namabarangnya = $fetcharray['namabarang'];
                                                $idbarangnya = $fetcharray['idbarang'];
                                            ?>
                                            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>


                                            <?php

                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <input type="number" name="qty" placeholder="Quantity" class="form-control"required>
                                        <br>
                                        <input type="text" name="penerima" placeholder="penerima" class="form-control"required>
                                        <br>
                                        <button type="submit" class="btn btn-primary" name="barangmasuk">submit</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php
                                            $ambilsemuadatastok = mysqli_query($conn,"select * from masuk m, stok s where s.idbarang = m.idbarang");
                                            while($data=mysqli_fetch_array($ambilsemuadatastok)){
                                                $idb = $data['idbarang'];
                                                $idm = $data['idmasuk'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];
                                                 
                                            ?>

                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idm;?>">
                                                  Edit
                                                </button>
                                                <input type="hidden" name="idbarangyangmaudihapus" value="<?=$idb;?>">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idm;?>">
                                                  Delete
                                                </button>
                                                </td>
                                            </tr>

                                             <!-- Edit Modal -->
                                             <div class="modal fade" id="edit<?=$idm;?>">
                                                <div class="modal-dialog" >
                                                    <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" >Edit Barang </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form method="post">
                                                    <div class="modal-body">
                                                        <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control"required>
                                                        <br>
                                                        <input type="number" name="qty" value="<?=$qty;?>" class="form-control"required>
                                                        <br>
                                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                                        <input type="hidden" name="idm" value="<?=$idm;?>">
                                                        <button type="submit" class="btn btn-warning" name="updatebarangmasuk">submit</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                <!-- Hapus Modal -->
                                                <div class="modal fade" id="delete<?=$idm;?>">
                                                <div class="modal-dialog" >
                                                    <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" >Hapus Barang </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form method="post">
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <?=$namabarang;?>?
                                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                                        <input type="hidden" name="kty" value="<?=$qty;?>">
                                                        <input type="hidden" name="idm" value="<?=$idm;?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>


                                            <?php
                                            };

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright BY AZIZ 2024</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
