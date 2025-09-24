<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Select "Logout" below if you are ready to end your current session.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!-- Logout link -->
        <a class="btn btn-primary" href="<?= BASE_URL ?>/admin.php?action=logout">Logout</a>
      </div>
    </div>
  </div>
</div>

 <!-- Bootstrap core JavaScript -->
  <script src="<?= BASE_URL ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= BASE_URL ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript -->
  <script src="<?= BASE_URL ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- SB Admin 2 JavaScript -->
  <script src="<?= BASE_URL ?>/assets/js/sb-admin-2.min.js"></script>
</body>
</html>
