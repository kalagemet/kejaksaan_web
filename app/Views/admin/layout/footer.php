</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; hamid.musafa@kejaksaan.go.id</span>
        </div>
    </div>
</footer>
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
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin mengakhiri session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href=<?php echo base_url('/logout');?>>Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<!-- <script src=<?php echo base_url("assets/js/bootstrap-3.3.7.min.js"); ?>></script> -->
<script src=<?php echo base_url("assets/vendor/jquery/jquery.min.js"); ?>></script>
<script src=<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.5.2.0.min.js"); ?>></script>
<script src=<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js"); ?>></script>

<!-- Core plugin JavaScript-->
<script src=<?php echo base_url("assets/vendor/jquery-easing/jquery.easing.min.js"); ?>></script>

<!-- Custom scripts for all pages-->
<script src=<?php echo base_url("assets/js/sb-admin-2.min.js"); ?>></script>

<?php if(isset($datatables) && $datatables){
    echo "<script src='".base_url("assets/vendor/datatables/jquery.dataTables.min.js")."'></script>
    <script src='".base_url("assets/vendor/datatables/dataTables.bootstrap4.min.js")."'></script>";
}?>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function() {
            div.style.display = "none";
        }, 600);
    }
}
</script>