
<?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>
<form method="post" action="<?php echo site_url('login/reset_password/');?>">
    <table class="table table-striped">
        <tr>
            <td> Password Lama </td>
            <td><input type="password" name="password" value="" required="" class="form-control"></td>
        </tr>
        <tr>
            <td> Password Baru </td>
            <td><input type="password" name="passwordbaru" value="" required="" class="form-control"></td>
        </tr>
        <tr>
            <td> Ulangi Password Baru </td>
            <td><input type="password" name="passconf" value="" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
        </tr>
    </table>
</form>
<br><br>


<!--response setelah upload-->
<?php if(!empty($response)):?>
    <?php echo $response;?>
<?php endif;?>
<br><br>

