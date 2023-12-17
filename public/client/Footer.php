<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">THAY ĐỔI MẬT KHẨU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Mật khẩu cũ</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Mật khẩu mới</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="newpassword" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nhập lại mật khẩu mới</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="text" name="renewpassword" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnchangepass" class="btn btn-danger">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop2" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">CÀI ĐẶT XÓA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Thời gian xóa</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <select class="custom-select rounded-0" name="timedelete">
                                    <option value="7" <?php if($getUser['timedelete'] == 7){ echo 'selected=""'; } ?>>1 tuần</option>
                                    <option value="21" <?php if($getUser['timedelete'] == 21){ echo 'selected=""'; } ?>>3 tuần</option>
                                    <option value="30" <?php if($getUser['timedelete'] == 30){ echo 'selected=""'; } ?>>1 tháng</option>
                                    <option value="60" <?php if($getUser['timedelete'] == 60){ echo 'selected=""'; } ?>>2 tháng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btntimedelete" class="btn btn-danger">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="thongbao"></div>
<!-- jQuery -->
<script src="<?= BASE_URL('template/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= BASE_URL('template/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= BASE_URL('template/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL('template/'); ?>plugins/select2/js/select2.full.min.js"></script>
<!-- daterangepicker -->
<script src="<?= BASE_URL('template/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?= BASE_URL('template/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= BASE_URL('template/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= BASE_URL('template/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= BASE_URL('template/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASE_URL('template/'); ?>dist/js/adminlte.js"></script>
<!-- DataTables -->
<script src="<?= BASE_URL('template/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL('template/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASE_URL('template/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BASE_URL('template/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).on('click','#popupchangpass', function(e) {
        $("#staticBackdrop").modal();
        return false;
    });
    $(document).on('click','#popupsettings', function(e) {
        $("#staticBackdrop2").modal();
        return false;
    });
    $('#btnchangepass').on('click', function(e) {
        e.preventDefault();
        const password           = $('input[name="password"]').val();
        const newpassword        = $('input[name="newpassword"]').val();
        const renewpassword      = $('input[name="renewpassword"]').val();
        $.ajax({
            url: "/assets/ajaxs/Changepassword.php",
            type: "post",
            dataType: "json",
            data: {
                type: 'Changepassword',
                password: password,
                newpassword: newpassword,
                renewpassword: renewpassword,
            },
            success: function(response) {
                alert(response.content);
                $("#staticBackdrop").modal('hide');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $('#btntimedelete').on('click', function(e) {
        e.preventDefault();
        const timedelete           = $('select[name="timedelete"]').val();
        $.ajax({
            url: "/assets/ajaxs/Timedelete.php",
            type: "post",
            dataType: "json",
            data: {
                type: 'Timedelete',
                timedelete: timedelete,
            },
            success: function(response) {
                alert(response.content);
                $("#staticBackdrop2").modal('hide');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $(".select2").select2({
    //   tags: true
    });
    $(".select2").on("select2:select", function (evt) {
      var element = evt.params.data.element;
      var $element = $(element);
      $element.detach();
      $(this).append($element);
      $(this).trigger("change");
    });
</script>
</div>

</body>

</html>